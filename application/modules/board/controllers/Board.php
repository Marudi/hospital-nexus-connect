<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Board extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('board_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');  
        }
    }

    public function index() {

        $data['boards'] = $this->board_model->getBoard();
        $this->load->view('home/dashboard'); 
        $this->load->view('board', $data);
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
                redirect("board/editBoard?id=$id");
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
          

            if (empty($id)) {     // Adding New Board  
                    $this->board_model->insertBoard($data);
                    $this->session->set_flashdata('feedback', lang('added'));
                
            } else { // Updating Board
                $this->board_model->updateBoard($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('board');
        }
    }

    function getBoard() {
        $data['boards'] = $this->board_model->getBoard();
        $this->load->view('board', $data);
    }

    function editBoard() {
        $data = array();
        $id = $this->input->get('id');
        $data['board'] = $this->board_model->getBoardById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); 
    }
    
    function editBoardByJason(){
        $id = $this->input->get('id');
        $data['board'] = $this->board_model->getBoardById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('board', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->board_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('board');
    }

}

/* End of file board.php */
/* Location: ./application/modules/board/controllers/board.php */
