<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slide_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertSlide($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('site_slide', $data2);
    }

    function getSlide()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('site_slide');
        return $query->result();
    }

    function getActiveSlide() 
    {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $this->db->where('status', 'Active');
        $query = $this->db->get('site_slide');
        return $query->result();
    }

    function getSlideById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('site_slide');
        return $query->row();
    }

    function updateSlide($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('site_slide', $data);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('site_slide');
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

    function getSlideByIonUserId($id)
    {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('site_slide');
        return $query->row();
    }
}
