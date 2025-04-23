<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Macro_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertMacro($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('macro', $data2);
    }

    function getMacro() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('macro');
        return $query->result();
    }

    function getMacroById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('macro');
        return $query->row();
    }
    
  

    function updateMacro($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('macro', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('macro');
    }
    
    function getMacroWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('macro');
        return $query->result();
    }

    function getMacroBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $query = $this->db->select('*')
                ->from('macro')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR short_name LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getMacroByLimit($limit, $start, $order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('short_name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('macro');
        return $query->result();
    }

    function getMacroByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('short_name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('macro')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR short_name LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }
    
    function checkMarcoExists($word) {
        $this->db->where('short_name', $word);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        return $this->db->get('macro')->row();
    }
    

}
