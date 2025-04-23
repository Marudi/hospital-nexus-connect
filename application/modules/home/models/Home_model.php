<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getSum($field, $table) {
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        return $query->result();
    }
    public function getTransactionLogs(){
         
        $last_30_days = strtotime('-30 days');
      
        $current_date_time = time()+(24*60*60);
        
        $date_format = '%d-%m-%Y %H:%i';

        // Build the query
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $this->db->from('transaction_logs');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(date_time, '$date_format')) <= $current_date_time");
        $this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(date_time, '$date_format')) >= $last_30_days");
       

        // Execute the query and return the result
        $query = $this->db->get();
        return $query->result();

    }
}
