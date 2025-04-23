<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Superadmin extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('superadmin_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['superadmins'] = $this->superadmin_model->getSuperadmin();
        $this->load->view('home/dashboard'); 
        $this->load->view('superadmin', $data);
        $this->load->view('home/footer'); 
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new');
        $this->load->view('home/footer'); 
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $module = $this->input->post('module');
        if (!empty($module)) {
            $module = implode(',', $module);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['superadmin'] = $this->superadmin_model->getSuperadminById($id);
                $this->load->view('home/dashboard'); 
                $this->load->view('add_new', $data);
                $this->load->view('home/footer');
            } else {
                $data = array();
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
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'module' => $module,
                    'phone' => $phone
                );
            } else {
                
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'module' => $module,
                    'phone' => $phone
                );
            }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New Superadmin
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('superadmin/addNewView');
                } else {
                    $dfg = 1;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->superadmin_model->insertSuperadmin($data);
                    $superadmin_user_id = $this->db->get_where('superadmin', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->superadmin_model->updateSuperadmin($superadmin_user_id, $id_info);

                    $base_url = str_replace(array('http://', 'https://', ' '), '', base_url()) . "auth/login";
                    $set['settings'] = $this->settings_model->getSettings();
                    $name1 = explode(' ', $name);
                    if (!isset($name1[1])) {
                        $name1[1] = null;
                    }
                    $data1 = array(
                        'firstname' => $name1[0],
                        'lastname' => $name1[1],
                        'name' => $name,
                        'base_url' => $base_url,
                        'email' => $email,
                        'password' => $password,
                        'hospital_id' => $hospital_user_id,
                        'company' => $set['settings']->system_vendor
                    );
                   
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else { // Updating Superadmin
                $ion_user_id = $this->db->get_where('superadmin', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->superadmin_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->superadmin_model->updateSuperadmin($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('superadmin');
        }
    }

    function getSuperadmin() {
        $data['superadmins'] = $this->superadmin_model->get_superadmin();
        $this->load->view('superadmin', $data);
    }

    function editSuperadmin() {
        $data = array();
        $id = $this->input->get('id');
        $data['superadmin'] = $this->superadmin_model->getSuperadminById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new', $data);
        $this->load->view('home/footer');
    }

    function editSuperadminByJason() {
        $id = $this->input->get('id');
        $data['superadmin'] = $this->superadmin_model->getSuperadminById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('superadmin', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->superadmin_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('superadmin');
    }

}

/* End of file superadmin.php */
/* Location: ./application/modules/superadmin/controllers/superadmin.php */
