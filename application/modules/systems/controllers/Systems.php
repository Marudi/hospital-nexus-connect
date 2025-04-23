<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Systems extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('systems_model');
    }

    public function activeHospitals() {
        $data['hospitals'] = array();
        $hospitalLists = $this->db->get('hospital')->result();
        foreach ($hospitalLists as $hospitalList) {
            $this->db->where('id', $hospitalList->ion_user_id);
            $status = $this->db->get('users')->row();
            if ($status->active == "1") {
                array_push($data['hospitals'], $hospitalList);
            }
        }
       
        $this->load->view('home/dashboard');
        $this->load->view('active_hospital', $data);
        $this->load->view('home/footer');
    }

    public function inactiveHospitals() {
        $data['hospitals'] = array();
        $hospitalLists = $this->db->get('hospital')->result();
        foreach ($hospitalLists as $hospitalList) {
            $this->db->where('id', $hospitalList->ion_user_id);
            $status = $this->db->get('users')->row();
            if ($status->active == "0") {
                array_push($data['hospitals'], $hospitalList);
            }
        }
        $this->load->view('home/dashboard');
        $this->load->view('inactive_hospital', $data);
        $this->load->view('home/footer');
    }

    public function expiredHospitals() {
        $data['hospitals'] = array();
        $data['hospitalExpiredList'] = $this->db->get('hospital_payment')->result();
        
        $this->load->view('home/dashboard');
        $this->load->view('expired_hospital', $data);
        $this->load->view('home/footer');
    }

    public function registeredDoctor() {
        $data['doctors'] = $this->db->get('doctor')->result();
        $this->load->view('home/dashboard');
        $this->load->view('registered_doctor', $data);
        $this->load->view('home/footer');
    }

    function getDoctor() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['doctors'] = $this->systems_model->getDoctorBysearch($search);
            } else {
                $data['doctors'] = $this->systems_model->getDoctor();
            }
        } else {
            if (!empty($search)) {
                $data['doctors'] = $this->systems_model->getDoctorByLimitBySearch($limit, $start, $search);
            } else {
                $data['doctors'] = $this->systems_model->getDoctorByLimit($limit, $start);
            }
        }

        $i = 0;
        foreach ($data['doctors'] as $doctor) {
            $i = $i + 1;
            $info[] = array(
                $doctor->id,
                $doctor->name,
                $doctor->phone,
                $this->db->get_where('hospital', array('id' => $doctor->hospital_id))->row()->name,
                    //  $options2
            );
        }

        if (!empty($data['doctors'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->systems_model->getDoctor()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    public function registeredPatient() {
        $data['patients'] = $this->db->get('patient')->result();
        $this->load->view('home/dashboard');
        $this->load->view('registered_patient', $data);
        $this->load->view('home/footer');
    }

    function getPatient() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->systems_model->getPatientBysearch($search);
            } else {
                $data['patients'] = $this->systems_model->getPatient();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->systems_model->getPatientByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->systems_model->getPatientByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();
      
        $i = 0;
        foreach ($data['patients'] as $patient) {
           // $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="systems/deletePatient?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            $i = $i + 1;
            $info[] = array(
                $patient->id,
                $patient->name,
                $patient->phone,
                $this->db->get_where('hospital', array('id' => $patient->hospital_id))->row()->name,
               // $options5
            );
        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->systems_model->getPatient()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

//    function deletePatient() {
//        $data = array();
//        $id = $this->input->get('id');
//
//        $patient_hospital_id = $this->patient_model->getPatientById($id)->hospital_id;
//        if ($patient_hospital_id != $this->session->userdata('hospital_id')) {
//            redirect('home/permission');
//        }
//
//        $user_data = $this->db->get_where('patient', array('id' => $id))->row();
//        $path = $user_data->img_url;
//
//        if (!empty($path)) {
//            unlink($path);
//        }
//        $ion_user_id = $user_data->ion_user_id;
//        $this->db->where('id', $ion_user_id);
//        $this->db->delete('users');
//        $this->patient_model->delete($id);
//        $this->session->set_flashdata('feedback', lang('deleted'));
//        redirect('systems/registeredPatient');
//    }

}
