<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuditLogs extends Migration
{
    public function up()
    {
        // Create audit_logs table
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'event_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'resource_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'user_agent' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'details' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'timestamp' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('event_type');
        $this->forge->addKey('user_id');
        $this->forge->addKey('resource_id');
        $this->forge->addKey('timestamp');
        $this->forge->createTable('audit_logs');

        // Create audit_log_signatures table
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'log_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'signature' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'timestamp' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('log_id');
        $this->forge->createTable('audit_log_signatures');
        
        // Create security_alerts table
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'alert_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'timestamp' => [
                'type' => 'DATETIME',
            ],
            'details' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'resolved' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'resolved_by' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'resolution_notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('alert_type');
        $this->forge->addKey('user_id');
        $this->forge->addKey('timestamp');
        $this->forge->createTable('security_alerts');
    }

    public function down()
    {
        $this->forge->dropTable('audit_logs');
        $this->forge->dropTable('audit_log_signatures');
        $this->forge->dropTable('security_alerts');
    }
} 