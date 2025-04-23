<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertFile($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('file', $data2);
    }

    function getFile() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('file');
        return $query->result();
    }

    function getFileById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('file');
        return $query->row();
    }

    function updateFile($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('file', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('file');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

}
