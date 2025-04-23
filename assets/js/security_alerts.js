/**
 * Security Alerts JavaScript
 * 
 * Handles client-side functionality for security alerts:
 * - Initializes DataTables for alerts
 * - Manages filter form submission
 * - Handles marking alerts as read
 * - Provides alert deletion functionality
 * - Manages viewing alert details
 * - Refreshes security alert notifications
 */
$(document).ready(function() {
    /**
     * Initialize DataTables for the alerts table
     */
    if ($.fn.DataTable && $('#alerts-table').length) {
        $('#alerts-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "order": [[5, "desc"]], // Sort by date/time by default
            "columnDefs": [
                { "orderable": false, "targets": 7 } // Actions column not sortable
            ]
        });
    }
    
    /**
     * Initialize Date Pickers
     */
    if ($.fn.datepicker && $('.datepicker').length) {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    }
    
    /**
     * Handle filter by severity links
     */
    $('.filter-severity').on('click', function(e) {
        e.preventDefault();
        var severity = $(this).data('severity');
        $('select[name="severity"]').val(severity);
        $('#alert-filter-form').submit();
    });
    
    /**
     * Handle filter form submission
     */
    $('#alert-filter-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: baseUrl + 'security/alerts/filter',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = baseUrl + 'security/alerts/filtered';
                } else {
                    showToast('error', 'Failed to apply filters. Please try again.');
                }
            },
            error: function() {
                showToast('error', 'An error occurred while filtering alerts.');
            }
        });
    });
    
    /**
     * Handle marking an alert as read
     */
    $('.mark-read').on('click', function() {
        var alertId = $(this).data('id');
        $.ajax({
            url: baseUrl + 'security/alerts/mark_read',
            type: 'POST',
            data: { alert_id: alertId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showToast('success', 'Alert marked as read');
                    // Refresh the table or update the row
                    window.location.reload();
                } else {
                    showToast('error', response.message || 'Failed to mark alert as read.');
                }
            },
            error: function() {
                showToast('error', 'An error occurred while updating the alert.');
            }
        });
    });
    
    /**
     * Handle marking all alerts as read
     */
    $('#mark-all-read').on('click', function() {
        if (confirm('Are you sure you want to mark all alerts as read?')) {
            $.ajax({
                url: baseUrl + 'security/alerts/mark_all_read',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showToast('success', 'All alerts marked as read');
                        // Refresh the table
                        window.location.reload();
                    } else {
                        showToast('error', response.message || 'Failed to mark all alerts as read.');
                    }
                },
                error: function() {
                    showToast('error', 'An error occurred while updating alerts.');
                }
            });
        }
    });
    
    /**
     * Handle deleting an alert
     */
    $('.delete-alert').on('click', function() {
        var alertId = $(this).data('id');
        if (confirm('Are you sure you want to delete this alert?')) {
            $.ajax({
                url: baseUrl + 'security/alerts/delete',
                type: 'POST',
                data: { alert_id: alertId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showToast('success', 'Alert deleted successfully');
                        // Refresh the table or remove the row
                        window.location.reload();
                    } else {
                        showToast('error', response.message || 'Failed to delete alert.');
                    }
                },
                error: function() {
                    showToast('error', 'An error occurred while deleting the alert.');
                }
            });
        }
    });
    
    /**
     * Handle viewing alert details
     */
    $('.view-details').on('click', function() {
        var alertId = $(this).data('id');
        $.ajax({
            url: baseUrl + 'security/alerts/get_details',
            type: 'GET',
            data: { alert_id: alertId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var alert = response.data;
                    var html = '<div class="row">' +
                               '<div class="col-md-12">' +
                               '<table class="table table-bordered">';
                    
                    // Alert Type
                    html += '<tr><th>Alert Type</th><td>' + alert.alert_type_name + '</td></tr>';
                    
                    // Severity
                    var severityClass = (alert.severity == 'critical') ? 'danger' : 
                                         ((alert.severity == 'high') ? 'warning' : 
                                          ((alert.severity == 'medium') ? 'primary' : 'info'));
                    html += '<tr><th>Severity</th><td><span class="label label-' + severityClass + '">' + 
                            capitalizeFirstLetter(alert.severity) + '</span></td></tr>';
                    
                    // Message
                    html += '<tr><th>Message</th><td>' + alert.message + '</td></tr>';
                    
                    // Additional Details
                    if (alert.details) {
                        html += '<tr><th>Details</th><td><pre>' + alert.details + '</pre></td></tr>';
                    }
                    
                    // IP Address
                    html += '<tr><th>IP Address</th><td>' + alert.ip_address + '</td></tr>';
                    
                    // User Agent
                    if (alert.user_agent) {
                        html += '<tr><th>User Agent</th><td>' + alert.user_agent + '</td></tr>';
                    }
                    
                    // User ID
                    if (alert.user_id) {
                        html += '<tr><th>User ID</th><td>' + alert.user_id + '</td></tr>';
                    }
                    
                    // Created At
                    html += '<tr><th>Created At</th><td>' + alert.created_at + '</td></tr>';
                    
                    // Status
                    var statusClass = (alert.status == 'unread') ? 'primary' : 'default';
                    html += '<tr><th>Status</th><td><span class="label label-' + statusClass + '">' + 
                            capitalizeFirstLetter(alert.status) + '</span></td></tr>';
                    
                    html += '</table></div></div>';
                    
                    $('#alert-details-content').html(html);
                    $('#alert-details-modal').modal('show');
                    
                    // Mark alert as read when viewed if it's unread
                    if (alert.status == 'unread') {
                        $.post(baseUrl + 'security/alerts/mark_read', { alert_id: alertId });
                        refreshSecurityNotifications();
                    }
                } else {
                    showToast('error', response.message || 'Failed to fetch alert details.');
                }
            },
            error: function() {
                showToast('error', 'An error occurred while fetching alert details.');
            }
        });
    });
    
    /**
     * Handle refreshing alerts
     */
    $('#refresh-alerts').on('click', function() {
        window.location.reload();
    });
});

/**
 * Helper function to refresh security notifications in the header
 */
function refreshSecurityNotifications() {
    if ($('#security-notifications').length) {
        $.ajax({
            url: baseUrl + 'security/alerts/notifications',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#security-notifications').html(response.html);
                    
                    // Update counter in title if needed
                    if (response.unread_count > 0) {
                        var title = document.title;
                        if (title.indexOf('(') >= 0) {
                            title = title.replace(/\(\d+\)/, '(' + response.unread_count + ')');
                        } else {
                            title = '(' + response.unread_count + ') ' + title;
                        }
                        document.title = title;
                    }
                }
            }
        });
    }
}

/**
 * Helper function to show toast notifications
 */
function showToast(type, message) {
    if (typeof toastr !== 'undefined') {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 5000
        };
        
        switch(type) {
            case 'success':
                toastr.success(message);
                break;
            case 'error':
                toastr.error(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'info':
                toastr.info(message);
                break;
            default:
                toastr.info(message);
        }
    } else {
        alert(message);
    }
}

/**
 * Helper function to capitalize the first letter of a string
 */
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/**
 * Set up automatic refresh for security notifications
 */
$(document).ready(function() {
    // Refresh security notifications every 2 minutes
    if ($('#security-notifications').length) {
        setInterval(refreshSecurityNotifications, 120000); // 2 minutes
    }
});

/**
 * Load notifications when the page loads
 */
$(document).ready(function() {
    refreshSecurityNotifications();
}); 