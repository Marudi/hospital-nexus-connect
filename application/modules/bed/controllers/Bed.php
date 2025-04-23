<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bed extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('bed_model');
        $this->load->model('patient/patient_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('nurse/nurse_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('pservice/pservice_model');
        $this->load->model('finance/finance_model');
        $this->load->model('lab/lab_model');

        if ($this->ion_auth->in_group(array('pharmacist', 'Laboratorist', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Accountant'))) {
            redirect('home/permission');
        }
        $data['beds'] = $this->bed_model->getBed();
        $data['categories'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bed', $data);
        $this->load->view('home/footer'); // just the header file  
    }

    public function addBedView()
    {
        $data = array();
        $data['categories'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_bed_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addBed()
    {
        $id = $this->input->post('id');
        $number = $this->input->post('number');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $category = $this->input->post('category');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('number', 'Bed Number', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['categories'] = $this->bed_model->getBedCategory();
                $data['bed'] = $this->bed_model->getBedById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_bed_view', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['categories'] = $this->bed_model->getBedCategory();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_bed_view', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $bed_id = implode('-', array($category, $number));
            $data = array();
            $data = array(
                'category' => $category,
                'number' => $number,
                'description' => $description,
                'bed_id' => $bed_id
            );
            if (empty($id)) {
                $this->bed_model->insertBed($data);
                //  $this->log_model->insertLog($this->ion_auth->get_user_id(), date('d-m-Y H:i:s', time()), 'Add New Bed(id='.$this->db->insert_id().' )', $this->db->insert_id());
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->bed_model->updateBed($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('bed');
        }
    }

    function editBed()
    {
        $data = array();
        $data['categories'] = $this->bed_model->getBedCategory();
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_bed_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editBedByJason()
    {
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedById($id);
        echo json_encode($data);
    }

    function delete()
    {
        $id = $this->input->get('id');
        $this->bed_model->deleteBed($id);
        //$this->log_model->insertLog($this->ion_auth->get_user_id(), date('d-m-Y H:i:s', time()), 'Delete Bed(id='.$id.' )', $id);
        redirect('bed');
    }

    public function bedCategory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Accountant'))) {
            redirect('home/permission');
        }
        $data['categories'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bed_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addCategoryView()
    {

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_category_view');
        $this->load->view('home/footer'); // just the header file
    }

    public function addCategory()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['bed'] = $this->bed_model->getBedCategoryById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_category_view', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_category_view', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->bed_model->insertBedCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->bed_model->updateBedCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('bed/bedCategory');
        }
    }

    function editCategory()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedCategoryById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_category_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editBedCategoryByJason()
    {
        $id = $this->input->get('id');
        $data['bedcategory'] = $this->bed_model->getBedCategoryById($id);
        echo json_encode($data);
    }

    function deleteBedCategory()
    {
        $id = $this->input->get('id');
        $this->bed_model->deleteBedCategory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('bed/bedCategory');
    }

    function bedAllotment()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Accountant'))) {
            redirect('home/permission');
        }
        $data['blood_group'] = $this->bed_model->getBloodGroup();

        $data['room_no'] = $this->bed_model->getBedCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $data['alloted_beds'] = $this->bed_model->getAllotment();

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bed_allotment', $data);
        $this->load->view('home/footer'); // just 
    }

    function addAllotmentView()
    {
        $data = array();
        $data['blood_group'] = $this->bed_model->getBloodGroup();

        $data['room_no'] = $this->bed_model->getBedCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_allotment_view', $data);
        $this->load->view('home/footer'); // just the header file
    }
    function editAllotmentView()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['blood_group'] = $this->bed_model->getBloodGroup();
        $data['allotment'] = $this->bed_model->getAllotmentById($id);
        $data['room_no'] = $this->bed_model->getBedCategory();
        // $beds=$this->bed_model->getBedByCategory($data['allotment']->category);
        // $option='';

        $alloted_time = $data['allotment']->a_time;
        // echo $alloted_time;
        $alloted_time_array = array();
        $alloted_time_array = explode("-", $alloted_time);
        $alloted_timestamp = strtotime($alloted_time_array[0] . ' ' . $alloted_time_array[1]);
        $beds = $this->bed_model->getBedByCategory($data['allotment']->category);
        $option = '';

        foreach ($beds as $bed) {
            $alloted_bed = array();
            $alloted_bed = $this->bed_model->getAllotedBedByBedIdByDate($bed->id, $alloted_timestamp);

            if (empty($alloted_bed)) {

                if ($bed->id == $data['allotment']->bed_id) {
                    $option .= '<option value="' . $bed->id . '" selected>' . $bed->number . '</option>';
                } else {
                    $option .= '<option value="' . $bed->id . '">' . $bed->number . '</option>';
                }
            } else {
                foreach ($alloted_bed as $al_bed) {
                    if ($al_bed->d_timestamp >= $alloted_timestamp || empty($al_bed->d_timestamp) && $al_bed->bed_id != $data['allotment']->bed_id) {
                        $option1 = "1";
                    } else {

                        if ($bed->id == $data['allotment']->bed_id) {
                            $option .= '<option value="' . $bed->id . '" selected>' . $bed->number . '</option>';
                        } else {
                            $option .= '<option value="' . $bed->id . '">' . $bed->number . '</option>';
                        }
                    }
                }
            }
        }

        $data['bed'] = $option;
        $data['patients'] = $this->patient_model->getPatient();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_allotment_view', $data);
        $this->load->view('home/footer'); // just the header file
    }
    function addAllotment()
    {
        $id = $this->input->post('id');
        $category_status = $this->input->post('category_status');

        $category_status_update = implode(',', $category_status);

        //$covid_19 = $this->input->post('covid_19');
        $reaksione = $this->input->post('reaksione');
        $transferred_from = $this->input->post('transferred_from');
        $diagnoza_a_shtrimit = $this->input->post('diagnoza_a_shtrimit');
        $doctor = $this->input->post('doctor');
        $diagnosis = $this->input->post('diagnosis');
        $other_illnesses = $this->input->post('other_illnesses');
        $anamneza = $this->input->post('anamneza');
        $blood_group = $this->input->post('blood_group');
        $accepting_doctor = $this->input->post('accepting_doctor');
        $category = $this->input->post('category');
        $patient = $this->input->post('patient');
        $a_time = $this->input->post('a_time');
        $a_time_array = array();
        $a_time_array = explode("-", $a_time);
        $a_timestamp = strtotime($a_time_array[0] . ' ' . $a_time_array[1]);

        //$d_time = $this->input->post('d_time');
        // $status = $this->input->post('status');
        $bed_id = $this->input->post('bed_id');

        $bed_details = $this->bed_model->getBedById($bed_id);
        $bed_display_id = $bed_details->category . '-' . $bed_details->number;

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('bed_id', 'Bed', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Alloted Time Field
        $this->form_validation->set_rules('a_time', 'Alloted Time', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Discharge Time Field
        // $this->form_validation->set_rules('d_time', 'Discharge Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Status Field
        //$this->form_validation->set_rules('status', 'Status', 'trim|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['blood_group'] = $this->bed_model->getBloodGroup();

            $data['room_no'] = $this->bed_model->getBedCategory();
            $data['patients'] = $this->patient_model->getPatient();
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_allotment_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $patientname = $this->patient_model->getPatientById($patient)->name;
            $data = array(
                'bed_id' => $bed_id,
                'patient' => $patient,
                'a_time' => $a_time,
                'category' => $category,
                'category_status' => $category_status_update,
                'reaksione' => $reaksione,
                //'covid_19' => $covid_19,
                'transferred_from' => $transferred_from,
                'anamneza' => $anamneza,
                'accepting_doctor' => $accepting_doctor,
                'doctor' => $doctor,
                'diagnosis' => $diagnosis,
                'diagnoza_a_shtrimit' => $diagnoza_a_shtrimit,
                'blood_group' => $blood_group,
                'other_illnesses' => $other_illnesses,
                // 'd_time' => $d_time,
                // 'status' => $status,
                'patientname' => $patientname,
                'a_timestamp' => $a_timestamp,
                'bed_display_id' => $bed_display_id
            );



            if (empty($id)) {
                $this->bed_model->insertAllotment($data);
                $inserted_id = $this->db->insert_id('alloted_bed');
                $bed_data = array(
                    'current_allotment_id' => $inserted_id,
                );
                //  $this->log_model->insertLog($this->ion_auth->get_user_id(), date('d-m-Y H:i:s', time()), 'Add New Bed Allotment(id='.$this->db->insert_id().' )', $this->db->insert_id());
                $this->bed_model->updateBed($bed_id, $bed_data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->bed_model->updateAllotment($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            $redirect = $this->input->post('redirect');
            if ($redirect == 'redirect') {
                redirect('patient/medicalHistory?id=' . $patient);
            } else {
                redirect('bed/bedAllotment');
            }
        }
    }

    function editAllotment()
    {
        $data = array();
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $id = $this->input->get('id');
        $data['allotment'] = $this->bed_model->getAllotmentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_allotment_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editAllotmentByJason()
    {
        $id = $this->input->get('id');
        $data['allotment'] = $this->bed_model->getAllotmentById($id);
        $data['patient'] = $this->patient_model->getPatientById($data['allotment']->patient);
        echo json_encode($data);
    }

    function deleteAllotment()
    {
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
        $id = $this->input->get('id');
        $this->bed_model->deletePaymentByAllotmentId($id);
        $this->bed_model->deleteServiceByAllotmentId($id);
        $this->bed_model->deleteMedicineByAllotmentId($id);
        $this->bed_model->deleteDiagnosticByAllotmentId($id);
        $this->bed_model->deleteCheckoutByAllotmentId($id);
        $this->bed_model->deleteDailyProgressByAllotmentId($id);
        $this->bed_model->deleteBedLab($id);
        $this->bed_model->deleteBedAllotment($id);
        //$this->log_model->insertLog($this->ion_auth->get_user_id(), date('d-m-Y H:i:s', time()), 'Delete Bed Allotment(id='.$id.' )', $id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('bed/bedAllotment');
    }

    function getBedList()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $status = $this->input->get('status');

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "bed_id",
            "1" => "description",
            "2" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['beds'] = $this->bed_model->getBedBysearch($search, $order, $dir);
            } else {
                $data['beds'] = $this->bed_model->getBedWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['beds'] = $this->bed_model->getBedByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['beds'] = $this->bed_model->getBedByLimit($limit, $start, $order, $dir);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;

        foreach ($data['beds'] as $bed) {
            $i = $i + 1;
            $option1 = '';
            $option2 = '';
            if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Accountant'))) {
                $option1 = '<button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $bed->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</button>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Accountant'))) {
                $option2 = '<a class="btn btn-soft-danger btn-xs btn_width delete_button" href="bed/delete?id=' . $bed->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            }
            $last_a_time = explode('-', $bed->last_a_time);
            $last_d_time = strtotime($bed->last_d_time);
            // if (!empty($last_d_time[1])) {
            //     $last_d_h_am_pm = explode(' ', $last_d_time[1]);
            //     $last_d_h = explode(':', $last_d_h_am_pm[1]);
            //     if ($last_d_h_am_pm[2] == 'AM') {
            //         $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
            //     } else {
            //         $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
            //     }
            //     $last_d_time = strtotime($last_d_time[0]) + $last_d_m;
            // }


            $current_allotment_id = $bed->current_allotment_id;
            $current_allotment = $this->bed_model->getAllotmentById($current_allotment_id);




            if (!empty($current_allotment->a_timestamp)) {
                if (empty($current_allotment->d_timestamp)) {
                    $bedstatus = '<span class="badge badge-soft-success">' . lang('alloted') . '</span>';
                    if ($status == 'available') {
                        continue;
                    }
                } elseif ((time() > $current_allotment->d_timestamp)) {
                    $bedstatus = '<span class="badge badge-soft-primary">' . lang('available') . '</span>';
                   
                    if ($status == 'alloted') {
                        continue;
                    }
                } elseif ((time() < $current_allotment->d_timestamp)) {
                    $bedstatus = '<span class="badge badge-soft-success">' . lang('alloted') . '</span>';
                  
                    if ($status == 'available') {
                        continue;
                    }
                }
            } else {
                $bedstatus = '<span class="badge badge-soft-primary">' . lang('available') . '</span>';
               
                if ($status == 'alloted') {
                    continue;
                }
            }


            $info[] = array(
                $bed->bed_id,
                $bed->description,
                $bedstatus,
                $option1 . ' ' . $option2
            );
        }

        if (!empty($info)) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['beds']),
                "recordsFiltered" => count($data['beds']),
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

    function getBedAllotmentList()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $status = $this->input->get('status');

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "a_time",
            "3" => "d_time",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['beds'] = $this->bed_model->getBedAllotmentBysearch($search, $order, $dir);
            } else {
                $data['beds'] = $this->bed_model->getAllotmentWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['beds'] = $this->bed_model->getBedAllotmentByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['beds'] = $this->bed_model->getBedAllotmentByLimit($limit, $start, $order, $dir);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;

        foreach ($data['beds'] as $bed) {

          
            if ($status == 'discharged') {
                if (empty($bed->d_time ?? null)) {
                    continue;
                }
            }
            if ($status == 'admitted_now') {
                if (!empty($bed->d_time ?? null)) {
                    continue;
                }
            }
           
          

            $i = $i + 1;
            $option1 = '';
            $option2 = '';
            if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor'))) {
                $option1 = '<a class="btn btn-soft-info btn-xs btn_width editbutton" href="bed/bedAllotmentDetails?id=' . $bed->id . '"><i class="fa fa-edit"> </i> '. lang('all') .' '. lang('details') . '</a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor'))) {
                $option2 = '<a class="btn btn-soft-danger btn-xs btn_width delete_button" href="bed/deleteAllotment?id=' . $bed->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            }
            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                $option1 = '<a class="btn btn-soft-info btn-xs btn_width editbutton" href="bed/editAllotmentView?id=' . $bed->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . ' ' . lang('checkin') . '</a>';
            }


            // $option3 = '<a class="btn btn-xs btn-success invoicebutton" style="margin-right: 10px" target="_blank" href="bed/printLabel?id=' . $bed->id . '">Label Print</a><a class="btn btn-xs btn-warning" href="bed/pdfLabel?id=' . $bed->id . '".><i class="fas fa-file"></i></a>';
            $option3 = '<a class="btn btn-xs btn-soft-success btn_width invoicebutton" style="margin-right: 10px" target="_blank" href="bed/printLabel?id=' . $bed->id . '"><i class="fa fa-print"> </i> Label Print</a>';

            $patientdetails = $this->patient_model->getPatientById($bed->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $bed->patientname;
            }

            $doctorDetails = $this->doctor_model->getDoctorById($bed->doctor);
            if (!empty($doctorDetails)) {
                $doctorname = $doctorDetails->name;
            } else {
                $doctortname = '';
            }

            if (!empty($bed->d_time)) {
                $decharge = '<a class="btn btn-soft-primary btn-xs btn_width " href="bed/dischargeReport?id=' . $bed->id . '"><i class="fa fa-file"> </i> ' . lang('discharge_report') . '</a>';
            } else {
                $decharge = ' ';
            }


            $bill_summary_button = '<a class="btn btn-soft-warning btn-xs btn_width label-warning" style="color: #fff;" target="_blank" href="bed/billDetails?id=' . $bed->id . '"><i class="fa fa-file"> </i> ' . lang('bill') . ' ' . lang('details') . '</a>';





            if (!empty($bed->bed_id)) {
                $bed_details = $this->bed_model->getBedById($bed->bed_id);
            }

            $bed_display_id = $bed->bed_display_id;
            if (empty($bed_display_id)) {
                $bed_display_id = $bed_details->category . '-' . $bed_details->number;
            }

            $due = $this->bed_model->getAllBedPaymentsSummary($bed->id)['due'];
            $due_formated = number_format($due, 2);

            $info[] = array(
                $bed_display_id,
                $patientname,
                $doctorname,
                $bed->a_time,
                $bed->d_time,
                $this->settings->currency . $due_formated,
                $option1 . ' ' . $bill_summary_button . ' ' . $option3 . ' ' . $decharge . ' ' . $option2
            );
        }

        if (!empty($info)) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['beds']),
                "recordsFiltered" => count($data['beds']),
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








    function getNotAvailableBed()
    {
        $date = $this->input->get('date');
        $dateexplode = explode('-', $date);
        $timesttamp = strtotime($dateexplode[0] . ' ' . $dateexplode[1]);
        $category = $this->input->get('category');
        $data = array();
        $data['bedlist'] = $this->bed_model->getNotBedAvailableList($timesttamp, $category);
        $data['date'] = $timesttamp;
        echo json_encode($data);
    }

    function getNotAvailableBedFromEdit()
    {
        $date = $this->input->get('date');
        $dateexplode = explode('-', $date);
        $timesttamp = strtotime($dateexplode[0] . ' ' . $dateexplode[1]);
        $category = $this->input->get('category');
        $id = $this->input->get('id');
        $data = array();
        $data['bedlist'] = $this->bed_model->getNotBedAvailableListFromEdit($timesttamp, $category, $id);
        $data['date'] = $timesttamp;
        echo json_encode($data);
    }

    function getBedByRoomNo()
    {
        $id = $this->input->get('id');
        $alloted_time = $this->input->get('alloted_time');
        // echo $alloted_time;
        $alloted_time_array = array();
        $alloted_time_array = explode("-", $alloted_time);
        $alloted_timestamp = strtotime($alloted_time_array[0] . ' ' . $alloted_time_array[1]);
        $beds = $this->bed_model->getBedByCategory($id);
        $option = '';
        $option = '<option  value="select">' . lang('select') . '</option>';
        foreach ($beds as $bed) {
            $alloted_bed = array();
            $alloted_bed = $this->bed_model->getAllotedBedByBedIdByDate($bed->id, $alloted_timestamp);

            if (empty($alloted_bed)) {

                $option .= '<option value="' . $bed->id . '">' . $bed->number . '</option>';
            } else {
                foreach ($alloted_bed as $al_bed) {
                    if ($al_bed->d_timestamp >= $alloted_timestamp || empty($al_bed->d_timestamp)) {
                        $option1 = "1";
                    } else {

                        $option .= '<option value="' . $bed->id . '">' . $bed->number . '</option>';
                    }
                }
            }
        }
        $data['response'] = $option;
        echo json_encode($data);
    }

    function bedAllotmentDetails()
    {
        $id = $this->input->get('id');
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['allotment'] = $this->bed_model->getBedAllotmentsById($id);
        $data['bed_id'] = $this->bed_model->getBedByCategory($data['allotment']->category);
        $data['patient'] = $this->patient_model->getPatientById($data['allotment']->patient);
        $data['pservice'] = $this->pservice_model->getPserviceByActive();
        $data['doctor'] = $this->doctor_model->getDoctorById($data['allotment']->doctor);
        $data['daily_progress'] = $this->bed_model->getDailyProgressByBedId($id);
        $data['daily_medicine'] = $this->bed_model->getMedicineAllotedByBedId($id);
        $data['daily_service'] = $this->bed_model->getServiceAllotedByBedId($id);
        $data['diagnostics_alloted'] = $this->bed_model->getDiagnosticAllotedByBedId($id);

        $data['diagnostics'] = $this->finance_model->getPaymentCategory();


        $data['all_payments'] = $this->bed_model->getAllBedPayments($id);


        $data['bed_checkout'] = $this->bed_model->getCheckoutByBedId($id);
        $date_exist = $this->bed_model->getServicesByDate(date('d-m-Y', time()));
        if (!empty($date_exist)) {
            $data['checked'] = explode("**", $date_exist->service);
        } else {
            $data['checked'] = array();
        }
        $option = '';
        $data['accepting_doctor'] = $this->doctor_model->getDoctorById($data['allotment']->accepting_doctor);
        foreach ($data['bed_id'] as $bed) {
            if ($bed->id == $data['allotment']->bed_id) {
                $option .= '<option value="' . $bed->id . '" selected>' . $bed->number . '</option>';
            } else {
                $option .= '<option value="' . $bed->id . '">' . $bed->number . '</option>';
            }
        }
        $data['option'] = $option;
        $data['blood_group'] = $this->bed_model->getBloodGroup();

        $data['room_no'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard', $data);
        $this->load->view('edit_allotment_bed', $data);
        $this->load->view('home/footer', $data);
    }

    function updateCheckin()
    {
        $id = $this->input->post('id');
        $category_status = $this->input->post('category_status');

        $category_status_update = implode(',', $category_status);

        // $covid_19 = $this->input->post('covid_19');
        $reaksione = $this->input->post('reaksione');
        $transferred_from = $this->input->post('transferred_from');
        $diagnoza_a_shtrimit = $this->input->post('diagnoza_a_shtrimit');
        $doctor = $this->input->post('doctor');
        $diagnosis = $this->input->post('diagnosis');
        $other_illnesses = $this->input->post('other_illnesses');
        $anamneza = $this->input->post('anamneza');
        $blood_group = $this->input->post('blood_group');
        $accepting_doctor = $this->input->post('accepting_doctor');
        $category = $this->input->post('category');
        $patient = $this->input->post('patient');
        $a_time = $this->input->post('a_time');
        //$d_time = $this->input->post('d_time');
        // $status = $this->input->post('status');
        $bed_id = $this->input->post('bed_id');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('bed_id', 'Bed', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Alloted Time Field
        $this->form_validation->set_rules('a_time', 'Alloted Time', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Discharge Time Field
        // $this->form_validation->set_rules('d_time', 'Discharge Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Status Field
        //$this->form_validation->set_rules('status', 'Status', 'trim|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['blood_group'] = $this->bed_model->getBloodGroup();

            $data['room_no'] = $this->bed_model->getBedCategory();
            $data['patients'] = $this->patient_model->getPatient();
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_allotment_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $patientname = $this->patient_model->getPatientById($patient)->name;
            $data = array(
                'bed_id' => $bed_id,
                'patient' => $patient,
                'a_time' => $a_time,
                'category' => $category,
                'category_status' => $category_status_update,
                'reaksione' => $reaksione,
                // 'covid_19' => $covid_19,
                'transferred_from' => $transferred_from,
                'anamneza' => $anamneza,
                'accepting_doctor' => $accepting_doctor,
                'doctor' => $doctor,
                'diagnosis' => $diagnosis,
                'diagnoza_a_shtrimit' => $diagnoza_a_shtrimit,
                'blood_group' => $blood_group,
                'other_illnesses' => $other_illnesses,
                // 'd_time' => $d_time,
                // 'status' => $status,
                'patientname' => $patientname
            );
            $data1 = array(
                'last_a_time' => $a_time,
                // 'last_d_time' => $d_time, 
            );

            if (empty($id)) {
                $this->bed_model->insertAllotment($data);
                $this->bed_model->updateBed($bed_id, $data1);
                //  $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->bed_model->updateAllotment($id, $data);
                $this->bed_model->updateBed($bed_id, $data1);

                $arr = array('message' => lang('updated'), 'title' => lang('updated'));
                echo json_encode($arr);
            }
        }
    }

    function updateDailyProgress()
    {
        $id = $this->input->post('daily_progress_id');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $description = $this->input->post('description');
        $daily_description = $this->input->post('daily_description');
        $nurse = $this->input->post('nurse');
        $alloted_bed_id = $this->input->post('alloted_bed_id');


        //  $this->load->library('form_validation');
        //   $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        //  $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        //  // Validating Patient Field
        //  $this->form_validation->set_rules('time', 'Time', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        $data = array();
        //  $patientname = $this->patient_model->getPatientById($patient)->name;
        $data = array(
            'date' => $date,
            'datestamp' => strtotime($date),
            'time' => $time,
            'alloted_bed_id' => $alloted_bed_id,
            'description' => $description,
            'daily_description' => $daily_description,
            'nurse' => $nurse,
        );


        if (empty($id)) {

            $this->bed_model->insertDailyProgress($data);
            $insert_id = $this->db->insert_id();
            //  $inserted_id=$this->db->inserted_id('daily_progress');
            $arr['info'] = $this->bed_model->getDailyProgressById($insert_id);
            $arr['nurse'] = $this->nurse_model->getNurseById($arr['info']->nurse);
            $arr['message'] = array('message' => lang('added'), 'title' => lang('added'));
            $arr['added'] = array('redir' => 'added');
            echo json_encode($arr);
        } else {
            $this->bed_model->updateDailyProgress($id, $data);
            //$this->bed_model->updateBedByBedId($bed_id, $data1);
            $arr['info'] = $this->bed_model->getDailyProgressById($id);
            $arr['nurse'] = $this->nurse_model->getNurseById($arr['info']->nurse);
            $arr['message'] = array('message' => lang('updated'), 'title' => lang('updated'));
            $arr['added'] = array('redir' => 'updated');
            echo json_encode($arr);
        }
    }

    function getDailyProgress()
    {
        $id = $this->input->get('id');
        $data = array();
        $data['info'] = $this->bed_model->getDailyProgressById($id);
        $data['nurse'] = $this->nurse_model->getNurseById($data['info']->nurse);
        echo json_encode($data);
    }

    function updateMedicine()
    {
        //  $id = $this->input->post('daily_progress_id');
        $date = time();
        $quantity = $this->input->post('quantity');
        $sales_price = $this->input->post('sales_price');
        $medicine_id = $this->input->post('medicine_name');
        $generic_name = $this->input->post('generic_name');
        $alloted_bed_id = $this->input->post('alloted_bed_id');
        $total = $this->input->post('total');
        $medicine_name = $this->medicine_model->getMedicineById($medicine_id);





        $data = array();
        //  $patientname = $this->patient_model->getPatientById($patient)->name;
        $data = array(
            'date' => $date,
            'quantity' => $quantity,
            'alloted_bed_id' => $alloted_bed_id,
            's_price' => $sales_price,
            'medicine_id' => $medicine_id,
            'medicine_pharmacy_id' => $medicine_name->id,
            'medicine_name' => $medicine_name->name,
            'generic_name' => $generic_name,
            'total' => $total
        );




        $this->bed_model->insertMedicineAllotedPatient($data);
        $insert_id = $this->db->insert_id();

        $arr['info'] = $this->bed_model->getMedicineAllotedPatientById($insert_id);
        $arr['medicine'] = $this->medicine_model->getMedicineById($arr['info']->medicine_id);
        $date = $arr['medicine']->date;
        if(!empty($arr['info']->date)){
            $arr['date'] = date('d-m-y  h:i A', $arr['info']->date);
        }

        $arr['message'] = array('message' => lang('added'), 'title' => lang('added'));

        echo json_encode($arr);
    }

    function deleteMedicine()
    {
        $id = $this->input->get('id');
        $bed_details = $this->bed_model->getMedicineAllotedPatientById($id);
        $payments = $this->finance_model->getPaymentById($bed_details->payment_id);
        if (!empty($payments->category_name)) {
            $category = explode("#", $payments->category_name);
            foreach ($category as $cat) {
                $individual = explode('*', $cat);
                if ($individual[5] != $bed_details->id) {
                    $price[] = $individual[4];
                    $cat_new[] = $cat;
                }
            }

            if (empty($cat_new)) {
                $this->finance_model->deletePayment($bed_details->payment_id);
                $data_bed = array('payment_id' => '');
                $this->bed_model->updateMedicineAlloted($bed_details->id, $data_bed);
            } else {
                $cat_new_update = implode("#", $cat_new);
                $total = array_sum($price);
                $data = array(
                    'category_name' => $cat_new_update,
                    'amount' => $total,
                    'gross_total' => $total,
                    'hospital_amount' => $total,
                );
                $data_bed = array('payment_id' => '');
                $this->bed_model->updateMedicineAlloted($bed_details->id, $data_bed);
                $this->finance_model->updatePayment($bed_details->payment_id, $data);
            }
        }
        $this->bed_model->deleteMedicine($id);
        $arr['message'] = array('message' => lang('delete'), 'title' => lang('delete'));
        echo json_encode($arr);
    }

    function updateServices()
    {
        $arr = array();
        $pservice = $this->input->post('pservice');
        $price = $this->input->post('service_price');
        $quantity = $this->input->post('service_quantity');
        $total = $this->input->post('service_total');

        $nurse = $this->input->post('nurse_service');
        $date = time();

        $data = array();
        $data = array(
            'date' => $date,
            'nurse' => $nurse,
            'service' => $pservice,
            'price' => $price,
            'quantity' => $quantity,
            'total' => $total,
            'alloted_bed_id' => $this->input->post('alloted_bed_id')
        );
        $this->bed_model->insertServices($data);
        $arr['message'] = array('message' => lang('added'), 'title' => lang('added'));
        $daily_service = $this->bed_model->getServiceAllotedByBedId($this->input->post('alloted_bed_id'));
        $settings = $this->settings_model->getSettings();
        $option = ' ';
        foreach ($daily_service as $service) {
            $pay_service = array();
            $pay_service_new = array();
            if (!empty($service->payment_id)) {
                $payment_explode = explode(",", $service->payment_id);
                for ($i = 0; $i < count($payment_explode); $i++) {
                    $payment_details = array();
                    $payment_details = $this->finance_model->getPaymentById($payment_explode[$i]);
                    $payment_d = array();
                    $payment_d = explode("#", $payment_details->category_name);
                    foreach ($payment_d as $key => $value) {
                        $pay_service = explode("*", $value);
                        $pay_service_new[] = $pay_service[0];
                    }
                }
            }
            $price = $service->price;
            $service_update = $service->service;
            $servicename = $this->db->get_where('pservice', array('id' => $service_update))->row();
            if (!empty($service->nurse)) {
                $nursename = $this->db->get_where('nurse', array('id' => $service->nurse))->row()->name;
            } else {
                $nursename = " ";
            }
            if (!empty($service->payment_id)) {
                $invoice_id = $this->finance_model->getPaymentById($service->payment_id)->id;
            } else {
                $invoice_id = '';
            }
            $date_explode = explode("-", $service->date);
            if (!empty($servicename)) {
                if ($this->ion_auth->in_group(array('admin'))) {
                    $option .= '<tr id="' . $service->date . '-' . $service_update . '">
                                                        <td>' . $servicename->name . '</td>
                                                        <td>' . date('d-m-y h:i A', $service->date) . '</td>
                                                        <td>' . $nursename . '</td>
                                                        <td>' . $invoice_id . '</td>
                                                        <td>' . $settings->currency . ' ' . $price . '</td>
                                                        <td>' . $service->quantity . ' </td>
                                                        <td>' . $settings->currency . ' ' . $service->quantity * $price . '</td>
                                                        <td class="no-print" id="delete-service-' . $date_explode[0] . '-' . $servicename->id . '"><button type="button" class="btn btn-soft-danger btn-xs btn_width delete_service" title=' . lang('delete') . ' data-toggle=" "data-id="' . $service->id . "**" . $service_update . '"><i class="fa fa-trash"></i></button></td>
                                                    </tr>';
                } else {
                    if (empty($service->payment_id)) {
                        $option .= '<tr id="' . $service->date . '-' . $service_update . '">
                                                        <td>' . $servicename->name . '</td>
                                                        <td>' . date('d-m-y h:i A', $service->date) . '</td>
                                                        <td>' . $nursename . '</td>
                                                        <td>' . $invoice_id . '</td>
                                                        <td>' . $settings->currency . ' ' . $price . '</td>
                                                        <td>' . $service->quantity . '  </td>
                                                        <td>' . $settings->currency . ' ' . $service->quantity * $price . '</td>
                                                        <td class="no-print" id="delete-service-' . $date_explode[0] . '-' . $servicename->id . '"><button type="button" class="btn btn-soft-danger btn-xs btn_width delete_service" title=' . lang('delete') . ' data-toggle=" "data-id="' . $service->id . "**" . $service_update . '"><i class="fa fa-trash"></i></button></td>
                                                    </tr>';
                    } else {
                        if (in_array($servicename->id, $pay_service_new)) {
                            $option .= '<tr id="' . $service->date . '-' . $service_update . '">
                                                        <td>' . $servicename->name . '</td>
                                                        <td>' . date('d-m-y h:i A', $service->date) . '</td>
                                                        <td>' . $nursename . '</td>
                                                        <td>' . $invoice_id . '</td>
                                                        <td>' . $settings->currency . ' ' . $price . '</td>
                                                        <td>' . $service->quantity . '  </td>
                                                        <td>' . $settings->currency . ' ' . $service->quantity * $price . '</td>
                                                        <td></td>
                                                    </tr>';
                        } else {
                            $option .= '<tr id="' . $service->date . '-' . $service_update . '">
                                                        <td>' . $servicename->name . '</td>
                                                        <td>' . date('d-m-y h:i A', $service->date) . '</td>
                                                        <td>' . $nursename . '</td>
                                                        <td>' . $invoice_id . '</td>
                                                        <td>' . $settings->currency . ' ' . $price . '</td>
                                                        <td>' . $service->quantity . '  </td>
                                                        <td>' . $settings->currency . ' ' . $service->quantity * $price . '</td>
                                                        <td class="no-print" id="delete-service-' . $date_explode[0] . '-' . $servicename->id . '"><button type="button" class="btn btn-soft-danger btn-xs btn_width delete_service" title=' . lang('delete') . ' data-toggle=" "data-id="' . $service->id . "**" . $service_update . '"><i class="fa fa-trash"></i></button></td>
                                                    </tr>';
                        }
                    }
                }
            }
        }
        $arr['option'] = array('option' => $option, 'title' => lang('added'));
        $arr['nurses'] = $this->nurse_model->getNurseById($nurse);

        echo json_encode($arr);
    }

    function deleteServices()
    {
        $id = $this->input->get('id');
        $service_details = $this->bed_model->getServicedById($id);
        $price_new = array();
        $service_new = array();
        if (empty($price_new)) {
            $this->bed_model->deleteServices($id);
        } else {
            $this->bed_model->updateServices($id, $data);
        }

        $arr['message'] = array('message' => lang('delete'), 'title' => lang('delete'), 'date' => $service_details->date);
        // $arr['date1'] = array();
        echo json_encode($arr);
    }










    function updateDiagnostics()
    {
        $arr = array();
        $diagnostic = $this->input->post('diagnostic');
        $price = $this->input->post('diagnostic_price');
        $quantity = $this->input->post('diagnostic_quantity');
        $total = $this->input->post('diagnostic_total');

        $nurse = $this->input->post('nurse_diagnostic');
        $date = time();

        $data = array();
        $data = array(
            'date' => $date,
            'nurse' => $nurse,
            'payment_procedure' => $diagnostic,
            'price' => $price,
            'quantity' => $quantity,
            'total' => $total,
            'alloted_bed_id' => $this->input->post('alloted_bed_id')
        );


        $this->bed_model->insertDiagnostic($data);
        $diagnostic_id = $this->db->insert_id();
        $arr['message'] = array('message' => lang('added'), 'title' => lang('added'));


        $daily_diagnostic = $this->bed_model->getDiagnosticAllotedByBedId($this->input->post('alloted_bed_id'));

        $settings = $this->settings_model->getSettings();

        $option = ' ';
        foreach ($daily_diagnostic as $diagnostic) {
            $pay_diagnostic = array();
            $pay_diagnostic_new = array();
            if (!empty($diagnostic->payment_id)) {
                $payment_explode = explode(",", $diagnostic->payment_id);
                for ($i = 0; $i < count($payment_explode); $i++) {
                    $payment_details = array();
                    $payment_details = $this->finance_model->getPaymentById($payment_explode[$i]);
                    $payment_d = array();
                    $payment_d = explode("#", $payment_details->category_name);
                    foreach ($payment_d as $key => $value) {
                        $pay_diagnostic = explode("*", $value);
                        $pay_diagnostic_new[] = $pay_diagnostic[0];
                    }
                }
            }
            $price = $diagnostic->price;
            $diagnostic_update = $diagnostic->payment_procedure;
            $servicename = $this->db->get_where('payment_category', array('id' => $diagnostic_update))->row();
            if (!empty($diagnostic->nurse)) {
                $nursename = $this->db->get_where('nurse', array('id' => $diagnostic->nurse))->row()->name;
            } else {
                $nursename = " ";
            }
            if (!empty($diagnostic->payment_id)) {
                $invoice_id = $this->finance_model->getPaymentById($diagnostic->payment_id)->id;
            } else {
                $invoice_id = '';
            }
            $date_explode = explode("-", $diagnostic->date);
            if (!empty($servicename)) {
                if ($this->ion_auth->in_group(array('admin'))) {
                    $option .= '<tr id="' . $diagnostic->date . '-' . $diagnostic_update . '">
                                                        <td>' . $servicename->category . '</td>
                                                        <td>' . date('d-m-y h:i A', $diagnostic->date) . '</td>
                                                        <td>' . $nursename . '</td>
                                                        <td>' . $invoice_id . '</td>
                                                        <td>' . $settings->currency . ' ' . $price . '</td>
                                                        <td>' . $diagnostic->quantity . ' </td>
                                                        <td>' . $settings->currency . ' ' . $diagnostic->quantity * $price . '</td>
                                                        <td class="no-print" id="delete-diagnostic-' . $date_explode[0] . '-' . $servicename->id . '"><button type="button" class="btn btn-soft-danger btn-xs btn_width delete_diagnostic" title=' . lang('delete') . ' data-toggle=" "data-id="' . $diagnostic->id . "**" . $diagnostic_update . '"><i class="fa fa-trash"></i></button></td>
                                                    </tr>';
                } else {
                    if (empty($diagnostic->payment_id)) {
                        $option .= '<tr id="' . $diagnostic->date . '-' . $diagnostic_update . '">
                                                        <td>' . $servicename->category . '</td>
                                                        <td>' . date('d-m-y h:i A', $diagnostic->date) . '</td>
                                                        <td>' . $nursename . '</td>
                                                        <td>' . $invoice_id . '</td>
                                                        <td>' . $settings->currency . ' ' . $price . '</td>
                                                        <td>' . $diagnostic->quantity . '  </td>
                                                        <td>' . $settings->currency . ' ' . $diagnostic->quantity * $price . '</td>
                                                        <td class="no-print" id="delete-diagnostic-' . $date_explode[0] . '-' . $servicename->id . '"><button type="button" class="btn btn-soft-danger btn-xs btn_width delete_diagnostic" title=' . lang('delete') . ' data-toggle=" "data-id="' . $diagnostic->id . "**" . $diagnostic_update . '"><i class="fa fa-trash"></i></button></td>
                                                    </tr>';
                    } else {
                        if (in_array($servicename->id, $pay_diagnostic_new)) {
                            $option .= '<tr id="' . $diagnostic->date . '-' . $diagnostic_update . '">
                                                        <td>' . $servicename->category . '</td>
                                                        <td>' . date('d-m-y h:i A', $diagnostic->date) . '</td>
                                                        <td>' . $nursename . '</td>
                                                        <td>' . $invoice_id . '</td>
                                                        <td>' . $settings->currency . ' ' . $price . '</td>
                                                        <td>' . $diagnostic->quantity . '  </td>
                                                        <td>' . $settings->currency . ' ' . $diagnostic->quantity * $price . '</td>
                                                        <td></td>
                                                    </tr>';
                        } else {
                            $option .= '<tr id="' . $diagnostic->date . '-' . $diagnostic_update . '">
                                                        <td>' . $servicename->category . '</td>
                                                        <td>' . date('d-m-y h:i A', $diagnostic->date) . '</td>
                                                        <td>' . $nursename . '</td>
                                                        <td>' . $invoice_id . '</td>
                                                        <td>' . $settings->currency . ' ' . $price . '</td>
                                                        <td>' . $diagnostic->quantity . '  </td>
                                                        <td>' . $settings->currency . ' ' . $diagnostic->quantity * $price . '</td>
                                                        <td class="no-print" id="delete-diagnostic-' . $date_explode[0] . '-' . $servicename->id . '"><button type="button" class="btn btn-soft-danger btn-xs btn_width delete_service" title=' . lang('delete') . ' data-toggle=" "data-id="' . $diagnostic->id . "**" . $diagnostic_update . '"><i class="fa fa-trash"></i></button></td>
                                                    </tr>';
                        }
                    }
                }
            }
        }


        $arr['option'] = array('option' => $option, 'title' => lang('added'));
        $arr['nurses'] = $this->nurse_model->getNurseById($nurse);

        echo json_encode($arr);
    }



    function deleteDiagnostic()
    {
        $id = $this->input->get('id');
        $diagnostic_details = $this->bed_model->getDiagnosticById($id);
        $lab_id = $this->lab_model->getLabByPaymentProcedureId($diagnostic_details->payment_procedure);
        $this->lab_model->deleteLab($lab_id->id);
        $this->bed_model->deleteDiagnostic($id);

        $arr['message'] = array('message' => lang('delete'), 'title' => lang('delete'), 'date' => $diagnostic_details->date);
        echo json_encode($arr);
    }




    function updateCheckout()
    {
        $id = $this->input->post('id');

        $doctor = $this->input->post('doctors_checkout');
        $alloted_bed_id = $this->input->post('alloted_bed_id');
        $bed_id = $this->bed_model->getAllotmentById($alloted_bed_id)->bed_id;
        $epicrisis = $this->input->post('epicrisis');
        $checkout_state = $this->input->post('checkout_state');
        $checkout_diagnosis = $this->input->post('checkout_diagnosis');
        // $dikordance = $this->input->post('dikordance');
        $anatomopatologic_diagnosis = $this->input->post('anatomopatologic_diagnosis');
        $final_diagnosis = $this->input->post('final_diagnosis');
        $d_time = $this->input->post('d_time');
        $instruction = $this->input->post('instruction');
        $medicine_to_take = $this->input->post('medicine_to_take');
        $data = array();
        $data = array(
            'date' => $d_time,
            'final_diagnosis' => $final_diagnosis,
            'anatomopatologic_diagnosis' => $anatomopatologic_diagnosis,
            //'dikordance' => $dikordance,
            'alloted_bed_id' => $alloted_bed_id,
            'doctor' => $doctor,
            'epicrisis' => $epicrisis,
            'checkout_state' => $checkout_state,
            'checkout_diagnosis' => $checkout_diagnosis,
            'instruction' => $instruction,
            'medicine_to_take' => $medicine_to_take
        );
        $data1 = array(
            'last_d_time' => $d_time,
            // 'last_d_time' => $d_time, 
        );

        if (!empty($id)) {
            $this->bed_model->updateCheckout($id, $data);
            $inserted_id = $id;
            $this->bed_model->updateBed($bed_id, $data1);
            $data['message'] = array('message' => lang('updated'), 'title' => lang('updated'));
        } else {
            $this->bed_model->insertCheckout($data);
            $inserted_id = $this->db->insert_id();
            $this->bed_model->updateBed($bed_id, $data1);
            $data['message'] = array('message' => lang('added'), 'title' => lang('added'));
        }
        $data['checkout'] = $this->bed_model->getCheckoutdById($inserted_id);
        $d_time_array = array();
        $d_time_array = explode("-", $d_time);
        $d_timestamp = strtotime($d_time_array[0] . ' ' . $d_time_array[1]);
        $data_update = array('d_time' => $d_time, 'd_timestamp' => $d_timestamp);

        $this->bed_model->updateAllotment($alloted_bed_id, $data_update);
        echo json_encode($data);
    }

    public function getNurseInfo()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->nurse_model->getNurseInfo($searchTerm);

        echo json_encode($response);
    }

    public function createMedicineInvoice()
    {
        $id = $this->input->get('id');
        $medicine_list = $this->bed_model->getMedicineAllotedByBedId($id);
        foreach ($medicine_list as $medicine) {
            $medicine_con[] = $medicine->medicine_id . '*' . $medicine->medicine_name . '*' . $medicine->s_price . '*' . $medicine->quantity . '*' . $medicine->total . '*' . $medicine->id . '*' . $medicine->medicine_pharmacy_id;
            $price[] = $medicine->total;
            $medicine_id[] = $medicine->medicine_id;
            $ids[] = $medicine->id;
            if (!empty($medicine->payment_id)) {
                $payment_id = $medicine->payment_id;
            }
        }
        if (!empty($medicine_id)) {
            $total = array_sum($price);
            $arr['ids'] = implode(",", $ids);
            $medicine_include = implode("#", $medicine_con);
            $data = array();
            $bed_alloted = $this->bed_model->getAllotmentById($id);
            $patient = $this->patient_model->getPatientById($bed_alloted->patient);
            $doctor = $this->doctor_model->getDoctorById($bed_alloted->doctor);
            $date = time();
            $date_string = date('d-m-Y');

            if (!empty($payment_id)) {
                $payment_details = $this->finance_model->getPaymentById($payment_id);
                $hospital_payment_id = $payment_details->hospital_payment_id;
            } else {
                $hospital_last_payment_id = $this->finance_model->lastRowByHospitalPayment();
                if (empty($hospital_last_payment_id)) {
                    $hospital_payment_id = '1';
                } else {
                    if (empty($hospital_last_payment_id->hospital_payment_id)) {
                        $hospital_payment_id = '1';
                    } else {
                        $hospital_payment_id = $hospital_last_payment_id->hospital_payment_id + 1;
                    }
                }
            }


            $data = array(
                'category_name' => $medicine_include,
                'patient' => $patient->id,
                'date' => $date,
                'amount' => $total,
                'doctor' => $bed_alloted->doctor,
                'gross_total' => $total,
                'status' => 'unpaid',
                'hospital_amount' => $total,
                'doctor_amount' => '0',
                'user' => $this->ion_auth->get_user_id(),
                'patient_name' => $patient->name,
                'patient_phone' => $patient->phone,
                'patient_address' => $patient->address,
                'doctor_name' => $doctor->name,
                'date_string' => $date_string,
                'payment_from' => 'admitted_patient_bed_medicine',
                'hospital_payment_id' => $hospital_payment_id,
                'alloted_bed_id' => $id
            );

            if (!empty($payment_id)) {
                $this->finance_model->updatePayment($payment_id, $data);
                $inserted_id = $payment_id;
            } else {
                $this->finance_model->insertPayment($data);
                $inserted_id = $this->db->insert_id('payment');
            }


            $data_update_medicine = array('payment_id' => $inserted_id);
            foreach ($ids as $id_bed_medicine) {
                $this->bed_model->updateMedicineAlloted($id_bed_medicine, $data_update_medicine);
            }
            if (!empty($payment_id)) {
                $arr['message'] = array('message' => lang('invoice') . ' ' . lang('updated'), 'title' => lang('invoice') . ' ' . lang('updated'));
            } else {
                $arr['message'] = array('message' => lang('invoice') . ' ' . lang('generated'), 'title' => lang('invoice') . ' ' . lang('generated'));
            }
        } else {
            $arr['message'] = array('message' => lang('no_new_medicine_add'), 'title' => lang('no_new_medicine_add'));
        }
        echo json_encode($arr);
    }




    public function createServiceInvoice()
    {
        $id = $this->input->get('id');
        $service_list = $this->bed_model->getServicedByIdByDate($id);
        foreach ($service_list as $service) {
            $service_con[] = $service->service . '*' . $service->price . '*' . $service->quantity . '*' . $service->total;
            $price[] = $service->total;
            $service_id[] = $service->id;
            $ids[] = $service->id;
            if (!empty($service->payment_id)) {
                $payment_id = $service->payment_id;
            }
        }



        if (!empty($payment_id)) {
            $payment_details = $this->finance_model->getPaymentById($payment_id);
            $hospital_payment_id = $payment_details->hospital_payment_id;
        } else {
            $hospital_last_payment_id = $this->finance_model->lastRowByHospitalPayment();
            if (empty($hospital_last_payment_id)) {
                $hospital_payment_id = '1';
            } else {
                if (empty($hospital_last_payment_id->hospital_payment_id)) {
                    $hospital_payment_id = '1';
                } else {
                    $hospital_payment_id = $hospital_last_payment_id->hospital_payment_id + 1;
                }
            }
        }


        if (!empty($service_id)) {
            $total = array_sum($price);
            $service_include = implode("#", $service_con);
            $data = array();
            $bed_alloted = $this->bed_model->getAllotmentById($id);
            $patient = $this->patient_model->getPatientById($bed_alloted->patient);
            $doctor = $this->doctor_model->getDoctorById($bed_alloted->doctor);
            $date = time();
            $date_string = date('d-m-Y');

            $data = array(
                'category_name' => $service_include,
                'patient' => $patient->id,
                'date' => $date,
                'amount' => $total,
                'doctor' => $bed_alloted->doctor,
                'gross_total' => $total,
                'status' => 'unpaid',
                'hospital_amount' => $total,
                'doctor_amount' => '0',
                'user' => $this->ion_auth->get_user_id(),
                'patient_name' => $patient->name,
                'patient_phone' => $patient->phone,
                'patient_address' => $patient->address,
                'doctor_name' => $doctor->name,
                'date_string' => $date_string,
                'payment_from' => 'admitted_patient_bed_service',
                'hospital_payment_id' => $hospital_payment_id,
                'alloted_bed_id' => $id
            );
            if (!empty($payment_id)) {
                $this->finance_model->updatePayment($payment_id, $data);
                $inserted_id = $payment_id;
            } else {
                $this->finance_model->insertPayment($data);
                $inserted_id = $this->db->insert_id('payment');
            }

            $data_update_service = array('payment_id' => $inserted_id);
            foreach ($ids as $id_bed_service) {
                $this->bed_model->updateServiceAlloted($id_bed_service, $data_update_service);
            }
            if (!empty($payment_id)) {
                $arr['message'] = array('message' => lang('invoice') . ' ' . lang('updated'), 'title' => lang('invoice') . ' ' . lang('updated'));
            } else {
                $arr['message'] = array('message' => lang('invoice') . ' ' . lang('generated'), 'title' => lang('invoice') . ' ' . lang('generated'));
            }
        } else {
            $arr['message'] = array('message' => lang('no_new_service_add'), 'title' => lang('no_new_service_add'));
        }
        echo json_encode($arr);
    }







    public function createDiagnosticInvoice()
    {
        $id = $this->input->get('id');
        $bed_diagnostic_list = $this->bed_model->getBedDiagnosticByIdByDate($id);
        foreach ($bed_diagnostic_list as $diagnostic) {
            $payment_procedure_type = $this->finance_model->getPaymentCategoryById($diagnostic->payment_procedure)->type;
            $service_con[] = $diagnostic->payment_procedure . '*' . $diagnostic->price . '*' . $payment_procedure_type . '*' . $diagnostic->quantity;
            $price[] = $diagnostic->total;
            $service_id[] = $diagnostic->id;
            // $payment_procedure[] = $diagnostic->payment_procedure;
            $ids[] = $diagnostic->id;
            if (!empty($diagnostic->payment_id)) {
                $payment_id = $diagnostic->payment_id;
            }
        }
        if (!empty($payment_id)) {
            $payment_details = $this->finance_model->getPaymentById($payment_id);
            $hospital_payment_id = $payment_details->hospital_payment_id;
            $previous_discount = $payment_details->discount;
            $previous_vat = $payment_details->vat;
        } else {
            $hospital_last_payment_id = $this->finance_model->lastRowByHospitalPayment();
            if (empty($hospital_last_payment_id)) {
                $hospital_payment_id = '1';
            } else {
                if (empty($hospital_last_payment_id->hospital_payment_id)) {
                    $hospital_payment_id = '1';
                } else {
                    $hospital_payment_id = $hospital_last_payment_id->hospital_payment_id + 1;
                }
            }
        }
        if (!empty($service_id)) {
            $amount = array_sum($price);
            $total = array_sum($price) - $previous_discount + $previous_vat;
            $service_include = implode(",", $service_con);
            $data = array();
            $bed_alloted = $this->bed_model->getAllotmentById($id);
            $patient = $this->patient_model->getPatientById($bed_alloted->patient);
            $doctor = $this->doctor_model->getDoctorById($bed_alloted->doctor);
            $date = time();
            $date_string = date('d-m-Y');

            $data = array(
                'category_name' => $service_include,
                'patient' => $patient->id,
                'date' => $date,
                'amount' => $amount,
                'doctor' => $bed_alloted->doctor,
                'gross_total' => $total,
                'status' => 'unpaid',
                'hospital_amount' => $total,
                'doctor_amount' => '0',
                'user' => $this->ion_auth->get_user_id(),
                'patient_name' => $patient->name,
                'patient_phone' => $patient->phone,
                'patient_address' => $patient->address,
                'doctor_name' => $doctor->name,
                'date_string' => $date_string,
                'payment_from' => 'admitted_patient_bed_diagnostic',
                'hospital_payment_id' => $hospital_payment_id,
                'alloted_bed_id' => $id
            );
            if (!empty($payment_id)) {
                $this->finance_model->updatePayment($payment_id, $data);
                $inserted_id = $payment_id;
            } else {
                $this->finance_model->insertPayment($data);
                $inserted_id = $this->db->insert_id('payment');
            }

            $data_update_diagnostic = array('payment_id' => $inserted_id);
            foreach ($ids as $id_diagnostic_service) {
                $this->bed_model->updateDiagnostic($id_diagnostic_service, $data_update_diagnostic);
            }
            $bed_lab_list = $this->lab_model->getDiagnosticByBedId($id);
            foreach ($bed_lab_list as $new_lab_procedure_id) {
                $new_lab_procedure_ids[] = $new_lab_procedure_id->id;
            }
            $lab_reports_previous = $this->lab_model->getLabByInvoice($inserted_id);
            if (!empty($lab_reports_previous)) {
                foreach ($lab_reports_previous as $lab) {
                    if (!in_array($lab->bed_diagnostic_id, $new_lab_procedure_ids)) {
                        $this->lab_model->deleteLab($lab->id);
                    }
                    $previous_lab_diagnostic_ids[] = $lab->bed_diagnostic_id;
                }
            }
            $hospital_last_lab_id = $this->lab_model->lastRowByLab();
            if (empty($hospital_last_lab_id)) {
                $hospital_lab_id = '1';
            } else {
                if (empty($hospital_last_lab_id->hospital_lab_id)) {
                    $hospital_lab_id = '1';
                } else {
                    $hospital_lab_id = $hospital_last_lab_id->hospital_lab_id + 1;
                }
            }
            $i = 0;
            foreach ($bed_lab_list as $lab) {
                if (in_array($lab->id,  $previous_lab_diagnostic_ids)) {
                    continue;
                }
                $payment_procedure_id = $lab->payment_procedure;
                $payment_procedure[] = $lab->payment_procedure;
                $idss[] = $lab->id;
                if (!empty($lab->payment_id)) {
                    $payment_id = $lab->payment_id;
                }
                $patient_category = $this->finance_model->getPaymentCategoryById($lab->payment_procedure);
                if ($patient_category->type == 'diagnostic') {
                    $data_update_lab = array(
                        'patient' => $patient->id,
                        'invoice_id' => $inserted_id,
                        'doctor' => $doctor->id,
                        'patient_name' => $patient->name,
                        'patient_phone' => $patient->phone,
                        'patient_address' => $patient->address,
                        'doctor_name' => $doctor->name,
                        'category_id' => $payment_procedure_id,
                        'test_status' => 'not_done',
                        'user' => $this->ion_auth->get_user_id(),
                        'date' => time(),
                        'date_string' => date('d-m-y'),
                        // 'hospital_patient_id' => $patient->hospital_patient_id,
                        // 'hospital_payment_id' => $hospital_payment_id,
                        // 'hospital_lab_id' => $hospital_lab_id,
                        'alloted_bed_id' => $id,
                        'bed_diagnostic_id' => $lab->id
                    );
                    $this->lab_model->insertLab($data_update_lab);
                    $lab_inserted_id = $this->db->insert_id('lab');
                }
            }

            if (!empty($payment_id)) {
                $arr['message'] = array('message' => lang('invoice') . ' ' . lang('updated'), 'title' => lang('invoice') . ' ' . lang('updated'));
            } else {
                $arr['message'] = array('message' => lang('invoice') . ' ' . lang('generated'), 'title' => lang('invoice') . ' ' . lang('generated'));
            }
        } else {
            $arr['message'] = array('message' => lang('no_new_service_add'), 'title' => lang('no_new_service_add'));
        }
        // $patient_details = $this->patient_model->getPatientById($patient);



        echo json_encode($arr);
    }




    function dischargeReport()
    {
        $bed_id = $this->input->get('id');
        $data['discharge'] = $this->bed_model->getCheckoutByBedId($bed_id);

        $data['bed'] = $this->bed_model->getBedAllotmentsById($data['discharge']->alloted_bed_id);
        $data['patient'] = $this->patient_model->getPatientbyId($data['bed']->patient);
        $data['doctor'] = $this->doctor_model->getDoctorbyId($data['discharge']->doctor);
        $data['settings'] = $this->settings_model->getSettings();
        $data['redirectlink'] = '';
        $data['redirect'] = '';
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('discharge_report', $data);
        $this->load->view('home/footer'); // just the footer fi
    }
    function download()
    {
        $bed_id = $this->input->get('id');
        $data['discharge'] = $this->bed_model->getCheckoutByBedId($bed_id);

        $data['bed'] = $this->bed_model->getBedAllotmentsById($data['discharge']->alloted_bed_id);
        $data['patient'] = $this->patient_model->getPatientbyId($data['bed']->patient);
        $data['doctor'] = $this->doctor_model->getDoctorbyId($data['discharge']->doctor);
        $data['settings'] = $this->settings_model->getSettings();
        error_reporting(0);
        $data['redirect'] = 'download';
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        //     $mpdf->SetHTMLFooter('
        //   <div style="text-align:right;font-weight: bold; 
        // font-size: 8pt;
        // font-style: italic;">
        //  ' . lang('user') . ' : ' . $this->ion_auth->user($data['payment']->user)->row()->username . '
        //   </div>', 'O');

        $html = $this->load->view('discharge_report', $data, true);

        $mpdf->WriteHTML($html);

        $filename = "discharge-report--00" . $$data['patient']->id . ".pdf";
        $mpdf->Output($filename, 'D');
    }



    function printLabel()
    {
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getAllotmentById($id);
        $data['patient'] = $this->patient_model->getPatientById($data['bed']->patient);
        $this->load->view('home/dashboard');
        $this->load->view('labLabel2', $data);
        $this->load->view('home/footer');
    }





    function billDetails()
    { {
            $id = $this->input->get('id');
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['allotment'] = $this->bed_model->getBedAllotmentsById($id);
            $data['bed_id'] = $this->bed_model->getBedByCategory($data['allotment']->category);
            $data['patient'] = $this->patient_model->getPatientById($data['allotment']->patient);
            $data['pservice'] = $this->pservice_model->getPserviceByActive();
            $data['doctor'] = $this->doctor_model->getDoctorById($data['allotment']->doctor);
            $data['daily_progress'] = $this->bed_model->getDailyProgressByBedId($id);
            $data['daily_medicine'] = $this->bed_model->getMedicineAllotedByBedId($id);
            $data['daily_service'] = $this->bed_model->getServiceAllotedByBedId($id);
            $data['diagnostics_alloted'] = $this->bed_model->getDiagnosticAllotedByBedId($id);

            $data['diagnostics'] = $this->finance_model->getPaymentCategory();


            $data['all_payments'] = $this->bed_model->getAllBedPayments($id);


            $data['bed_checkout'] = $this->bed_model->getCheckoutByBedId($id);
            $date_exist = $this->bed_model->getServicesByDate(date('d-m-Y', time()));
            if (!empty($date_exist)) {
                $data['checked'] = explode("**", $date_exist->service);
            } else {
                $data['checked'] = array();
            }
            $option = '';
            $data['accepting_doctor'] = $this->doctor_model->getDoctorById($data['allotment']->accepting_doctor);
            foreach ($data['bed_id'] as $bed) {
                if ($bed->id == $data['allotment']->bed_id) {
                    $option .= '<option value="' . $bed->id . '" selected>' . $bed->number . '</option>';
                } else {
                    $option .= '<option value="' . $bed->id . '">' . $bed->number . '</option>';
                }
            }
            $data['option'] = $option;
            $data['blood_group'] = $this->bed_model->getBloodGroup();

            $data['room_no'] = $this->bed_model->getBedCategory();
            $this->load->view('home/dashboard', $data);
            $this->load->view('bill_details', $data);
            $this->load->view('home/footer', $data);
        }
    }




    public function getAvaiablePatietListforBedAllotment()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->bed_model->getAvaiablePatietListforBedAllotment($searchTerm);

        echo json_encode($response);
    }




    function getBillDetailsForBed()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $legthh = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $status = $this->input->get('status');
        $order = $this->input->post('order');
        $id = $this->input->get('id');

        $all_payments = $this->bed_model->getAllBedPayments($id);

        foreach ($all_payments as $key => $value) {
            $payment_details = $this->finance_model->getPaymentById($value);
            $payment_deposit[] = $this->finance_model->getDepositByPaymentId($payment_details->id);
            if ($payment_details->payment_from == 'admitted_patient_bed_medicine') {
                $type =  lang('medicine');
            } elseif ($payment_details->payment_from == 'admitted_patient_bed_service') {
                $type = lang('service');
            } elseif ($payment_details->payment_from == 'admitted_patient_bed_diagnostic') {
                $type = lang('diagnostic');
            }

            $payment_summary = $this->bed_model->getPaymentSummaryById($value);


            $info[] = array(
                $payment_details->id,
                $type,
                date('d-m-Y', $payment_details->date),
                $this->settings->currency . $payment_details->amount,
                $this->settings->currency . $payment_details->discount,
                $this->settings->currency . $payment_summary['total'],
                $this->settings->currency . $payment_summary['paid'],
                $this->settings->currency . $payment_summary['due']
            );
        }

        $this_admission_payment_summary = $this->bed_model->getAllBedPaymentsSummary($id);

        $info[] = array(
            '',
            '',
            '<strong>' . lang('total') . '</strong>',
            '<strong>' . $this->settings->currency . number_format($this_admission_payment_summary['amount'], 2) . '</strong>',
            '<strong>' . $this->settings->currency . number_format($this_admission_payment_summary['discount'], 2) . '</strong>',
            '<strong>' . $this->settings->currency . number_format($this_admission_payment_summary['total'], 2) . '</strong>',
            '<strong>' . $this->settings->currency . number_format($this_admission_payment_summary['paid'], 2) . '</strong>',
            '<strong>' . $this->settings->currency . number_format($this_admission_payment_summary['due'], 2) . '</strong>',
        );



        if (!empty($all_payments)) {
            $output = array(
                'draw' => intval($requestData['draw']),
                "recordsTotal" => count($all_payments),
                "recordsFiltered" => count($all_payments),
                'data' => $info
            );
        } else {
            $output = array(
                // 'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            );
        }


        echo json_encode($output);
    }





    function getServiceByAllotmentId()
    {
        $requestData = $_REQUEST;
        $id = $this->input->get('id');
        $all_services = $this->bed_model->getServicedByIdByDate($id);
        foreach ($all_services as $service) {
            $payment_details = $this->finance_model->getPaymentById($service->payment_id);
            $service_name = $this->pservice_model->getPserviceById($service->service);
            $nurse_name = $this->nurse_model->getNurseById($service->nurse)->name;
            $option = '<td class="no-print" id="delete-service-' . date("d") . '-' . $service->id . '"><button type="button" class="btn btn-soft-danger btn-xs btn_width delete_service" title=' . lang("delete") . ' data-toggle="" data-id="' . $service->id . "**" . $service->service . '"><i class="fa fa-trash"></i></button></td>';
            $info[] = array(
                $service_name->name,
                date('d-m-y h:i A', $service->date),
                $nurse_name,
                $payment_details->id,
                $service->price,
                $service->quantity,
                $service->total,
                $option,
            );
        }

        if (!empty($all_services)) {
            $output = array(
                'draw' => intval($requestData['draw']),
                "recordsTotal" => count($all_services),
                "recordsFiltered" => count($all_services),
                'data' => $info
            );
        } else {
            $output = array(
                // 'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            );
        }


        echo json_encode($output);
    }


    function getDiagnosticByAllotmentId()
    {
        $requestData = $_REQUEST;
        $id = $this->input->get('id');
        $all_diagnostics = $this->bed_model->getDiagnosticAllotedByBedId($id);
        foreach ($all_diagnostics as $diagnostic) {
            $payment_details = $this->finance_model->getPaymentById($diagnostic->payment_id);
            $payment_procedure = $this->finance_model->getPaymentCategoryById($diagnostic->payment_procedure)->category;
            $option = '<td class="no-print" id="delete-diagnostic-' . date("d") . '-' . $diagnostic->id . '"><button type="button" class="btn btn-soft-danger btn-xs btn_width delete_diagnostic" title=' . lang("delete") . ' data-toggle="" data-id="' . $diagnostic->id . "**" . $diagnostic->payment_procedure . '"><i class="fa fa-trash"></i></button></td>';
            $info[] = array(
                $payment_procedure,
                date('d-m-y h:i A', $diagnostic->date),
                $diagnostic->nurse,
                $payment_details->id,
                $diagnostic->price,
                $diagnostic->quantity,
                $diagnostic->total,
                $option,
            );
        }

        if (!empty($all_diagnostics)) {
            $output = array(
                'draw' => intval($requestData['draw']),
                "recordsTotal" => count($all_diagnostics),
                "recordsFiltered" => count($all_diagnostics),
                'data' => $info
            );
        } else {
            $output = array(
                // 'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            );
        }


        echo json_encode($output);
    }


    function getMedicineByAllotmentId()
    {
        $requestData = $_REQUEST;
        $id = $this->input->get('id');
        $all_medicines = $this->bed_model->getMedicineAllotedByBedId($id);
        foreach ($all_medicines as $medicine) {
            if (!empty($medicine->payment_id)) {
                $invoice_id = $this->finance_model->getPaymentById($medicine->payment_id)->id;
            } else {
                $invoice_id = '';
            }
            $option = '<td class="no-print" id="delete-' . $medicine->id . '"><button type="button" class="btn btn-soft-danger btn-xs btn_width delete_medicine" title=' . lang("delete") . ' data-toggle="" data-id="' . $medicine->id . '"><i class="fa fa-trash"></i></button></td>';
            $info[] = array(
                date('d-m-y h:i A', $medicine->date),
                $medicine->generic_name,
                $medicine->medicine_name,
                $invoice_id,
                $this->settings->currency . $medicine->s_price,
                $medicine->quantity,
                $this->settings->currency . $medicine->total,
                $option,
            );
        }

        if (!empty($all_medicines)) {
            $output = array(
                'draw' => intval($requestData['draw']),
                "recordsTotal" => count($all_medicines),
                "recordsFiltered" => count($all_medicines),
                'data' => $info
            );
        } else {
            $output = array(
                // 'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            );
        }


        echo json_encode($output);
    }
}

/* End of file bed.php */
/* Location: ./application/modules/bed/controllers/bed.php */
