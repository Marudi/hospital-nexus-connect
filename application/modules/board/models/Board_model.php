<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Board_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertBoard($data) {

        $this->db->insert('feedback_board', $data);
    }

    function getBoard() {
        $query = $this->db->get('feedback_board');
        return $query->result();
    }

    function getBoardById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('feedback_board');
        return $query->row();
    }

    function updateBoard($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('feedback_board', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('feedback_board');
    }

   


}
