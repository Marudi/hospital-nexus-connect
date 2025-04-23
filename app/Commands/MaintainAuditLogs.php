<?php namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

/**
 * MaintainAuditLogs Command
 * 
 * CLI command to manage audit logs according to retention policy
 */
class MaintainAuditLogs extends BaseCommand {
    protected $group = 'Maintenance';
    protected $name = 'logs:maintain';
    protected $description = 'Maintains audit logs according to retention policy';
    
    protected $db;
    protected $auditLogger;
    
    public function __construct() {
        $this->db = \Config\Database::connect();
        $this->auditLogger = new \App\Libraries\AuditLogger();
    }
    
    /**
     * Run the log maintenance command
     */
    public function run(array $params) {
        // Archive logs older than policy threshold
        $retentionDays = 730; // 2 years, adjust according to your policy
        $archiveDate = date('Y-m-d', strtotime('-' . $retentionDays . ' days'));
        
        CLI::write('Archiving logs older than ' . $archiveDate, 'yellow');
        
        // Create archive directory if it doesn't exist
        if (!is_dir(WRITEPATH . 'archives')) {
            mkdir(WRITEPATH . 'archives', 0755, true);
        }
        
        // Get logs to archive
        $logsToArchive = $this->db->table('audit_logs')
            ->where('timestamp <', $archiveDate . ' 00:00:00')
            ->get()
            ->getResultArray();
        
        $count = count($logsToArchive);
        CLI::write('Found ' . $count . ' logs to archive', 'green');
        
        if ($count > 0) {
            // Archive logs
            $archiveFile = 'audit_logs_archive_' . date('Y-m-d_His') . '.json';
            file_put_contents(WRITEPATH . 'archives/' . $archiveFile, json_encode($logsToArchive));
            
            // Sign the archive
            $archiveSignature = hash_hmac('sha256', json_encode($logsToArchive), config('Encryption')->key);
            file_put_contents(WRITEPATH . 'archives/' . $archiveFile . '.sig', $archiveSignature);
            
            // Delete archived logs
            $this->db->table('audit_logs')
                ->where('timestamp <', $archiveDate . ' 00:00:00')
                ->delete();
            
            CLI::write('Archived ' . $count . ' logs to ' . WRITEPATH . 'archives/' . $archiveFile, 'green');
            
            // Log the archiving process
            $this->auditLogger->log('audit_logs_archived', 'system', [
                'archive_file' => $archiveFile,
                'records_count' => $count,
                'date_range' => 'before ' . $archiveDate
            ]);
        }
        
        // Clean up old security alerts that have been resolved
        $resolvedAlertRetentionDays = 365; // 1 year for resolved alerts
        $resolvedCutoffDate = date('Y-m-d', strtotime('-' . $resolvedAlertRetentionDays . ' days'));
        
        CLI::write('Cleaning up resolved security alerts older than ' . $resolvedCutoffDate, 'yellow');
        
        $result = $this->db->table('security_alerts')
            ->where('resolved', 1)
            ->where('timestamp <', $resolvedCutoffDate . ' 00:00:00')
            ->delete();
            
        CLI::write('Cleaned up ' . $this->db->affectedRows() . ' resolved security alerts', 'green');
        
        // Verify integrity of existing logs
        $this->verifyLogIntegrity();
        
        CLI::write('Log maintenance completed', 'green');
    }
    
    /**
     * Verify integrity of logs
     */
    private function verifyLogIntegrity() {
        CLI::write('Verifying log integrity...', 'yellow');
        
        // Get signed logs
        $signatures = $this->db->table('audit_log_signatures')
            ->get()
            ->getResultArray();
            
        $signaturesByLogId = [];
        foreach ($signatures as $sig) {
            $signaturesByLogId[$sig['log_id']] = $sig['signature'];
        }
        
        // Check a sample of logs
        $sampleSize = 100;
        $logs = $this->db->table('audit_logs')
            ->orderBy('RAND()')
            ->limit($sampleSize)
            ->get()
            ->getResultArray();
            
        $tampered = 0;
        foreach ($logs as $log) {
            if (isset($signaturesByLogId[$log['id']])) {
                $isValid = $this->auditLogger->verifyLogIntegrity($log['id']);
                if (!$isValid) {
                    CLI::write('Warning: Log ' . $log['id'] . ' may have been tampered with!', 'red');
                    $tampered++;
                }
            }
        }
        
        if ($tampered > 0) {
            CLI::write('Found ' . $tampered . ' potentially tampered logs out of ' . count($logs) . ' checked', 'red');
            
            // Log this security event
            $this->auditLogger->log('log_integrity_violation', 'system', [
                'tampered_count' => $tampered,
                'sample_size' => $sampleSize
            ]);
        } else {
            CLI::write('All checked logs passed integrity verification', 'green');
        }
        
        // Sign any unsigned logs
        $unsignedCount = $this->db->query("
            SELECT COUNT(*) as cnt 
            FROM audit_logs a 
            LEFT JOIN audit_log_signatures s ON a.id = s.log_id 
            WHERE s.log_id IS NULL
        ")->getRow()->cnt;
        
        if ($unsignedCount > 0) {
            CLI::write('Found ' . $unsignedCount . ' unsigned logs. Signing...', 'yellow');
            
            $unsignedLogs = $this->db->query("
                SELECT a.id
                FROM audit_logs a 
                LEFT JOIN audit_log_signatures s ON a.id = s.log_id 
                WHERE s.log_id IS NULL
                LIMIT 1000
            ")->getResultArray();
            
            $signed = 0;
            foreach ($unsignedLogs as $log) {
                if ($this->auditLogger->signLog($log['id'])) {
                    $signed++;
                }
            }
            
            CLI::write('Signed ' . $signed . ' logs', 'green');
        } else {
            CLI::write('All logs are properly signed', 'green');
        }
    }
} 