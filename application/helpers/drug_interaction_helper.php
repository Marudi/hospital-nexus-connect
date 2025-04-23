<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function check_drug_interactions($medicines) {
    $CI =& get_instance();
    $CI->load->model('settings/settings_model');
    
    // Get API preference from settings
    $settings = $CI->settings_model->getSettings();
    $api_preference = isset($settings->drug_interaction_source) ? $settings->drug_interaction_source : 'openfda';
    
    $interactions = array();
    $warnings = array();
    
    // Pre-check DDInter connectivity if it's selected or part of 'both'
    $ddinter_available = true;
    if ($api_preference == 'ddinter' || $api_preference == 'both') {
        $ddinter_available = verify_ddinter_api_connectivity();
        if (!$ddinter_available) {
            error_log("DDInter API connectivity test failed - falling back to alternative API");
            // Add a system message about DDInter API unavailability
            $interactions[] = array(
                'source' => 'System Message',
                'medicines' => array('System Notice'),
                'interaction' => "<strong>API Connection Notice</strong><br><br>The DDInter API is currently unavailable. The system will use " . 
                    ($api_preference == 'both' ? "only alternative sources" : "OpenFDA as a fallback") . 
                    " for interaction checking. Please contact your system administrator if this persists."
            );
            
            // If DDInter was the only selected source, switch to OpenFDA as fallback
            if ($api_preference == 'ddinter') {
                $api_preference = 'openfda';
            }
        }
    }
    
    // Check interactions for each pair of medicines
    if (count($medicines) > 1) {
        for ($i = 0; $i < count($medicines); $i++) {
            for ($j = $i + 1; $j < count($medicines); $j++) {
                $med1 = trim($medicines[$i]);
                $med2 = trim($medicines[$j]);
                
                // Skip empty medicines
                if (empty($med1) || empty($med2)) {
                    continue;
                }
                
                $interaction_result = null;
                
                // Check OpenFDA if configured
                if ($api_preference == 'openfda' || $api_preference == 'both') {
                    $interaction_result = check_openfda_interaction($med1, $med2);
                }
                
                // Check DrugBank if configured and no result from OpenFDA
                if (empty($interaction_result) && ($api_preference == 'drugbank' || $api_preference == 'both')) {
                    $interaction_result = check_drugbank_interaction($med1, $med2);
                }
                
                // Check DDInter if configured and no result from other sources
                if (empty($interaction_result) && $ddinter_available && ($api_preference == 'ddinter' || $api_preference == 'both')) {
                    error_log("Checking DDInter interaction for $med1 and $med2");
                    $interaction_result = check_ddinter_interaction($med1, $med2);
                    
                    // If DDInter failed but we have other options, try them as fallback
                    if (!empty($interaction_result) && $interaction_result['source'] == 'System Message' && strpos($interaction_result['interaction'], 'API Connection Error') !== false) {
                        error_log("DDInter API failed for interaction check between $med1 and $med2 - trying fallback");
                        
                        // Try OpenFDA as fallback if not already tried
                        if ($api_preference != 'openfda' && $api_preference != 'both') {
                            $interaction_result = check_openfda_interaction($med1, $med2);
                        }
                        
                        // If still no results, try DrugBank as final fallback
                        if ((empty($interaction_result) || ($interaction_result['source'] == 'System Message' && strpos($interaction_result['interaction'], 'API Connection Error') !== false)) 
                            && $api_preference != 'drugbank' && $api_preference != 'both') {
                            $interaction_result = check_drugbank_interaction($med1, $med2);
                        }
                    }
                }
                
                // Add the result to the interactions array
                if (!empty($interaction_result)) {
                    $interactions[] = $interaction_result;
                    error_log("Added interaction result for $med1 and $med2 from source: " . $interaction_result['source']);
                } else {
                    error_log("No interaction found for $med1 and $med2 from any source");
                }
                
                // If no results from any API and both were checked, add a default warning
                if (empty($interaction_result) && $api_preference == 'both') {
                    $interactions[] = array(
                        'source' => 'System',
                        'medicines' => array($med1, $med2),
                        'interaction' => 'Potential drug interaction detected. Please verify the safety of using these medications together.'
                    );
                }
            }
        }
    }
    
    // Check individual medicine warnings
    foreach ($medicines as $medicine) {
        $medicine = trim($medicine);
        
        if (empty($medicine)) {
            continue;
        }
        
        // Check OpenFDA warnings if configured
        if ($api_preference == 'openfda' || $api_preference == 'both') {
            $warning = check_openfda_warnings($medicine);
            if (!empty($warning)) {
                $warnings[] = $warning;
            }
        }
        
        // Check DrugBank warnings if configured
        if ($api_preference == 'drugbank' || $api_preference == 'both') {
            $drugbank_warning = check_drugbank_warnings($medicine);
            if (!empty($drugbank_warning)) {
                $warnings[] = $drugbank_warning;
            }
        }
        
        // Check DDInter warnings if configured and available
        if ($ddinter_available && ($api_preference == 'ddinter' || $api_preference == 'both')) {
            $ddinter_warning = check_ddinter_warnings($medicine);
            if (!empty($ddinter_warning)) {
                $warnings[] = $ddinter_warning;
                error_log("Added DDInter warning for $medicine");
            }
        }
    }
    
    return array('interactions' => $interactions, 'warnings' => $warnings);
}

function check_openfda_interaction($med1, $med2) {
    // First try exact match
    $api_url = "https://api.fda.gov/drug/label.json";
    $query = "?search=(generic_name:" . urlencode($med1) . "+AND+drug_interactions:" . urlencode($med2) . ")+OR+(generic_name:" . urlencode($med2) . "+AND+drug_interactions:" . urlencode($med1) . ")&limit=1";
    
    try {
        $response = @file_get_contents($api_url . $query);
        if ($response) {
            $data = json_decode($response, true);
            if (!empty($data['results'])) {
                foreach ($data['results'] as $result) {
                    if (!empty($result['drug_interactions'])) {
                        // Search for interactions mentioning both drugs
                        foreach ($result['drug_interactions'] as $interaction) {
                            if (stripos($interaction, $med1) !== false && stripos($interaction, $med2) !== false) {
                                // Format and summarize the interaction data
                                $formatted_interaction = format_interaction_text($interaction, $med1, $med2);
                                
                                return array(
                                    'source' => 'OpenFDA',
                                    'medicines' => array($med1, $med2),
                                    'interaction' => $formatted_interaction
                                );
                            }
                        }
                    }
                }
            }
        }
        
        // Try broader search if exact match fails
        $query = "?search=drug_interactions:(" . urlencode($med1) . ")+AND+drug_interactions:(" . urlencode($med2) . ")&limit=1";
        $response = @file_get_contents($api_url . $query);
        if ($response) {
            $data = json_decode($response, true);
            if (!empty($data['results'])) {
                foreach ($data['results'] as $result) {
                    if (!empty($result['drug_interactions'])) {
                        // Concatenate all drug interactions for better context
                        $full_interaction_text = implode(" ", $result['drug_interactions']);
                        $formatted_interaction = format_interaction_text($full_interaction_text, $med1, $med2);
                        
                        return array(
                            'source' => 'OpenFDA',
                            'medicines' => array($med1, $med2),
                            'interaction' => $formatted_interaction
                        );
                    }
                }
            }
        }
        
        // Try even broader search for more results
        $query = "?search=(drug_interactions:" . urlencode($med1) . ")+OR+(drug_interactions:" . urlencode($med2) . ")&limit=3";
        $response = @file_get_contents($api_url . $query);
        if ($response) {
            $data = json_decode($response, true);
            if (!empty($data['results'])) {
                $all_interactions = array();
                
                foreach ($data['results'] as $result) {
                    if (!empty($result['drug_interactions'])) {
                        // Extract text containing both drug names where possible
                        foreach ($result['drug_interactions'] as $interaction) {
                            if ((stripos($interaction, $med1) !== false && stripos($interaction, $med2) !== false) ||
                                (stripos($interaction, $med1) !== false && stripos($interaction, 'anticoagulant') !== false) ||
                                (stripos($interaction, $med2) !== false && stripos($interaction, 'anticoagulant') !== false) ||
                                (stripos($interaction, $med1) !== false && (stripos($interaction, 'interact') !== false || stripos($interaction, 'interaction') !== false)) ||
                                (stripos($interaction, $med2) !== false && (stripos($interaction, 'interact') !== false || stripos($interaction, 'interaction') !== false))) {
                                $all_interactions[] = $interaction;
                            }
                        }
                    }
                }
                
                if (!empty($all_interactions)) {
                    $full_interaction_text = implode(" ", $all_interactions);
                    $formatted_interaction = format_interaction_text($full_interaction_text, $med1, $med2);
                    
                    return array(
                        'source' => 'OpenFDA',
                        'medicines' => array($med1, $med2),
                        'interaction' => $formatted_interaction
                    );
                }
            }
        }
    } catch (Exception $e) {
        // Log error but continue
        error_log("OpenFDA API Error: " . $e->getMessage());
        
        // Return API connection error message
        return array(
            'source' => 'System Message',
            'medicines' => array($med1, $med2),
            'interaction' => "<strong>API Connection Error</strong><br><br>The system cannot reach the OpenFDA API at this time. This is a connection issue with the external service, not a problem with the medications you selected.<br><br>Please try again later or contact your system administrator if this issue persists."
        );
    }
    
    return null;
}

/**
 * Format and summarize drug interaction text to make it more readable
 * 
 * @param string $text The raw interaction text
 * @param string $med1 First medicine name
 * @param string $med2 Second medicine name
 * @return string Formatted interaction text
 */
function format_interaction_text($text, $med1, $med2) {
    // Remove excessive whitespace
    $text = preg_replace('/\s+/', ' ', $text);
    
    // Split into sentences (imperfect but helps)
    $sentences = preg_split('/(?<=[.!?])\s+/', $text);
    
    // Find the most relevant sentences mentioning both drugs
    $relevant_sentences = array();
    $found_clinical_impact = false;
    $found_intervention = false;
    
    // First priority - extract clinical impact and intervention sections if present
    foreach ($sentences as $sentence) {
        // Look for key sections without truncation
        if (stripos($sentence, 'Clinical Impact:') !== false || stripos($sentence, 'Clinical Impact') !== false) {
            $found_clinical_impact = true;
            $relevant_sentences[] = '<strong>Clinical Impact:</strong> ' . trim(str_ireplace('Clinical Impact:', '', $sentence));
        } 
        else if (stripos($sentence, 'Intervention:') !== false || stripos($sentence, 'Intervention') !== false) {
            $found_intervention = true;
            $relevant_sentences[] = '<strong>Intervention:</strong> ' . trim(str_ireplace('Intervention:', '', $sentence));
        }
    }
    
    // Second priority - look for sentences mentioning the drugs
    foreach ($sentences as $sentence) {
        if ((stripos($sentence, $med1) !== false || stripos($sentence, $med2) !== false)) {
            // Skip if we already have this exact sentence
            if (in_array($sentence, $relevant_sentences)) {
                continue;
            }
            
            // Include the sentence without truncation
            if (!$found_clinical_impact && stripos($sentence, 'may increase') !== false || 
                stripos($sentence, 'inhibit') !== false || 
                stripos($sentence, 'effect') !== false ||
                stripos($sentence, 'risk') !== false) {
                $relevant_sentences[] = $sentence;
            } else if (count($relevant_sentences) < 5) {
                $relevant_sentences[] = $sentence;
            }
        }
    }
    
    // If still no results, try to extract meaningful content from the text
    if (count($relevant_sentences) < 2) {
        // Look for common patterns in drug interaction text
        $patterns = array(
            '/monitor patients.{5,500}?[.!?]/i',
            '/may (increase|decrease|affect).{5,500}?[.!?]/i',
            '/(elevated risk|increased risk|risk of).{5,500}?[.!?]/i',
            '/(bleeding|hemorrhage).{5,500}?[.!?]/i',
            '/(warfarin|anticoagulant).{5,500}?[.!?]/i',
            '/(interaction|interacts with).{5,500}?[.!?]/i'
        );
        
        foreach ($patterns as $pattern) {
            if (preg_match_all($pattern, $text, $matches)) {
                foreach ($matches[0] as $match) {
                    if (!in_array($match, $relevant_sentences)) {
                        $relevant_sentences[] = $match;
                    }
                    
                    // Limit to 5 most relevant sentences
                    if (count($relevant_sentences) >= 5) {
                        break 2;
                    }
                }
            }
        }
    }
    
    // If still not enough, use the first 500 characters or more of the original text
    if (empty($relevant_sentences)) {
        $full_text = $text;
        
        return "<strong>Potential interaction detected between $med1 and $med2.</strong><br><br>" . $full_text;
    }
    
    // Add standard headers if not found in text
    $formatted_text = "<strong>Potential interaction between $med1 and $med2</strong><br><br>";
    
    if (!$found_clinical_impact) {
        $formatted_text .= "<strong>Clinical Impact:</strong> These medications may interact and cause adverse effects.<br><br>";
    }
    
    $formatted_text .= implode("<br><br>", $relevant_sentences);
    
    if (!$found_intervention) {
        $formatted_text .= "<br><br><strong>Recommendation:</strong> Monitor patient carefully when using these medications together.";
    }
    
    return $formatted_text;
}

function check_drugbank_interaction($med1, $med2) {
    $CI =& get_instance();
    $CI->load->model('settings/settings_model');
    $settings = $CI->settings_model->getSettings();
    
    // Get DrugBank API key from settings
    $api_key = isset($settings->drugbank_api_key) ? $settings->drugbank_api_key : '';
    
    if (empty($api_key)) {
        error_log("DrugBank API key not configured");
        return array(
            'source' => 'System Message',
            'medicines' => array($med1, $med2),
            'interaction' => "<strong>API Configuration Error</strong><br><br>The DrugBank API key is not configured in your system. Please contact your system administrator to set up the API key for drug interaction checking."
        );
    }
    
    // DrugBank API endpoint for interactions
    $api_url = "https://api.drugbank.com/v1/drug_interactions";
    
    // First, search for drug IDs
    $drug1_id = get_drugbank_drug_id($med1, $api_key);
    $drug2_id = get_drugbank_drug_id($med2, $api_key);
    
    if (empty($drug1_id) || empty($drug2_id)) {
        return array(
            'source' => 'System Message',
            'medicines' => array($med1, $med2),
            'interaction' => "<strong>Medication Not Found</strong><br><br>One or both medications could not be found in the DrugBank database. Please check the spelling or try different medication names."
        );
    }
    
    try {
        // Prepare API request
        $headers = array(
            'Authorization: Bearer ' . $api_key,
            'Content-Type: application/json',
            'Accept: application/json'
        );
        
        // Set up cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url . "?drug_id=" . urlencode($drug1_id) . "&interacting_drug_id=" . urlencode($drug2_id));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // Execute the request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Process the response
        if ($http_code == 200 && !empty($response)) {
            $data = json_decode($response, true);
            
            if (!empty($data) && isset($data['interactions']) && count($data['interactions']) > 0) {
                $interaction = $data['interactions'][0];
                $description = isset($interaction['description']) ? $interaction['description'] : 'Potential interaction detected between these medications.';
                $severity = isset($interaction['severity']) ? $interaction['severity'] : 'Unknown';
                
                // Format the interaction in HTML
                $formatted_interaction = format_drugbank_interaction($description, $med1, $med2, $severity);
                
                return array(
                    'source' => 'DrugBank',
                    'medicines' => array($med1, $med2),
                    'interaction' => $formatted_interaction,
                    'severity' => $severity
                );
            }
        } else {
            error_log("DrugBank API Error: HTTP Code " . $http_code);
            error_log("DrugBank API Response: " . $response);
        }
    } catch (Exception $e) {
        error_log("DrugBank API Error: " . $e->getMessage());
        return array(
            'source' => 'System Message',
            'medicines' => array($med1, $med2),
            'interaction' => "<strong>API Connection Error</strong><br><br>The system cannot reach the DrugBank API at this time. This is a connection issue with the external service, not a problem with the medications you selected.<br><br>Please try again later or contact your system administrator if this issue persists."
        );
    }
    
    return null;
}

/**
 * Format DrugBank interaction text to make it more readable
 * 
 * @param string $description The interaction description
 * @param string $med1 First medicine name
 * @param string $med2 Second medicine name
 * @param string $severity Interaction severity
 * @return string Formatted interaction text
 */
function format_drugbank_interaction($description, $med1, $med2, $severity) {
    // Create a formatted heading
    $formatted_text = "<strong>Potential interaction between $med1 and $med2</strong><br><br>";
    
    // Add severity indicator
    $severity_class = '';
    switch (strtolower($severity)) {
        case 'major':
            $severity_class = 'text-danger';
            break;
        case 'moderate':
            $severity_class = 'text-warning';
            break;
        case 'minor':
            $severity_class = 'text-info';
            break;
        default:
            $severity_class = 'text-secondary';
    }
    
    $formatted_text .= "<strong>Severity:</strong> <span class='$severity_class'>" . ucfirst($severity) . "</span><br><br>";
    
    // Add clinical impact section
    $formatted_text .= "<strong>Clinical Impact:</strong> " . $description . "<br><br>";
    
    // Add recommendation section
    $recommendation = get_recommendation_by_severity($severity);
    $formatted_text .= "<strong>Recommendation:</strong> " . $recommendation;
    
    return $formatted_text;
}

/**
 * Get recommendation based on the severity level
 * 
 * @param string $severity Severity level
 * @return string Recommendation text
 */
function get_recommendation_by_severity($severity) {
    switch (strtolower($severity)) {
        case 'major':
        case 'high':
        case 'severe':
            return "Avoid concurrent use of these medications if possible. If combination cannot be avoided, monitor patient very closely for adverse effects and consider dose adjustments.";
        case 'moderate':
        case 'medium':
            return "Use caution when combining these medications. Monitor patient for potential adverse effects and consider adjusting dosages if necessary.";
        case 'minor':
        case 'low':
            return "The interaction between these medications is generally minor. Monitor patient as usual and be aware of potential interaction effects.";
        default:
            return "Monitor patient carefully when using these medications together.";
    }
}

function get_drugbank_drug_id($drug_name, $api_key) {
    $api_url = "https://api.drugbank.com/v1/drugs/search";
    
    try {
        // Prepare API request
        $headers = array(
            'Authorization: Bearer ' . $api_key,
            'Content-Type: application/json',
            'Accept: application/json'
        );
        
        // Set up cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url . "?q=" . urlencode($drug_name));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // Execute the request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Process the response
        if ($http_code == 200 && !empty($response)) {
            $data = json_decode($response, true);
            
            if (!empty($data) && isset($data['drugs']) && count($data['drugs']) > 0) {
                // Return the first drug match ID
                return $data['drugs'][0]['id'];
            }
        }
    } catch (Exception $e) {
        error_log("DrugBank Search API Error: " . $e->getMessage());
    }
    
    return null;
}

function check_drugbank_warnings($medicine) {
    $CI =& get_instance();
    $CI->load->model('settings/settings_model');
    $settings = $CI->settings_model->getSettings();
    
    // Get DrugBank API key from settings
    $api_key = isset($settings->drugbank_api_key) ? $settings->drugbank_api_key : '';
    
    if (empty($api_key)) {
        return array(
            'source' => 'System Message',
            'medicine' => $medicine,
            'warnings' => array(
                'warnings' => array('API Configuration Error: The DrugBank API key is not configured in your system. Please contact your system administrator to set up the API key for drug interaction checking.')
            )
        );
    }
    
    // First, get the drug ID
    $drug_id = get_drugbank_drug_id($medicine, $api_key);
    
    if (empty($drug_id)) {
        return array(
            'source' => 'System Message',
            'medicine' => $medicine,
            'warnings' => array(
                'warnings' => array('Medication Not Found: This medication could not be found in the DrugBank database. Please check the spelling or try a different medication name.')
            )
        );
    }
    
    // DrugBank API endpoint for drug info
    $api_url = "https://api.drugbank.com/v1/drugs/{$drug_id}";
    
    try {
        // Prepare API request
        $headers = array(
            'Authorization: Bearer ' . $api_key,
            'Content-Type: application/json',
            'Accept: application/json'
        );
        
        // Set up cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // Execute the request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Process the response
        if ($http_code == 200 && !empty($response)) {
            $data = json_decode($response, true);
            
            if (!empty($data)) {
                $warnings = array();
                
                // Extract warnings, precautions and other relevant safety information
                if (isset($data['warnings']) && !empty($data['warnings'])) {
                    $warnings['boxed_warnings'] = array($data['warnings']);
                }
                
                if (isset($data['contraindications']) && !empty($data['contraindications'])) {
                    $warnings['warnings'] = array($data['contraindications']);
                }
                
                if (isset($data['precautions']) && !empty($data['precautions'])) {
                    $warnings['precautions'] = array($data['precautions']);
                }
                
                if (!empty($warnings)) {
                    return array(
                        'source' => 'DrugBank',
                        'medicine' => $medicine,
                        'warnings' => $warnings
                    );
                }
            }
        }
    } catch (Exception $e) {
        error_log("DrugBank API Error: " . $e->getMessage());
        return array(
            'source' => 'System Message',
            'medicine' => $medicine,
            'warnings' => array(
                'warnings' => array('API Connection Error: The system cannot reach the DrugBank API at this time. This is a connection issue with the external service. Please try again later or contact your system administrator if this issue persists.')
            )
        );
    }
    
    return null;
}

function check_openfda_warnings($medicine) {
    $api_url = "https://api.fda.gov/drug/label.json";
    $query = "?search=(generic_name:" . urlencode($medicine) . "+OR+brand_name:" . urlencode($medicine) . ")&limit=1";
    
    try {
        $response = @file_get_contents($api_url . $query);
        if ($response) {
            $data = json_decode($response, true);
            if (!empty($data['results'])) {
                $result = $data['results'][0];
                $warnings = array();
                
                // Get boxed warnings if available
                if (!empty($result['boxed_warning'])) {
                    $warnings['boxed_warnings'] = array($result['boxed_warning'][0]);
                }
                
                // Get general warnings
                if (!empty($result['warnings'])) {
                    $warnings['warnings'] = array($result['warnings'][0]);
                }
                
                // Get precautions
                if (!empty($result['precautions'])) {
                    $warnings['precautions'] = array($result['precautions'][0]);
                }
                
                if (!empty($warnings)) {
                    return array(
                        'source' => 'OpenFDA',
                        'medicine' => $medicine,
                        'warnings' => $warnings
                    );
                }
            }
        }
    } catch (Exception $e) {
        // Log error but continue
        error_log("OpenFDA API Error: " . $e->getMessage());
        
        // Return API connection error message
        return array(
            'source' => 'System Message',
            'medicine' => $medicine,
            'warnings' => array(
                'warnings' => array('API Connection Error: The system cannot reach the OpenFDA API at this time. This is a connection issue with the external service. Please try again later or contact your system administrator if this issue persists.')
            )
        );
    }
    
    return null;
}

/**
 * Check for drug interactions using the DDInter API
 * Uses DDInter database to check for drug-drug interactions
 * 
 * @param string $med1 First medicine name
 * @param string $med2 Second medicine name
 * @return array|null Interaction data or null if no interaction found
 */
function check_ddinter_interaction($med1, $med2) {
    // Verify if the server can connect to the DDInter API
    if (!verify_ddinter_api_connectivity()) {
        return array(
            'source' => 'System Message',
            'medicines' => array($med1, $med2),
            'interaction' => "<strong>API Connection Error</strong><br><br>The system cannot reach the DDInter API at this time. Possible causes:<br>1. Server network restrictions<br>2. DDInter API may be down<br>3. Server configuration issues<br><br>Please try using a different drug interaction source in the settings (OpenFDA or DrugBank) until this is resolved."
        );
    }
    
    // Clean drug names for better matching
    $med1 = trim($med1);
    $med2 = trim($med2);
    
    error_log("DDInter API: Checking interaction between $med1 and $med2");
    
    // Get DDInter interaction data
    $interaction_data = get_ddinter_interaction_data($med1, $med2);
    
    if (!empty($interaction_data)) {
        // Format the interaction data for display
        $formatted_interaction = format_ddinter_interaction($interaction_data, $med1, $med2);
        
        return array(
            'source' => 'DDInter',
            'medicines' => array($med1, $med2),
            'interaction' => $formatted_interaction
        );
    }
    
    // If no specific interaction was found, provide a helpful message
    error_log("DDInter API: No interaction data found between $med1 and $med2");
    return array(
        'source' => 'DDInter',
        'medicines' => array($med1, $med2),
        'interaction' => "<strong>Interaction Data Not Available</strong><br><br>The DDInter database did not return any specific interaction information between $med1 and $med2. <span class='text-danger'>This does NOT mean these medications are safe to use together.</span><br><br>Some interactions may not be detected by the automated system. It is essential to:<br>1. Consult your healthcare provider or pharmacist before combining these medications<br>2. Consider checking additional drug interaction resources<br>3. Monitor for unexpected side effects if these medications are used together"
    );
} 

/**
 * Verify if the server can connect to the DDInter API
 * This performs a simple connectivity test to check if the server can reach DDInter servers
 * 
 * @return bool True if connection is successful, false otherwise
 */
function verify_ddinter_api_connectivity() {
    static $connectivity_verified = null;
    
    // If we've already checked connectivity in this request, return the cached result
    if ($connectivity_verified !== null) {
        return $connectivity_verified;
    }
    
    error_log("Verifying DDInter API connectivity...");
    
    // DDInter base URL - updated to use the service endpoint
    $base_url = "https://ddinter.scbdd.com/service/api/";
    
    // Try with curl
    if (function_exists('curl_init')) {
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);
        
        error_log("DDInter API connectivity test (curl): HTTP $http_code, Error: $curl_error");
        
        if ($http_code >= 200 && $http_code < 400) {
            $connectivity_verified = true;
            return true;
        }
    }
    
    // If curl failed or is not available, try with file_get_contents
    try {
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'HEAD',
                'timeout' => 5,
                'ignore_errors' => true
            ),
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false
            )
        ));
        
        $response = @file_get_contents($base_url, false, $context);
        
        if ($response !== false) {
            $connectivity_verified = true;
            error_log("DDInter API connectivity test (file_get_contents): Success");
            return true;
        }
    } catch (Exception $e) {
        error_log("DDInter API connectivity test exception: " . $e->getMessage());
    }
    
    // All connection attempts failed
    $connectivity_verified = false;
    error_log("DDInter API connectivity test: All methods failed. Server cannot connect to DDInter API");
    return false;
}

/**
 * Get drug-drug interaction data from DDInter
 * 
 * @param string $med1 First medicine name
 * @param string $med2 Second medicine name
 * @return array|null Interaction data or null if no interaction found
 */
function get_ddinter_interaction_data($med1, $med2) {
    // Actual DDInter API endpoint for drug-drug interactions
    $api_url = "https://ddinter.scbdd.com/service/api/ddi/";
    
    // Set up request parameters
    $params = array(
        'drug1' => urlencode($med1),
        'drug2' => urlencode($med2),
        'format' => 'json'
    );
    
    $query_string = http_build_query($params);
    $request_url = $api_url . "?" . $query_string;
    
    // Make API request
    $result = make_ddinter_api_request($request_url);
    
    if ($result['success'] && !empty($result['data'])) {
        error_log("DDInter API: Found interaction data for $med1 and $med2");
        return $result['data'];
    }
    
    // If the first attempt fails, try with the search endpoint
    error_log("DDInter API: First attempt failed, trying search endpoint");
    
    // Use the search endpoint as fallback
    $fallback_url = "https://ddinter.scbdd.com/service/api/search/";
    $params = array(
        'query' => urlencode("$med1 $med2"),
        'format' => 'json'
    );
    $query_string = http_build_query($params);
    $request_url = $fallback_url . "?" . $query_string;
    
    $result = make_ddinter_api_request($request_url);
    
    if ($result['success'] && !empty($result['data'])) {
        error_log("DDInter API: Found interaction data using fallback approach");
        return $result['data'];
    }
    
    error_log("DDInter API: No interaction data found for $med1 and $med2");
    return null;
}

/**
 * Format DDInter interaction data into a readable HTML format
 * 
 * @param array $interaction_data Raw interaction data from DDInter API
 * @param string $med1 First medicine name
 * @param string $med2 Second medicine name
 * @return string Formatted HTML
 */
function format_ddinter_interaction($interaction_data, $med1, $med2) {
    // Create a formatted heading
    $formatted_text = "<strong>Potential interaction between $med1 and $med2</strong><br><br>";
    
    // Extract and format severity if available
    if (isset($interaction_data['interaction']['severity'])) {
        $severity = $interaction_data['interaction']['severity'];
        $severity_class = get_severity_class($severity);
        $formatted_text .= "<strong>Severity:</strong> <span class='$severity_class'>" . ucfirst($severity) . "</span><br><br>";
    }
    
    // Extract and format mechanism if available
    if (isset($interaction_data['interaction']['mechanism'])) {
        $formatted_text .= "<strong>Mechanism:</strong> " . $interaction_data['interaction']['mechanism'] . "<br><br>";
    } elseif (isset($interaction_data['mechanism'])) {
        $formatted_text .= "<strong>Mechanism:</strong> " . $interaction_data['mechanism'] . "<br><br>";
    }
    
    // Extract and format clinical impact if available
    if (isset($interaction_data['interaction']['description'])) {
        $formatted_text .= "<strong>Clinical Impact:</strong> " . $interaction_data['interaction']['description'] . "<br><br>";
    } elseif (isset($interaction_data['description'])) {
        $formatted_text .= "<strong>Clinical Impact:</strong> " . $interaction_data['description'] . "<br><br>";
    }
    
    // Extract and format management strategy if available
    if (isset($interaction_data['interaction']['management'])) {
        $formatted_text .= "<strong>Management Strategy:</strong> " . $interaction_data['interaction']['management'] . "<br><br>";
    } elseif (isset($interaction_data['management'])) {
        $formatted_text .= "<strong>Management Strategy:</strong> " . $interaction_data['management'] . "<br><br>";
    }
    
    // Extract and format recommendation if available
    if (isset($interaction_data['interaction']['recommendation'])) {
        $formatted_text .= "<strong>Recommendation:</strong> " . $interaction_data['interaction']['recommendation'] . "<br><br>";
    } elseif (isset($interaction_data['recommendation'])) {
        $formatted_text .= "<strong>Recommendation:</strong> " . $interaction_data['recommendation'] . "<br><br>";
    } else {
        // Default recommendation based on severity if available
        if (isset($interaction_data['interaction']['severity'])) {
            $formatted_text .= "<strong>Recommendation:</strong> " . get_recommendation_by_severity($interaction_data['interaction']['severity']);
        } elseif (isset($interaction_data['severity'])) {
            $formatted_text .= "<strong>Recommendation:</strong> " . get_recommendation_by_severity($interaction_data['severity']);
        } else {
            $formatted_text .= "<strong>Recommendation:</strong> Monitor patient carefully when using these medications together.";
        }
    }
    
    // Add source attribution
    $formatted_text .= "<br><small>Source: DDInter Database (https://ddinter.scbdd.com/)</small>";
    
    return $formatted_text;
}

/**
 * Check for individual drug warnings from DDInter
 * 
 * @param string $medicine Medicine name
 * @return array|null Warning data or null if no warnings found
 */
function check_ddinter_warnings($medicine) {
    $medicine = trim($medicine);
    error_log("DDInter API: Checking warnings for $medicine");
    
    // Actual DDInter API endpoint for drug information
    $api_url = "https://ddinter.scbdd.com/service/api/drug/";
    
    // Set up request parameters
    $params = array(
        'name' => urlencode($medicine),
        'format' => 'json'
    );
    
    $query_string = http_build_query($params);
    $request_url = $api_url . "?" . $query_string;
    
    // Make API request
    $result = make_ddinter_api_request($request_url);
    
    if ($result['success'] && !empty($result['data'])) {
        $warnings = array();
        
        // Extract warnings from response
        if (isset($result['data']['warnings']) && is_array($result['data']['warnings'])) {
            $warnings['warnings'] = $result['data']['warnings'];
        } elseif (isset($result['data']['warnings']) && is_string($result['data']['warnings'])) {
            $warnings['warnings'] = array($result['data']['warnings']);
        }
        
        if (isset($result['data']['precautions']) && is_array($result['data']['precautions'])) {
            $warnings['precautions'] = $result['data']['precautions'];
        } elseif (isset($result['data']['precautions']) && is_string($result['data']['precautions'])) {
            $warnings['precautions'] = array($result['data']['precautions']);
        }
        
        if (isset($result['data']['contraindications']) && is_array($result['data']['contraindications'])) {
            $warnings['boxed_warnings'] = $result['data']['contraindications'];
        } elseif (isset($result['data']['contraindications']) && is_string($result['data']['contraindications'])) {
            $warnings['boxed_warnings'] = array($result['data']['contraindications']);
        }
        
        if (!empty($warnings)) {
            return array(
                'source' => 'DDInter',
                'medicine' => $medicine,
                'warnings' => $warnings
            );
        }
    }
    
    // If no warnings found, return a default message
    return array(
        'source' => 'DDInter',
        'medicine' => $medicine,
        'warnings' => array(
            'warnings' => array('No specific warnings were found for this medication in the DDInter database. This does not necessarily mean the medication is completely without risks. Please consult your healthcare provider for complete information.')
        )
    );
}

/**
 * Utility function to make DDInter API requests
 * 
 * @param string $url The full API URL including query parameters
 * @param int $retries Number of retries on failure (default: 1)
 * @return array Response data containing 'success', 'data', 'http_code', and 'error'
 */
function make_ddinter_api_request($url, $retries = 1) {
    $result = array(
        'success' => false,
        'data' => null,
        'http_code' => 0,
        'error' => ''
    );
    
    $attempt = 0;
    
    // Log the API request attempt (for debugging)
    error_log("DDInter API Request: $url");
    
    while ($attempt <= $retries && !$result['success']) {
        if ($attempt > 0) {
            // Increase backoff delay between retries
            $delay = 1000000 * $attempt; // 1s, 2s, 3s...
            usleep($delay);
            error_log("DDInter API Retry #$attempt after " . ($delay/1000000) . "s delay");
        }
        
        $attempt++;
        
        // Try with CURL
        if (function_exists('curl_init')) {
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; HealthcareApp/1.0)');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Accept: application/json',
                    'Connection: keep-alive'
                ));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_FAILONERROR, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
                
                // Execute the request
                $response = curl_exec($ch);
                $result['http_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $result['error'] = curl_error($ch);
                
                // Debug information
                $info = curl_getinfo($ch);
                error_log("DDInter API: Time: " . $info['total_time'] . "s, Size: " . $info['size_download'] . " bytes, Speed: " . $info['speed_download'] . " bytes/s");
                
                curl_close($ch);
                
                // Process successful response
                if ($response && ($result['http_code'] >= 200 && $result['http_code'] < 300)) {
                    // Try to decode the JSON response
                    $decoded = json_decode($response, true);
                    
                    // Check if JSON was valid
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        error_log("DDInter API JSON parsing error: " . json_last_error_msg());
                        error_log("Response body (first 200 chars): " . substr($response, 0, 200));
                        $result['error'] = "JSON parsing error: " . json_last_error_msg();
                        continue;
                    }
                    
                    $result['data'] = $decoded;
                    $result['success'] = true;
                    error_log("DDInter API Success on attempt $attempt via CURL");
                    return $result;
                } else if ($response) {
                    // We got a response but not a 2xx status code
                    error_log("DDInter API Received HTTP {$result['http_code']} response");
                    error_log("Response body (first 200 chars): " . substr($response, 0, 200));
                }
                
            } catch (Exception $e) {
                $result['error'] = $e->getMessage();
                error_log("DDInter API CURL Exception on attempt $attempt: " . $e->getMessage());
            }
        } else {
            error_log("CURL is not available on this server. Will try file_get_contents");
        }
        
        // If curl failed or is not available, try with file_get_contents
        if (!$result['success']) {
            error_log("DDInter API: Trying with file_get_contents as fallback");
            
            try {
                // Set up a stream context to mimic curl options
                $context = stream_context_create(array(
                    'http' => array(
                        'method' => 'GET',
                        'header' => "Accept: application/json\r\n" .
                                   "User-Agent: Mozilla/5.0 (compatible; HealthcareApp/1.0)\r\n" .
                                   "Connection: close\r\n",
                        'timeout' => 30,
                        'follow_location' => 1,
                        'max_redirects' => 5,
                        'ignore_errors' => true
                    ),
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false
                    )
                ));
                
                // Try direct URL
                $response = @file_get_contents($url, false, $context);
                
                // Check if we got a response
                if ($response !== false) {
                    $http_response_header = isset($http_response_header) ? $http_response_header : array();
                    $status_line = isset($http_response_header[0]) ? $http_response_header[0] : '';
                    preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
                    $status = $match[1] ?? 0;
                    
                    error_log("DDInter API file_get_contents status: $status");
                    
                    // Process successful response
                    if ($status >= 200 && $status < 300) {
                        // Try to decode the JSON response
                        $decoded = json_decode($response, true);
                        
                        // Check if JSON was valid
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            error_log("DDInter API JSON parsing error: " . json_last_error_msg());
                            error_log("Response body (first 200 chars): " . substr($response, 0, 200));
                            continue;
                        }
                        
                        $result['data'] = $decoded;
                        $result['success'] = true;
                        $result['http_code'] = $status;
                        error_log("DDInter API Success on attempt $attempt via file_get_contents");
                        return $result;
                    }
                }
            } catch (Exception $e) {
                error_log("DDInter API file_get_contents Exception: " . $e->getMessage());
            }
        }
    }
    
    error_log("DDInter API Failed after $attempt attempts with all methods");
    return $result;
}

/**
 * Get severity class for CSS styling based on severity level
 * 
 * @param string $severity Severity level
 * @return string CSS class name
 */
function get_severity_class($severity) {
    switch (strtolower($severity)) {
        case 'major':
        case 'high':
        case 'severe':
            return 'text-danger';
        case 'moderate':
        case 'medium':
            return 'text-warning';
        case 'minor':
        case 'low':
            return 'text-info';
        default:
            return 'text-secondary';
    }
}

/**
 * 
 * @param string $medicine Medicine name
 * @return array|null Warning data or null if no warnings found
 */

/**
 * 
 * @param string $url The full API URL including query parameters
 * @param int $retries Number of retries on failure (default: 1)
 * @return array Response data containing 'success', 'data', 'http_code', and 'error'
 */
 
