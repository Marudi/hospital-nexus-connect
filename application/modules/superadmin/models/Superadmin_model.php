<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Superadmin_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertSuperadmin($data) {
        $this->db->insert('superadmin', $data); 
    }

    function getSuperadmin() {

        $query = $this->db->get('superadmin');
        return $query->result();
    }

    function getSuperadminById($id) {

        $this->db->where('id', $id);
        $query = $this->db->get('superadmin');
        return $query->row();
    }

    function updateSuperadmin($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('superadmin', $data);
    }

    function updateSuperadminByIonId($id, $data) {
        $this->db->where('ion_user_id', $id);
        $this->db->update('superadmin', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('superadmin');
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
    function getSuperadminByIonUserId($id) {
       
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('superadmin');
        return $query->row();
    }
}
