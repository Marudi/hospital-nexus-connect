<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_security_alerts_table extends CI_Migration {

    public function up() {
        // Check if table already exists
        if (!$this->db->table_exists('security_alerts')) {
            // Table structure
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'alert_type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                    'null' => FALSE
                ),
                'message' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => FALSE
                ),
                'severity' => array(
                    'type' => 'ENUM',
                    'constraint' => "'critical','high','medium','low'",
                    'default' => 'medium',
                    'null' => FALSE
                ),
                'details' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'ip_address' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '45',
                    'null' => TRUE
                ),
                'user_agent' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE
                ),
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'null' => TRUE
                ),
                'status' => array(
                    'type' => 'ENUM',
                    'constraint' => "'unread','read'",
                    'default' => 'unread',
                    'null' => FALSE
                ),
                'created_at' => array(
                    'type' => 'DATETIME',
                    'null' => FALSE
                ),
                'updated_at' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            ));
            
            // Add primary key
            $this->dbforge->add_key('id', TRUE);
            
            // Add indexes
            $this->dbforge->add_key('alert_type');
            $this->dbforge->add_key('severity');
            $this->dbforge->add_key('status');
            $this->dbforge->add_key('created_at');
            $this->dbforge->add_key('user_id');
            
            // Create table
            $this->dbforge->create_table('security_alerts', TRUE);
            
            // Add sample data for testing
            $sample_data = array(
                array(
                    'alert_type' => 'login_failure',
                    'message' => 'Failed login attempt for user \'admin\'',
                    'severity' => 'medium',
                    'details' => json_encode(array('reason' => 'Invalid credentials', 'timestamp' => date('Y-m-d H:i:s'))),
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'status' => 'unread',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ),
                array(
                    'alert_type' => 'unauthorized_access',
                    'message' => 'Unauthorized access attempt to admin area',
                    'severity' => 'high',
                    'details' => json_encode(array('resource' => '/admin/settings', 'timestamp' => date('Y-m-d H:i:s'))),
                    'ip_address' => '192.168.1.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'status' => 'unread',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-1 hour')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-1 hour'))
                ),
                array(
                    'alert_type' => 'brute_force',
                    'message' => 'Multiple failed login attempts detected from IP 192.168.1.2',
                    'severity' => 'critical',
                    'details' => json_encode(array('attempt_count' => 5, 'timestamp' => date('Y-m-d H:i:s'))),
                    'ip_address' => '192.168.1.2',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'status' => 'unread',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
                )
            );
            
            foreach ($sample_data as $data) {
                $this->db->insert('security_alerts', $data);
            }
        }
    }

    public function down() {
        // Drop table if it exists
        if ($this->db->table_exists('security_alerts')) {
            $this->dbforge->drop_table('security_alerts');
        }
    }
} 