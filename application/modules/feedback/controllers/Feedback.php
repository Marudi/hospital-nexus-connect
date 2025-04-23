<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('feedback_model');
        $this->load->model('board/board_model');
        $this->load->model('category/category_model');
        $this->load->model('roadmap/roadmap_model');
        // if (!$this->ion_auth->in_group('superadmin')) {
        //     redirect('home/permission');  
        // }
    }

    public function overview() {
        $data['daterange'] = $this->input->post('daterange');
        $date_range = explode('-', $data['daterange']);

        // $start_date = $date_range[0];
        // $end_date = $date_range[1];
        $start_date = strtotime($date_range[0]);
        $end_date = strtotime($date_range[1]);
        if (!empty($start_date) && !empty($end_date)) {
        $data['top_feedback'] = $this->feedback_model->get_top_feedback_date($start_date, $end_date);
        $data['total_feedback'] = $this->feedback_model->get_total_feedback_date($start_date, $end_date);
        $data['feedback_id1'] = $this->feedback_model->get_total_id1_feedback_date($start_date, $end_date);
        $data['feedback_id2'] = $this->feedback_model->get_total_id2_feedback_date($start_date, $end_date);
        $data['feedback_id3'] = $this->feedback_model->get_total_id3_feedback_date($start_date, $end_date);
        $data['feedback_id4'] = $this->feedback_model->get_total_id4_feedback_date($start_date, $end_date);
        $data['feedback_id5'] = $this->feedback_model->get_total_id5_feedback_date($start_date, $end_date);
        } else {
        $data['top_feedback'] = $this->feedback_model->get_top_feedback();
        $data['total_feedback'] = $this->feedback_model->get_total_feedback();
        $data['feedback_id1'] = $this->feedback_model->get_total_feedback_id1();
        $data['feedback_id2'] = $this->feedback_model->get_total_feedback_id2();
        $data['feedback_id3'] = $this->feedback_model->get_total_feedback_id3();
        $data['feedback_id4'] = $this->feedback_model->get_total_feedback_id4();
        $data['feedback_id5'] = $this->feedback_model->get_total_feedback_id5();
        }
       
        $data['boards'] = $this->board_model->getBoard();
        $data['feedbacks'] = $this->feedback_model->getFeedback();
        $this->load->view('home/dashboard'); 
        $this->load->view('overview', $data);
        $this->load->view('home/footer'); 
    }



    public function index() {
        $data['boards'] = $this->board_model->getBoard();
        $data['categories'] = $this->category_model->getCategory();
        $data['roadmaps'] = $this->roadmap_model->getRoadmap();
        $data['feedbacks'] = $this->feedback_model->getFeedback();
        $this->load->view('home/dashboard'); 
        $this->load->view('feedback', $data);
        $this->load->view('home/footer'); 
    }

    public function addNewView() {
        $data['boards'] = $this->board_model->getBoard();
        $data['categories'] = $this->category_model->getCategory();
        $data['roadmaps'] = $this->roadmap_model->getRoadmap();
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); 
    }

    public function addNew() {
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        
        if(!empty($id)){
            $date = $this->input->post('date');
        }else{
            $date = time();
        }
        
        $category = $this->input->post('category');
        $board = $this->input->post('board');
        $status = $this->input->post('status');
        $roadmap = $this->input->post('roadmap');
        $approval_status = $this->input->post('approval_status');
        
        if (empty($id)) {
            $ion_user_id = $this->ion_auth->get_user_id();
            $userdetails = $this->ion_auth->user()->row();
            $username = $userdetails->username;
            $email = $userdetails->email;
            $hospital_id = $this->session->userdata('hospital_id');
        } else {
            $ion_user_id = $this->input->post('ion_user_id');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $hospital_id = $this->input->post('hospital_id');
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("feedback/editFeedback?id=$id");
            } else {
                $data['boards'] = $this->board_model->getBoard();
                $data['categories'] = $this->category_model->getCategory();
                $data['roadmaps'] = $this->roadmap_model->getRoadmap();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); 
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); 
            }
        } else {
            $data = array(
                'username' => $username,
                'description' => $description,
                'date' => $date,
                'email' => $email,
                'ion_user_id' => $ion_user_id,
                'category' => $category,
                'board' => $board,
                'roadmap' => $roadmap,
                'status' => $status,
                'hospital_id' => $hospital_id,
                'approval_status' => $approval_status
            );

            if (empty($id)) {     // Adding New Feedback  
                $this->feedback_model->insertFeedback($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Feedback
                $this->feedback_model->updateFeedback($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('feedback');
        }
    }



    function editFeedback() {
        $data = array();
        $id = $this->input->get('id');
        $data['boards'] = $this->board_model->getBoard();
        $data['categories'] = $this->category_model->getCategory();
        $data['roadmaps'] = $this->roadmap_model->getRoadmap();
        $data['feedback'] = $this->feedback_model->getFeedbackById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); 
    }
    
    function editFeedbackByJason(){
        $id = $this->input->get('id');
        $data['feedback'] = $this->feedback_model->getFeedbackById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('feedback', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->feedback_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('feedback');
    }


    function getFeedback()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $settings = $this->settings_model->getSettings();
        $filter_board = $_GET['board'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "username",
            

        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];
        if (empty($filter_board) || $filter_board == 'all') {
            if ($this->ion_auth->in_group(array('admin'))) {
                if ($limit == -1) {
                    if (!empty($search)) {
                        $data['feedbacks'] = $this->feedback_model->getFeedbackBySearchByAdmin($search, $order, $dir);
                    } else {
                        $data['feedbacks'] = $this->feedback_model->getFeedbackWithoutSearchByAdmin($order, $dir);
                    }
                } else {
                    if (!empty($search)) {
                        $data['feedbacks'] = $this->feedback_model->getFeedbackByLimitBySearchByAdmin($limit, $start, $search, $order, $dir);
                    } else {
                        $data['feedbacks'] = $this->feedback_model->getFeedbackByLimitByAdmin($limit, $start, $order, $dir);
                    }
                }
            }else{
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['feedbacks'] = $this->feedback_model->getFeedbackBySearch($search, $order, $dir);
                } else {
                    $data['feedbacks'] = $this->feedback_model->getFeedbackWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['feedbacks'] = $this->feedback_model->getFeedbackByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['feedbacks'] = $this->feedback_model->getFeedbackByLimit($limit, $start, $order, $dir);
                }
            }
        }
        } else {
            if ($this->ion_auth->in_group(array('admin'))) {
                if ($limit == -1) {
                    if (!empty($search)) {
                        $data['feedbacks'] = $this->feedback_model->getFeedbackBySearchByBoardByAdmin($search, $order, $dir, $filter_board);
                    } else {
                        $data['feedbacks'] = $this->feedback_model->getFeedbackWithoutSearchByBoardByAdmin($order, $dir, $filter_board);
                    }
                } else {
                    if (!empty($search)) {
                        $data['feedbacks'] = $this->feedback_model->getFeedbackByLimitBySearchByBoardByAdmin($limit, $start, $search, $order, $dir, $filter_board);
                    } else {
                        $data['feedbacks'] = $this->feedback_model->getFeedbackByLimitByBoardByAdmin($limit, $start, $order, $dir, $filter_board);
                    }
                }
            }else{
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['feedbacks'] = $this->feedback_model->getFeedbackBySearchByBoard($search, $order, $dir, $filter_board);
                } else {
                    $data['feedbacks'] = $this->feedback_model->getFeedbackWithoutSearchByBoard($order, $dir, $filter_board);
                }
            } else {
                if (!empty($search)) {
                    $data['feedbacks'] = $this->feedback_model->getFeedbackByLimitBySearchByBoard($limit, $start, $search, $order, $dir, $filter_board);
                } else {
                    $data['feedbacks'] = $this->feedback_model->getFeedbackByLimitByBoard($limit, $start, $order, $dir, $filter_board);
                }
            }
        }
        }



        foreach ($data['feedbacks'] as $feedback) {

$roadmapname = $this->roadmap_model->getRoadmapById($feedback->roadmap);

            if ($this->ion_auth->in_group(array('superadmin'))) {
                $actions = '<div class="dropdown">
                                                    <button type="button" aria-haspopup="true" data-toggle="dropdown"
                                                        aria-expanded="false" class="btn btn-link">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div tabindex="-1" aria-hidden="true"
                                                        class="dropdown-menu dropdown-menu-right">
                                                        <ul class="nav flex-column">
                                                        <li class="nav-item feedback-info">
                                                                <a class="nav-link btn btn-link text-primary drop finfo" data-bs-toggle="modal"
                                                    data-bs-target="#myModal" data-id="' . $feedback->id . '" data-username="' . $feedback->username . '" data-email="' . $feedback->email . '" data-description="' . $feedback->description . '" data-roadmap="' . $roadmapname->title . '" data-category="' . $feedback->category . '" data-board="' . $feedback->board . '">
                                                    <i class="fa fa-eye"></i> View Information</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link btn btn-link text-primary drop edit-feedback"
                                                                    href="#" data-id="' . $feedback->id . '">
                                                                    <i class="nav-link-icon fa fa-edit"></i>Edit
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link btn btn-link text-primary drop edit-roadmap"
                                                                    href="feedback/delete?id=' . $feedback->id . '">
                                                                    <i class="nav-link-icon fa fa-trash"></i>Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>';
                // $options1 = ' <a class="btn btn-soft-success btn-xs infobutton" title="' . lang('info') . '" data-toggle = "modal" data-id="' . $feedback->id . '"><i class="fa fa-eye"> </i></a>';
                $options2 = ' <a class="btn btn-soft-primary btn-xs editbutton" title="' . lang('edit') . '" href="feedback/editFeedback?id=' . $feedback->id . '"><i class="fa fa-edit"> </i></a>';
                $options3 = '<a class="btn btn-soft-danger btn-xs delete_button" title="' . lang('delete') . '" href="feedback/delete?id=' . $feedback->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i></a>';

               
            }
            if ($this->ion_auth->in_group(array('admin'))) {
                $actions = '<div class="dropdown">
                                                    <button type="button" aria-haspopup="true" data-toggle="dropdown"
                                                        aria-expanded="false" class="btn btn-link">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div tabindex="-1" aria-hidden="true"
                                                        class="dropdown-menu dropdown-menu-right">
                                                        <ul class="nav flex-column">
                                                        <li class="nav-item feedback-info">
                                                                <a class="nav-link btn btn-link text-primary drop finfo" data-bs-toggle="modal"
                                                    data-bs-target="#myModal" data-id="' . $feedback->id . '" data-username="' . $feedback->username . '" data-email="' . $feedback->email . '" data-description="' . $feedback->description . '" data-roadmap="' . $roadmapname->title . '" data-category="' . $feedback->category . '" data-board="' . $feedback->board . '">
                                                    <i class="fa fa-eye"></i> View Information</a>
                                                            </li>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>';
                // $options1 = ' <a class="btn btn-soft-success btn-xs infobutton" title="' . lang('info') . '" data-toggle = "modal" data-id="' . $feedback->id . '"><i class="fa fa-eye"> </i></a>';
                $options2 = ' <a class="btn btn-soft-primary btn-xs editbutton" title="' . lang('edit') . '" href="feedback/editFeedback?id=' . $feedback->id . '"><i class="fa fa-edit"> </i></a>';
                $options3 = '<a class="btn btn-soft-danger btn-xs delete_button" title="' . lang('delete') . '" href="feedback/delete?id=' . $feedback->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i></a>';

               
            }
            if($this->ion_auth->in_group(array('superadmin'))){
            $cat = '<select class="form-control category" data-id="' . $feedback->id . '">';
            $categories = $this->category_model->getCategory();
            foreach ($categories as $category) {
                $selected = ($feedback->category == $category->title) ? 'selected' : '';
                $cat .= '<option value="' . $category->title . '" ' . $selected . '>' . $category->title . '</option>';
            }
            $cat .= '</select>';
            }else{
                $cat = $feedback->category;
            }

            if($this->ion_auth->in_group(array('superadmin'))){
            $road = '<select class="form-control roadmap" data-id="' . $feedback->id . '">';
            $roadmaps = $this->roadmap_model->getRoadmap();
            foreach ($roadmaps as $roadmap) {
                $selected = ($feedback->roadmap == $roadmap->id) ? 'selected' : '';
                $road .= '<option value="' . $roadmap->id . '" ' . $selected . '>' . $roadmap->title . '</option>';
            }
            $road .= '</select>';
            }else{
                $roadmap_details = $this->roadmap_model->getRoadmapById($feedback->roadmap);
                $road = $roadmap_details->title;
            }
            if($this->ion_auth->in_group(array('superadmin'))){
            // Determine approval status based on approval_status
            $approval_status = $feedback->approval_status == 1 ? 
                '<span style="color: green;">Approved</span>' : 
                '<span class="edit-feedback text-primary" style="cursor: pointer;" data-id="' . $feedback->id . '">View & Approve</span>';
            }else{
                $approval_status = $feedback->approval_status == 1 ? 
                '<span style="color: green;">Approved</span>' : 
                '<span class="text-primary">Pending</span>';
            }

            $comment_count = $this->feedback_model->count_comments_by_feedback_id($feedback->id);
            $comments = '<a href="feedback/comments?feedback_id=' . $feedback->id . '" class="" title="Comments">' . $comment_count . '</a>';

            // $comments = '<a href="feedback/comments?id=' . $feedback->id . '" class="" title="Comments">0</a>';

      
            $info[] = array(
                $feedback->id, 
                $feedback->username,
                $feedback->email,
                $feedback->description,
                $road,
                $cat,
                $comments,
                $approval_status,
                $actions,
            );

        
            
        }








        if (!empty($data['feedbacks'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['feedbacks']),
                "recordsFiltered" => count($data['feedbacks']),
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

    function changeCategory()
    {
        
        $id = $this->input->post('id');
        $category = $this->input->post('category');         
                $data = array(
                    'category' => $category
                );
                $this->feedback_model->changeCategory($id, $data);
            echo json_encode("success");
      
    }

    function changeRoadmap()
    {
        
        $id = $this->input->post('id');
        $roadmap = $this->input->post('roadmap');         
                $data = array(
                    'roadmap' => $roadmap
                );
                $this->feedback_model->changeCategory($id, $data);
            echo json_encode("success");
      
    }

    // Comment Section Start //

    public function comments() {
        
        $data['comments'] = $this->feedback_model->getComment();
        $data['feedbacks'] = $this->feedback_model->getFeedback();
        $this->load->view('home/dashboard'); 
        $this->load->view('comment', $data);
        $this->load->view('home/footer'); 
    }

    public function addCommentView() {
        $data['feedbacks'] = $this->feedback_model->getFeedback();
        $this->load->view('home/dashboard'); 
        $this->load->view('add_comment', $data);
        $this->load->view('home/footer'); 
    }

    public function addComment() {
        $id = $this->input->post('id');
        $comment = $this->input->post('comment');
        $feedback = $this->input->post('feedback');
        
        if(!empty($id)){
            $date = $this->input->post('date');
        }else{
            $date = time();
        }
        
        $status = $this->input->post('status');
        
        if (empty($id)) {
            $ion_user_id = $this->ion_auth->get_user_id();
            $userdetails = $this->ion_auth->user()->row();
            $username = $userdetails->username;
            $email = $userdetails->email;
            $hospital_id = $this->session->userdata('hospital_id');
        } else {
            $ion_user_id = $this->input->post('ion_user_id');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $hospital_id = $this->input->post('hospital_id');
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('comment', 'Comment', 'trim|required|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("feedback/editComment?id=$id");
            } else {
                $data['feedbacks'] = $this->feedback_model->getFeedback();
                $this->load->view('home/dashboard'); 
                $this->load->view('add_comment', $data);
                $this->load->view('home/footer'); 
            }
        } else {
            $data = array(
                'username' => $username,
                'comment' => $comment,
                'date' => $date,
                'email' => $email,
                'ion_user_id' => $ion_user_id,
                'status' => $status,
                'feedback' => $feedback,
                'hospital_id' => $hospital_id
                
            );

            if (empty($id)) {     // Adding New Feedback  
                $this->feedback_model->insertComment($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Feedback
                $this->feedback_model->updateComment($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('feedback/comments');
        }
    }



    function editComment() {
        $data = array();
        $id = $this->input->get('id');
        $data['feedbacks'] = $this->feedback_model->getFeedback();
        $data['comment'] = $this->feedback_model->getCommentById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('add_comment', $data);
        $this->load->view('home/footer'); 
    }
    

    function deleteComment() {
        $data = array();
        $id = $this->input->get('id');
        $this->feedback_model->deleteComment($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('feedback/comments');
    }

    function getComment()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $settings = $this->settings_model->getSettings();
        $feedback_id = $_GET['feedback_id'];
        $admin = $this->session->userdata('hospital_id');
        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "username",
            

        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];
        if ($this->ion_auth->in_group(array('superadmin'))) {
            if($feedback_id != 'null'){
                if ($limit == -1) {
                    if (!empty($search)) {
                        $data['comments'] = $this->feedback_model->getCommentBySearchByFeedback($feedback_id, $search, $order, $dir);
                    } else {
                        $data['comments'] = $this->feedback_model->getCommentWithoutSearchByFeedback($feedback_id, $order, $dir);
                    }
                } else {
                    if (!empty($search)) {
                        $data['comments'] = $this->feedback_model->getCommentByLimitBySearchByFeedback($feedback_id, $limit, $start, $search, $order, $dir);
                    } else {
                        $data['comments'] = $this->feedback_model->getCommentByLimitByFeedback($feedback_id, $limit, $start, $order, $dir);
                    }
                }
            }else{
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['comments'] = $this->feedback_model->getCommentBySearch($search, $order, $dir);
                } else {
                    $data['comments'] = $this->feedback_model->getCommentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['comments'] = $this->feedback_model->getCommentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['comments'] = $this->feedback_model->getCommentByLimit($limit, $start, $order, $dir);
                }
            }
        }
        }else{
            if($feedback_id != 'null'){
                if ($limit == -1) {
                    if (!empty($search)) {
                        $data['comments'] = $this->feedback_model->getCommentBySearchByFeedback($feedback_id, $search, $order, $dir);
                    } else {
                        $data['comments'] = $this->feedback_model->getCommentWithoutSearchByFeedback($feedback_id, $order, $dir);
                    }
                } else {
                    if (!empty($search)) {
                        $data['comments'] = $this->feedback_model->getCommentByLimitBySearchByFeedback($feedback_id, $limit, $start, $search, $order, $dir);
                    } else {
                        $data['comments'] = $this->feedback_model->getCommentByLimitByFeedback($feedback_id, $limit, $start, $order, $dir);
                    }
                }
            }else{
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['comments'] = $this->feedback_model->getCommentBySearchByAdmin($search, $order, $dir);
                } else {
                    $data['comments'] = $this->feedback_model->getCommentWithoutSearchByAdmin($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['comments'] = $this->feedback_model->getCommentByLimitBySearchByAdmin($limit, $start, $search, $order, $dir);
                } else {
                    $data['comments'] = $this->feedback_model->getCommentByLimitByAdmin($limit, $start, $order, $dir);
                }
            }
        }
        }
            $i = 0;
        foreach ($data['comments'] as $comment) {
            $i = $i + 1;
            if ($this->ion_auth->in_group(array('superadmin'))) {
            $status = "";
            if ($comment->status == "Pending Moderation") {
                $status = '<select class="form-control status" data-id="' . $comment->id . '"><option value="Pending Moderation" selected>Pending Moderation</option><option value="Approved">Approved</option><option value="Dis-Approved">Dis-Approved</option></select>';
            } else if ($comment->status == "Approved") {
                $status = '<select class="form-control status" data-id="' . $comment->id . '"><option value="Pending Moderation">Pending Moderation</option><option value="Approved" selected>Approved</option><option value="Dis-Approved">Dis-Approved</option></select>';
            }else if ($comment->status == "Dis-Approved") {
                $status = '<select class="form-control status" data-id="' . $comment->id . '"><option value="Pending Moderation">Pending Moderation</option><option value="Approved">Approved</option><option value="Dis-Approved" selected>Dis-Approved</option></select>';
                //$status .= '<span class="badge bg-success">' . lang('delivered') . '</span>';
            }
        }else{
$status = $comment->status;
        }


            if ($this->ion_auth->in_group(array('admin', 'superadmin'))) {
                $actions = '<div class="dropdown">
                                                    <button type="button" aria-haspopup="true" data-toggle="dropdown"
                                                        aria-expanded="false" class="btn btn-link">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div tabindex="-1" aria-hidden="true"
                                                        class="dropdown-menu dropdown-menu-right">
                                                        <ul class="nav flex-column">
                                                       
                                                            <li class="nav-item">
                                                                <a class="nav-link btn btn-link text-primary drop edit-feedback"
                                                                   href="feedback/editComment?id=' . $comment->id . '">
                                                                    <i class="nav-link-icon fa fa-edit"></i>Edit
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link btn btn-link text-primary drop edit-roadmap"
                                                                    href="feedback/deleteComment?id=' . $comment->id . '">
                                                                    <i class="nav-link-icon fa fa-trash"></i>Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>';
                
               
            }
        //    if($feedback_id != 'null'){
        //     if($feedback_id == $comment->feedback){
        //     $info[] = array(
        //         $comment->id, 
        //         $comment->comment,
        //         $comment->username,
        //         $comment->email,
        //         $status,
        //         $actions,
        //     );
        // }
    // }else{
        $info[] = array(
            $comment->id, 
            $comment->comment,
            $comment->username,
            $comment->email,
            $status,
            $actions,
        );
    // }
        
            
        }








        if (!empty($data['comments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['comments']),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
                
            );
        }




        echo json_encode($output);
    }

    function changeCommentStatus()
    {
        
        $id = $this->input->post('id');
        $status = $this->input->post('status');         
                $data = array(
                    'status' => $status
                );
                $this->feedback_model->updateComment($id, $data);
            echo json_encode("success");
      
    }

}

/* End of file feedback.php */
/* Location: ./application/modules/feedback/controllers/feedback.php */