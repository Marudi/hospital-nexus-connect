// Admin routes for audit and security
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // Audit log routes
    $routes->get('audit-logs', 'AdminController::auditLogs');
    $routes->get('export-audit-logs', 'AdminController::exportAuditLogs');
    $routes->get('verify-log/(:num)', 'AdminController::verifyLog/$1');
    
    // Security alert routes
    $routes->get('security-alerts', 'AdminController::securityAlerts');
    $routes->get('resolve-alert/(:num)', 'AdminController::resolveAlert/$1');
    $routes->post('resolve-alert/(:num)', 'AdminController::resolveAlert/$1');
}); 