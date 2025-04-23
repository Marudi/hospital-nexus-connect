<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Security Alerts</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Security Alerts</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- Alert Summary Boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $critical_count ?></h3>
                        <p>Critical Alerts</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <a href="<?= base_url('security/alerts/filter?severity=critical') ?>" class="small-box-footer">
                        View All <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $high_count ?></h3>
                        <p>High Alerts</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <a href="<?= base_url('security/alerts/filter?severity=high') ?>" class="small-box-footer">
                        View All <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $medium_count ?></h3>
                        <p>Medium Alerts</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <a href="<?= base_url('security/alerts/filter?severity=medium') ?>" class="small-box-footer">
                        View All <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $low_count ?></h3>
                        <p>Low Alerts</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <a href="<?= base_url('security/alerts/filter?severity=low') ?>" class="small-box-footer">
                        View All <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filter Alerts</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('security/alerts/filter') ?>" method="get" id="filter-form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Alert Type</label>
                                <select class="form-control" name="alert_type">
                                    <option value="">All Types</option>
                                    <?php foreach($alert_types as $type_key => $type_name): ?>
                                        <option value="<?= $type_key ?>" <?= isset($filters['alert_type']) && $filters['alert_type'] == $type_key ? 'selected' : '' ?>><?= $type_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Severity</label>
                                <select class="form-control" name="severity">
                                    <option value="">All Severities</option>
                                    <option value="critical" <?= isset($filters['severity']) && $filters['severity'] == 'critical' ? 'selected' : '' ?>>Critical</option>
                                    <option value="high" <?= isset($filters['severity']) && $filters['severity'] == 'high' ? 'selected' : '' ?>>High</option>
                                    <option value="medium" <?= isset($filters['severity']) && $filters['severity'] == 'medium' ? 'selected' : '' ?>>Medium</option>
                                    <option value="low" <?= isset($filters['severity']) && $filters['severity'] == 'low' ? 'selected' : '' ?>>Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="">All Status</option>
                                    <option value="unread" <?= isset($filters['status']) && $filters['status'] == 'unread' ? 'selected' : '' ?>>Unread</option>
                                    <option value="read" <?= isset($filters['status']) && $filters['status'] == 'read' ? 'selected' : '' ?>>Read</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>IP Address</label>
                                <input type="text" class="form-control" name="ip_address" placeholder="IP Address" value="<?= isset($filters['ip_address']) ? $filters['ip_address'] : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="start_date" value="<?= isset($filters['start_date']) ? $filters['start_date'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="end_date" value="<?= isset($filters['end_date']) ? $filters['end_date'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="<?= base_url('security/alerts') ?>" class="btn btn-default">Reset Filters</a>
                                <?php if(count($alerts) > 0): ?>
                                    <button type="button" id="mark-all-read" class="btn btn-info ml-2">Mark All as Read</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alerts Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Security Alerts</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">Date/Time</th>
                                <th width="10%">Type</th>
                                <th width="10%">Severity</th>
                                <th width="15%">IP Address</th>
                                <th width="25%">Description</th>
                                <th width="10%">Status</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($alerts) > 0): ?>
                                <?php foreach($alerts as $index => $alert): ?>
                                    <tr class="<?= $alert['status'] == 'unread' ? 'font-weight-bold' : '' ?>" 
                                        data-alert-id="<?= $alert['id'] ?>">
                                        <td><?= $index + 1 ?></td>
                                        <td><?= date('Y-m-d H:i:s', strtotime($alert['created_at'])) ?></td>
                                        <td><?= $alert_types[$alert['alert_type']] ?? 'Unknown' ?></td>
                                        <td>
                                            <span class="badge 
                                                <?= $alert['severity'] == 'critical' ? 'badge-danger' : '' ?>
                                                <?= $alert['severity'] == 'high' ? 'badge-warning' : '' ?>
                                                <?= $alert['severity'] == 'medium' ? 'badge-info' : '' ?>
                                                <?= $alert['severity'] == 'low' ? 'badge-success' : '' ?>">
                                                <?= ucfirst($alert['severity']) ?>
                                            </span>
                                        </td>
                                        <td><?= $alert['ip_address'] ?></td>
                                        <td><?= $alert['description'] ?></td>
                                        <td>
                                            <span class="badge <?= $alert['status'] == 'unread' ? 'badge-danger' : 'badge-secondary' ?>">
                                                <?= ucfirst($alert['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($alert['status'] == 'unread'): ?>
                                                <button type="button" class="btn btn-xs btn-info mark-read" data-id="<?= $alert['id'] ?>">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-xs btn-default view-details" data-id="<?= $alert['id'] ?>" 
                                                data-details="<?= htmlspecialchars(json_encode($alert)) ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs btn-danger delete-alert" data-id="<?= $alert['id'] ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No security alerts found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Details Modal -->
<div class="modal fade" id="alertDetailsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alert Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="20%">Alert Type</th>
                            <td id="modal-alert-type"></td>
                        </tr>
                        <tr>
                            <th>Severity</th>
                            <td id="modal-severity"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td id="modal-description"></td>
                        </tr>
                        <tr>
                            <th>IP Address</th>
                            <td id="modal-ip"></td>
                        </tr>
                        <tr>
                            <th>Date/Time</th>
                            <td id="modal-datetime"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td id="modal-status"></td>
                        </tr>
                        <tr id="details-row">
                            <th>Details</th>
                            <td>
                                <pre id="modal-details" class="p-2 bg-light" style="max-height: 300px; overflow-y: auto;"></pre>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    // Mark alert as read
    $('.mark-read').on('click', function() {
        const alertId = $(this).data('id');
        $.ajax({
            url: '<?= base_url('security/alerts/mark_read') ?>',
            type: 'POST',
            data: { alert_id: alertId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Update UI
                    const row = $('tr[data-alert-id="' + alertId + '"]');
                    row.removeClass('font-weight-bold');
                    row.find('td:eq(6) span').removeClass('badge-danger').addClass('badge-secondary').text('Read');
                    row.find('.mark-read').remove();
                    
                    // Show toast notification
                    toastr.success('Alert marked as read');
                    
                    // Update counts
                    updateAlertCounts();
                } else {
                    toastr.error(response.message || 'Failed to mark alert as read');
                }
            },
            error: function() {
                toastr.error('An error occurred. Please try again.');
            }
        });
    });
    
    // Mark all as read
    $('#mark-all-read').on('click', function() {
        if (confirm('Are you sure you want to mark all alerts as read?')) {
            $.ajax({
                url: '<?= base_url('security/alerts/mark_all_read') ?>',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Update UI
                        $('tr.font-weight-bold').removeClass('font-weight-bold');
                        $('td span.badge-danger').removeClass('badge-danger').addClass('badge-secondary').text('Read');
                        $('.mark-read').remove();
                        
                        // Show toast notification
                        toastr.success('All alerts marked as read');
                        
                        // Update counts
                        updateAlertCounts();
                    } else {
                        toastr.error(response.message || 'Failed to mark all alerts as read');
                    }
                },
                error: function() {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }
    });
    
    // Delete alert
    $('.delete-alert').on('click', function() {
        const alertId = $(this).data('id');
        if (confirm('Are you sure you want to delete this alert?')) {
            $.ajax({
                url: '<?= base_url('security/alerts/delete') ?>',
                type: 'POST',
                data: { alert_id: alertId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Remove row from table
                        $('tr[data-alert-id="' + alertId + '"]').fadeOut(function() {
                            $(this).remove();
                            
                            // If no more rows, add empty message
                            if ($('table tbody tr').length === 0) {
                                $('table tbody').append('<tr><td colspan="8" class="text-center">No security alerts found</td></tr>');
                            }
                        });
                        
                        // Show toast notification
                        toastr.success('Alert deleted successfully');
                        
                        // Update counts
                        updateAlertCounts();
                    } else {
                        toastr.error(response.message || 'Failed to delete alert');
                    }
                },
                error: function() {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }
    });
    
    // View alert details
    $('.view-details').on('click', function() {
        const alertDetails = JSON.parse($(this).data('details'));
        const modal = $('#alertDetailsModal');
        
        // Fill in the details
        modal.find('#modal-alert-type').text(alertDetails.alert_type ? 
            '<?= json_encode($alert_types) ?>'[alertDetails.alert_type] || alertDetails.alert_type : 'Unknown');
        
        const severityBadge = `<span class="badge 
            ${alertDetails.severity === 'critical' ? 'badge-danger' : ''} 
            ${alertDetails.severity === 'high' ? 'badge-warning' : ''} 
            ${alertDetails.severity === 'medium' ? 'badge-info' : ''} 
            ${alertDetails.severity === 'low' ? 'badge-success' : ''}">
            ${alertDetails.severity ? alertDetails.severity.charAt(0).toUpperCase() + alertDetails.severity.slice(1) : 'Unknown'}
        </span>`;
        modal.find('#modal-severity').html(severityBadge);
        
        modal.find('#modal-description').text(alertDetails.description || 'No description available');
        modal.find('#modal-ip').text(alertDetails.ip_address || 'Not available');
        modal.find('#modal-datetime').text(alertDetails.created_at || 'Unknown');
        
        const statusBadge = `<span class="badge 
            ${alertDetails.status === 'unread' ? 'badge-danger' : 'badge-secondary'}">
            ${alertDetails.status ? alertDetails.status.charAt(0).toUpperCase() + alertDetails.status.slice(1) : 'Unknown'}
        </span>`;
        modal.find('#modal-status').html(statusBadge);
        
        // Show/hide details section based on if details exist
        if (alertDetails.details) {
            modal.find('#details-row').show();
            modal.find('#modal-details').text(alertDetails.details);
        } else {
            modal.find('#details-row').hide();
        }
        
        // Show the modal
        modal.modal('show');
    });
    
    // Helper function to update alert counts via AJAX
    function updateAlertCounts() {
        $.ajax({
            url: '<?= base_url('security/alerts/filter') ?>',
            type: 'GET',
            data: $('#filter-form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.counts) {
                    $('.small-box:eq(0) h3').text(response.counts.critical || 0);
                    $('.small-box:eq(1) h3').text(response.counts.high || 0);
                    $('.small-box:eq(2) h3').text(response.counts.medium || 0);
                    $('.small-box:eq(3) h3').text(response.counts.low || 0);
                }
            }
        });
    }
});
</script> 