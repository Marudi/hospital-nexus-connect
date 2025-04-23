<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Google Places Helper
 * 
 * This helper provides functions to include Google Places API scripts
 */

if (!function_exists('include_google_places_scripts')) {
    /**
     * Include Google Places API scripts
     * 
     * This function outputs the necessary script tags to include Google Places API
     * 
     * @param string $api_key Google API key (optional, will use config if not provided)
     * @return void
     */
    function include_google_places_scripts($api_key = NULL) {
        $CI =& get_instance();
        
        // Try to load API key from config if not provided
        if (empty($api_key)) {
            $CI->load->config('google_api', TRUE);
            $api_key = $CI->config->item('google_api_key', 'google_api');
        }
        
        // Output CSS link
        echo '<link rel="stylesheet" href="' . base_url('common/css/google-places-autocomplete.css') . '">' . PHP_EOL;
        
        // Output script tags
        echo '<script type="text/javascript">' . PHP_EOL;
        echo '    const GOOGLE_API_KEY = "' . $api_key . '";' . PHP_EOL;
        echo '</script>' . PHP_EOL;
        echo '<script type="text/javascript" src="' . base_url('common/js/google-places-autocomplete.js') . '"></script>' . PHP_EOL;
    }
} 