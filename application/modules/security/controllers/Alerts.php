<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Security Alerts Controller
 * 
 * This controller manages security alert functionalities including listing,
 * filtering, viewing details, marking as read, and deleting alerts.
 */
class Alerts extends MX_Controller {
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        
        // Check if user is logged in
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        
        // Check if user has permission to access security alerts
        if (!$this->ion_auth->in_group(array('admin', 'security'))) {
            $this->session->set_flashdata('error', 'You do not have permission to access security alerts');
            redirect('dashboard');
        }
        
        // Load models
        $this->load->model('security/security_model');
        
        // Load helper
        $this->load->helper('date');
    }
    
    /**
     * Index page - displays all security alerts
     */
    public function index() {
        // Reset any filters in session
        $this->session->unset_userdata('security_alert_filters');
        
        // Get alert counts by severity
        $filters = array();
        $critical_count = $this->security_model->count_alerts_by_severity('critical', $filters);
        $high_count = $this->security_model->count_alerts_by_severity('high', $filters);
        $medium_count = $this->security_model->count_alerts_by_severity('medium', $filters);
        $low_count = $this->security_model->count_alerts_by_severity('low', $filters);
        
        // Get all alerts
        $data['alerts'] = $this->security_model->get_all_alerts();
        $data['alert_types'] = $this->security_model->get_alert_types();
        
        // Set severity counts
        $data['critical_count'] = $critical_count;
        $data['high_count'] = $high_count;
        $data['medium_count'] = $medium_count;
        $data['low_count'] = $low_count;
        
        // Set page title and load views
        $data['page_title'] = 'Security Alerts';
        $data['main_content'] = 'security/alerts';
        $this->load->view('admin/includes/template', $data);
    }
    
    /**
     * Filter alerts based on the provided criteria
     */
    public function filter() {
        // Check if this is an AJAX request
        if (!$this->input->is_ajax_request()) {
            redirect('security/alerts');
        }
        
        // Get filter parameters
        $filters = array(
            'alert_type' => $this->input->post('alert_type'),
            'severity' => $this->input->post('severity'),
            'status' => $this->input->post('status'),
            'ip_address' => $this->input->post('ip_address'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date')
        );
        
        // Remove empty filters
        foreach ($filters as $key => $value) {
            if (empty($value)) {
                unset($filters[$key]);
            }
        }
        
        // Save filters in session
        $this->session->set_userdata('security_alert_filters', $filters);
        
        // Return success response
        $response = array('success' => true);
        echo json_encode($response);
    }
    
    /**
     * Display filtered alerts
     */
    public function filtered() {
        // Get filters from session
        $filters = $this->session->userdata('security_alert_filters');
        
        if (empty($filters)) {
            redirect('security/alerts');
        }
        
        // Get alert counts by severity with applied filters
        $critical_count = $this->security_model->count_alerts_by_severity('critical', $filters);
        $high_count = $this->security_model->count_alerts_by_severity('high', $filters);
        $medium_count = $this->security_model->count_alerts_by_severity('medium', $filters);
        $low_count = $this->security_model->count_alerts_by_severity('low', $filters);
        
        // Get filtered alerts
        $data['alerts'] = $this->security_model->get_filtered_alerts($filters);
        $data['alert_types'] = $this->security_model->get_alert_types();
        
        // Set severity counts
        $data['critical_count'] = $critical_count;
        $data['high_count'] = $high_count;
        $data['medium_count'] = $medium_count;
        $data['low_count'] = $low_count;
        
        // Set active filters for display
        $data['active_filters'] = $filters;
        
        // Set page title and load views
        $data['page_title'] = 'Filtered Security Alerts';
        $data['main_content'] = 'security/alerts';
        $this->load->view('admin/includes/template', $data);
    }
    
    /**
     * View details of a specific alert
     * 
     * @param int $alert_id The ID of the alert to view
     */
    public function detail($alert_id) {
        // Get alert details
        $alert = $this->security_model->get_alert_by_id($alert_id);
        
        if (empty($alert)) {
            $this->session->set_flashdata('error', 'Alert not found');
            redirect('security/alerts');
        }
        
        // Mark the alert as read when viewed
        if ($alert['status'] == 'unread') {
            $this->security_model->mark_alert_as_read($alert_id);
            $alert['status'] = 'read';
        }
        
        $data['alert'] = $alert;
        $data['alert_types'] = $this->security_model->get_alert_types();
        
        // Set page title and load views
        $data['page_title'] = 'Security Alert Details';
        $data['main_content'] = 'security/alert_detail';
        $this->load->view('admin/includes/template', $data);
    }
    
    /**
     * Get alert details via AJAX
     */
    public function get_details() {
        // Check if this is an AJAX request
        if (!$this->input->is_ajax_request()) {
            redirect('security/alerts');
        }
        
        $alert_id = $this->input->get('alert_id');
        
        // Get alert details
        $alert = $this->security_model->get_alert_by_id($alert_id);
        
        if (empty($alert)) {
            $response = array('success' => false, 'message' => 'Alert not found');
            echo json_encode($response);
            return;
        }
        
        // Add alert type name to response
        $alert_types = $this->security_model->get_alert_types();
        $alert['alert_type_name'] = isset($alert_types[$alert['alert_type']]) ? 
                                     $alert_types[$alert['alert_type']] : 
                                     $alert['alert_type'];
        
        $response = array('success' => true, 'data' => $alert);
        echo json_encode($response);
    }
    
    /**
     * Mark an alert as read
     * 
     * @param int $alert_id The ID of the alert to mark as read
     */
    public function mark_read($alert_id = null) {
        // Check if this is an AJAX request or a direct call
        $is_ajax = $this->input->is_ajax_request();
        
        // If this is an AJAX request, get the alert ID from POST
        if ($is_ajax) {
            $alert_id = $this->input->post('alert_id');
        }
        
        if (empty($alert_id)) {
            if ($is_ajax) {
                $response = array('success' => false, 'message' => 'No alert ID provided');
                echo json_encode($response);
                return;
            } else {
                $this->session->set_flashdata('error', 'No alert ID provided');
                redirect('security/alerts');
            }
        }
        
        // Mark the alert as read
        $success = $this->security_model->mark_alert_as_read($alert_id);
        
        if ($success) {
            if ($is_ajax) {
                $response = array('success' => true);
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('success', 'Alert marked as read');
                redirect('security/alerts');
            }
        } else {
            if ($is_ajax) {
                $response = array('success' => false, 'message' => 'Failed to mark alert as read');
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', 'Failed to mark alert as read');
                redirect('security/alerts');
            }
        }
    }
    
    /**
     * Mark all alerts as read
     */
    public function mark_all_read() {
        // Check if this is an AJAX request or a direct call
        $is_ajax = $this->input->is_ajax_request();
        
        // Mark all alerts as read
        $success = $this->security_model->mark_all_alerts_as_read();
        
        if ($success) {
            if ($is_ajax) {
                $response = array('success' => true);
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('success', 'All alerts marked as read');
                redirect('security/alerts');
            }
        } else {
            if ($is_ajax) {
                $response = array('success' => false, 'message' => 'Failed to mark alerts as read');
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', 'Failed to mark alerts as read');
                redirect('security/alerts');
            }
        }
    }
    
    /**
     * Delete an alert
     * 
     * @param int $alert_id The ID of the alert to delete
     */
    public function delete($alert_id = null) {
        // Check if this is an AJAX request or a direct call
        $is_ajax = $this->input->is_ajax_request();
        
        // If this is an AJAX request, get the alert ID from POST
        if ($is_ajax) {
            $alert_id = $this->input->post('alert_id');
        }
        
        if (empty($alert_id)) {
            if ($is_ajax) {
                $response = array('success' => false, 'message' => 'No alert ID provided');
                echo json_encode($response);
                return;
            } else {
                $this->session->set_flashdata('error', 'No alert ID provided');
                redirect('security/alerts');
            }
        }
        
        // Delete the alert
        $success = $this->security_model->delete_alert($alert_id);
        
        if ($success) {
            if ($is_ajax) {
                $response = array('success' => true);
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('success', 'Alert deleted successfully');
                redirect('security/alerts');
            }
        } else {
            if ($is_ajax) {
                $response = array('success' => false, 'message' => 'Failed to delete alert');
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', 'Failed to delete alert');
                redirect('security/alerts');
            }
        }
    }
    
    /**
     * Load security alerts for the notification dropdown
     * 
     * This method is used via AJAX to load the notification component
     */
    public function notifications() {
        // Check if this is an AJAX request
        if (!$this->input->is_ajax_request()) {
            redirect('dashboard');
        }
        
        // Get counts of unread alerts by severity
        $filters = array('status' => 'unread');
        $data['critical_count'] = $this->security_model->count_alerts_by_severity('critical', $filters);
        $data['high_count'] = $this->security_model->count_alerts_by_severity('high', $filters);
        $data['medium_count'] = $this->security_model->count_alerts_by_severity('medium', $filters);
        $data['low_count'] = $this->security_model->count_alerts_by_severity('low', $filters);
        
        // Calculate total unread count
        $data['unread_count'] = $data['critical_count'] + $data['high_count'] + $data['medium_count'] + $data['low_count'];
        
        // Get recent alerts (limit to 5)
        $data['recent_alerts'] = $this->security_model->get_all_alerts(5);
        
        // Load and return the notification view
        $html = $this->load->view('security/notifications', $data, true);
        
        $response = array(
            'success' => true,
            'html' => $html,
            'unread_count' => $data['unread_count']
        );
        
        echo json_encode($response);
    }
} 