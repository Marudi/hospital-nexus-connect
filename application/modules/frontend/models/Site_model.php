<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertAppointment($data) {
        $data1 = array('hospital_id' => $this->session->userdata('url_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('appointment', $data2);
    }

    function getAppointment() {
        $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $this->db->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search .  "%' OR address LIKE '%" . $search . "%')", NULL, FALSE);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
         $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByLimitBySearch($limit, $start, $search) {

       

        $this->db->order_by('id', 'desc');  
        $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $this->db->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search .  "%' OR address LIKE '%" . $search . "%')", NULL, FALSE);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentForCalendar() {
        $this->db->order_by('id', 'asc');
         $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByDoctor($doctor) {
        $this->db->where('doctor', $doctor);
         $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByPatient($patient) {
         $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $this->db->where('patient', $patient);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('appointment');
        return $query->row();
    }

    function getAppointmentByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('appointment');
         $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function updateAppointment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('appointment');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }


    function getSettings() {
        $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $query = $this->db->get('single_website_settings');
        return $query->row();
    }

    function updateSettings($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('single_website_settings', $data);
    }
    
    function getAvailableSlotByDoctorByDate($date, $doctor) {
        //$newDate = date("m-d-Y", strtotime($date));
        $weekday = strftime("%A", $date);
         $this->db->where('hospital_id', $this->session->userdata('url_id'));
        $this->db->where('date', $date);
        $this->db->where('doctor', $doctor);
        $holiday = $this->db->get('holidays')->result();

        if (empty($holiday)) {
             $this->db->where('hospital_id', $this->session->userdata('url_id'));
            $this->db->where('date', $date);
            $this->db->where('doctor', $doctor);
            $query = $this->db->get('appointment')->result();


            $this->db->where('doctor', $doctor);
            $this->db->where('weekday', $weekday);
            $this->db->order_by('s_time_key', 'asc');
            $query1 = $this->db->get('time_slot')->result();

            $availabletimeSlot = array();
            $bookedTimeSlot = array();

            foreach ($query1 as $timeslot) {
                $availabletimeSlot[] = $timeslot->s_time . ' To ' . $timeslot->e_time;
            }
            foreach ($query as $bookedTime) {
                if ($bookedTime->status != 'Cancelled') {
                    $bookedTimeSlot[] = $bookedTime->time_slot;
                }
            }

            $availableSlot = array_diff($availabletimeSlot, $bookedTimeSlot);
        } else {
            $availableSlot = array();
        }

        return $availableSlot;
    }
    function getSiteSettingsByUrl($url){
        return $this->db->where('url_hospital',$url)
                ->get('single_website_settings')->row();
    }

}
