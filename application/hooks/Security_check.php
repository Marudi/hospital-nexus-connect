<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Security Check Hook Class
 * 
 * This hook performs security checks on every request to identify potential threats.
 */
class Security_check {
    
    protected $CI;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->CI =& get_instance();
    }
    
    /**
     * Run security checks after controller execution
     */
    public function check() {
        // Skip if CLI request
        if ($this->CI->input->is_cli_request()) {
            return;
        }
        
        // Load security utility if not already loaded
        if (!class_exists('Security_utility')) {
            $this->CI->load->library('security/security_utility');
        }
        
        // Check for SQL injection attempts
        $this->CI->security_utility->validate_request_params();
        
        // Check for XSS attempts
        $this->CI->security_utility->check_xss_attempt();
    }
} 