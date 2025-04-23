<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roadmap_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertRoadmap($data) {

        $this->db->insert('feedback_roadmap', $data);
    }

    function getRoadmap() {
        $query = $this->db->get('feedback_roadmap');
        return $query->result();
    }

    function getRoadmapById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('feedback_roadmap');
        return $query->row();
    }
    function getRoadmapFeedbackById($id) {
        $this->db->where('roadmap', $id);
        $query = $this->db->get('feedback_roadmap');
        return $query->row();
    }

    function updateRoadmap($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('feedback_roadmap', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('feedback_roadmap');
    }

   


}
