<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Themes Controller
 * 
 * Controller for managing themes in the admin panel
 */
class Themes extends MX_Controller {
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        
        // Check permission
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('message', lang('access_denied'));
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/dashboard');
        }
        
        // Load models
        $this->load->model('Themes_model');
        
        // Load helpers
        $this->load->helper('form');
    }
    
    /**
     * Index - List all themes
     */
    public function index() {
        $data['title'] = lang('themes');
        $data['themes'] = $this->Themes_model->get_all_themes();
        $data['active_theme'] = $this->Themes_model->get_active_theme();
        
        $this->template->build('themes/index', $data);
    }
    
    /**
     * Activate a theme
     * 
     * @param string $theme_id Theme ID
     */
    public function activate($theme_id) {
        // Validate theme exists
        if (!$this->Themes_model->get_theme_by_id($theme_id)) {
            $this->session->set_flashdata('message', lang('theme_not_found'));
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes');
        }
        
        // Activate theme
        $result = $this->Themes_model->activate_theme($theme_id);
        
        if ($result) {
            $this->session->set_flashdata('message', lang('theme_activated_successfully'));
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', lang('theme_activation_failed'));
            $this->session->set_flashdata('message_type', 'error');
        }
        
        redirect('admin/settings/themes');
    }
    
    /**
     * Customize theme
     * 
     * @param string $theme_id Theme ID
     */
    public function customize($theme_id) {
        // Validate theme exists
        $theme = $this->Themes_model->get_theme_by_id($theme_id);
        if (!$theme) {
            $this->session->set_flashdata('message', lang('theme_not_found'));
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes');
        }
        
        $data['title'] = lang('customize_theme') . ' - ' . $theme['name'];
        $data['theme'] = $theme;
        $data['theme_options'] = $this->Themes_model->get_theme_config_options($theme_id);
        $data['theme_settings'] = $this->Themes_model->get_theme_settings($theme_id);
        
        $this->template->build('themes/customize', $data);
    }
    
    /**
     * Save theme settings
     * 
     * @param string $theme_id Theme ID
     */
    public function save_settings($theme_id) {
        // Validate theme exists
        if (!$this->Themes_model->get_theme_by_id($theme_id)) {
            $this->session->set_flashdata('message', lang('theme_not_found'));
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes');
        }
        
        // Get theme options
        $theme_options = $this->input->post('theme_options');
        
        // Save settings
        $result = $this->Themes_model->save_theme_settings($theme_id, $theme_options);
        
        if ($result) {
            $this->session->set_flashdata('message', lang('settings_saved_successfully'));
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', lang('settings_save_failed'));
            $this->session->set_flashdata('message_type', 'error');
        }
        
        redirect('admin/settings/themes/customize/' . $theme_id);
    }
    
    /**
     * Reset theme settings to default
     * 
     * @param string $theme_id Theme ID
     */
    public function reset_settings($theme_id) {
        // Validate theme exists
        if (!$this->Themes_model->get_theme_by_id($theme_id)) {
            $this->session->set_flashdata('message', lang('theme_not_found'));
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes');
        }
        
        // Reset settings
        $result = $this->Themes_model->reset_theme_settings($theme_id);
        
        if ($result) {
            $this->session->set_flashdata('message', lang('settings_reset_successfully'));
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', lang('settings_reset_failed'));
            $this->session->set_flashdata('message_type', 'error');
        }
        
        redirect('admin/settings/themes/customize/' . $theme_id);
    }
    
    /**
     * Preview theme
     * 
     * @param string $theme_id Theme ID
     */
    public function preview($theme_id) {
        // Set preview theme in session
        $this->session->set_userdata('preview_theme', $theme_id);
        
        // Redirect to frontend
        redirect(site_url());
    }
    
    /**
     * Install theme form
     */
    public function install() {
        $data['title'] = lang('install_theme');
        
        $this->template->build('themes/install', $data);
    }
    
    /**
     * Upload and install theme
     */
    public function upload() {
        // Check if file was uploaded
        if (!isset($_FILES['theme_file']) || $_FILES['theme_file']['error'] != 0) {
            $this->session->set_flashdata('message', lang('theme_file_required'));
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes/install');
        }
        
        // Upload configuration
        $config['upload_path'] = './uploads/temp/';
        $config['allowed_types'] = 'zip';
        $config['max_size'] = 5120; // 5MB
        $config['overwrite'] = TRUE;
        
        // Create temp directory if it doesn't exist
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        
        // Load upload library
        $this->load->library('upload', $config);
        
        // Attempt to upload file
        if (!$this->upload->do_upload('theme_file')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes/install');
        }
        
        // Get uploaded file data
        $upload_data = $this->upload->data();
        $theme_file = $upload_data['full_path'];
        
        // Install theme
        $result = $this->Themes_model->install_theme($theme_file);
        
        // Delete uploaded file
        @unlink($theme_file);
        
        if ($result === TRUE) {
            $this->session->set_flashdata('message', lang('theme_installed_successfully'));
            $this->session->set_flashdata('message_type', 'success');
            redirect('admin/settings/themes');
        } else {
            $this->session->set_flashdata('message', $result);
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes/install');
        }
    }
    
    /**
     * Delete a theme
     * 
     * @param string $theme_id Theme ID
     */
    public function delete($theme_id) {
        // Validate theme exists
        if (!$this->Themes_model->get_theme_by_id($theme_id)) {
            $this->session->set_flashdata('message', lang('theme_not_found'));
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes');
        }
        
        // Check if theme is default
        if ($theme_id == 'default') {
            $this->session->set_flashdata('message', lang('cannot_delete_default_theme'));
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes');
        }
        
        // Check if theme is active
        $active_theme = $this->Themes_model->get_active_theme();
        if ($active_theme['id'] == $theme_id) {
            $this->session->set_flashdata('message', lang('cannot_delete_active_theme'));
            $this->session->set_flashdata('message_type', 'error');
            redirect('admin/settings/themes');
        }
        
        // Delete theme
        $result = $this->Themes_model->delete_theme($theme_id);
        
        if ($result) {
            $this->session->set_flashdata('message', lang('theme_deleted_successfully'));
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', lang('theme_deletion_failed'));
            $this->session->set_flashdata('message_type', 'error');
        }
        
        redirect('admin/settings/themes');
    }
} 