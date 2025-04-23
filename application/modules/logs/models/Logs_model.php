<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insertLogs($data) {
       $this->db->insert('logs',$data);
    }
    
    public function insertAuditLog($data) {
        $this->db->insert('audit_logs', $data);
        return $this->db->insert_id();
    }
    
    public function getDistinctAuditEventTypes() {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        $this->db->select('event')
                ->distinct()
                ->from('audit_logs')
                ->order_by('event', 'asc');
        
        return $this->db->get()->result_array();
    }
    
    public function getAuditLogsByFilter($filter_data) {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        // Apply filters
        if (!empty($filter_data['event_type'])) {
            $this->db->where('event', $filter_data['event_type']);
        }
        
        if (!empty($filter_data['user_id'])) {
            $this->db->where('user', $filter_data['user_id']);
        }
        
        if (!empty($filter_data['date_from'])) {
            $this->db->where('date_time >=', $filter_data['date_from'] . ' 00:00:00');
        }
        
        if (!empty($filter_data['date_to'])) {
            $this->db->where('date_time <=', $filter_data['date_to'] . ' 23:59:59');
        }
        
        if (!empty($filter_data['resource_id'])) {
            $this->db->where('resource_id', $filter_data['resource_id']);
        }
        
        if (!empty($filter_data['ip_address'])) {
            $this->db->where('ip_address', $filter_data['ip_address']);
        }
        
        $this->db->order_by('date_time', 'desc');
        return $this->db->get('audit_logs')->result();
    }
    
    public function countAllAuditLogs() {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        return $this->db->count_all_results('audit_logs');
    }
    
    public function countTodayAuditLogs() {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        $this->db->where('date_time >=', date('Y-m-d') . ' 00:00:00');
        $this->db->where('date_time <=', date('Y-m-d') . ' 23:59:59');
        
        return $this->db->count_all_results('audit_logs');
    }
    
    public function countCriticalAuditLogs() {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        // Define critical events
        $this->db->where_in('event', [
            'login_failed', 'unauthorized_access', 'permission_denied', 
            'log_integrity_violation', 'patient_data_access_denied',
            'security_alert_created', 'security_policy_violation'
        ]);
        
        return $this->db->count_all_results('audit_logs');
    }
    
    public function getRecentAuditLogs($limit = 5) {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        $this->db->order_by('date_time', 'desc');
        $this->db->limit($limit);
        
        return $this->db->get('audit_logs')->result();
    }
    
    public function verifyLogIntegrity($logId) {
        // Get the log entry
        $log = $this->db->where('id', $logId)
                        ->get('audit_logs')
                        ->row();
        
        if (!$log) {
            return false;
        }
        
        // Get the signature
        $signature = $this->db->where('log_id', $logId)
                              ->get('audit_log_signatures')
                              ->row();
        
        if (!$signature) {
            // If no signature exists, create one for future verification
            $this->signAuditLog($logId);
            return true;
        }
        
        // Calculate the signature again
        $log_string = implode('|', [
            $log->id,
            $log->event,
            $log->resource_id ?? '',
            $log->user,
            $log->ip_address,
            $log->date_time,
            $log->details
        ]);
        
        $calculated_signature = hash_hmac('sha256', $log_string, $this->config->item('encryption_key'));
        
        // Compare signatures
        return hash_equals($signature->signature, $calculated_signature);
    }
    
    public function signAuditLog($logId) {
        // Get the log entry
        $log = $this->db->where('id', $logId)
                        ->get('audit_logs')
                        ->row();
        
        if (!$log) {
            return false;
        }
        
        // Calculate the signature
        $log_string = implode('|', [
            $log->id,
            $log->event,
            $log->resource_id ?? '',
            $log->user,
            $log->ip_address,
            $log->date_time,
            $log->details
        ]);
        
        $signature = hash_hmac('sha256', $log_string, $this->config->item('encryption_key'));
        
        // Store the signature
        $this->db->insert('audit_log_signatures', [
            'log_id' => $logId,
            'signature' => $signature,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        return true;
    }
    
    // Security Alerts Functions
    
    public function getDistinctSecurityAlertTypes() {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        $this->db->select('alert_type')
                ->distinct()
                ->from('security_alerts')
                ->order_by('alert_type', 'asc');
        
        return $this->db->get()->result_array();
    }
    
    public function getSecurityAlertsByFilter($filter_data) {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        // Apply filters
        if (!empty($filter_data['alert_type'])) {
            $this->db->where('alert_type', $filter_data['alert_type']);
        }
        
        if (!empty($filter_data['user_id'])) {
            $this->db->where('user_id', $filter_data['user_id']);
        }
        
        if (!empty($filter_data['date_from'])) {
            $this->db->where('timestamp >=', $filter_data['date_from'] . ' 00:00:00');
        }
        
        if (!empty($filter_data['date_to'])) {
            $this->db->where('timestamp <=', $filter_data['date_to'] . ' 23:59:59');
        }
        
        if (!empty($filter_data['severity'])) {
            $this->db->where('severity', $filter_data['severity']);
        }
        
        if (isset($filter_data['status']) && $filter_data['status'] !== '') {
            $this->db->where('status', $filter_data['status']);
        }
        
        $this->db->order_by('timestamp', 'desc');
        return $this->db->get('security_alerts')->result();
    }
    
    public function getSecurityAlertById($alertId) {
        return $this->db->where('id', $alertId)
                        ->get('security_alerts')
                        ->row();
    }
    
    public function resolveSecurityAlert($alertId, $notes, $action) {
        return $this->db->where('id', $alertId)
                        ->update('security_alerts', [
                            'status' => 'resolved',
                            'resolved_by' => $this->ion_auth->user()->row()->id,
                            'resolution_notes' => $notes,
                            'resolution_action' => $action,
                            'resolved_at' => date('Y-m-d H:i:s')
                        ]);
    }
    
    public function countAllSecurityAlerts() {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        return $this->db->count_all_results('security_alerts');
    }
    
    public function countUnresolvedSecurityAlerts() {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        $this->db->where('status', 'unresolved');
        
        return $this->db->count_all_results('security_alerts');
    }
    
    public function countCriticalSecurityAlerts() {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        $this->db->where('severity', 'critical');
        
        return $this->db->count_all_results('security_alerts');
    }
    
    public function getRecentSecurityAlerts($limit = 5) {
        if($this->ion_auth->in_group(array('admin'))) {
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        }
        
        $this->db->order_by('timestamp', 'desc');
        $this->db->limit($limit);
        
        return $this->db->get('security_alerts')->result();
    }
    
    function getLogsWithoutSearch($order, $dir) {
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->where('hospital_id',$hospital_ion_user_id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('logs');
        return $query->result();
    }

    function getLogsBySearch($search, $order, $dir) {
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $query = $this->db->select('*')
                ->from('logs')
                ->where('hospital_id', $hospital_ion_user_id)
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getLogsByLimit($limit, $start, $order, $dir) {
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        $this->db->where('hospital_id', $hospital_ion_user_id);
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('logs');
        return $query->result();
    }

    function getLogsByLimitBySearch($limit, $start, $search, $order, $dir) {
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('logs')
                ->where('hospital_id', $hospital_ion_user_id)
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }
    function getLogsWithoutSearchForSuperadmin($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
     
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('logs');
        return $query->result();
    }

    function getLogsBysearchForSuperadmin($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $query = $this->db->select('*')
                ->from('logs')
              
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getLogsByLimitForSuperadmin($limit, $start, $order, $dir) {
      
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('logs');
        return $query->result();
    }

    function getLogsByLimitBySearchForSuperadmin($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('logs')
                
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }
    public function insertTransactionLogs($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('transaction_logs', $data2);
       
     }
     function getTransactionLogsWithoutSearch($order, $dir) {
       // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;
        
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->where('hospital_id',$this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('transaction_logs');
        return $query->result();
    }

    function getTransactionLogsBySearch($search, $order, $dir) {
       // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $query = $this->db->select('*')
                ->from('transaction_logs')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR date_time LIKE '%" . $search . "%' OR deposit_type LIKE '%" . $search . "%' OR invoice_id LIKE '%" . $search . "%'  OR action LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getTransactionLogsByLimit($limit, $start, $order, $dir) {
       // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('transaction_logs');
        return $query->result();
    }

    function getTransactionLogsByLimitBySearch($limit, $start, $search, $order, $dir) {
       // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('transaction_logs')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR date_time LIKE '%" . $search . "%' OR deposit_type LIKE '%" . $search . "%' OR invoice_id LIKE '%" . $search . "%'  OR action LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }
    function getThisLogsTodays(){
       
     
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;
        $access_user = $this->db->where('role !=','Admin')->where('hospital_id', $hospital_ion_user_id)->get('logs')->result();
       
        for($d = 1; $d <= date('d'); $d++){
            $accces[$d]='0';
        }
        foreach($access_user as $user){
           
            if(date('m',strtotime($user->date_time))==date('m')){
               
                $accces[ sprintf('%d', date('d',strtotime($user->date_time)))]+=1;
            }
        }
     
      
        return $accces;
        
    }
    function frequentLogin(){
       
     
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;
        $access_user = $this->db->order_by('id','desc')->where('role !=','Admin')->where('hospital_id', $hospital_ion_user_id)->get('logs')->result();
       
        
     
      
        return $access_user;
        
    }
}