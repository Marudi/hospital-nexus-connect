<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertSettings($hospital_settings_data)
    {
        $this->db->insert('settings', $hospital_settings_data);
    }

    function getSettings()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('settings');
        return $query->row();
    }

    function updateSettings($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('settings', $data);
    }

    function updateHospitalSettings($id, $data)
    {
        $this->db->where('hospital_id', $id);
        $this->db->update('settings', $data);
    }

    function getSubscription()
    {
        $this->db->where('id', $this->hospital_id);
        $query = $this->db->get('hospital');
        return $query->row();
    }

    function getHospitalPaymentsById($id)
    {
        return $this->db->where('hospital_user_id', $id)
            ->get('hospital_payment')->row();
    }

    function getStaffinfoWithAddNewOption($searchTerm)
    {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records5 = $this->db->get('nurse')->result_array();
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records6 = $this->db->get('doctor')->result_array();
            $users = array_merge($fetched_records1, $fetched_records2, $fetched_records3, $fetched_records4, $fetched_records5, $fetched_records6);
        } else {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(2);
            $fetched_records1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(2);
            $fetched_records2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(2);
            $fetched_records3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(2);
            $fetched_records4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(2);
            $fetched_records5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(2);
            $fetched_records6 = $this->db->get('doctor')->result_array();
            $users = array_merge($fetched_records1, $fetched_records2, $fetched_records3, $fetched_records4, $fetched_records5, $fetched_records6);
        }

        $data = array();

        foreach ($users as $user) {
            $data[] = array("id" => $user['ion_user_id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }

    function getColumnOrder($order, $columns_valid = array())
    {
        $col = 0;
        $dir = "";
        $values = array();
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != "desc") {
            $dir = "asc";
        }
        if (!isset($columns_valid[$col])) {
            $order = null;
        } else {
            $order = $columns_valid[$col];
        }
        $values[] = $dir;
        $values[] = $order;
        return $values;
    }



    function getGoogleReCaptchaSettings()
    {
        $query = $this->db->get('google_captcha');
        return $query->row();
    }

    function addGoogleReCaptcha($data){
        $this->db->insert('google_captcha', $data);
    }

    function updateGoogleReCaptcha($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('google_captcha', $data);
    }

    function getSettingsByHId($hospital_id)
    {
        $this->db->where('hospital_id', $hospital_id);
        $query = $this->db->get('settings');
        return $query->row();
    }
}
