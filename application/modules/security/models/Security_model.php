<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get all security alerts
     * 
     * @return array Array of security alerts
     */
    public function get_all_alerts() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('security_alerts')->result_array();
    }
    
    /**
     * Get filtered security alerts
     * 
     * @param array $filters Array of filter criteria
     * @return array Array of filtered security alerts
     */
    public function get_filtered_alerts($filters = []) {
        if (!empty($filters)) {
            if (isset($filters['alert_type']) && $filters['alert_type'] !== '') {
                $this->db->where('alert_type', $filters['alert_type']);
            }
            
            if (isset($filters['severity']) && $filters['severity'] !== '') {
                $this->db->where('severity', $filters['severity']);
            }
            
            if (isset($filters['status']) && $filters['status'] !== '') {
                $this->db->where('status', $filters['status']);
            }
            
            if (isset($filters['ip_address']) && $filters['ip_address'] !== '') {
                $this->db->like('ip_address', $filters['ip_address']);
            }
            
            if (isset($filters['start_date']) && $filters['start_date'] !== '') {
                $this->db->where('created_at >=', $filters['start_date'] . ' 00:00:00');
            }
            
            if (isset($filters['end_date']) && $filters['end_date'] !== '') {
                $this->db->where('created_at <=', $filters['end_date'] . ' 23:59:59');
            }
        }
        
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('security_alerts')->result_array();
    }
    
    /**
     * Count alerts by severity
     * 
     * @param string $severity Severity level (critical, high, medium, low)
     * @param array $filters Additional filters
     * @return int Count of alerts
     */
    public function count_alerts_by_severity($severity, $filters = []) {
        $this->db->where('severity', $severity);
        
        if (!empty($filters)) {
            if (isset($filters['alert_type']) && $filters['alert_type'] !== '') {
                $this->db->where('alert_type', $filters['alert_type']);
            }
            
            if (isset($filters['status']) && $filters['status'] !== '') {
                $this->db->where('status', $filters['status']);
            }
            
            if (isset($filters['ip_address']) && $filters['ip_address'] !== '') {
                $this->db->like('ip_address', $filters['ip_address']);
            }
            
            if (isset($filters['start_date']) && $filters['start_date'] !== '') {
                $this->db->where('created_at >=', $filters['start_date'] . ' 00:00:00');
            }
            
            if (isset($filters['end_date']) && $filters['end_date'] !== '') {
                $this->db->where('created_at <=', $filters['end_date'] . ' 23:59:59');
            }
        }
        
        return $this->db->count_all_results('security_alerts');
    }
    
    /**
     * Get all alert types
     * 
     * @return array Array of alert types
     */
    public function get_alert_types() {
        return [
            'login_attempt' => 'Failed Login Attempt',
            'brute_force' => 'Brute Force Attack',
            'sql_injection' => 'SQL Injection Attempt',
            'xss_attempt' => 'XSS Attempt',
            'csrf_failure' => 'CSRF Token Failure',
            'file_upload' => 'Suspicious File Upload',
            'permission_violation' => 'Permission Violation',
            'api_misuse' => 'API Misuse',
            'data_export' => 'Unusual Data Export',
            'system_change' => 'Critical System Change'
        ];
    }
    
    /**
     * Mark alert as read
     * 
     * @param int $alert_id Alert ID
     * @return bool Success or failure
     */
    public function mark_alert_as_read($alert_id) {
        $this->db->where('id', $alert_id);
        return $this->db->update('security_alerts', ['status' => 'read', 'updated_at' => date('Y-m-d H:i:s')]);
    }
    
    /**
     * Mark all alerts as read
     * 
     * @return bool Success or failure
     */
    public function mark_all_alerts_as_read() {
        return $this->db->update('security_alerts', ['status' => 'read', 'updated_at' => date('Y-m-d H:i:s')]);
    }
    
    /**
     * Delete alert
     * 
     * @param int $alert_id Alert ID
     * @return bool Success or failure
     */
    public function delete_alert($alert_id) {
        $this->db->where('id', $alert_id);
        return $this->db->delete('security_alerts');
    }
    
    /**
     * Add new security alert
     * 
     * @param array $data Alert data
     * @return bool Success or failure
     */
    public function add_alert($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->db->insert('security_alerts', $data);
    }
    
    /**
     * Get alert details by ID
     * 
     * @param int $alert_id Alert ID
     * @return array Alert details
     */
    public function get_alert_by_id($alert_id) {
        $this->db->where('id', $alert_id);
        return $this->db->get('security_alerts')->row_array();
    }
} 