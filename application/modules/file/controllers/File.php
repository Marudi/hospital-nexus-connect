<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('file_model');
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Doctor', 'Laboratorist', 'im', 'Pharmacist', 'Receptionist'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['files'] = $this->file_model->getFile();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); 
        $this->load->view('file', $data);
        $this->load->view('home/footer'); 
    }

    public function addNewView() {
        $data['files'] = $this->file_model->getFile();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); 
        $this->load->view('add_new');
        $this->load->view('home/footer'); 
    }

    public function addNew() {

        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $module = $this->input->post('module');
        if (!empty($module)) {
            $module = implode(',', $module);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Title Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|max_length[100]|xss_clean');



        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("file/editFile?id=$id");
            } else {
                $this->load->view('home/dashboard'); 
                $this->load->view('add_new');
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
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'title' => $title,
                    'module' => $module
                );
            } else {
                
                $data = array();
                $data = array(
                    'title' => $title,
                    'module' => $module
                );
            }

            if (empty($id)) {     // Adding New File
                $this->file_model->insertFile($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating File
                $this->file_model->updateFile($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('file');
        }
    }

    function getFile() {
        $data['files'] = $this->file_model->getFile();
        $this->load->view('file', $data);
    }

    function editFile() {
        $data = array();
        $id = $this->input->get('id');
        $data['file'] = $this->file_model->getFileById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); 
    }

    function editFileByJason() {
        $id = $this->input->get('id');
        $data['file'] = $this->file_model->getFileById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $this->file_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('file');
    }

}

/* End of file file.php */
/* Location: ./application/modules/file/controllers/file.php */
