<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertCategory($data) {

        $this->db->insert('feedback_category', $data);
    }

    function getCategory() {
        $query = $this->db->get('feedback_category');
        return $query->result();
    }

    function getCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('feedback_category');
        return $query->row();
    }

    function updateCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('feedback_category', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('feedback_category');
    }

   


}
