<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertAppointment($data) {
        $this->db->insert('appointment', $data);
    }



    function getSettings() {
        $query = $this->db->get('website_settings');
        return $query->row();
    }

    function updateSettings($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('website_settings', $data);
    }
      function addHospitalPayment($data){
        $this->db->insert('hospital_payment', $data);
    }
    function addHospitalDeposit($data){
        return $this->db->insert('hospital_deposit', $data);
    }
    function updateHospitalPayment($id,$data){
        $this->db->where('id', $id);
        $this->db->update('hospital_payment', $data);
    }

    // Subscribe Section //

    function insertSubscribe($data) {
        
        $this->db->insert('subscribe',$data);
    }
    

    function deleteSubscribe($id) {
        $this->db->where('id', $id);
        $this->db->delete('subscribe');
    }
    
    function getSubscribe() {      
        $query = $this->db->get('subscribe')->result();
        return $query;
    }
    
        function getHospitalById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('hospital');
        return $query->row();
    }
        function getHospital() {
        $query = $this->db->get('hospital');
        return $query->result();
    }

}
