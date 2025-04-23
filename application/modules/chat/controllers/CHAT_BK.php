<?php

Class Chat extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('chat_model'); 
    }
    
    public function index() {
        
        $users = $this->db->get_where('users_groups', array('group_id' => 11))->result_array();
        $admins = array();
        foreach($users as $user) {
            $result = $this->db->get_where('users', array('id' => $user['user_id']))->row();
            if($result) {

                $hospital = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row();
               
            }
        }
            $hospital = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row();
            $data['admins'] = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->result_array();
            
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array6 = $this->db->get('doctor')->result_array();
        
        $data['employees'] = array_merge( $array1, $array2, $array3, $array4, $array5, $array6);
        $id = $this->ion_auth->user()->row()->id;
        $data['current_user'] = $id;
        $this->db->limit(1);
        $this->db->order_by('date_time', 'desc');
        $this->db->where('sender_id', $id);
        $this->db->or_where('receiver_id', $id);
        $chat = $this->db->get('chat')->row(); 
        $data['chats'] = '';
        $data['receiver_id'] = '';
        
        for($i = 0; $i < count($data['employees']); $i++) {
            if($id != $data['employees'][$i]['ion_user_id']) {
                    $this->db->limit(1);
                    $this->db->order_by('date_time', 'desc');
                    $this->db->where('sender_id', $data['employees'][$i]['ion_user_id']);
                    $this->db->where('receiver_id', $id);
                    $latestChat = $this->db->get('chat')->row();
                    if(!empty($latestChat)){
                    if($latestChat->status == 'unread') {
                        $data['employees'][$i]['newChat'] .=  'unread';
                    } else {
                        $data['employees'][$i]['newChat'] .=  'read';
                    }
                    }else{
                          $data['employees'][$i]['newChat']='';
                    }
            }
        }
        
        
        for($i = 0; $i < count($data['admins']); $i++) {
            if($id != $data['admins'][$i]['id']) {
                    $this->db->limit(1);
                    $this->db->order_by('date_time', 'desc');
                    $this->db->where('sender_id', $data['admins'][$i]['id']);
                    $this->db->where('receiver_id', $id);
                    $latestChat = $this->db->get('chat')->row(); 
                    if($latestChat->status == 'unread') {
                        $data['admins'][$i]['newChat'] .=  'unread';
                    } else {
                        $data['admins'][$i]['newChat'] .=  'read';
                    }
            }
        }
        
        
       if($chat) {
            $id2 = '';
            if($chat->sender_id == $id) {
                $id2 = $chat->receiver_id;
            } else if($chat->receiver_id == $id) {
                $id2 = $chat->sender_id;
            }
            
            $data['user'] = $this->db->get_where('users', array('id' => $id2))->row()->username;
            
            $this->db->limit(20);
            $this->db->order_by('date_time', 'desc');
            $this->db->group_start();
            $this->db->where('sender_id', $id);
            $this->db->where('receiver_id', $id2);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('sender_id', $id2);
            $this->db->where('receiver_id', $id);
            $this->db->group_end();
            $chats = $this->db->get('chat')->result_array();

            for($i=(count($chats)-1); $i >= 0; $i--) {
                if($chats[$i]['sender_id'] == $id) {
                    $status = array(
                        'status' => 'read'
                    );
                    $this->db->where('id', $chats[$i]['id']);
                    $this->db->update('chat', $status);
                    $data['chats'] .= '<span class="chat-sender">'.$chats[$i]['chat_text'].'</span>';
                } else {
                    $status = array(
                        'status' => 'read'
                    );
                    $this->db->where('id', $chats[$i]['id']);
                    $this->db->update('chat', $status);
                    $data['chats'] .= '<span class="chat-receiver">'.$chats[$i]['chat_text'].'</span>';
                }
            }
            
            $data['lastMessageId'] = $chats[count($chats)-1]['id'];
            $data['recentMessageId'] = $chats[0]['id'];

            $data['receiver_id'] = $id2;
            
            $employee = array();
       } else {
           if(!empty($data['employees'])){
           $data['lastMessageId'] = 0;
           $data['recentMessageId'] = 0;
           $data['receiver_id'] = $data['employees'][0]['ion_user_id'];
           $data['user'] = $this->db->get_where('users', array('id' => $data['employees'][0]['ion_user_id']))->row()->username;
       }else{
            $data['lastMessageId'] = 0;
           $data['recentMessageId'] = 0;
           $data['receiver_id'] = ' ';
           $data['user'] = ' ';
       }
       }
        
        
        $this->load->view('home/dashboard');
        $this->load->view('chat', $data);
        $this->load->view('home/footer');
    }
    
    public function sendChat() {
        $chat = $this->input->get('chat');
        $receiver_id = $this->input->get('receiverId');
        $id = $this->ion_auth->user()->row()->id;
        $data = array(
            'sender_id' => $id,
            'receiver_id' => $receiver_id,
            'date_time' => date('Y-m-d H:i:s'),
            'status' => 'unread',
            'chat_text' => $chat,
        );
        $this->db->insert('chat', $data);
        echo json_encode('success');
    }
    
    public function checkChat() {
        $id = $this->ion_auth->user()->row()->id;
        $receiverId = $this->input->get('receiverId');
        $recentId = $this->input->get('recentId');
        
        $data['currentChats'] = '';
        $data['recentId'] = ''; 
        
        $this->db->order_by('date_time', 'desc');
        $this->db->where('id >', $recentId);
        $this->db->where('receiver_id', $id);
        $this->db->where('sender_id', $receiverId);
        $chats = $this->db->get('chat')->result_array();
        

        for($i=(count($chats)-1); $i >= 0; $i--) {
                if($chats[$i]['sender_id'] == $id) {
                    $data['currentChats'] .= '<span class="chat-sender">'.$chats[$i]['chat_text'].'</span>';
                } else {
                    $data['currentChats'] .= '<span class="chat-receiver">'.$chats[$i]['chat_text'].'</span>';
                }
                
                $data2 = array(
                    'status' => 'read'
                );
                $this->db->where('id', $chats[$i]['id']);
                $this->db->update('chat', $data2);
         }
       
         if(count($chats) > 0) {
             $data['recentId'] = $chats[0]['id'];
         } else {
             $data['recentId'] = $recentId;
         }
         
            $hospital = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row();
            $admins = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->result_array();
            
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array6 = $this->db->get('doctor')->result_array();
            $employees = array_merge( $array1, $array2, $array3, $array4, $array5, $array6);
            
            $data['unreads'] = array();
            
            for($i = 0; $i < count($employees); $i++) {
            if($id != $employees[$i]['ion_user_id']) {
                $this->db->limit(1);
                $this->db->order_by('date_time', 'desc');
                $this->db->where('sender_id', $employees[$i]['ion_user_id']);
                $this->db->where('receiver_id', $id);
                $this->db->where('status', 'unread');
                $unreadChat = $this->db->get('chat')->row();
                if(empty($unreadChat)) {
                    
                } else {
                    array_push($data['unreads'], $employees[$i]['ion_user_id']);
                }
           }
        }
        
        for($i = 0; $i < count($admins); $i++) {
            if($id != $admins[$i]['id']) {
                $this->db->limit(1);
                $this->db->order_by('date_time', 'desc');
                $this->db->where('sender_id', $admins[$i]['id']);
                $this->db->where('receiver_id', $id);
                $this->db->where('status', 'unread');
                $unreadChat = $this->db->get('chat')->row();
                if(empty($unreadChat)) {

                } else {
                    array_push($data['unreads'], $admins[$i]['id']);
                }
             }
        }

        
        echo json_encode($data);
    }
    
    public function checkChat2() {
        $id = $this->ion_auth->user()->row()->id;
         
            $hospital = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row();
            $admins = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->result_array();
            
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array6 = $this->db->get('doctor')->result_array();
            $employees = array_merge( $array1, $array2, $array3, $array4, $array5, $array6);
            
            $data['unreads'] = array();
            
            for($i = 0; $i < count($employees); $i++) {
            if($id != $employees[$i]['ion_user_id']) {
                $this->db->limit(1);
                $this->db->order_by('date_time', 'desc');
                $this->db->where('sender_id', $employees[$i]['ion_user_id']);
                $this->db->where('receiver_id', $id);
                $this->db->where('status', 'unread');
                $unreadChat = $this->db->get('chat')->row();
                if(empty($unreadChat)) {
                    
                } else {
                    array_push($data['unreads'], $employees[$i]['ion_user_id']);
                }
           }
        }
        
        for($i = 0; $i < count($admins); $i++) {
            if($id != $admins[$i]['id']) {
                $this->db->limit(1);
                $this->db->order_by('date_time', 'desc');
                $this->db->where('sender_id', $admins[$i]['id']);
                $this->db->where('receiver_id', $id);
                $this->db->where('status', 'unread');
                $unreadChat = $this->db->get('chat')->row();
                if(empty($unreadChat)) {

                } else {
                    array_push($data['unreads'], $admins[$i]['id']);
                }
             }
        }

        
        echo json_encode($data);
    }
    
    public function getOldMessage() {
        $id = $this->ion_auth->user()->row()->id;
        $id2 = $this->input->get('receiverId');
        $lastMessageId = $this->input->get('lastMessageId');
        
            $this->db->limit(20);
            $this->db->order_by('date_time', 'desc');
            $this->db->group_start();
            $this->db->where('id <', $lastMessageId);
            $this->db->where('sender_id', $id);
            $this->db->where('receiver_id', $id2);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('id <', $lastMessageId);
            $this->db->where('sender_id', $id2);
            $this->db->where('receiver_id', $id);
            $this->db->group_end();
            $chats = $this->db->get('chat')->result_array();
            $data['chats'] = '';
            
             if($chats) {
                 for($i=(count($chats)-1); $i >= 0; $i--) {
                if($chats[$i]['sender_id'] == $id) {
                    $data['chats'] .= '<span class="chat-sender">'.$chats[$i]['chat_text'].'</span>';
                } else {
                    $data['chats'] .= '<span class="chat-receiver">'.$chats[$i]['chat_text'].'</span>';
                }
                
                $status = array(
                        'status' => 'read'
                    );
                    $this->db->where('id', $chats[$i]['id']);
                    $this->db->update('chat', $status);
            }
            
                $data['lastMessageId'] = $chats[count($chats)-1]['id'];
             } else {
                 $data['lastMessageId'] = 0;
             }
            
            echo json_encode($data);
    }
    
    public function changeChat() {
        $id2 = $this->input->get('id');
        $id = $this->ion_auth->user()->row()->id;
        
        $data['user'] = $this->db->get_where('users', array('id' => $id2))->row()->username;
        
        $this->db->limit(20);
            $this->db->order_by('date_time', 'desc');
            $this->db->group_start();
            $this->db->where('sender_id', $id);
            $this->db->where('receiver_id', $id2);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('sender_id', $id2);
            $this->db->where('receiver_id', $id);
            $this->db->group_end();
            $chats = $this->db->get('chat')->result_array();

            if($chats) {
                 for($i=(count($chats)-1); $i >= 0; $i--) {
                if($chats[$i]['sender_id'] == $id) {
                    $status = array(
                        'status' => 'read'
                    );
                    $this->db->where('id', $chats[$i]['id']);
                    $this->db->update('chat', $status);
                    $data['chats'] .= '<span class="chat-sender">'.$chats[$i]['chat_text'].'</span>';
                } else {
                    $status = array(
                        'status' => 'read'
                    );
                    $this->db->where('id', $chats[$i]['id']);
                    $this->db->update('chat', $status);
                    $data['chats'] .= '<span class="chat-receiver">'.$chats[$i]['chat_text'].'</span>';
                }
            }
            
            $data['lastMessageId'] = $chats[count($chats)-1]['id'];
            $data['recentId'] = $chats[0]['id'];
             } else {
                 $data['lastMessageId'] = 0;
                 $data['recentId'] = 0;
             }
            
            echo json_encode($data);
    }
    
    public function findChatPerson() {
        $id = $this->ion_auth->user()->row()->id;
        $search = $this->input->get('search');
        
        if($search == '') {
            $hospital = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row();
        
        $this->db->where('id', $hospital->ion_user_id);
        $admins = $this->db->get('users')->result_array();
        //$data['admins'] = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->result_array();
            
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array4 = $this->db->get('pharmacist')->result_array();
        $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array6 = $this->db->get('doctor')->result_array();
            $employees = array_merge( $array1, $array2, $array3, $array4, $array5, $array6);
    } else {
        $hospital = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row();
        $this->db->group_start();
        $this->db->like('username', $search);
        $this->db->or_like('email', $search);
        $this->db->group_end();
        $this->db->where('id', $hospital->ion_user_id);
        $admins = $this->db->get('users')->result_array();
        
            
            $this->db->select('*');
            $this->db->group_start();
        $this->db->like('name', $search);
        $this->db->or_like('email', $search);
        $this->db->group_end();
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->group_start();
        $this->db->like('name', $search);
        $this->db->or_like('email', $search);
        $this->db->group_end();
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->group_start();
        $this->db->like('name', $search);
        $this->db->or_like('email', $search);
        $this->db->group_end();
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->group_start();
        $this->db->like('name', $search);
        $this->db->or_like('email', $search);
        $this->db->group_end();
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array4 = $this->db->get('pharmacist')->result_array();
        $this->db->select('*');
        $this->db->group_start();
        $this->db->like('name', $search);
        $this->db->or_like('email', $search);
        $this->db->group_end();
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array6 = $this->db->get('doctor')->result_array();
            $employees = array_merge( $array1, $array2, $array3, $array4, $array5, $array6);
    }
        
        
        
        $data['admin'] = '';
        $data['employee'] = '';
        
        
        for($i = 0; $i < count($employees); $i++) {
            if($id != $employees[$i]['ion_user_id']) {
                $this->db->limit(1);
                $this->db->order_by('date_time', 'desc');
                $this->db->where('sender_id', $employees[$i]['ion_user_id']);
                $this->db->where('receiver_id', $id);
                $this->db->where('status', 'unread');
                $unreadChat = $this->db->get('chat')->row();
                if(empty($unreadChat)) {
                    $unreadChat = '';
                } else {
                    $unreadChat = 'newChat';
                }
                
                $data['employee'] .=     '<button class="ca-btn ca-chat-btn d-block '.$unreadChat.'" data-id="'.$employees[$i]['ion_user_id'].'">'.$employees[$i]['name'].'</button>';
            }
        }
        
        for($i = 0; $i < count($admins); $i++) {
            if($id != $admins[$i]['id']) {
                $this->db->limit(1);
                $this->db->order_by('date_time', 'desc');
                $this->db->where('sender_id', $admins[$i]['id']);
                $this->db->where('receiver_id', $id);
                $this->db->where('status', 'unread');
                $unreadChat = $this->db->get('chat')->row();
                if(empty($unreadChat)) {
                    $unreadChat = '';
                } else {
                    $unreadChat = 'newChat';
                }
                
                  $data['admin'] .=     '<button class="ca-btn ca-chat-btn d-block '.$unreadChat.'" data-id="'.$admins[$i]['id'].'">'.$admins[$i]['username'].'</button>';
            }
        }
        
            echo json_encode($data);
    }
    

    
}

