<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertFeedback($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('feedback', $data2);

        
    }

    function getFeedback() {
        $query = $this->db->get('feedback');
        return $query->result();
    }

    function getFeedbackById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('feedback');
        return $query->row();
    }

    function updateFeedback($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('feedback', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('feedback');
    }

    function getFeedbackBySearch($search, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
            ->from('feedback')
            // ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
            ->get();

        return $query->result();
    }

    function getFeedbackWithoutSearch($order, $dir)
    {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('feedback');
        return $query->result();
    }
    function getFeedbackByLimitBySearch($limit, $start, $search, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('feedback')
            // ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
            ->get();



        return $query->result();
    }

    function getFeedbackByLimit($limit, $start, $order, $dir)
    {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('feedback');
        return $query->result();
    }

    function getFeedbackBySearchByBoard($search, $order, $dir, $filter_board)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
            ->from('feedback')
            // ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where('board', $filter_board)
            ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
            ->get();

        return $query->result();
    }
    function getFeedbackWithoutSearchByBoard($order, $dir, $filter_board)
    {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->where('board', $filter_board)->get('feedback');
        return $query->result();
    }
    function getFeedbackByLimitBySearchByBoard($limit, $start, $search, $order, $dir, $filter_board)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('feedback')
            // ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where('board', $filter_board)
            ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
            ->get();

        return $query->result();
    }
    function getFeedbackByLimitByBoard($limit, $start, $order, $dir, $filter_board)
    {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->where('board', $filter_board)->get('feedback');
        return $query->result();
    }


    public function get_total_feedback() {
        return $this->db->count_all('feedback'); // Assuming your table name is 'users'
    }

    public function get_total_feedback_id1() {
        $this->db->where('roadmap', 1);
    return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }

    public function get_total_feedback_id2() {
        $this->db->where('roadmap', 2);
    return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }

    public function get_total_feedback_id3() {
        $this->db->where('roadmap', 3);
    return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }

    public function get_total_feedback_id4() {
        $this->db->where('roadmap', 4);
    return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }

    public function get_total_feedback_id5() {
        $this->db->where('roadmap', 5);
    return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }
    public function get_top_feedback() {
        $this->db->select('board, COUNT(*) as count');
        $this->db->from('feedback');
        $this->db->group_by('board');
        $this->db->order_by('count', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_total_feedback_date($start_date, $end_date) {
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }
    public function get_total_id1_feedback_date($start_date, $end_date) {
        $this->db->where('roadmap', 1);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }
    public function get_total_id2_feedback_date($start_date, $end_date) {
        $this->db->where('roadmap', 2);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }
    public function get_total_id3_feedback_date($start_date, $end_date) {
        $this->db->where('roadmap', 3);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }
    public function get_total_id4_feedback_date($start_date, $end_date) {
        $this->db->where('roadmap', 4);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }
    public function get_total_id5_feedback_date($start_date, $end_date) {
        $this->db->where('roadmap', 5);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->count_all_results('feedback'); // Assuming your table name is 'feedback'
    }
    public function get_top_feedback_date($start_date, $end_date) {
        $this->db->select('board, COUNT(*) as count');
        $this->db->from('feedback');
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $this->db->group_by('board');
        $this->db->order_by('count', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
    function changeCategory($id, $data) {
        $this->db->where("id", $id);
        $this->db->update("feedback", $data);
    }

// Comment Section Start //

function insertComment($data) {
    $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
    $data2 = array_merge($data, $data1);
    $this->db->insert('comments', $data2);

    
}

function getComment() {
    $query = $this->db->get('comments');
    return $query->result();
}

function getCommentById($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('comments');
    return $query->row();
}

function updateComment($id, $data) {
    $this->db->where('id', $id);
    $this->db->update('comments', $data);
}

function deleteComment($id) {
    $this->db->where('id', $id);
    $this->db->delete('comments');
}

function getCommentBySearch($search, $order, $dir)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->select('*')
        ->from('comments')
        // ->where('hospital_id', $this->session->userdata('hospital_id'))
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();

    return $query->result();
}
function getCommentWithoutSearch($order, $dir)
{
    // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->get('comments');
    return $query->result();
}

function getCommentByLimitBySearch($limit, $start, $search, $order, $dir)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->select('*')
        ->from('comments')
        // ->where('hospital_id', $this->session->userdata('hospital_id'))
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();



    return $query->result();
}

function getCommentByLimit($limit, $start, $order, $dir)
{
    // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->get('comments');
    return $query->result();
}

public function count_comments_by_feedback_id($feedback_id) {
    $this->db->where('feedback', $feedback_id);
    return $this->db->count_all_results('comments'); // Assuming your table name is 'comments'
}


function getCommentBySearchByAdmin($search, $order, $dir)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->select('*')
        ->from('comments')
        ->where('hospital_id', $this->session->userdata('hospital_id'))
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();

    return $query->result();
}
function getCommentWithoutSearchByAdmin($order, $dir)
{
    $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->get('comments');
    return $query->result();
}

function getCommentByLimitBySearchByAdmin($limit, $start, $search, $order, $dir)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->select('*')
        ->from('comments')
        ->where('hospital_id', $this->session->userdata('hospital_id'))
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();



    return $query->result();
}

function getCommentByLimitByAdmin($limit, $start, $order, $dir)
{
    $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->get('comments');
    return $query->result();
}







function getCommentBySearchByFeedback($feedback_id, $search, $order, $dir)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->select('*')
        ->from('comments')
        ->where('feedback', $feedback_id)
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();

    return $query->result();
}
function getCommentWithoutSearchByFeedback($feedback_id, $order, $dir)
{
    $this->db->where('feedback', $feedback_id);
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->get('comments');
    return $query->result();
}

function getCommentByLimitBySearchByFeedback($feedback_id, $limit, $start, $search, $order, $dir)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->select('*')
        ->from('comments')
        ->where('feedback', $feedback_id)
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();



    return $query->result();
}

function getCommentByLimitByFeedback($feedback_id, $limit, $start, $order, $dir)
{
    $this->db->where('feedback', $feedback_id);
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->get('comments');
    return $query->result();
}



function getFeedbackBySearchByAdmin($search, $order, $dir)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->select('*')
        ->from('feedback')
        ->where('hospital_id', $this->session->userdata('hospital_id'))
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();

    return $query->result();
}

function getFeedbackWithoutSearchByAdmin($order, $dir)
{
    $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->get('feedback');
    return $query->result();
}

function getFeedbackByLimitBySearchByAdmin($limit, $start, $search, $order, $dir)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->select('*')
        ->from('feedback')
        ->where('hospital_id', $this->session->userdata('hospital_id'))
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();



    return $query->result();
}

function getFeedbackByLimitByAdmin($limit, $start, $order, $dir)
{
    $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->get('feedback');
    return $query->result();
}
function getFeedbackBySearchByBoardByAdmin($search, $order, $dir, $filter_board)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->select('*')
        ->from('feedback')
        ->where('hospital_id', $this->session->userdata('hospital_id'))
        ->where('board', $filter_board)
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();

    return $query->result();
}

function getFeedbackWithoutSearchByBoardByAdmin($order, $dir, $filter_board)
{
    $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $query = $this->db->where('board', $filter_board)->get('feedback');
    return $query->result();
}

function getFeedbackByLimitBySearchByBoardByAdmin($limit, $start, $search, $order, $dir, $filter_board)
{
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->select('*')
        ->from('feedback')
        ->where('hospital_id', $this->session->userdata('hospital_id'))
        ->where('board', $filter_board)
        ->where("(id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR status LIKE '%')", NULL, FALSE)
        ->get();

    return $query->result();
}
function getFeedbackByLimitByBoardByAdmin($limit, $start, $order, $dir, $filter_board)
{
    $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', 'desc');
    }
    $this->db->limit($limit, $start);
    $query = $this->db->where('board', $filter_board)->get('feedback');
    return $query->result();
}
}
