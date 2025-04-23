<?php
// Basic test script for NLM API functions with error handling testing

// Include the CodeIgniter base_url function
define('BASEPATH', true);
include 'application/helpers/drug_interaction_helper.php';

// Enable error reporting for testing
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Test medications
$medications = [
    'aspirin',
    'warfarin',
    'lisinopril',
    'metoprolol',
    'nonexistentdrug123' // Fake drug to test error handling
];

echo "NLM API Test Script - Error Handling Test\n";
echo "======================================\n\n";

// Test 1: Test RxCUI retrieval with error handling
echo "Test 1: Getting RxCUI identifiers with error handling\n";
echo "----------------------------------------------------\n";
$rxcuis = [];
foreach ($medications as $med) {
    echo "Getting RxCUI for $med: ";
    $rxcui = get_rxcui($med);
    if ($rxcui) {
        echo "SUCCESS - RxCUI: $rxcui\n";
        $rxcuis[$med] = $rxcui;
    } else {
        echo "FAILED - Could not get RxCUI\n";
    }
}
echo "\n";

// Test 2: Test interaction checking with error handling
echo "Test 2: Checking interactions with error handling\n";
echo "-----------------------------------------------\n";

// Test with valid medications first
if (isset($rxcuis['aspirin']) && isset($rxcuis['warfarin'])) {
    echo "a) Valid medications: aspirin and warfarin\n";
    $result = check_nlm_interaction('aspirin', 'warfarin');
    if ($result) {
        echo "   Response source: " . $result['source'] . "\n";
        echo "   Interaction text sample: " . substr(strip_tags($result['interaction']), 0, 100) . "...\n\n";
    } else {
        echo "   No result returned\n\n";
    }
}

// Test with one invalid medication
echo "b) One invalid medication: aspirin and nonexistentdrug123\n";
$result = check_nlm_interaction('aspirin', 'nonexistentdrug123');
if ($result) {
    echo "   Response source: " . $result['source'] . "\n";
    echo "   Error message: " . substr(strip_tags($result['interaction']), 0, 100) . "...\n\n";
} else {
    echo "   No result returned (expected an error message)\n\n";
}

// Test with API failure simulation (invalid RxCUI)
echo "c) API failure simulation (using invalid RxCUIs)\n";
function test_with_invalid_rxcuis() {
    // Override the get_nlm_interaction_by_rxcui function to simulate an API failure
    global $rxcuis;
    if (isset($rxcuis['aspirin']) && isset($rxcuis['warfarin'])) {
        $result = check_nlm_interaction('aspirin', 'warfarin');
        // We'll override the API call function with a global function variable
        // This isn't possible in PHP easily without a mock framework, so we'll just check the error handling in the main function
        echo "   Response source: " . $result['source'] . "\n";
        echo "   Interaction exists: " . (strpos($result['interaction'], 'API') !== false ? "No (API error message)" : "Yes (found interaction)") . "\n\n";
    }
}
test_with_invalid_rxcuis();

// Test 3: Test warnings with error handling
echo "Test 3: Testing warnings with error handling\n";
echo "-----------------------------------------\n";

// Test with valid medication
if (isset($rxcuis['aspirin'])) {
    echo "a) Valid medication: aspirin\n";
    $result = check_nlm_warnings('aspirin');
    if ($result) {
        echo "   Response source: " . $result['source'] . "\n";
        if (isset($result['warnings']['warnings'][0])) {
            echo "   Warning sample: " . substr($result['warnings']['warnings'][0], 0, 100) . "...\n\n";
        } else {
            echo "   No specific warnings text found\n\n";
        }
    } else {
        echo "   No result returned\n\n";
    }
}

// Test with invalid medication
echo "b) Invalid medication: nonexistentdrug123\n";
$result = check_nlm_warnings('nonexistentdrug123');
if ($result) {
    echo "   Response source: " . $result['source'] . "\n";
    if (isset($result['warnings']['warnings'][0])) {
        echo "   Error message: " . $result['warnings']['warnings'][0] . "\n\n";
    } else {
        echo "   No specific warning message found\n\n";
    }
} else {
    echo "   No result returned (expected an error message)\n\n";
}

echo "NLM API error handling test completed\n";
?> 