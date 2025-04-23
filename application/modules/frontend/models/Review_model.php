<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Review_model extends CI_Model {
    
    function getReview() {
         
        $query = $this->db->get('review')->result();
        return $query;
    }
    
    function insertReview($data) {
        
        $this->db->insert('review',$data);
    }
    
    function updateReview($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('review',$data);
    }
    
    function getReviewById($id) {
        
        $this->db->where('id', $id);
        $query = $this->db->get('review')->row();
        return $query;
    }
    
    function deleteReview($id) {
        $this->db->where('id', $id);
        $this->db->delete('review');
    }
    
    function getActiveReview() {
        
        $this->db->where('status','Active');
        $query = $this->db->get('review')->result();
        return $query;
    }
    
}