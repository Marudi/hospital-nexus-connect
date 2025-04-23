<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertBlog($data) {

        $this->db->insert('blog', $data);
    }

    function getBlog() {
     
        $query = $this->db->get('blog');
        return $query->result();
    }

    function getBlogById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('blog');
        return $query->row();
    }

    function updateBlog($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('blog', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('blog');
    }



}
