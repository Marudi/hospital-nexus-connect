<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs extends MX_Controller {

    function __construct() {
        parent::__construct();
       
        $this->load->model('logs_model');
        if(!$this->ion_auth->in_group(array('admin','superadmin'))){
            redirect('home/permission');
        }
    }
    function index(){
        $this->load->view('home/dashboard');
        $this->load->view('logs');
        $this->load->view('home/footer');
    }
    
    function auditLogs() {
        // Audit log view with comprehensive filters
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        
        // Get filter params from GET request
        $filter_data = array(
            'event_type' => $this->input->get('event_type'),
            'user_id' => $this->input->get('user_id'),
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'resource_id' => $this->input->get('resource_id'),
            'ip_address' => $this->input->get('ip_address')
        );
        
        // Log this access attempt to audit logs
        $audit_data = array(
            'name' => $this->ion_auth->user()->row()->username,
            'email' => $this->ion_auth->user()->row()->email,
            'role' => $this->ion_auth->get_users_groups()->row()->name,
            'ip_address' => $this->input->ip_address(),
            'date_time' => date('Y-m-d H:i:s'),
            'event' => 'audit_log_view',
            'details' => json_encode($filter_data),
            'hospital_id' => $this->session->userdata('hospital_id'),
            'user' => $this->ion_auth->user()->row()->id
        );
        $this->logs_model->insertAuditLog($audit_data);
        
        // Get event types for dropdown
        $data['eventTypes'] = $this->logs_model->getDistinctAuditEventTypes();
        
        // Get users for dropdown
        $data['users'] = $this->db->select('id, username')
                                ->from('users')
                                ->get()->result_array();
                                
        // Get audit logs with filtering                        
        $data['logs'] = $this->logs_model->getAuditLogsByFilter($filter_data);
        
        // Calculate statistics for dashboard
        $data['total_logs'] = $this->logs_model->countAllAuditLogs();
        $data['today_logs'] = $this->logs_model->countTodayAuditLogs();
        $data['critical_logs'] = $this->logs_model->countCriticalAuditLogs();
        $data['recent_logs'] = $this->logs_model->getRecentAuditLogs(5);
        
        $this->load->view('home/dashboard');
        $this->load->view('audit_logs', $data);
        $this->load->view('home/footer');
    }
    
    function verifyLogIntegrity($logId) {
        $result = $this->logs_model->verifyLogIntegrity($logId);
        $status = $result ? 'verified' : 'tampered';
        
        $this->session->set_flashdata('feedback', lang('log_integrity') . ' ' . lang($status));
        redirect('logs/auditLogs');
    }

    function exportAuditLogs() {
        // Check permissions
        if (!$this->ion_auth->in_group(array('admin', 'superadmin'))) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect('logs/auditLogs');
        }
        
        // Get filter params from GET request
        $filter_data = array(
            'event_type' => $this->input->get('event_type'),
            'user_id' => $this->input->get('user_id'),
            'date_from' => $this->input->get('date_from') ? $this->input->get('date_from') : date('Y-m-d', strtotime('-30 days')),
            'date_to' => $this->input->get('date_to') ? $this->input->get('date_to') : date('Y-m-d'),
            'resource_id' => $this->input->get('resource_id'),
            'ip_address' => $this->input->get('ip_address')
        );
        
        // Log this export attempt
        $audit_data = array(
            'name' => $this->ion_auth->user()->row()->username,
            'email' => $this->ion_auth->user()->row()->email,
            'role' => $this->ion_auth->get_users_groups()->row()->name,
            'ip_address' => $this->input->ip_address(),
            'date_time' => date('Y-m-d H:i:s'),
            'event' => 'audit_log_export',
            'details' => json_encode($filter_data),
            'hospital_id' => $this->session->userdata('hospital_id'),
            'user' => $this->ion_auth->user()->row()->id
        );
        $this->logs_model->insertAuditLog($audit_data);
        
        // Get logs with filtering
        $logs = $this->logs_model->getAuditLogsByFilter($filter_data);
        
        // Determine export format
        $format = $this->input->get('format') ? $this->input->get('format') : 'csv';
        
        if ($format === 'csv') {
            $this->exportToCSV($logs);
        } else if ($format === 'pdf') {
            $this->exportToPDF($logs);
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($logs));
        }
    }
    
    private function exportToCSV($logs) {
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="audit_logs_' . date('Y-m-d') . '.csv"');
        
        // Create a file pointer
        $output = fopen('php://output', 'w');
        
        // Add CSV header row
        fputcsv($output, array('ID', 'Event Type', 'Resource ID', 'User', 'IP Address', 'Timestamp', 'Details'));
        
        // Add data rows
        foreach ($logs as $log) {
            $user = $this->db->select('username')->from('users')->where('id', $log->user)->get()->row();
            $username = $user ? $user->username : 'Unknown';
            
            fputcsv($output, array(
                $log->id,
                $log->event,
                $log->resource_id ?? 'N/A',
                $username,
                $log->ip_address,
                $log->date_time,
                $log->details
            ));
        }
        
        fclose($output);
        exit;
    }
    
    private function exportToPDF($logs) {
        // Implementation for PDF export using TCPDF or similar library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        
        // Set document information
        $pdf->SetCreator('KlinicX');
        $pdf->SetAuthor('KlinicX');
        $pdf->SetTitle('Audit Logs Report');
        $pdf->SetSubject('Audit Logs');
        
        // Add a page
        $pdf->AddPage('L', 'A4');
        
        // Set font
        $pdf->SetFont('helvetica', '', 10);
        
        // Create table header
        $html = '<h1>Audit Logs Report</h1>';
        $html .= '<table border="1" cellpadding="5"><tr>';
        $html .= '<th>ID</th>';
        $html .= '<th>Event Type</th>';
        $html .= '<th>Resource ID</th>';
        $html .= '<th>User</th>';
        $html .= '<th>IP Address</th>';
        $html .= '<th>Timestamp</th>';
        $html .= '<th>Details</th>';
        $html .= '</tr>';
        
        // Add data rows
        foreach ($logs as $log) {
            $user = $this->db->select('username')->from('users')->where('id', $log->user)->get()->row();
            $username = $user ? $user->username : 'Unknown';
            
            $html .= '<tr>';
            $html .= '<td>' . $log->id . '</td>';
            $html .= '<td>' . $log->event . '</td>';
            $html .= '<td>' . ($log->resource_id ?? 'N/A') . '</td>';
            $html .= '<td>' . $username . '</td>';
            $html .= '<td>' . $log->ip_address . '</td>';
            $html .= '<td>' . $log->date_time . '</td>';
            $html .= '<td>' . substr($log->details, 0, 50) . (strlen($log->details) > 50 ? '...' : '') . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</table>';
        
        // Print table
        $pdf->writeHTML($html, true, false, true, false, '');
        
        // Output PDF
        $pdf->Output('audit_logs_' . date('Y-m-d') . '.pdf', 'D');
        exit;
    }

    function securityAlerts() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        
        // Get filter params from GET request
        $filter_data = array(
            'alert_type' => $this->input->get('alert_type'),
            'user_id' => $this->input->get('user_id'),
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'severity' => $this->input->get('severity'),
            'status' => $this->input->get('status')
        );
        
        // Log this access attempt
        $audit_data = array(
            'name' => $this->ion_auth->user()->row()->username,
            'email' => $this->ion_auth->user()->row()->email,
            'role' => $this->ion_auth->get_users_groups()->row()->name,
            'ip_address' => $this->input->ip_address(),
            'date_time' => date('Y-m-d H:i:s'),
            'event' => 'security_alerts_view',
            'details' => json_encode($filter_data),
            'hospital_id' => $this->session->userdata('hospital_id'),
            'user' => $this->ion_auth->user()->row()->id
        );
        $this->logs_model->insertAuditLog($audit_data);
        
        // Get data for dropdowns
        $data['alertTypes'] = $this->logs_model->getDistinctSecurityAlertTypes();
        $data['users'] = $this->db->select('id, username')
                                ->from('users')
                                ->get()->result_array();
        
        // Get security alerts with filtering
        $data['alerts'] = $this->logs_model->getSecurityAlertsByFilter($filter_data);
        
        // Calculate statistics
        $data['total_alerts'] = $this->logs_model->countAllSecurityAlerts();
        $data['unresolved_alerts'] = $this->logs_model->countUnresolvedSecurityAlerts();
        $data['critical_alerts'] = $this->logs_model->countCriticalSecurityAlerts();
        $data['recent_alerts'] = $this->logs_model->getRecentSecurityAlerts(5);
        
        $this->load->view('home/dashboard');
        $this->load->view('security_alerts', $data);
        $this->load->view('home/footer');
    }
    
    function resolveAlert($alertId) {
        if (!$this->ion_auth->in_group(array('admin', 'superadmin'))) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect('logs/securityAlerts');
        }
        
        if ($this->input->post()) {
            $resolution_notes = $this->input->post('resolution_notes');
            $resolution_action = $this->input->post('resolution_action');
            
            $this->logs_model->resolveSecurityAlert($alertId, $resolution_notes, $resolution_action);
            
            // Log this resolution
            $audit_data = array(
                'name' => $this->ion_auth->user()->row()->username,
                'email' => $this->ion_auth->user()->row()->email,
                'role' => $this->ion_auth->get_users_groups()->row()->name,
                'ip_address' => $this->input->ip_address(),
                'date_time' => date('Y-m-d H:i:s'),
                'event' => 'security_alert_resolved',
                'details' => json_encode(array(
                    'alert_id' => $alertId,
                    'notes' => $resolution_notes,
                    'action' => $resolution_action
                )),
                'hospital_id' => $this->session->userdata('hospital_id'),
                'user' => $this->ion_auth->user()->row()->id
            );
            $this->logs_model->insertAuditLog($audit_data);
            
            $this->session->set_flashdata('feedback', lang('alert_resolved'));
            redirect('logs/securityAlerts');
        }
        
        $data = array();
        $data['alert'] = $this->logs_model->getSecurityAlertById($alertId);
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('resolve_alert', $data);
        $this->load->view('home/footer');
    }

    function getLogs(){
     
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "email",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];
        if($this->ion_auth->in_group(array('admin'))){
        if ($limit == -1) {
            if (!empty($search)) {
                $data['logs'] = $this->logs_model->getLogsBysearch($search, $order, $dir);
            } else {
                $data['logs'] = $this->logs_model->getLogsWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['logs'] = $this->logs_model->getLogsByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['logs'] = $this->logs_model->getLogsWithoutSearch($order, $dir);
                //$data['logs'] = $this->logs_model->getLogsByLimit($limit, $start, $order, $dir);
            }
        }
    }else{
        if ($limit == -1) {
            if (!empty($search)) {
                $data['logs'] = $this->logs_model->getLogsBysearchForSuperadmin($search, $order, $dir);
            } else {
                $data['logs'] = $this->logs_model->getLogsWithoutSearchForSuperadmin($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['logs'] = $this->logs_model->getLogsByLimitBySearchForSuperadmin($limit, $start, $search, $order, $dir);
            } else {
                $data['logs'] = $this->logs_model->getLogsWithoutSearchForSuperadmin($order, $dir);
                //$data['logs'] = $this->logs_model->getLogsByLimitForSuperadmin($limit, $start, $order, $dir);
            }
        }
       
    }
    $count=count($data['logs']);
        $i = 0;
        foreach ($data['logs'] as $log) {
            $i = $i + 1;

            $info[] = array(
                
                $log->name,
                $log->email,
                $log->role,
                $log->ip_address,
                $log->date_time
            );

           
        }

        if (!empty($data['logs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $count,
                "recordsFiltered" => $i,
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
    function transactionLogs(){
        $this->load->view('home/dashboard');
        $this->load->view('transaction_logs');
        $this->load->view('home/footer');
    }
    function getTransaction(){
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "date_time",
            "2" => "deposit_type",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];
        
        if ($limit == -1) {
            if (!empty($search)) {
                $data['logs'] = $this->logs_model->getTransactionLogsBysearch($search, $order, $dir);
            } else {
                $data['logs'] = $this->logs_model->getTransactionLogsWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['logs'] = $this->logs_model->getTransactionLogsByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['logs'] = $this->logs_model->getTransactionLogsWithoutSearch( $order, $dir);
            }
        }
  
    $count=count($data['logs']);
        $i = 0;
        foreach ($data['logs'] as $log) {
            $i = $i + 1;
    if($log->action=='Added'){
      $action='<span class="badge bg-success">'.lang('added').'</span>';
    }elseif($log->action=='Added/Deposited'){
        $action='<span class="badge bg-success">'.lang('added').' ' .lang('deposited').'</span>';
    }elseif($log->action=='Updated'){
        $action='<span class="badge bg-success">'.lang('updated').'</span>';
    }elseif($log->action=='deleted_deposit'){
        $action='<span class="badge bg-danger">'.lang('deleted').' '.'Deposit'.'</span>';
    }
    elseif($log->action=='deleted'){
        $action='<span class="badge bg-danger">'.lang('deleted').'</span>';
    }else{
    $action='<span class="badge bg-info">'.lang('updated').' ' .lang('deposited').'</span>';
    }
    $user_name=$this->db->get_where('users',array('id'=>$log->user))->row()->username;
            $info[] = array(
                
                $log->date_time,
                $log->invoice_id,
                $log->patientname,
                $log->deposit_type,
                $log->amount,
                // $values[0],
                $user_name,
                $action
            );

           
        }

        if (!empty($data['logs'])) {
            $output = array(
                "draw" => $requestData['draw'],
                "recordsTotal" => count($this->db->get_where('transaction_logs',array('hospital_id'=> $this->session->userdata('hospital_id')))->result()),
                "recordsFiltered" => $count,
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