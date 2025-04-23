<?php namespace App\Controllers;

/**
 * AdminController Class
 * 
 * Provides admin functionality for audit log review and security management
 */
class AdminController extends BaseController {
    protected $db;
    protected $auditLogger;
    
    public function __construct() {
        $this->db = \Config\Database::connect();
        $this->auditLogger = new \App\Libraries\AuditLogger();
    }
    
    /**
     * Audit log review dashboard
     */
    public function auditLogs() {
        // Ensure only authorized users can access
        if (!$this->hasPermission('view_audit_logs')) {
            return redirect()->to('/unauthorized');
        }
        
        $filters = [
            'event_type' => $this->request->getGet('event_type'),
            'user_id' => $this->request->getGet('user_id'),
            'date_from' => $this->request->getGet('date_from'),
            'date_to' => $this->request->getGet('date_to'),
            'resource_id' => $this->request->getGet('resource_id')
        ];
        
        // Log this access to audit logs too
        $this->auditLogger->log('audit_log_review', 'system', [
            'filters' => $filters
        ]);
        
        $builder = $this->db->table('audit_logs');
        
        // Apply filters
        if (!empty($filters['event_type'])) {
            $builder->where('event_type', $filters['event_type']);
        }
        
        if (!empty($filters['user_id'])) {
            $builder->where('user_id', $filters['user_id']);
        }
        
        if (!empty($filters['date_from'])) {
            $builder->where('timestamp >=', $filters['date_from'] . ' 00:00:00');
        }
        
        if (!empty($filters['date_to'])) {
            $builder->where('timestamp <=', $filters['date_to'] . ' 23:59:59');
        }
        
        if (!empty($filters['resource_id'])) {
            $builder->where('resource_id', $filters['resource_id']);
        }
        
        // Paginate results
        $data['logs'] = $builder->orderBy('timestamp', 'DESC')
                               ->paginate(50);
        $data['pager'] = $builder->pager;
        
        // Get event types for filter dropdown
        $data['eventTypes'] = $this->db->table('audit_logs')
                                      ->select('event_type')
                                      ->distinct()
                                      ->get()
                                      ->getResultArray();
        
        // Get users for filter dropdown
        $data['users'] = $this->db->table('users')
                                 ->select('id, username')
                                 ->get()
                                 ->getResultArray();
        
        return view('admin/audit_logs', $data);
    }
    
    /**
     * Export audit logs
     */
    public function exportAuditLogs() {
        // Ensure only authorized users can access
        if (!$this->hasPermission('export_audit_logs')) {
            return redirect()->to('/unauthorized');
        }
        
        $filters = [
            'event_type' => $this->request->getGet('event_type'),
            'user_id' => $this->request->getGet('user_id'),
            'date_from' => $this->request->getGet('date_from') ?? date('Y-m-d', strtotime('-30 days')),
            'date_to' => $this->request->getGet('date_to') ?? date('Y-m-d'),
            'resource_id' => $this->request->getGet('resource_id')
        ];
        
        // Log this export to audit logs
        $this->auditLogger->log('audit_log_export', 'system', [
            'filters' => $filters,
            'format' => $this->request->getGet('format') ?? 'csv'
        ]);
        
        $builder = $this->db->table('audit_logs');
        
        // Apply filters (same as in auditLogs method)
        if (!empty($filters['event_type'])) {
            $builder->where('event_type', $filters['event_type']);
        }
        
        if (!empty($filters['user_id'])) {
            $builder->where('user_id', $filters['user_id']);
        }
        
        if (!empty($filters['date_from'])) {
            $builder->where('timestamp >=', $filters['date_from'] . ' 00:00:00');
        }
        
        if (!empty($filters['date_to'])) {
            $builder->where('timestamp <=', $filters['date_to'] . ' 23:59:59');
        }
        
        if (!empty($filters['resource_id'])) {
            $builder->where('resource_id', $filters['resource_id']);
        }
        
        $logs = $builder->orderBy('timestamp', 'DESC')
                      ->get()
                      ->getResultArray();
        
        // Generate export file
        $format = $this->request->getGet('format') ?? 'csv';
        
        if ($format === 'csv') {
            return $this->generateCSV($logs);
        } else if ($format === 'pdf') {
            return $this->generatePDF($logs);
        } else {
            return $this->response->setJSON($logs);
        }
    }
    
    /**
     * Security alerts dashboard
     */
    public function securityAlerts() {
        // Ensure only authorized users can access
        if (!$this->hasPermission('view_security_alerts')) {
            return redirect()->to('/unauthorized');
        }
        
        $filters = [
            'alert_type' => $this->request->getGet('alert_type'),
            'user_id' => $this->request->getGet('user_id'),
            'date_from' => $this->request->getGet('date_from'),
            'date_to' => $this->request->getGet('date_to'),
            'resolved' => $this->request->getGet('resolved')
        ];
        
        // Log this access
        $this->auditLogger->log('security_alerts_review', 'system', [
            'filters' => $filters
        ]);
        
        $builder = $this->db->table('security_alerts');
        
        // Apply filters
        if (!empty($filters['alert_type'])) {
            $builder->where('alert_type', $filters['alert_type']);
        }
        
        if (!empty($filters['user_id'])) {
            $builder->where('user_id', $filters['user_id']);
        }
        
        if (!empty($filters['date_from'])) {
            $builder->where('timestamp >=', $filters['date_from'] . ' 00:00:00');
        }
        
        if (!empty($filters['date_to'])) {
            $builder->where('timestamp <=', $filters['date_to'] . ' 23:59:59');
        }
        
        if (isset($filters['resolved']) && $filters['resolved'] !== '') {
            $builder->where('resolved', $filters['resolved']);
        }
        
        // Paginate results
        $data['alerts'] = $builder->orderBy('timestamp', 'DESC')
                                ->paginate(20);
        $data['pager'] = $builder->pager;
        
        // Get alert types for filter dropdown
        $data['alertTypes'] = $this->db->table('security_alerts')
                                     ->select('alert_type')
                                     ->distinct()
                                     ->get()
                                     ->getResultArray();
        
        // Get users for filter dropdown
        $data['users'] = $this->db->table('users')
                                ->select('id, username')
                                ->get()
                                ->getResultArray();
        
        return view('admin/security_alerts', $data);
    }
    
    /**
     * Resolve a security alert
     */
    public function resolveAlert($alertId) {
        // Ensure only authorized users can access
        if (!$this->hasPermission('resolve_security_alerts')) {
            return redirect()->to('/unauthorized');
        }
        
        if ($this->request->getMethod() === 'post') {
            $resolution_notes = $this->request->getPost('resolution_notes');
            
            $this->db->table('security_alerts')
                   ->where('id', $alertId)
                   ->update([
                       'resolved' => 1,
                       'resolved_by' => session()->get('user_id'),
                       'resolution_notes' => $resolution_notes
                   ]);
            
            // Log the resolution
            $this->auditLogger->log('security_alert_resolved', $alertId, [
                'notes' => $resolution_notes
            ]);
            
            return redirect()->to('/admin/security-alerts')->with('message', 'Alert resolved successfully');
        }
        
        $data['alert'] = $this->db->table('security_alerts')
                               ->where('id', $alertId)
                               ->get()
                               ->getRowArray();
        
        return view('admin/resolve_alert', $data);
    }
    
    /**
     * Check if user has permission
     */
    private function hasPermission($permission) {
        // Implement your permission checking logic here
        // For now, we'll assume admin role has all permissions
        return session()->get('role') === 'admin';
    }
    
    /**
     * Generate CSV file from logs
     */
    private function generateCSV($logs) {
        $filename = 'audit_logs_' . date('Y-m-d') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Add CSV header
        fputcsv($output, ['ID', 'Event Type', 'Resource ID', 'User ID', 'IP Address', 'Timestamp', 'Details']);
        
        // Add data rows
        foreach ($logs as $log) {
            $details = json_decode($log['details'], true);
            $detailsStr = is_array($details) ? http_build_query($details, '', ', ') : $log['details'];
            
            fputcsv($output, [
                $log['id'],
                $log['event_type'],
                $log['resource_id'],
                $log['user_id'],
                $log['ip_address'],
                $log['timestamp'],
                $detailsStr
            ]);
        }
        
        fclose($output);
        exit;
    }
    
    /**
     * Generate PDF file from logs
     */
    private function generatePDF($logs) {
        // This is a simple implementation. For production, you'd use a proper PDF library.
        $filename = 'audit_logs_' . date('Y-m-d') . '.pdf';
        
        // Assuming you have a PDF library like TCPDF installed
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // Set document information
        $pdf->SetCreator('KlinicX');
        $pdf->SetAuthor('KlinicX Admin');
        $pdf->SetTitle('Audit Logs Report');
        $pdf->SetSubject('KlinicX Audit Logs');
        
        // Add a page
        $pdf->AddPage();
        
        // Set font
        $pdf->SetFont('helvetica', '', 10);
        
        // Create table header
        $html = '<table border="1" cellpadding="3">
                    <tr>
                        <th>ID</th>
                        <th>Event Type</th>
                        <th>Resource ID</th>
                        <th>User ID</th>
                        <th>IP Address</th>
                        <th>Timestamp</th>
                        <th>Details</th>
                    </tr>';
        
        // Add data rows
        foreach ($logs as $log) {
            $details = json_decode($log['details'], true);
            $detailsStr = is_array($details) ? http_build_query($details, '', ', ') : $log['details'];
            
            $html .= '<tr>
                        <td>' . $log['id'] . '</td>
                        <td>' . $log['event_type'] . '</td>
                        <td>' . $log['resource_id'] . '</td>
                        <td>' . $log['user_id'] . '</td>
                        <td>' . $log['ip_address'] . '</td>
                        <td>' . $log['timestamp'] . '</td>
                        <td>' . $detailsStr . '</td>
                    </tr>';
        }
        
        $html .= '</table>';
        
        // Output HTML as PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        
        // Output PDF
        $pdf->Output($filename, 'D');
        exit;
    }
} 