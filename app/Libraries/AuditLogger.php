<?php namespace App\Libraries;

/**
 * AuditLogger Class
 * 
 * Provides comprehensive logging for HIPAA/HITECH compliance
 */
class AuditLogger {
    protected $db;
    
    public function __construct() {
        $this->db = \Config\Database::connect();
    }
    
    /**
     * Log an event to the audit trail
     * 
     * @param string $eventType Type of event (login_success, patient_record_access, etc)
     * @param string $resourceId ID of the resource being accessed
     * @param array $details Additional details about the event
     * @return bool Success or failure
     */
    public function log($eventType, $resourceId, $details = []) {
        $data = [
            'event_type' => $eventType,
            'resource_id' => $resourceId,
            'user_id' => session()->get('user_id') ?? 0,
            'ip_address' => service('request')->getIPAddress(),
            'user_agent' => service('request')->getUserAgent()->getAgentString(),
            'details' => json_encode($details),
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        return $this->db->table('audit_logs')->insert($data);
    }
    
    /**
     * Sign a log entry to ensure integrity
     * 
     * @param int $logId ID of the log entry to sign
     * @return bool Success or failure
     */
    public function signLog($logId) {
        $log = $this->db->table('audit_logs')
            ->where('id', $logId)
            ->get()
            ->getRowArray();
        
        if (!$log) {
            return false;
        }
        
        // Create a hash of the log entry
        $logString = implode('|', [
            $log['id'],
            $log['event_type'],
            $log['resource_id'],
            $log['user_id'],
            $log['ip_address'],
            $log['timestamp'],
            $log['details']
        ]);
        
        $signature = hash_hmac('sha256', $logString, config('Encryption')->key);
        
        // Store the signature
        $this->db->table('audit_log_signatures')->insert([
            'log_id' => $logId,
            'signature' => $signature,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        
        return true;
    }
    
    /**
     * Verify the integrity of a log entry
     * 
     * @param int $logId ID of the log entry to verify
     * @return bool True if the log entry is intact, false otherwise
     */
    public function verifyLogIntegrity($logId) {
        $log = $this->db->table('audit_logs')
            ->where('id', $logId)
            ->get()
            ->getRowArray();
        
        if (!$log) {
            return false;
        }
        
        $signature = $this->db->table('audit_log_signatures')
            ->where('log_id', $logId)
            ->get()
            ->getRowArray()['signature'] ?? '';
            
        if (empty($signature)) {
            return false;
        }
        
        // Recreate the hash
        $logString = implode('|', [
            $log['id'],
            $log['event_type'],
            $log['resource_id'],
            $log['user_id'],
            $log['ip_address'],
            $log['timestamp'],
            $log['details']
        ]);
        
        $calculatedSignature = hash_hmac('sha256', $logString, config('Encryption')->key);
        
        // Compare signatures
        return hash_equals($signature, $calculatedSignature);
    }
} 