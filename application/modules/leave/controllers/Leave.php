<?php

class Leave extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('leave_model');
    }

    public function index() {
        $data['leave_types'] = $this->leave_model->getLeaveType();
        $this->load->view('home/dashboard');
        $this->load->view('leave', $data);
        $this->load->view('home/footer');
    }

    public function leaveType() {
        $this->load->view('home/dashboard');
        $this->load->view('leave_type');
        $this->load->view('home/footer');
    }

    public function addNew() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->ion_auth->in_group(array('admin'))) {
            $this->form_validation->set_rules('staff', 'Staff', 'trim|required|xss_clean');
        }
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('duration', 'Leave Duration', 'trim|required|xss_clean');
        $duration = $this->input->post('duration');
        if ($duration == 'single' || $duration == 'halfday') {
            $this->form_validation->set_rules('date', 'Leave Date', 'trim|required|xss_clean');
            $date = $this->input->post('date');
        } else {
            $this->form_validation->set_rules('date2', 'Leave Dates', 'trim|required|xss_clean');
            $date = $this->input->post('date2');
        }
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('reason', 'Leave Reason', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Leave Status', 'trim|required|xss_clean');

        if ($this->form_validation->run() == true) {

            if ($this->ion_auth->in_group(array('admin'))) {
                $staff = $this->input->post('staff');
            } else {
                $staff = $this->ion_auth->user()->row()->id;
            }

            if ($duration == 'multiple') {
                $dates = explode(',', $date);
                foreach ($dates as $date) {
                    $data = array(
                        'staff' => $staff,
                        'type' => $this->input->post('leave_type'),
                        'duration' => 'single',
                        'reason' => $this->input->post('reason'),
                        'status' => $this->input->post('status'),
                        'date' => $date,
                        'hospital_id' => $this->session->userdata('hospital_id'),
                        'created_on' => date('d-m-Y')
                    );

                    $this->leave_model->insertLeave($data);
                }
            } else {
                $data = array(
                    'staff' => $staff,
                    'type' => $this->input->post('leave_type'),
                    'duration' => 'single',
                    'reason' => $this->input->post('reason'),
                    'status' => $this->input->post('status'),
                    'date' => $date,
                    'hospital_id' => $this->session->userdata('hospital_id'),
                    'created_on' => date('d-m-Y')
                );

                $this->leave_model->insertLeave($data);
            }

            $this->session->set_flashdata('feedback', lang('added'));
            redirect('leave');
        } else {
            $this->session->set_flashdata('feedback', lang('failed'));
            redirect('leave');
        }
    }

    public function updateLeave() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');
        if ($this->ion_auth->in_group(array('admin'))) {
            $this->form_validation->set_rules('staff', 'Staff', 'trim|required|xss_clean');
            $this->form_validation->set_rules('status', 'Leave Status', 'trim|required|xss_clean');
        }
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('duration', 'Leave Duration', 'trim|required|xss_clean');
        $duration = $this->input->post('duration');
        if ($duration == 'single' || $duration == 'halfday') {
            $this->form_validation->set_rules('date', 'Leave Date', 'trim|required|xss_clean');
            $date = $this->input->post('date');
        } else {
            $this->form_validation->set_rules('date2', 'Leave Dates', 'trim|required|xss_clean');
            $date = $this->input->post('date2');
        }
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('reason', 'Leave Reason', 'trim|required|xss_clean');

        if ($this->form_validation->run() == true) {

            if ($this->ion_auth->in_group(array('admin'))) {
                $staff = $this->input->post('staff');
            } else {
                $staff = $this->ion_auth->user()->row()->id;
            }

            if ($this->ion_auth->in_group(array('admin'))) {
                $status = $this->input->post('status');
            } else {
                $status = $this->db->get_where('leaves', array('id' => $this->input->post('id')))->row()->status;
            }

            $data = array(
                'staff' => $staff,
                'type' => $this->input->post('leave_type'),
                'duration' => $this->input->post('duration'),
                'reason' => $this->input->post('reason'),
                'status' => $status,
                'date' => $date,
                'hospital_id' => $this->session->userdata('hospital_id')
            );

            $this->leave_model->updateLeave($this->input->post('id'), $data);

            $this->session->set_flashdata('feedback', lang('updated'));
            redirect('leave');
        } else {
            $this->session->set_flashdata('feedback', lang('failed'));
            redirect('leave');
        }
    }

    public function getLeave() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['leaves'] = $this->leave_model->getLeaveBySearch($search);
            } else {
                $data['leaves'] = $this->leave_model->getLeave();
            }
        } else {
            if (!empty($search)) {
                $data['leaves'] = $this->leave_model->getLeaveByLimitBySearch($limit, $start, $search);
            } else {
                $data['leaves'] = $this->leave_model->getLeaveByLimit($limit, $start);
            }
        }


        $i = 0;
        foreach ($data['leaves'] as $leavetypes) {
            $i = $i + 1;
            if ($this->ion_auth->in_group(array('admin'))) {

                $options1 = ' <a type="button" class="btn btn-soft-primary waves-effect waves-light editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $leavetypes->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                $options5 = '<a class="btn btn-soft-danger waves-effect waves-light delete_button" title="' . lang('delete') . '" href="leave/deleteLeave?id=' . $leavetypes->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            } else {

                if ($leavetypes->status == 'pending') {
                    $options1 = ' <a type="button" class="btn btn-soft-primary waves-effect waves-light editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $leavetypes->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                } else {
                    $options1 = ' ';
                }
                $options5 = '<a class="btn btn-soft-danger waves-effect waves-light delete_button" title="' . lang('delete') . '" href="leave/deleteLeave?id=' . $leavetypes->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            if ($this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $this->db->get_where('users', array('id' => $leavetypes->staff))->row()->username,
                    $leavetypes->date,
                    $leavetypes->status,
                    $leavetypes->type,
                    $leavetypes->reason,
                    $options1 . ' ' . $options5,
                );
            } else {
                $info[] = array(
                    $this->db->get_where('users', array('id' => $leavetypes->staff))->row()->username,
                    $leavetypes->date,
                    $leavetypes->status,
                    $leavetypes->type,
                    $leavetypes->reason,
                    $options1 . ' ' . $options5,
                );
            }
        }

        if ($this->ion_auth->in_group(array('admin'))) {
            if (!empty($data['leaves'])) {
                $output = array(
                    "draw" => intval($requestData['draw']),
                    "recordsTotal" => count($this->leave_model->getLeave()),
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
        } else {
            if (!empty($data['leaves'])) {
                $output = array(
                    "draw" => intval($requestData['draw']),
                    "recordsTotal" => $this->db->get_where('leaves', array('staff' => $this->ion_auth->user()->row()->id))->num_rows(),
                    "recordsFiltered" => $this->db->get_where('leaves', array('staff' => $this->ion_auth->user()->row()->id))->num_rows(),
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
        }



        echo json_encode($output);
    }

    public function deleteLeave() {
        $id = $this->input->get('id');
        $this->leave_model->deleteLeave($id);

        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('leave/leave');
    }

    public function getLeaveById() {
        $id = $this->input->get('id');
        $data['leave'] = $this->leave_model->getLeaveById($id);
        $data['name'] = $this->db->get_where('users', array('id' => $data['leave']->staff))->row()->username;
        echo json_encode($data);
    }

    public function getLeaveType() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['leavetypes'] = $this->leave_model->getLeaveTypeBySearch($search);
            } else {
                $data['leavetypes'] = $this->leave_model->getLeaveType();
            }
        } else {
            if (!empty($search)) {
                $data['leavetypes'] = $this->leave_model->getLeaveTypeByLimitBySearch($limit, $start, $search);
            } else {
                $data['leavetypes'] = $this->leave_model->getLeaveTypeByLimit($limit, $start);
            }
        }


        $i = 0;
        foreach ($data['leavetypes'] as $leavetypes) {
            $i = $i + 1;

            if ($this->ion_auth->in_group(array('admin'))) {

                $options1 = ' <a type="button" class="btn btn-soft-primary waves-effect waves-light editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $leavetypes->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                $options5 = '<a class="btn btn-soft-danger waves-effect waves-light delete_button" title="' . lang('delete') . '" href="leave/deleteLeaveType?id=' . $leavetypes->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            if (!$this->ion_auth->in_group(array('admin'))) {

                $options1 = ' <a type="button" class="btn btn-soft-primary waves-effect waves-light editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $leavetypes->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                $options5 = '<a class="btn btn-soft-danger waves-effect waves-light delete_button" title="' . lang('delete') . '" href="leave/deleteLeaveType?id=' . $leavetypes->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            if ($this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $leavetypes->name,
                    $options1 . ' ' . $options5,
                        //  $options2
                );
            }


            if (!$this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $leavetypes->name,
                    $options1 . ' ' . $options5,
                        //  $options2
                ); 
            }
        }

        if (!empty($data['leavetypes'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->leave_model->getLeaveType()),
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

    public function addNewLeaveType() {
        $name = $this->input->post('name');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Leave Type Name', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            redirect('leave/leaveType');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'hospital_id' => $this->session->userdata('hospital_id')
            );
            $this->leave_model->addLeaveType($data);

            $this->session->set_flashdata('feedback', lang('added'));
            redirect('leave/leaveType');
        }
    }

    public function updateLeaveType() {
        $name = $this->input->post('name');
        $id = $this->input->post('id');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Leave Type Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('id', 'Leave Type ID', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            redirect('leave/leaveType');
        } else {
            $data = array(
                'name' => $name
            );
            $this->leave_model->updateLeaveType($id, $data);

            $this->session->set_flashdata('feedback', lang('updated'));
            redirect('leave/leaveType');
        }
    }

    public function deleteLeaveType() {
        $id = $this->input->get('id');
        $this->leave_model->deleteLeaveType($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('leave/leaveType');
    }

    public function getLeaveTypeById() {
        $id = $this->input->get('id');
        $result = $this->leave_model->getLeaveTypeById($id);
        echo json_encode($result);
    }

    public function getStaffinfoWithAddNewOption() {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->settings_model->getStaffinfoWithAddNewOption($searchTerm);

        echo json_encode($response);
    }

    public function getSelectStaffinfoById() {
        // Search term
        $searchTerm = $this->input->get('id');

        // Get users
        $response = $this->settings_model->getStaffinfoWithAddNewOption($searchTerm);

        echo json_encode($response);
    }

}
