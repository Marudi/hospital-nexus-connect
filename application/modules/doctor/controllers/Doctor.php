<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctor extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('doctor_model');

        $this->load->model('department/department_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('patient/patient_model');
        $this->load->model('doctorvisit/doctorvisit_model');
        $this->load->model('prescription/prescription_model');
        $this->load->model('schedule/schedule_model');
        $this->load->model('settings/settings_model');
        $this->load->module('patient');
        $this->load->module('sms');
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Receptionist', 'Nurse', 'Laboratorist', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['departments'] = $this->department_model->getDepartment();
      
        $this->load->view('home/dashboard');
        $this->load->view('doctor/doctor', $data);
        $this->load->view('home/footer');
    }

    public function addNewView() {
        $data = array();
        $data['departments'] = $this->department_model->getDepartment();
        $this->load->view('home/dashboard');
        $this->load->view('doctor/add_new', $data);
        $this->load->view('home/footer');
    }

    public function addNew() {

        $id = $this->input->post('id');

        if (empty($id)) {
            $limit = $this->doctor_model->getLimit();
            if ($limit <= 0) {
                $this->session->set_flashdata('feedback', lang('doctor_limit_exceed'));
                redirect('doctor');
            }
        }


        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $department = $this->input->post('department');
        $department_details=$this->department_model->getDepartmentById($department);
        $profile = $this->input->post('profile');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
        // Validating Department Field   
        $this->form_validation->set_rules('department', 'Department', 'trim|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        // $this->form_validation->set_rules('profile', 'Profile', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['departments'] = $this->department_model->getDepartment();
                $data['doctor'] = $this->doctor_model->getDoctorById($id);
                $this->load->view('home/dashboard');
                $this->load->view('doctor/add_new', $data);
                $this->load->view('home/footer');
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['departments'] = $this->department_model->getDepartment();
                $this->load->view('home/dashboard');
                $this->load->view('doctor/add_new', $data);
                $this->load->view('home/footer');
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $file_name1 = $_FILES['signature']['name'];
           
            $file_name_pieces1 = explode('_', $file_name1);
            $new_file_name1 = '';
            $count1 = 1;
            foreach ($file_name_pieces1 as $piece) {
                if ($count1 !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name1 .= $piece;
                $count1++;
            }
            
            $config1 = array(
                'file_name' => $new_file_name1,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];

                $this->load->library('Upload', $config1);
                $this->upload->initialize($config1);
                if ($this->upload->do_upload('signature')) {
                    $path1 = $this->upload->data();
                    $signature = "uploads/" . $path1['file_name'];
                    $data = array();
                    $data = array(
                        'img_url' => $img_url,
                        'name' => $name,
                        'email' => $email,
                        'address' => $address,
                        'phone' => $phone,
                        'department' => $department,
                        'department_name'=>$department_details->name,
                        'profile' => $profile,
                        'signature'=>$signature,
                        'appointment_confirmation' => 'Active',
                        
                    );
                }else{
                    $data = array();
                    $data = array(
                        'img_url' => $img_url,
                        'name' => $name,
                        'email' => $email,
                        'address' => $address,
                        'phone' => $phone,
                        'department' => $department,
                        'department_name'=>$department_details->name,
                        'profile' => $profile,
                        
                        'appointment_confirmation' => 'Active',
                        
                    );
                }
               
            } else {
                $this->load->library('Upload', $config1);
                $this->upload->initialize($config1);
             
                if ($this->upload->do_upload('signature')) {
                    $path1 = $this->upload->data();
                    $signature = "uploads/" . $path1['file_name'];
                   
                    $data = array();
                    $data = array(
                       
                        'name' => $name,
                        'email' => $email,
                        'address' => $address,
                        'phone' => $phone,
                        'department' => $department,
                        'department_name'=>$department_details->name,
                        'profile' => $profile,
                        'signature'=>$signature,
                        'appointment_confirmation' => 'Active',
                        
                    );
                }else{
                  
                    $data = array();
                    $data = array(
                        'name' => $name,
                        'email' => $email,
                        'address' => $address,
                        'phone' => $phone,
                        'department' => $department,
                        'profile' => $profile,
                        'department_name'=>$department_details->name,
                       
                        'appointment_confirmation' => 'Active',
                        
                    );
                }
               
            }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New Doctor
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('doctor/addNewView');
                } else {
                    $dfg = 4;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->doctor_model->insertDoctor($data);
                    $doctor_user_id = $this->db->get_where('doctor', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->doctor_model->updateDoctor($doctor_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                    $base_url = str_replace(array('http://', 'https://', ' '), '', base_url()) . "auth/login";
                    //sms
                    $set['settings'] = $this->settings_model->getSettings();
                    $autosms = $this->sms_model->getAutoSmsByType('doctor');
                    $message = $autosms->message;
                    $to = $phone;
                    $name1 = explode(' ', $name);
                    if (!isset($name1[1])) {
                        $name1[1] = null;
                    }
                    $data1 = array(
                        'firstname' => $name1[0],
                        'lastname' => $name1[1],
                        'name' => $name,
                        'base_url' => $base_url,
                        'email' => $email,
                        'password' => $password,
                        'department' => $department,
                        'company' => $set['settings']->system_vendor
                    );

                    if ($autosms->status == 'Active') {
                        $messageprint = $this->parser->parse_string($message, $data1);
                        $data2[] = array($to => $messageprint);
                        $this->sms->sendSms($to, $message, $data2);
                    }
                    //end
                    //email

                    $autoemail = $this->email_model->getAutoEmailByType('doctor');
                    if ($autoemail->status == 'Active') {
                        $mail_provider = $this->settings_model->getSettings()->emailtype;
                        $settngs_name = $this->settings_model->getSettings()->system_vendor;
                        $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);
                        $message1 = $autoemail->message;
                        $messageprint1 = $this->parser->parse_string($message1, $data1);
                        if ($mail_provider == 'Domain Email') {
                            $this->email->from($email_Settings->admin_email);
                        }
                        if ($mail_provider == 'Smtp') {
                            $this->email->from($email_Settings->user, $settngs_name);
                        }
                        $this->email->to($email);
                        $this->email->subject('Registration confirmation');
                        $this->email->message($messageprint1);
                        $this->email->send();
                    }

                    //end


                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else { // Updating Doctor
                $doctor_details = $this->doctor_model->getDoctorById($id);
                if ($email != $doctor_details->email) {
                    if ($this->ion_auth->email_check($email)) {
                        $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                        redirect("doctor/editDoctor?id=" . $id);
                    }
                }
                $ion_user_id = $this->db->get_where('doctor', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->doctor_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->doctor_model->updateDoctor($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('doctor');
        }
    }

    function editDoctor() {
        $data = array();
        $data['departments'] = $this->department_model->getDepartment();
        $id = $this->input->get('id');
        $data['doctor'] = $this->doctor_model->getDoctorById($id);
        $this->load->view('home/dashboard');
        $this->load->view('doctor/add_new', $data);
        $this->load->view('home/footer');
    }

    function details() {

        $data = array();

        if ($this->ion_auth->in_group(array('Doctor'))) {

            $doctor_ion_id = $this->ion_auth->get_user_id();
            $id = $this->doctor_model->getDoctorByIonUserId($doctor_ion_id)->id;
            $data['doctor'] = $this->doctor_model->getDoctorById($id);
            $data['todays_appointments'] = $this->appointment_model->getAppointmentByDoctorByToday($id);
            $data['appointments'] = $this->appointment_model->getAppointmentByDoctor($id);
            $data['patients'] = $this->patient_model->getPatient();
            $data['appointment_patients'] = $this->patient->getPatientByAppointmentByDctorId($id);
            $data['doctors'] = $this->doctor_model->getDoctor();
            $data['prescriptions'] = $this->prescription_model->getPrescriptionByDoctorId($id);
            $data['holidays'] = $this->schedule_model->getHolidaysByDoctor($id);
            $data['schedules'] = $this->schedule_model->getScheduleByDoctor($id);

            $this->load->view('home/dashboard');
            $this->load->view('doctor/details', $data);
            $this->load->view('home/footer');
        } else {
            redirect('home');
        }
    }

    function editDoctorByJason() {
        $id = $this->input->get('id');
        $data['doctor'] = $this->doctor_model->getDoctorById($id);
        if($data['doctor']->department == null && $data['doctor']->department_name != null){
            $department_details = $this->department_model->getDepartmentByName($data['doctor']->department_name);
            if($department_details){
                $department_id = $department_details->id;
            }
            $data['doctor']->department = $department_id;
        }
        echo json_encode($data);
    }

    function delete() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('doctor', array('id' => $id))->row();
        $path = $user_data->img_url;
        $path1 = $user_data->signature;

        if (!empty($path)) {
            unlink($path);
        }
        if (!empty($path1)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->doctor_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('doctor');
    }
  
    function getDoctor() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "email",
            "3" => "phone",
            "4" => "department",
            "5" => "profile", 
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['doctors'] = $this->doctor_model->getDoctorBysearch($search, $order, $dir);
            } else {
                $data['doctors'] = $this->doctor_model->getDoctorWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['doctors'] = $this->doctor_model->getDoctorByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['doctors'] = $this->doctor_model->getDoctorByLimit($limit, $start, $order, $dir);
            }
        }


        $i = 0;
        foreach ($data['doctors'] as $doctor) {
            $i = $i + 1;
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options1 = '<a type="button" class="btn btn-soft-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $doctor->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }
            $options2 = '<a class="btn btn-soft-info btn-xs detailsbutton" title="' . lang('appointments') . '"  href="appointment/getAppointmentByDoctorId?id=' . $doctor->id . '"> <i class="fa fa-calendar"> </i> ' . lang('appointments') . '</a>';
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options3 = '<a class="btn btn-soft-danger btn-xs btn_width delete_button" title="' . lang('delete') . '" href="doctor/delete?id=' . $doctor->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            }

            if ($this->ion_auth->in_group(array('admin'))) {
                $zoom = '<a class="btn btn-soft-info btn-xs detailsbutton" title="' . lang('Zoom Setting') . '"  href="meeting/zoomSettings?id=' . $doctor->id . '"> <i class="fa fa-cog"> </i> ' . lang('Zoom Setting') . '</a>';
            }



            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options4 = '<a href="schedule/holidays?doctor=' . $doctor->id . '" class="btn btn-soft-primary btn-xs btn_width" data-toggle="modal" data-id="' . $doctor->id . '"><i class="fa fa-book"></i> ' . lang('holiday') . '</a>';
                $options5 = '<a href="schedule/timeSchedule?doctor=' . $doctor->id . '" class="btn btn-soft-info btn-xs btn_width" data-toggle="modal" data-id="' . $doctor->id . '"><i class="fa fa-book"></i> ' . lang('time_schedule') . '</a>';
                $options6 = '<a type="button" class="btn btn-soft-info btn-xs btn_width detailsbutton inffo" title="' . lang('info') . '" data-toggle="modal" data-id="' . $doctor->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';
            }
  $department_details=$this->department_model->getDepartmentById($doctor->department);
  if(!empty($department_details)){
      $depart=$department_details->name;
  }else{
      $depart=$doctor->department_name;
  }
            $info[] = array(
                $doctor->id,
                $doctor->name,
                $doctor->email,
                $doctor->phone,
                $depart,
                $doctor->profile,
                $options6 . ' ' . $options1 . ' ' . $options2 . ' ' . $options4 . ' ' . $zoom . ' ' . $options5 . ' ' . $options3,
            );
        }

        if (!empty($data['doctors'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->doctor_model->getDoctor()),
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

    public function getDoctorInfo() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->doctor_model->getDoctorInfo($searchTerm);

        echo json_encode($response);
    }

    public function getDoctorWithAddNewOption() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->doctor_model->getDoctorWithAddNewOption($searchTerm);

        echo json_encode($response);
    }
    function getDoctorByDepartment() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $department = $this->input->post("id");
        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "email",
            "3" => "phone",
            "4" => "department",
            "5" => "profile", 
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['doctors'] = $this->doctor_model->getDoctorBysearchByDepartment($search, $order, $dir,$department);
            } else {
                $data['doctors'] = $this->doctor_model->getDoctorWithoutSearchByDepartment($order, $dir,$department);
            }
        } else {
            if (!empty($search)) {
                $data['doctors'] = $this->doctor_model->getDoctorByLimitBySearchByDepartment($limit, $start, $search, $order, $dir,$department);
            } else {
                $data['doctors'] = $this->doctor_model->getDoctorByLimitByDepartment($limit, $start, $order, $dir,$department);
            }
        }


        $i = 0;
        foreach ($data['doctors'] as $doctor) {
            $i = $i + 1;
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options1 = '<a type="button" class="btn btn-soft-info  btn-xs waves-effect waves-light editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $doctor->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }
            $options2 = '<a class="btn btn-soft-info waves-effect waves-light btn-xs detailsbutton" title="' . lang('appointments') . '"  href="appointment/getAppointmentByDoctorId?id=' . $doctor->id . '"> <i class="fa fa-calendar"> </i> ' . lang('appointments') . '</a>';
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options3 = '<a class="btn btn-soft-danger waves-effect waves-light btn-xs delete_button" title="' . lang('delete') . '" href="doctor/delete?id=' . $doctor->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            }



            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options4 = '<a href="schedule/holidays?doctor=' . $doctor->id . '" class="btn btn-soft-primary waves-effect waves-light btn-xs btn_width" data-toggle="modal" data-id="' . $doctor->id . '"><i class="fa fa-book"></i> ' . lang('holiday') . '</a>';
                $options5 = '<a href="schedule/timeSchedule?doctor=' . $doctor->id . '" class="btn btn-soft-info waves-effect waves-light btn-xs btn_width" data-toggle="modal" data-id="' . $doctor->id . '"><i class="fa fa-book"></i> ' . lang('time_schedule') . '</a>';
                $options6 = '<a type="button" class="btn btn-soft-info waves-effect waves-light btn-xs btn_width detailsbutton inffo" title="' . lang('info') . '" data-toggle="modal" data-id="' . $doctor->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';
            }
            $department_details=$this->department_model->getDepartmentById($doctor->department);
            if(!empty($department_details)){
                $depart=$department_details->name;
            }else{
                $depart=$doctor->department_name;
            }
            $info[] = array(
                $doctor->id,
                $doctor->name,
                $doctor->email,
                $doctor->phone,
                $depart,
                $doctor->profile,
                $options6 . ' ' . $options1 . ' ' . $options2 . ' ' . $options4 . ' ' . $options5 . ' ' . $options3,
            );
        }

        if (!empty($data['doctors'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->db->get_where('doctor',array('department'=>$department))->result()),
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

    function deleteDoctorImage(){
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('doctor', array('id' => $id))->row();
        $path = $user_data->signature;
        if (!empty($path)) {
            unlink($path);
        }
        $data=array('signature'=>'');
        $this->doctor_model->updateDoctor($id,$data);
        $data_response=array();
        $data_response['response']='yes';
        echo json_encode($data_response);
    }
    public function getDoctorVisit() {
        $id = $this->input->get('id');
       // $description = $this->input->get('description');
        $visits = $this->doctor_model->getDoctorVisitByDoctorId($id);
        $option = '<option value="">' . lang('select') . '</option>';
        foreach ($visits as $visit) {
           
                $option .= '<option value="' . $visit->id . '">' . $visit->visit_description . '</option>';
            
        }
        $data['response'] = $option;
        echo json_encode($data);
    }
    public function getDoctorVisitCharges() {
        $id = $this->input->get('id');
        $data['response'] = $this->doctorvisit_model->getDoctorvisitById($id);


        echo json_encode($data);
    }
    public function getDoctorVisitForEdit() {
        $id = $this->input->get('id');
        $description = $this->input->get('description');
        $visits = $this->doctor_model->getDoctorVisitByDoctorId($id);
        $option = '<option value="">' . lang('select') . '</option>';
        foreach ($visits as $visit) {
            if($visit->id == $description){
              $option .= '<option value="' . $visit->id . '" selected ="selected">' . $visit->visit_description . '</option>';
            }else{
                $option .= '<option value="' . $visit->id . '">' . $visit->visit_description . '</option>';
            }
        }
        $data['response'] = $option;
        $data['visit_description'] = $option;
        echo json_encode($data);
    }
}

/* End of file doctor.php */
/* Location: ./application/modules/doctor/controllers/doctor.php */