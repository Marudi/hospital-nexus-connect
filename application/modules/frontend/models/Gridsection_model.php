<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gridsection_model extends CI_Model {

    function getGridsection() {
       
        $query = $this->db->get('grid')->result();
        return $query;
    }

    function insertGridsection($data) {
       
        $this->db->insert('grid', $data);
    }

    function updateGridsection($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('grid', $data);
    }

    function getGridsectionById($id) {
      
        $this->db->where('id', $id);
        $query = $this->db->get('grid')->row();
        return $query;
    }

    function deleteGridsection($id) {
        $this->db->where('id', $id);
        $this->db->delete('grid');
    }

    function getActiveGrids() {
        
        $this->db->where('status', 'Active');
        $this->db->order_by('position', 'ASC');
        $query = $this->db->get('grid')->result();
        return $query;
    }

}
