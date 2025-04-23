<?php

Class Chat_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getName($id) {
        $this->db->where('id', $id);
        return $this->db->get('users')->row()->username;
    }
}

