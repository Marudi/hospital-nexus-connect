<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crutches_model extends CI_Model {
    
    function getCrutches() {
         
        $query = $this->db->get('crutches')->result();
        return $query;
    }
    
    function insertCrutches($data) {
        
        $this->db->insert('crutches',$data);
    }
    
    function updateCrutches($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('crutches',$data);
    }
    
    function getCrutchesById($id) {
        
        $this->db->where('id', $id);
        $query = $this->db->get('crutches')->row();
        return $query;
    }
    
    function deleteCrutches($id) {
        $this->db->where('id', $id);
        $this->db->delete('crutches');
    }
    
    function getActiveCrutches() {
        
        $this->db->where('status','Active');
        $query = $this->db->get('crutches')->result();
        return $query;
    }
    
}