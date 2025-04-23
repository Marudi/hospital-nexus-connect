<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertFaq($data) {

        $this->db->insert('faq', $data);
    }

    function getFaq() {
        $query = $this->db->get('faq');
        return $query->result();
    }

    function getFaqById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('faq');
        return $query->row();
    }

    function updateFaq($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('faq', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('faq');
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

    function getFaqByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('faq');
        return $query->row();
    }

}
