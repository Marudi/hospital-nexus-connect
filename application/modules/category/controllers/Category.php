<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');  
        }
    }

    public function index() {

        $data['categorys'] = $this->category_model->getCategory();
        $this->load->view('home/dashboard'); 
        $this->load->view('category', $data);
        $this->load->view('home/footer'); 
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new');
        $this->load->view('home/footer'); 
    }

    public function addNew() {

        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        if(!empty($id)){
            $date = $this->input->post('date');
        }else{
            $date = time();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("category/editCategory?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); 
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); 
            }
        } else {
            

         
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'title' => $title,
                    'description' => $description,
                    'date' => $date
                );
          

            if (empty($id)) {     // Adding New Category  
                    $this->category_model->insertCategory($data);
                    $this->session->set_flashdata('feedback', lang('added'));
                
            } else { // Updating Category
                $this->category_model->updateCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('category');
        }
    }

    function getCategory() {
        $data['categorys'] = $this->category_model->getCategory();
        $this->load->view('category', $data);
    }

    function editCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['category'] = $this->category_model->getCategoryById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); 
    }
    
    function editCategoryByJason(){
        $id = $this->input->get('id');
        $data['category'] = $this->category_model->getCategoryById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('category', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->category_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('category');
    }

}

/* End of file category.php */
/* Location: ./application/modules/category/controllers/category.php */
