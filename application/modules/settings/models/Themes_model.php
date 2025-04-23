<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Themes Model
 * 
 * Handles theme management functions for the application
 */
class Themes_model extends CI_Model {
    
    private $themes_path;
    private $theme_settings_table = 'theme_settings';
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->themes_path = FCPATH . 'themes/';
        
        // Load file helper
        $this->load->helper('file');
        
        // Ensure theme_settings table exists
        $this->ensure_theme_settings_table();
    }
    
    /**
     * Get all available themes
     *
     * @return array Array of theme data
     */
    public function get_all_themes() {
        $themes = array();
        
        // Get all directories in the themes folder
        $theme_dirs = glob($this->themes_path . '*', GLOB_ONLYDIR);
        
        foreach ($theme_dirs as $theme_dir) {
            $theme_id = basename($theme_dir);
            $theme_info = $this->get_theme_by_id($theme_id);
            
            if ($theme_info) {
                $themes[] = $theme_info;
            }
        }
        
        return $themes;
    }
    
    /**
     * Get theme information by ID
     *
     * @param string $theme_id The theme identifier
     * @return array|null Theme information or null if not found
     */
    public function get_theme_by_id($theme_id) {
        $theme_dir = $this->themes_path . $theme_id;
        $theme_json = $theme_dir . '/theme.json';
        
        if (!file_exists($theme_json)) {
            return null;
        }
        
        $json_data = file_get_contents($theme_json);
        $theme_data = json_decode($json_data, true);
        
        if (!$theme_data) {
            return null;
        }
        
        // Add additional info
        $theme_data['id'] = $theme_id;
        $theme_data['preview_image'] = base_url("themes/{$theme_id}/preview.png");
        $theme_data['path'] = $theme_dir;
        
        return $theme_data;
    }
    
    /**
     * Get active theme
     *
     * @return array Active theme information
     */
    public function get_active_theme() {
        $this->load->model('settings/settings_model');
        $theme_id = $this->settings_model->get_setting('active_theme');
        
        if (!$theme_id) {
            $theme_id = 'default'; // Default theme
        }
        
        return $this->get_theme_by_id($theme_id);
    }
    
    /**
     * Activate a theme
     *
     * @param string $theme_id The theme identifier
     * @return boolean True on success, false on failure
     */
    public function activate_theme($theme_id) {
        // Check if theme exists
        $theme = $this->get_theme_by_id($theme_id);
        if (!$theme) {
            return false;
        }
        
        $this->load->model('settings/settings_model');
        $result = $this->settings_model->update_setting('active_theme', $theme_id);
        
        if ($result) {
            // Clear cache
            $this->output->delete_cache();
            return true;
        }
        
        return false;
    }
    
    /**
     * Get theme configuration options
     *
     * @param string $theme_id The theme identifier
     * @return array Theme configuration options
     */
    public function get_theme_config_options($theme_id) {
        $theme_dir = $this->themes_path . $theme_id;
        $config_file = $theme_dir . '/config.json';
        
        if (!file_exists($config_file)) {
            return array();
        }
        
        $json_data = file_get_contents($config_file);
        $config_data = json_decode($json_data, true);
        
        return is_array($config_data) ? $config_data : array();
    }
    
    /**
     * Get current theme settings
     *
     * @param string $theme_id The theme identifier
     * @return array Current theme settings
     */
    public function get_theme_settings($theme_id) {
        $this->db->where('theme_id', $theme_id);
        $query = $this->db->get($this->theme_settings_table);
        
        $settings = array();
        foreach ($query->result() as $row) {
            $settings[$row->setting_key] = $row->setting_value;
        }
        
        return $settings;
    }
    
    /**
     * Save theme settings
     *
     * @param string $theme_id The theme identifier
     * @param array $settings Array of settings key-value pairs
     * @return boolean True on success, false on failure
     */
    public function save_theme_settings($theme_id, $settings) {
        if (empty($settings) || !is_array($settings)) {
            return false;
        }
        
        $success = true;
        
        // Begin transaction
        $this->db->trans_begin();
        
        foreach ($settings as $key => $value) {
            // Check if setting exists
            $this->db->where('theme_id', $theme_id);
            $this->db->where('setting_key', $key);
            $query = $this->db->get($this->theme_settings_table);
            
            if ($query->num_rows() > 0) {
                // Update existing setting
                $this->db->where('theme_id', $theme_id);
                $this->db->where('setting_key', $key);
                $result = $this->db->update($this->theme_settings_table, array(
                    'setting_value' => $value,
                    'updated_at' => date('Y-m-d H:i:s')
                ));
            } else {
                // Insert new setting
                $result = $this->db->insert($this->theme_settings_table, array(
                    'theme_id' => $theme_id,
                    'setting_key' => $key,
                    'setting_value' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ));
            }
            
            if (!$result) {
                $success = false;
            }
        }
        
        if ($success) {
            $this->db->trans_commit();
            // Clear cache
            $this->output->delete_cache();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }
    
    /**
     * Reset theme settings to default
     *
     * @param string $theme_id The theme identifier
     * @return boolean True on success, false on failure
     */
    public function reset_theme_settings($theme_id) {
        $this->db->where('theme_id', $theme_id);
        $result = $this->db->delete($this->theme_settings_table);
        
        if ($result) {
            // Clear cache
            $this->output->delete_cache();
        }
        
        return $result;
    }
    
    /**
     * Delete a theme
     *
     * @param string $theme_id The theme identifier
     * @return boolean True on success, false on failure
     */
    public function delete_theme($theme_id) {
        // Default theme cannot be deleted
        if ($theme_id == 'default') {
            return false;
        }
        
        // Check if theme is active
        $active_theme = $this->get_active_theme();
        if ($active_theme['id'] == $theme_id) {
            return false;
        }
        
        // Delete theme directory
        $theme_dir = $this->themes_path . $theme_id;
        if (!is_dir($theme_dir)) {
            return false;
        }
        
        // Delete settings from database
        $this->db->where('theme_id', $theme_id);
        $this->db->delete($this->theme_settings_table);
        
        // Delete theme directory
        $this->load->helper('file');
        delete_files($theme_dir, true);
        return rmdir($theme_dir);
    }
    
    /**
     * Install a theme from a zip file
     *
     * @param string $file_path Path to the zip file
     * @return array Result array with success status and message
     */
    public function install_theme($file_path) {
        // Check if file exists
        if (!file_exists($file_path)) {
            return array(
                'success' => false,
                'message' => 'Theme file not found'
            );
        }
        
        // Create temporary directory for extraction
        $temp_dir = FCPATH . 'temp/theme_' . time();
        if (!is_dir($temp_dir)) {
            mkdir($temp_dir, 0755, true);
        }
        
        // Extract zip file
        $zip = new ZipArchive;
        if ($zip->open($file_path) !== true) {
            return array(
                'success' => false,
                'message' => 'Failed to open theme package'
            );
        }
        
        $zip->extractTo($temp_dir);
        $zip->close();
        
        // Look for theme.json file
        $theme_json = null;
        $theme_dir = null;
        
        // Find the directory containing theme.json
        $directories = glob($temp_dir . '/*', GLOB_ONLYDIR);
        foreach ($directories as $dir) {
            if (file_exists($dir . '/theme.json')) {
                $theme_json = $dir . '/theme.json';
                $theme_dir = $dir;
                break;
            }
        }
        
        // If theme.json not found in subdirectories, check root
        if (!$theme_json && file_exists($temp_dir . '/theme.json')) {
            $theme_json = $temp_dir . '/theme.json';
            $theme_dir = $temp_dir;
        }
        
        if (!$theme_json) {
            // Clean up temp directory
            delete_files($temp_dir, true);
            rmdir($temp_dir);
            
            return array(
                'success' => false,
                'message' => 'Invalid theme package: theme.json not found'
            );
        }
        
        // Parse theme.json
        $json_data = file_get_contents($theme_json);
        $theme_data = json_decode($json_data, true);
        
        if (!$theme_data || !isset($theme_data['name'])) {
            // Clean up temp directory
            delete_files($temp_dir, true);
            rmdir($temp_dir);
            
            return array(
                'success' => false,
                'message' => 'Invalid theme.json file'
            );
        }
        
        // Get theme ID (directory name)
        $theme_id = isset($theme_data['id']) ? $theme_data['id'] : sanitize_filename($theme_data['name']);
        
        // Check if theme already exists
        if (is_dir($this->themes_path . $theme_id)) {
            // Clean up temp directory
            delete_files($temp_dir, true);
            rmdir($temp_dir);
            
            return array(
                'success' => false,
                'message' => 'A theme with the same ID already exists'
            );
        }
        
        // Move theme to themes directory
        $destination = $this->themes_path . $theme_id;
        rename($theme_dir, $destination);
        
        // Clean up temp directory
        delete_files($temp_dir, true);
        if (is_dir($temp_dir)) {
            rmdir($temp_dir);
        }
        
        return array(
            'success' => true,
            'message' => 'Theme installed successfully',
            'theme_id' => $theme_id
        );
    }
    
    /**
     * Check if a theme exists
     *
     * @param string $theme_id The theme identifier
     * @return boolean True if exists, false otherwise
     */
    public function theme_exists($theme_id) {
        return is_dir($this->themes_path . $theme_id) && 
               file_exists($this->themes_path . $theme_id . '/theme.json');
    }
    
    /**
     * Ensure theme_settings table exists
     *
     * @return boolean True if table exists or was created, false on failure
     */
    public function ensure_theme_settings_table() {
        // Check if table exists
        if ($this->db->table_exists($this->theme_settings_table)) {
            return true;
        }
        
        // If table doesn't exist, create it
        $sql_path = APPPATH . 'modules/settings/sql/theme_settings.sql';
        
        if (file_exists($sql_path)) {
            $sql = file_get_contents($sql_path);
            return $this->db->query($sql);
        }
        
        return false;
    }
} 