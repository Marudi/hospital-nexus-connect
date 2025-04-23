<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roadmap extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('roadmap_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');  
        }
    }

    public function index() {

        $data['roadmaps'] = $this->roadmap_model->getRoadmap();
        $this->load->view('home/dashboard'); 
        $this->load->view('roadmap', $data);
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
        if(!empty($id)){
            $date = $this->input->post('date');
        }else{
            $date = time();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("roadmap/editRoadmap?id=$id");
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
                    
                    'date' => $date,
                );
          

            if (empty($id)) {     // Adding New Roadmap  
                    $this->roadmap_model->insertRoadmap($data);
                    $this->session->set_flashdata('feedback', lang('added'));
                
            } else { // Updating Roadmap
                $this->roadmap_model->updateRoadmap($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('roadmap');
        }
    }

    function getRoadmap() {
        $data['roadmaps'] = $this->roadmap_model->getRoadmap();
        $this->load->view('roadmap', $data);
    }

    function editRoadmap() {
        $data = array();
        $id = $this->input->get('id');
        $data['roadmap'] = $this->roadmap_model->getRoadmapById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); 
    }
    
    function editRoadmapByJason(){
        $id = $this->input->get('id');
        $data['roadmap'] = $this->roadmap_model->getRoadmapById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('roadmap', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->roadmap_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('roadmap');
    }

}

/* End of file roadmap.php */
/* Location: ./application/modules/roadmap/controllers/roadmap.php */
