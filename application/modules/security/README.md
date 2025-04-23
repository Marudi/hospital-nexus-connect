# Security Module for KlinicX

This module provides security monitoring and alerting functionality for the KlinicX application.

## Features

- **Security Alerts Dashboard**: View and manage security alerts
- **Real-time Notifications**: Get notifications for security events
- **Security Monitoring**: Automatic detection of suspicious activities
- **Audit Trail**: Comprehensive logging of security-related events

## Installation

1. The module is already included in the application.
2. Run the database migration to create the necessary tables:
   ```
   http://yoursite.com/security/migrate/create_table
   ```
   Or from the command line:
   ```
   php index.php security/migrate/create_table
   ```

## Components

### Security Alerts

The security alerts system monitors and logs potential security threats, including:
- Failed login attempts
- Brute force attacks
- Unauthorized access attempts
- SQL injection attempts
- XSS attempts
- Suspicious activities

### Security Utility Library

The `Security_utility` library provides methods for logging security events and performing security checks:

```php
// Log a security alert
$this->security_utility->log_alert($alert_type, $message, $severity, $additional_data);

// Log a failed login attempt
$this->security_utility->log_login_failure($identity, $reason);

// Check for brute force attacks
$this->security_utility->check_login_attempts($threshold, $time_period);

// Validate request parameters for SQL injection
$this->security_utility->validate_request_params();

// Check for XSS attempts
$this->security_utility->check_xss_attempt();
```

### Security Hook

The module includes a hook that automatically runs security checks on every request:
- SQL injection detection
- XSS attempt detection

## Configuration

The security module can be configured in the `application/config/security.php` file:

```php
// Example configuration
$config['security_alerts_enabled'] = TRUE;
$config['brute_force_threshold'] = 5;
$config['brute_force_time_period'] = 15; // minutes
```

## Usage

### Viewing Security Alerts

Administrators can view and manage security alerts from the admin dashboard:
1. Log in as an administrator
2. Navigate to Security > Alerts
3. View, filter, and manage alerts

### Real-time Notifications

The system provides real-time notifications for new security alerts in the header/navbar.

### Logging Security Events

To log security events from your code:

```php
// Load the library (if not already loaded)
$this->load->library('security/security_utility');

// Log a security event
$this->security_utility->log_alert(
    'custom_event',
    'Description of the event',
    'medium', // severity: critical, high, medium, low
    array('details' => 'Additional details')
);
```

## Permissions

The following permissions are required to access different parts of the security module:

- **View Security Alerts**: Requires 'admin' or 'security' group
- **Manage Security Alerts**: Requires 'admin' group

## Support

For issues or questions, please contact the system administrator. 