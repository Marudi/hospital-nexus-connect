<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Security Utility Class
 * 
 * This class provides utility functions for security-related tasks:
 * - Logging security alerts
 * - Performing security checks
 * - Validating request data
 */
class Security_utility {
    
    /**
     * CodeIgniter instance
     *
     * @var object
     */
    protected $CI;
    
    /**
     * Constructor
     */
    public function __construct() {
        // Get the CodeIgniter instance
        $this->CI =& get_instance();
        
        // Load necessary models
        $this->CI->load->model('security/security_model');
    }
    
    /**
     * Log a security alert
     *
     * @param string $alert_type Type of alert (login_failure, unauthorized_access, etc.)
     * @param string $message Alert message
     * @param string $severity Alert severity (critical, high, medium, low)
     * @param array $additional_data Additional data to store with the alert
     * @return int|boolean Alert ID on success, FALSE on failure
     */
    public function log_alert($alert_type, $message, $severity = 'medium', $additional_data = array()) {
        // Validate severity
        $valid_severities = array('critical', 'high', 'medium', 'low');
        if (!in_array($severity, $valid_severities)) {
            $severity = 'medium'; // Default to medium if invalid severity provided
        }
        
        // Format details if provided as array
        $details = isset($additional_data['details']) ? $additional_data['details'] : '';
        if (is_array($details)) {
            $details = json_encode($details, JSON_PRETTY_PRINT);
        }
        
        // Prepare alert data
        $alert_data = array(
            'alert_type' => $alert_type,
            'message' => $message,
            'severity' => $severity,
            'details' => $details,
            'ip_address' => $this->CI->input->ip_address(),
            'user_agent' => $this->CI->input->user_agent(),
            'status' => 'unread'
        );
        
        // Add user ID if user is logged in
        if ($this->CI->ion_auth->logged_in()) {
            $user = $this->CI->ion_auth->user()->row();
            $alert_data['user_id'] = $user->id;
        }
        
        // Add any additional data
        foreach ($additional_data as $key => $value) {
            if ($key != 'details' && !isset($alert_data[$key])) {
                $alert_data[$key] = $value;
            }
        }
        
        // Log the alert
        return $this->CI->security_model->add_alert($alert_data);
    }
    
    /**
     * Log a failed login attempt
     *
     * @param string $identity The identity that was used in the login attempt
     * @param string $reason The reason for the login failure
     * @return int|boolean Alert ID on success, FALSE on failure
     */
    public function log_login_failure($identity, $reason = 'Invalid credentials') {
        $message = "Failed login attempt for user '{$identity}'";
        $details = array(
            'reason' => $reason,
            'timestamp' => date('Y-m-d H:i:s')
        );
        
        return $this->log_alert('login_failure', $message, 'medium', array('details' => $details));
    }
    
    /**
     * Log an unauthorized access attempt
     *
     * @param string $resource The resource that was attempted to be accessed
     * @param string $action The action that was attempted
     * @return int|boolean Alert ID on success, FALSE on failure
     */
    public function log_unauthorized_access($resource, $action = 'access') {
        $message = "Unauthorized {$action} attempt to {$resource}";
        $severity = 'high';
        
        // Get current user information if available
        $user_info = array();
        if ($this->CI->ion_auth->logged_in()) {
            $user = $this->CI->ion_auth->user()->row();
            $user_info['user_id'] = $user->id;
            $user_info['username'] = $user->username;
            $user_info['email'] = $user->email;
        }
        
        $details = array(
            'resource' => $resource,
            'action' => $action,
            'timestamp' => date('Y-m-d H:i:s'),
            'url' => current_url(),
            'user_info' => $user_info
        );
        
        return $this->log_alert('unauthorized_access', $message, $severity, array('details' => $details));
    }
    
    /**
     * Log a suspicious activity
     *
     * @param string $activity Description of the suspicious activity
     * @param string $severity Alert severity
     * @param array $details Additional details about the activity
     * @return int|boolean Alert ID on success, FALSE on failure
     */
    public function log_suspicious_activity($activity, $severity = 'medium', $details = array()) {
        $message = "Suspicious activity detected: {$activity}";
        
        if (is_array($details)) {
            $details['timestamp'] = date('Y-m-d H:i:s');
            $details['url'] = current_url();
        }
        
        return $this->log_alert('suspicious_activity', $message, $severity, array('details' => $details));
    }
    
    /**
     * Log a security policy violation
     *
     * @param string $policy The policy that was violated
     * @param string $description Description of the violation
     * @param string $severity Alert severity
     * @return int|boolean Alert ID on success, FALSE on failure
     */
    public function log_policy_violation($policy, $description, $severity = 'high') {
        $message = "Security policy violation: {$policy}";
        
        $details = array(
            'policy' => $policy,
            'description' => $description,
            'timestamp' => date('Y-m-d H:i:s'),
            'url' => current_url(),
        );
        
        return $this->log_alert('policy_violation', $message, $severity, array('details' => $details));
    }
    
    /**
     * Check for multiple failed login attempts from the same IP
     *
     * @param int $threshold Number of failed attempts before triggering
     * @param int $time_period Time period in minutes
     * @return boolean TRUE if threshold exceeded, FALSE otherwise
     */
    public function check_login_attempts($threshold = 5, $time_period = 15) {
        // Get current IP address
        $ip_address = $this->CI->input->ip_address();
        
        // Calculate time period
        $time_limit = date('Y-m-d H:i:s', strtotime("-{$time_period} minutes"));
        
        // Set up filters for security model
        $filters = array(
            'alert_type' => 'login_failure',
            'ip_address' => $ip_address,
            'start_date' => $time_limit
        );
        
        // Get number of failed login attempts
        $alerts = $this->CI->security_model->get_filtered_alerts($filters);
        $attempt_count = count($alerts);
        
        // If threshold exceeded, log an alert
        if ($attempt_count >= $threshold) {
            $message = "Multiple failed login attempts detected from IP {$ip_address}";
            $details = array(
                'attempt_count' => $attempt_count,
                'time_period' => $time_period,
                'threshold' => $threshold,
                'timestamp' => date('Y-m-d H:i:s')
            );
            
            $this->log_alert('brute_force_attempt', $message, 'critical', array('details' => $details));
            return true;
        }
        
        return false;
    }
    
    /**
     * Validate request parameters for SQL injection attempts
     *
     * @param array $params Parameters to validate
     * @return boolean TRUE if valid, FALSE if suspicious
     */
    public function validate_request_params($params = null) {
        // If no params provided, use GET and POST data
        if ($params === null) {
            $params = array_merge($this->CI->input->get(), $this->CI->input->post());
        }
        
        // SQL injection patterns to check
        $sql_patterns = array(
            '/(\%27)|(\')|(\-\-)|(\%23)|(#)/',
            '/(\%3D)|(=)[^\n]*((\%27)|(\')|(\-\-)|(\%3B)|(;))/',
            '/\w*((\%27)|(\'))((\%6F)|o|(\%4F))((\%72)|r|(\%52))/',
            '/((\%27)|(\'))union/',
            '/((\%27)|(\'))select/',
            '/((\%27)|(\'))insert/',
            '/((\%27)|(\'))update/',
            '/((\%27)|(\'))delete/',
            '/((\%27)|(\'))drop/',
            '/((\%27)|(\'))truncate/',
            '/((\%27)|(\'))alter/',
            '/((\%27)|(\'))exec/',
            '/((\%27)|(\'))concat/',
            '/((\%27)|(\'))information_schema/',
        );
        
        // Check each parameter against patterns
        foreach ($params as $key => $value) {
            if (is_string($value)) {
                foreach ($sql_patterns as $pattern) {
                    if (preg_match($pattern, strtolower($value))) {
                        // Log the suspicious request
                        $message = "Possible SQL injection attempt detected in parameter '{$key}'";
                        $details = array(
                            'parameter' => $key,
                            'value' => $value,
                            'pattern_matched' => $pattern,
                            'timestamp' => date('Y-m-d H:i:s'),
                            'url' => current_url(),
                            'request_method' => $this->CI->input->method()
                        );
                        
                        $this->log_alert('sql_injection_attempt', $message, 'critical', array('details' => $details));
                        return false;
                    }
                }
            }
        }
        
        return true;
    }
    
    /**
     * Check for possible cross-site scripting (XSS) attempts
     *
     * @param array $params Parameters to validate
     * @return boolean TRUE if valid, FALSE if suspicious
     */
    public function check_xss_attempt($params = null) {
        // If no params provided, use GET and POST data
        if ($params === null) {
            $params = array_merge($this->CI->input->get(), $this->CI->input->post());
        }
        
        // XSS patterns to check
        $xss_patterns = array(
            '/<script\b[^>]*>(.*?)<\/script>/is',
            '/\bon\w+\s*=\s*"[^"]*"/is',
            '/\bon\w+\s*=\s*\'[^\']*\'/is',
            '/\bon\w+\s*=[^\s>]*/is',
            '/<iframe\b[^>]*>(.*?)<\/iframe>/is',
            '/<object\b[^>]*>(.*?)<\/object>/is',
            '/<embed\b[^>]*>(.*?)<\/embed>/is',
            '/<base\b[^>]*>/is',
            '/<applet\b[^>]*>(.*?)<\/applet>/is',
            '/<meta\b[^>]*>/is',
            '/expression\s*\(.*?\)/is',
            '/javascript\s*:/is',
            '/vbscript\s*:/is',
            '/data\s*:/is',
        );
        
        // Check each parameter against patterns
        foreach ($params as $key => $value) {
            if (is_string($value)) {
                foreach ($xss_patterns as $pattern) {
                    if (preg_match($pattern, strtolower($value))) {
                        // Log the suspicious request
                        $message = "Possible XSS attempt detected in parameter '{$key}'";
                        $details = array(
                            'parameter' => $key,
                            'value' => $value,
                            'pattern_matched' => $pattern,
                            'timestamp' => date('Y-m-d H:i:s'),
                            'url' => current_url(),
                            'request_method' => $this->CI->input->method()
                        );
                        
                        $this->log_alert('xss_attempt', $message, 'critical', array('details' => $details));
                        return false;
                    }
                }
            }
        }
        
        return true;
    }
    
    /**
     * Get unread security alert counts
     *
     * @return array Counts of unread alerts by severity
     */
    public function get_unread_alert_counts() {
        $filters = array('status' => 'unread');
        
        $counts = array(
            'critical' => $this->CI->security_model->count_alerts_by_severity('critical', $filters),
            'high' => $this->CI->security_model->count_alerts_by_severity('high', $filters),
            'medium' => $this->CI->security_model->count_alerts_by_severity('medium', $filters),
            'low' => $this->CI->security_model->count_alerts_by_severity('low', $filters)
        );
        
        $counts['total'] = $counts['critical'] + $counts['high'] + $counts['medium'] + $counts['low'];
        
        return $counts;
    }
} 