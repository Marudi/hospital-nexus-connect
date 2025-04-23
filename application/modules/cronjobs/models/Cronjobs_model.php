<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cronjobs_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getSettings($user) {
        return $this->db->where('hospital_id', $user)
                        ->get('settings')->row();
    }

    public function getAppointment($time) {
        return $this->db->where('date >= ', $time)
                        ->get('appointment')->result();
    }

    function getAutoSmsByType($hospital_id, $type) {
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('type', $type);
        $query = $this->db->get('autosmstemplate');
        return $query->row();
    }

    function getAutoEmailByType($hospital_id, $type) {
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('type', $type);
        $query = $this->db->get('autoemailtemplate');
        return $query->row();
    }

    function getSmsSettingsByGatewayName($hospital_id, $name) {
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('name', $name);
        $query = $this->db->get('sms_settings');
        return $query->row();
    }

    function getEmailSettingsByType($hospital_id, $type) {
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('type', $type);
        $query = $this->db->get('email_settings');
        return $query->row();
    }

    function getPatientById($hospital_id, $id) {
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }

    function getDoctorById($hospital_id, $id) {
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('id', $id);
        $query = $this->db->get('doctor');
        return $query->row();
    }
    function updateAppointment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }

}
