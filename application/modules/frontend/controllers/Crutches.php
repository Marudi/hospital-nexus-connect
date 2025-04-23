<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crutches extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        $this->load->model('slide_model');
        $this->load->model('service_model');
        $this->load->model('email/email_model');
       
        $this->load->model('frontend/crutches_model');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }
    
    public function index() {
        $data = array();
        $data['settings'] = $this->frontend_model->getSettings();
        $data['crutchess'] = $this->crutches_model->getCrutches();
        $this->load->view('home/dashboard'); 
        $this->load->view('frontend/crutches', $data);
        $this->load->view('home/footer'); 
    }
    
    public function addNew() {
        
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $designation = $this->input->post('designation');
        $crutches = $this->input->post('crutches');
        $status = $this->input->post('status');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("crutches/editCrutches?id=$id");
            } else {
                $this->load->view('home/dashboard'); 
                $this->load->view('frontend/add_new');
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
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "10000",
                'max_width' => "10000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img' => $img_url,
                    'name' => $name,
                    'designation' => $designation,
                    'crutches' => $crutches,
                    'status' => $status
                );
            } else {
              
                $data = array();
                $data = array(
                    'name' => $name,
                    'designation' => $designation,
                    'crutches' => $crutches,
                    'status' => $status
                );
            }

           

            if (empty($id)) {     // Adding New Slide
                $this->crutches_model->insertCrutches($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Slide
                $this->crutches_model->updateCrutches($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('frontend/crutches');
        }
        
    }
    
    function editCrutchesByJason() {
        $id = $this->input->get('id');
        $data['crutches'] = $this->crutches_model->getCrutchesById($id);
        echo json_encode($data);
    }
    
    function editCrutches() {
        $id = $this->input->get('id');
        $data['crutches'] = $this->crutches_model->getCrutchesById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('frontend/add_new', $data);
        $this->load->view('home/footer'); 
    }
    
    function delete() {
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('crutches', array('id' => $id))->row();
        $path = $user_data->img;
        if (!empty($path)) {
            unlink($path);
        }
        $this->crutches_model->deleteCrutches($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('frontend/crutches');
    }
}