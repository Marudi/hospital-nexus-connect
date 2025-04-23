<?php namespace App\Services;

/**
 * SecurityMonitoringService Class
 * 
 * Monitors for suspicious activity patterns and triggers alerts
 */
class SecurityMonitoringService {
    protected $db;
    protected $thresholds = [
        'login_failures' => 5,  // 5 failures in threshold period
        'record_access_volume' => 50,  // 50 records in threshold period
        'off_hours_access' => true
    ];
    protected $periodMinutes = 60;
    
    public function __construct() {
        $this->db = \Config\Database::connect();
    }
    
    /**
     * Check for suspicious activity for a user
     * 
     * @param int $userId User ID to check
     * @return array List of triggered alerts
     */
    public function checkForSuspiciousActivity($userId) {
        $alerts = [];
        
        // Check login failures
        if ($this->checkLoginFailures($userId)) {
            $alerts[] = 'excessive_login_failures';
            $this->triggerAlert('excessive_login_failures', $userId);
        }
        
        // Check volume of record access
        if ($this->checkAccessVolume($userId)) {
            $alerts[] = 'high_volume_access';
            $this->triggerAlert('high_volume_access', $userId);
        }
        
        // Check for off-hours access
        if ($this->isOffHoursAccess() && $this->thresholds['off_hours_access']) {
            $alerts[] = 'off_hours_access';
            $this->triggerAlert('off_hours_access', $userId);
        }
        
        return $alerts;
    }
    
    /**
     * Check if user has excessive login failures
     * 
     * @param int $userId User ID to check
     * @return bool True if threshold exceeded
     */
    private function checkLoginFailures($userId) {
        $timeThreshold = date('Y-m-d H:i:s', time() - ($this->periodMinutes * 60));
        
        $count = $this->db->table('audit_logs')
            ->where('event_type', 'login_failure')
            ->where('user_id', $userId)
            ->where('timestamp >', $timeThreshold)
            ->countAllResults();
            
        return $count >= $this->thresholds['login_failures'];
    }
    
    /**
     * Check if user is accessing an unusual volume of records
     * 
     * @param int $userId User ID to check
     * @return bool True if threshold exceeded
     */
    private function checkAccessVolume($userId) {
        $timeThreshold = date('Y-m-d H:i:s', time() - ($this->periodMinutes * 60));
        
        $count = $this->db->table('audit_logs')
            ->where('event_type', 'patient_record_access')
            ->where('user_id', $userId)
            ->where('timestamp >', $timeThreshold)
            ->countAllResults();
            
        return $count >= $this->thresholds['record_access_volume'];
    }
    
    /**
     * Check if current time is outside normal business hours
     * 
     * @return bool True if current time is off-hours
     */
    private function isOffHoursAccess() {
        $hour = (int)date('H');
        $day = (int)date('w'); // 0 (Sunday) to 6 (Saturday)
        
        // Consider off-hours as nights and weekends
        return ($hour < 6 || $hour >= 22 || $day == 0 || $day == 6);
    }
    
    /**
     * Create a security alert
     * 
     * @param string $alertType Type of alert
     * @param int $userId User ID that triggered the alert
     * @return bool Success or failure
     */
    private function triggerAlert($alertType, $userId) {
        $user = $this->db->table('users')->where('id', $userId)->get()->getRow();
        
        if (!$user) {
            return false;
        }
        
        // Log the alert
        $result = $this->db->table('security_alerts')->insert([
            'alert_type' => $alertType,
            'user_id' => $userId,
            'timestamp' => date('Y-m-d H:i:s'),
            'details' => json_encode([
                'username' => $user->username ?? 'unknown',
                'department' => $user->department ?? 'unknown',
                'ip_address' => service('request')->getIPAddress()
            ])
        ]);
        
        // Notify security team
        $this->notifySecurity($alertType, $user);
        
        return $result;
    }
    
    /**
     * Send notification to security team
     * 
     * @param string $alertType Type of alert
     * @param object $user User that triggered the alert
     * @return void
     */
    private function notifySecurity($alertType, $user) {
        // Check if email service is available
        if (service('email', null, false)) {
            $email = service('email');
            $email->setTo(config('Security')->securityEmail ?? 'security@klinicx.com');
            $email->setSubject('Security Alert: ' . $alertType);
            $email->setMessage("Security alert triggered for user {$user->username} ({$user->id}).\nAlert type: {$alertType}\nTimestamp: " . date('Y-m-d H:i:s'));
            $email->send();
        }
        
        // Add other notification methods here (SMS, Slack, etc.)
    }
} 