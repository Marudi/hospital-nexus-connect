<?php
// Include necessary classes
require_once 'app/Libraries/AuditLogger.php';
require_once 'app/Commands/MaintainAuditLogs.php';

// Create an instance of the maintenance command
$maintainLogs = new \App\Commands\MaintainAuditLogs();

// Run the maintenance routine
$maintainLogs->run([]);

echo "Log maintenance completed.\n"; 