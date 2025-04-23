<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Google API Configuration
|--------------------------------------------------------------------------
|
| This file contains the configuration settings for Google API services
| including Places API, Maps API, etc.
|
*/

// Google API Key - Replace with your actual API key
$config['google_api_key'] = 'AIzaSyDQe03FIisHmaZqxPYFRaW2x_jVyxcIdGY';

// Google Places API Configuration
$config['places_api_enabled'] = TRUE;
$config['places_api_region'] = ''; // Optional: Restrict to specific region (e.g., 'us') 