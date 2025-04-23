<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_model extends CI_Model {
    
    function getGallery() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('site_gallery')->result();
        return $query;
    }
    
    function insertGallery($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('site_gallery',$data2);
    }
    
    function updateGallery($id, $data) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $this->db->update('site_gallery',$data);
    }
    
    function getGalleryById($id) { 
        $this->db->where('id', $id);
        $query = $this->db->get('site_gallery')->row();
        return $query;
    }
    
    function deleteGallery($id) {
        $this->db->where('id', $id);
        $this->db->delete('site_gallery');
    }
    
    function getActiveImages() {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $this->db->where('status','Active');
        $this->db->order_by('position','ASC');
        $query = $this->db->get('site_gallery')->result();
        return $query;
    }
}
