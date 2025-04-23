<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0"><?php echo lang('audit_logs'); ?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('audit_logs'); ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <?php if($this->session->flashdata('feedback')): ?>
        <div class="alert alert-<?php echo $this->session->flashdata('feedback_type'); ?> alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('feedback'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate"><?php echo lang('total_logs'); ?></span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="<?php echo $total_logs; ?>"><?php echo $total_logs; ?></span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <i class="bx bx-list-ul text-primary display-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate"><?php echo lang('today_logs'); ?></span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="<?php echo $today_logs; ?>"><?php echo $today_logs; ?></span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <i class="bx bx-calendar-check text-success display-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate"><?php echo lang('critical_events'); ?></span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="<?php echo $critical_logs; ?>"><?php echo $critical_logs; ?></span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <i class="bx bx-error-circle text-danger display-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate"><?php echo lang('quick_actions'); ?></span>
                                <div class="mt-2">
                                    <a href="<?php echo site_url('logs/exportAuditLogs'); ?>" class="btn btn-primary btn-sm me-1"><i class="mdi mdi-download me-1"></i><?php echo lang('export'); ?></a>
                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal"><i class="mdi mdi-filter me-1"></i><?php echo lang('filter'); ?></a>
                                </div>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <i class="bx bx-cog text-secondary display-6"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Stats Cards -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo lang('audit_logs'); ?></h4>
                        <p class="card-title-desc"><?php echo lang('comprehensive_audit_trail'); ?></p>
                    </div>
                    <div class="card-body">
                        <!-- Filter form for smaller screens (collapse) -->
                        <div class="d-block d-md-none mb-3">
                            <button class="btn btn-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                                <i class="mdi mdi-filter me-1"></i> <?php echo lang('show_filters'); ?>
                            </button>
                            <div class="collapse mt-2" id="filterCollapse">
                                <div class="card card-body">
                                    <form action="" method="get" class="row g-3">
                                        <div class="col-12">
                                            <label for="event_type" class="form-label"><?php echo lang('event_type'); ?></label>
                                            <select name="event_type" id="event_type_sm" class="form-select">
                                                <option value=""><?php echo lang('all_events'); ?></option>
                                                <?php foreach($eventTypes as $type): ?>
                                                <option value="<?php echo $type['event']; ?>" <?php echo ($this->input->get('event_type') == $type['event']) ? 'selected' : ''; ?>><?php echo $type['event']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="user_id" class="form-label"><?php echo lang('user'); ?></label>
                                            <select name="user_id" id="user_id_sm" class="form-select">
                                                <option value=""><?php echo lang('all_users'); ?></option>
                                                <?php foreach($users as $user): ?>
                                                <option value="<?php echo $user['id']; ?>" <?php echo ($this->input->get('user_id') == $user['id']) ? 'selected' : ''; ?>><?php echo $user['username']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="date_from" class="form-label"><?php echo lang('date_from'); ?></label>
                                            <input type="date" class="form-control" id="date_from_sm" name="date_from" value="<?php echo $this->input->get('date_from'); ?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="date_to" class="form-label"><?php echo lang('date_to'); ?></label>
                                            <input type="date" class="form-control" id="date_to_sm" name="date_to" value="<?php echo $this->input->get('date_to'); ?>">
                                        </div>
                                        <div class="col-12">
                                            <label for="ip_address" class="form-label"><?php echo lang('ip_address'); ?></label>
                                            <input type="text" class="form-control" id="ip_address_sm" name="ip_address" value="<?php echo $this->input->get('ip_address'); ?>" placeholder="e.g. 192.168.1.1">
                                        </div>
                                        <div class="col-12">
                                            <label for="resource_id" class="form-label"><?php echo lang('resource_id'); ?></label>
                                            <input type="text" class="form-control" id="resource_id_sm" name="resource_id" value="<?php echo $this->input->get('resource_id'); ?>" placeholder="e.g. patient_123">
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary"><?php echo lang('apply_filters'); ?></button>
                                            <a href="<?php echo site_url('logs/auditLogs'); ?>" class="btn btn-secondary"><?php echo lang('reset'); ?></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End filter form for smaller screens -->

                        <div class="table-responsive">
                            <table id="audit-logs-table" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('id'); ?></th>
                                        <th><?php echo lang('timestamp'); ?></th>
                                        <th><?php echo lang('event'); ?></th>
                                        <th><?php echo lang('user'); ?></th>
                                        <th><?php echo lang('ip_address'); ?></th>
                                        <th><?php echo lang('resource'); ?></th>
                                        <th><?php echo lang('details'); ?></th>
                                        <th><?php echo lang('actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($logs as $log): ?>
                                    <tr>
                                        <td><?php echo $log->id; ?></td>
                                        <td><?php echo $log->date_time; ?></td>
                                        <td>
                                            <?php 
                                            $event_class = '';
                                            $critical_events = ['login_failed', 'unauthorized_access', 'permission_denied', 'log_integrity_violation', 'patient_data_access_denied', 'security_alert_created', 'security_policy_violation'];
                                            
                                            if(in_array($log->event, $critical_events)) {
                                                $event_class = 'badge bg-danger';
                                            } elseif(strpos($log->event, 'failed') !== false) {
                                                $event_class = 'badge bg-warning text-dark';
                                            } else {
                                                $event_class = 'badge bg-info';
                                            }
                                            ?>
                                            <span class="<?php echo $event_class; ?>"><?php echo $log->event; ?></span>
                                        </td>
                                        <td>
                                            <?php 
                                            $username = 'Unknown';
                                            foreach($users as $user) {
                                                if($user['id'] == $log->user) {
                                                    $username = $user['username'];
                                                    break;
                                                }
                                            }
                                            echo $username;
                                            ?>
                                        </td>
                                        <td><?php echo $log->ip_address; ?></td>
                                        <td><?php echo $log->resource_id ?? 'N/A'; ?></td>
                                        <td>
                                            <?php 
                                            $details_preview = substr($log->details, 0, 30);
                                            if(strlen($log->details) > 30) {
                                                $details_preview .= '...';
                                            }
                                            echo $details_preview;
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info view-details" data-bs-toggle="modal" data-bs-target="#logDetailsModal" 
                                                data-id="<?php echo $log->id; ?>"
                                                data-timestamp="<?php echo $log->date_time; ?>"
                                                data-event="<?php echo $log->event; ?>"
                                                data-user="<?php echo $username; ?>"
                                                data-ip="<?php echo $log->ip_address; ?>"
                                                data-resource="<?php echo $log->resource_id ?? 'N/A'; ?>"
                                                data-details="<?php echo htmlspecialchars($log->details); ?>"
                                                data-useragent="<?php echo $log->user_agent ?? 'N/A'; ?>"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <a href="<?php echo site_url('logs/verifyLogIntegrity/' . $log->id); ?>" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="<?php echo lang('verify_integrity'); ?>">
                                                <i class="mdi mdi-shield-check"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel"><?php echo lang('filter_logs'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="get" class="row g-3">
                    <div class="col-md-6">
                        <label for="event_type" class="form-label"><?php echo lang('event_type'); ?></label>
                        <select name="event_type" id="event_type" class="form-select">
                            <option value=""><?php echo lang('all_events'); ?></option>
                            <?php foreach($eventTypes as $type): ?>
                            <option value="<?php echo $type['event']; ?>" <?php echo ($this->input->get('event_type') == $type['event']) ? 'selected' : ''; ?>><?php echo $type['event']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="user_id" class="form-label"><?php echo lang('user'); ?></label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value=""><?php echo lang('all_users'); ?></option>
                            <?php foreach($users as $user): ?>
                            <option value="<?php echo $user['id']; ?>" <?php echo ($this->input->get('user_id') == $user['id']) ? 'selected' : ''; ?>><?php echo $user['username']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="date_from" class="form-label"><?php echo lang('date_from'); ?></label>
                        <input type="date" class="form-control" id="date_from" name="date_from" value="<?php echo $this->input->get('date_from'); ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="date_to" class="form-label"><?php echo lang('date_to'); ?></label>
                        <input type="date" class="form-control" id="date_to" name="date_to" value="<?php echo $this->input->get('date_to'); ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="ip_address" class="form-label"><?php echo lang('ip_address'); ?></label>
                        <input type="text" class="form-control" id="ip_address" name="ip_address" value="<?php echo $this->input->get('ip_address'); ?>" placeholder="e.g. 192.168.1.1">
                    </div>
                    <div class="col-md-6">
                        <label for="resource_id" class="form-label"><?php echo lang('resource_id'); ?></label>
                        <input type="text" class="form-control" id="resource_id" name="resource_id" value="<?php echo $this->input->get('resource_id'); ?>" placeholder="e.g. patient_123">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary"><?php echo lang('apply_filters'); ?></button>
                        <a href="<?php echo site_url('logs/auditLogs'); ?>" class="btn btn-secondary"><?php echo lang('reset'); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Log Details Modal -->
<div class="modal fade" id="logDetailsModal" tabindex="-1" aria-labelledby="logDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logDetailsModalLabel"><?php echo lang('log_details'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong><?php echo lang('id'); ?>:</strong> <span id="modal-id"></span></p>
                        <p><strong><?php echo lang('timestamp'); ?>:</strong> <span id="modal-timestamp"></span></p>
                        <p><strong><?php echo lang('event'); ?>:</strong> <span id="modal-event"></span></p>
                        <p><strong><?php echo lang('user'); ?>:</strong> <span id="modal-user"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong><?php echo lang('ip_address'); ?>:</strong> <span id="modal-ip"></span></p>
                        <p><strong><?php echo lang('resource'); ?>:</strong> <span id="modal-resource"></span></p>
                        <p><strong><?php echo lang('user_agent'); ?>:</strong> <span id="modal-useragent"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><strong><?php echo lang('details'); ?>:</strong></p>
                        <pre id="modal-details" class="bg-light p-3 rounded" style="max-height: 200px; overflow-y: auto;"></pre>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang('close'); ?></button>
                <a href="#" id="verify-link" class="btn btn-primary"><?php echo lang('verify_integrity'); ?></a>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#audit-logs-table').DataTable({
            responsive: true,
            "order": [[ 0, "desc" ]],
            "pageLength": 25,
            "language": {
                "emptyTable": "<?php echo lang('no_logs_found'); ?>",
                "search": "<?php echo lang('search'); ?>:",
                "lengthMenu": "<?php echo lang('show'); ?> _MENU_ <?php echo lang('entries'); ?>",
                "info": "<?php echo lang('showing'); ?> _START_ <?php echo lang('to'); ?> _END_ <?php echo lang('of'); ?> _TOTAL_ <?php echo lang('entries'); ?>",
                "paginate": {
                    "first": "<?php echo lang('first'); ?>",
                    "last": "<?php echo lang('last'); ?>",
                    "next": "<?php echo lang('next'); ?>",
                    "previous": "<?php echo lang('previous'); ?>"
                }
            }
        });

        // Show log details in modal
        $('.view-details').click(function() {
            const id = $(this).data('id');
            const timestamp = $(this).data('timestamp');
            const event = $(this).data('event');
            const user = $(this).data('user');
            const ip = $(this).data('ip');
            const resource = $(this).data('resource');
            const details = $(this).data('details');
            const useragent = $(this).data('useragent');

            $('#modal-id').text(id);
            $('#modal-timestamp').text(timestamp);
            $('#modal-event').text(event);
            $('#modal-user').text(user);
            $('#modal-ip').text(ip);
            $('#modal-resource').text(resource);
            $('#modal-details').text(details);
            $('#modal-useragent').text(useragent);
            $('#verify-link').attr('href', '<?php echo site_url('logs/verifyLogIntegrity/'); ?>' + id);
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script> 