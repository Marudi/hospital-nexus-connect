<?php
// Define the database configuration directly
$dbConfig = [
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'klinicx_local',
    'DBDriver' => 'MySQLi',
];

// Create database connection manually
$db = new mysqli($dbConfig['hostname'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

echo "Connected to database successfully.\n";

// Create audit_logs table
$create_audit_logs = "
CREATE TABLE IF NOT EXISTS `audit_logs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `event_type` VARCHAR(50) NOT NULL,
    `resource_id` VARCHAR(50) NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `user_agent` TEXT NULL,
    `details` JSON NULL,
    `timestamp` DATETIME NOT NULL,
    INDEX (`event_type`),
    INDEX (`user_id`),
    INDEX (`resource_id`),
    INDEX (`timestamp`)
)";

if ($db->query($create_audit_logs) === TRUE) {
    echo "Table audit_logs created successfully.\n";
} else {
    echo "Error creating table audit_logs: " . $db->error . "\n";
}

// Create audit_log_signatures table
$create_audit_log_signatures = "
CREATE TABLE IF NOT EXISTS `audit_log_signatures` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `log_id` BIGINT UNSIGNED NOT NULL,
    `signature` VARCHAR(64) NOT NULL,
    `timestamp` DATETIME NOT NULL,
    INDEX (`log_id`)
)";

if ($db->query($create_audit_log_signatures) === TRUE) {
    echo "Table audit_log_signatures created successfully.\n";
} else {
    echo "Error creating table audit_log_signatures: " . $db->error . "\n";
}

// Create security_alerts table
$create_security_alerts = "
CREATE TABLE IF NOT EXISTS `security_alerts` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `alert_type` VARCHAR(50) NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `timestamp` DATETIME NOT NULL,
    `details` JSON NULL,
    `resolved` TINYINT(1) DEFAULT 0,
    `resolved_by` INT UNSIGNED NULL,
    `resolution_notes` TEXT NULL,
    INDEX (`alert_type`),
    INDEX (`user_id`),
    INDEX (`timestamp`)
)";

if ($db->query($create_security_alerts) === TRUE) {
    echo "Table security_alerts created successfully.\n";
} else {
    echo "Error creating table security_alerts: " . $db->error . "\n";
}

$db->close();
echo "Migration completed.\n"; 