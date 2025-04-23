<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Review_model extends CI_Model {
    
    function getReview() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('site_review')->result();
        return $query;
    }
    
    function insertReview($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('site_review',$data2);
    }
    
    function updateReview($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('site_review',$data);
    }
    
    function getReviewById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('site_review')->row();
        return $query;
    }
    
    function deleteReview($id) {
        $this->db->where('id', $id);
        $this->db->delete('site_review'); 
    }
    
    function getActiveReview() {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $this->db->where('status','Active');
        $query = $this->db->get('site_review')->result();
        return $query;
    }
}