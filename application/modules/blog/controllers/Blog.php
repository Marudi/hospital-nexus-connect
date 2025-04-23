<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('blog_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['blogs'] = $this->blog_model->getBlog();
        $this->load->view('home/dashboard'); 
        $this->load->view('blog', $data);
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
        // $date = $this->input->post('date');
        $posted_by = $this->input->post('posted_by');
        $description = $this->input->post('description');
       $button_link = $this->input->post('button_link');
        if(!empty($id)){
            $date = $this->input->post('date');
        }else{
            $date = time();
        }
        $status = $this->input->post('status');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
       

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("blog/editBlog?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); 
                $this->load->view('add_new', $data);
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
                    'img_url' => $img_url,
                    'title' => $title,
                    'posted_by' => $posted_by,
                    'description' => $description,
                    'date' => $date,
                    'button_link' => $button_link
                );
            } else {
               
                $data = array();
                $data = array(
                    'title' => $title,
                    'posted_by' => $posted_by,
                    'description' => $description,
                    'date' => $date,
                    'button_link' => $button_link
                );
            }

           

            if (empty($id)) {     // Adding New Blog
                $this->blog_model->insertBlog($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Blog
                $this->blog_model->updateBlog($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('blog');
        }
    }

    function getBlog() {
        $data['blogs'] = $this->blog_model->getBlog();
        $this->load->view('blog', $data);
    }

    function editBlog() {
        $data = array();
        $id = $this->input->get('id');
        $data['blog'] = $this->blog_model->getBlogById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new', $data);
        $this->load->view('home/footer');
    }

    function editBlogByJason() {
        $id = $this->input->get('id');
        $data['blog'] = $this->blog_model->getBlogById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('blog', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        
        $this->blog_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('blog');
    }

}

/* End of file blog.php */
/* Location: ./application/modules/blog/controllers/blog.php */
