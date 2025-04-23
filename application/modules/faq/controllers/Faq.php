<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('faq_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }

    public function index()
    {

        $data['faqs'] = $this->faq_model->getFaq();
        $this->load->view('home/dashboard');
        $this->load->view('faq', $data);
        $this->load->view('home/footer');
    }

    public function addNewView()
    {
        $this->load->view('home/dashboard');
        $this->load->view('add_new');
        $this->load->view('home/footer');
    }

    public function addNew()
    {

        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("faq/editFaq?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard');
                $this->load->view('add_new', $data);
                $this->load->view('home/footer');
            }
        } else {
           

                $data = array();
                $data = array(
                    'title' => $title,
                    'description' => $description,
                );
            

            if (empty($id)) {     // Adding New Faq  
                $this->faq_model->insertFaq($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Faq
                $this->faq_model->updateFaq($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('faq');
        }
    }

    function getFaq()
    {
        $data['faqs'] = $this->faq_model->getFaq();
        $this->load->view('faq', $data);
    }

    function editFaq()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['faq'] = $this->faq_model->getFaqById($id);
        $this->load->view('home/dashboard');
        $this->load->view('add_new', $data);
        $this->load->view('home/footer');
    }

    function editFaqByJason()
    {
        $id = $this->input->get('id');
        $data['faq'] = $this->faq_model->getFaqById($id);
        echo json_encode($data);
    }

    function delete()
    {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('faq', array('id' => $id))->row();
       
        $this->faq_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('faq');
    }
}

/* End of file faq.php */
/* Location: ./application/modules/faq/controllers/faq.php */
