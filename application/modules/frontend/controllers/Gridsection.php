<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gridsection extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('site_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        $this->load->model('slide_model');
        $this->load->model('service_model');
        $this->load->model('email/email_model');
      
        $this->load->model('frontend/gridsection_model');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
         if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }
    
    public function index() {
        $data = array();
        // $data['settings'] = $this->frontend_model->getSettings();
        $data['gridsections'] = $this->gridsection_model->getGridsection();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('frontend/grid_section', $data);
        $this->load->view('home/footer'); // just the footer file
    }
    
    public function addNew() {
        
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $category = $this->input->post('category');
        $description = $this->input->post('description');
        $position = $this->input->post('position');
        $status = $this->input->post('status');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Title Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Text 1 Field
        $this->form_validation->set_rules('category', 'Time', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Text 2 Field
        // $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
        // $this->form_validation->set_rules('position', 'Position', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // $this->form_validation->set_rules('status', 'Status', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("gridsection/editGridsection?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('frontend/add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            
         
                $data = array();
                $data = array(
                    'title' => $title,
                    'category' => $category,
                    
                );
            

            //$usertitle = $this->input->post('title');

            if (empty($id)) {     // Adding New Slide
                $this->gridsection_model->insertGridsection($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Slide
                $this->gridsection_model->updateGridsection($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('frontend/gridsection');
        }
        
    }
    
    function editGridsectionByJason() {
        $id = $this->input->get('id');
        $data['gridsection'] = $this->gridsection_model->getGridsectionById($id);
        echo json_encode($data);
    }
    
    function editGridsection() {
        $id = $this->input->get('id');
        $data['gridsection'] = $this->gridsection_model->getGridsectionById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('frontend/add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }
    
    function delete() {
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('grid', array('id' => $id))->row();
        $path = $user_data->img;
        if (!empty($path)) {
            unlink($path);
        }
        $this->gridsection_model->deleteGridsection($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('frontend/gridsection');
    }
}