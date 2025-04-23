<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gridsection extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('site_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        $this->load->model('site/slide_model');
        $this->load->model('site/service_model');
        $this->load->model('email/email_model');
        $this->load->model('site/featured_model');
        $this->load->model('site/gridsection_model');
    }
    
    public function index() {
        $data = array();
        $data['settings'] = $this->site_model->getSettings();
        $data['gridsections'] = $this->gridsection_model->getGridsection();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('site/gridsection/gridsection', $data);
        $this->load->view('home/footer'); // just the footer file 
    }
    
    public function addNew() {
        
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $category = $this->input->post('category');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Title Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Text 1 Field
        $this->form_validation->set_rules('category', 'Time', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("site/gridsection/editGridsection?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('site/gridsection/add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {
        

                $data = array();
                $data = array(
                    'title' => $title,
                    'category' => $category
                    
                );
           

            

            if (empty($id)) {     // Adding New Slide
                $this->gridsection_model->insertGridsection($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Slide
                $this->gridsection_model->updateGridsection($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('site/gridsection');
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
        $this->load->view('site/gridsection/add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }
    
    function delete() {
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('site_grid', array('id' => $id))->row();
        $path = $user_data->img;
        if (!empty($path)) {
            unlink($path);
        }
        $this->gridsection_model->deleteGridsection($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('site/gridsection');
    }
}