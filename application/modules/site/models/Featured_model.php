<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Featured_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertFeatured($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('site_featured', $data2);
    }

    function getFeatured()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('site_featured');
        return $query->result();
    }

    function getActiveFeatured()
    {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $query = $this->db->get('site_featured');
        return $query->result();
    }

    function getFeaturedById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('site_featured');
        return $query->row();
    }

    function updateFeatured($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('site_featured', $data);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('site_featured');
    }

    function updateIonUser($username, $email, $password, $ion_user_id)
    {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getFeaturedByIonUserId($id)
    {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('site_featured');
        return $query->row();
    }
}
