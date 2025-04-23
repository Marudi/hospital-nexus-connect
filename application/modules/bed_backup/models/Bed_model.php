<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bed_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertBed($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('bed', $data2);
    }

    function getBed() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('bed');
        return $query->result();
    }
    
    function getBedWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('bed');
        return $query->result();
    }

    function getBedBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('bed')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR bed_id LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getBedByLimit($limit, $start, $order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('bed');
        return $query->result();
    }

    function getBedByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('bed')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR bed_id LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getBedById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('bed');
        return $query->row();
    }

    function updateBed($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bed', $data);
    }

    function updateBedByBedId($bed_id, $data) {
        $this->db->where('bed_id', $bed_id);
        $this->db->update('bed', $data);
    }

    function insertBedCategory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('bed_category', $data2);
    }

    function getBedCategory() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('bed_category');
        return $query->result();
    }

    function getBedAllotmentsByPatientId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $id);
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }

    function getBedCategoryById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('bed_category');
        return $query->row();
    }

    function updateBedCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bed_category', $data);
    }

    function deleteBed($id) {
        $this->db->where('id', $id);
        $this->db->delete('bed');
    }

    function deleteBedCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('bed_category');
    }

    function insertAllotment($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('alloted_bed', $data2);
    }

    function getAllotment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }
    
    function getAllotmentWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }

    function getBedAllotmentBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('alloted_bed')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR bed_id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getBedAllotmentByLimit($limit, $start, $order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }

    function getBedAllotmentByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('alloted_bed')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR bed_id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getAllotmentById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('alloted_bed');
        return $query->row();
    }

    function updateAllotment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('alloted_bed', $data);
    }

    function deleteBedAllotment($id) {
        $this->db->where('id', $id);
        $this->db->delete('alloted_bed');
    }

    function getAllotedBedByTime($a_time, $d_time, $bed_id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->group_start();
        $this->db->where('bed_id', $bed_id);
        $this->db->where('a_time_search <=', strtotime(str_replace(" - ", " ", $a_time)));
        $this->db->where('d_time_search >=', strtotime(str_replace(" - ", " ", $a_time)));
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('bed_id', $bed_id);
        $this->db->where('a_time_search <=', strtotime(str_replace(" - ", " ", $d_time)));
        $this->db->where('d_time_search >=', strtotime(str_replace(" - ", " ", $d_time)));
        $this->db->group_end();
        $this->db->where('bed_id', $bed_id);
        return $this->db->get('alloted_bed')->result();
    }

    function getAllotedBedByATime($a_time, $d_time, $bed_id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->group_start();
        $this->db->where('bed_id', $bed_id);
        $this->db->where('a_time_search <=', strtotime(str_replace(" - ", " ", $a_time)));
        $this->db->where('d_time_search >=', strtotime(str_replace(" - ", " ", $a_time)));
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('bed_id', $bed_id);
        $this->db->where('a_time_search <=', strtotime(str_replace(" - ", " ", $d_time)));
        $this->db->where('d_time_search >=', strtotime(str_replace(" - ", " ", $d_time)));
        $this->db->group_end();
        return $this->db->get('alloted_bed')->result();
    }

    function getNotBedAvailableList($date, $category) {

        $array = array('bed_id' => $category, 'a_time_search <=' => $date, 'd_time_search >=' => $date);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where($array);
        return $this->db->get('alloted_bed')->result();
    }

    function getNotBedAvailableListFromEdit($date, $category, $id) {

        $array = array('bed_id' => $category, 'a_time_search <=' => $date, 'd_time_search >=' => $date, 'id !=' => $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where($array);
        return $this->db->get('alloted_bed')->result();
    }
    function getBedByCategory($id) {

        return $this->db->where('hospital_id', $this->session->userdata('hospital_id'))
                        ->where('category', $id)
                        ->get('bed')->result();
    }

    function getBloodGroup() {
        return $this->db->get('blood_group')->result();
    }

    function getDailyProgressByBedId($id) {
        return $this->db->where('hospital_id', $this->session->userdata('hospital_id'))
                        ->where('alloted_bed_id', $id)
                       
                        ->get('daily_progress')->result();
    }

    function getDailyProgressById($id) {
        return $this->db->where('id', $id)
                        ->where('hospital_id', $this->session->userdata('hospital_id'))
                        ->get('daily_progress')->row();
    }

    function insertDailyProgress($data) {
        
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('daily_progress', $data2);
    }

    function updateDailyProgress($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('daily_progress', $data);
    }
   function insertMedicineAllotedPatient($data) {
      
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('bed_medicine', $data2);
    }
     function getMedicineAllotedPatientById($id) {
        return $this->db->where('id', $id)
                        ->where('hospital_id', $this->session->userdata('hospital_id'))
                        ->get('bed_medicine')->row();
    }
     function updateMedicineAlloted($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bed_medicine', $data);
    }
    function getMedicineAllotedByBedId($id) {
        return $this->db->where('alloted_bed_id', $id)
                        ->where('hospital_id', $this->session->userdata('hospital_id'))
                        ->get('bed_medicine')->result();
    }
    function deleteMedicine($id) {
        $this->db->where('id', $id);
        $this->db->delete('bed_medicine');
    }
    function getServicesByDate($date){
        return $this->db->where('date',$date)       
        ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->get('bed_service')->row();
    }
    
    function updateServices($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bed_service', $data);
    }
     
       function insertServices($data) {
      
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('bed_service', $data2);
    }
    function getServiceAllotedByBedId($id) {
        return $this->db->where('alloted_bed_id', $id)
                        ->where('hospital_id', $this->session->userdata('hospital_id'))
                        ->get('bed_service')->result();
    }
    function getServicedById($id) {
        return $this->db->where('id', $id)
                       
                        ->get('bed_service')->row();
    }
     function deleteServices($id) {
        $this->db->where('id', $id);
        $this->db->delete('bed_service');
    }
       function insertCheckout($data) {
       
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('bed_checkout', $data2);
    }
    function updateCheckout($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bed_checkout', $data);
    }
     function getCheckoutdById($id) {
        return $this->db->where('id', $id)
        ->where('hospital_id', $this->session->userdata('hospital_id'))
                        ->get('bed_checkout')->row();
    }
     function getCheckoutByBedId($id) {
        return $this->db->where('alloted_bed_id', $id)
        ->where('hospital_id', $this->session->userdata('hospital_id'))
                        ->get('bed_checkout')->row();
    }
     function getAllotedBedByBedIdByDate($bed_id,$date) {
       
        $this->db->where('bed_id', $bed_id)->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('a_timestamp <=', $date);
        
          //$this->db->limit('1');
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }
     function getBedAllotmentsById($id) {
       
        $this->db->where('id', $id);
        $query = $this->db->get('alloted_bed');
        return $query->row();
    }
    function getServicedByIdByDate($id) {
        return $this->db->where('alloted_bed_id', $id)
                        ->where('hospital_id', $this->session->userdata('hospital_id'))
                       ->where('date',date('d-m-Y'))
                        ->get('bed_service')->row();
    }



   



}
