<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Macro extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('macro_model');
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Nurse', 'Laboratorist', 'Doctor', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {


        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('macro', $data);
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
        $short_name = $this->input->post('short_name');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('short_name', 'Short Name', 'trim|required|min_length[2]|max_length[1000]|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[100000]|xss_clean');
        // Validating Password Field



        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {

                $data['macro'] = $this->macro_model->getMacroById($id);
                $this->load->view('home/dashboard', $data);
                $this->load->view('add_new', $data);
                $this->load->view('home/footer');


                // $this->session->set_flashdata('feedback', lang('form_validation_error'));
                // redirect('macro/editMacro?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data);
                $this->load->view('add_new');
                $this->load->view('home/footer');
            }
        } else {
            $data = array();
            $data = array(
                'short_name' => $short_name,
                'description' => $description,


            );


            if (empty($id)) {     // Adding New Macro
                $data['created_by'] = $this->ion_auth->get_user_id();
                $data['created_by_name'] = $this->db->get_where('users', array('id' => $this->ion_auth->get_user_id()))->row()->username;
                $data['date_time'] = time();
                $this->macro_model->insertMacro($data);
                $this->session->set_flashdata('feedback', lang('updated'));
            } else { // Updating Macro

                $this->macro_model->updateMacro($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('macro');
        }
    }



    function editMacro()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['macro'] = $this->macro_model->getMacroById($id);
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new', $data);
        $this->load->view('home/footer');
    }

    function editMacroByJason()
    {
        $id = $this->input->get('id');
        $data['macro'] = $this->macro_model->getMacroById($id);
        echo json_encode($data);
    }

    function delete()
    {
        $id = $this->input->get('id');
        $this->macro_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('macro');
    }
    function getMacro()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "category",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['macros'] = $this->macro_model->getMacroBysearch($search, $order, $dir);
            } else {
                $data['macros'] = $this->macro_model->getMacroWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['macros'] = $this->macro_model->getMacroByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['macros'] = $this->macro_model->getMacroByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['macros'] as $macro) {
            $i = $i + 1;


            $options1 = ' <a type="button" class="btn btn-soft-info btn-xs editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $macro->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            $options5 = '<a class="btn btn-soft-danger btn-xs delete_button" title="' . lang('delete') . '" href="macro/delete?id=' . $macro->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';




            $info[] = array(
                $macro->short_name,
                $macro->description,
                $macro->created_by_name,
                date('d-m-Y H:i', $macro->date_time),
                $options1 . ' ' . $options5,
            );
        }

        if (!empty($data['macros'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['macros']),
                "recordsFiltered" => count($data['macros']),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }
}

/* End of file Macro.php */
/* Location: ./application/modules/Macro/controllers/Macro.php */
