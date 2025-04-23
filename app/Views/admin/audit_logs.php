<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Audit Logs<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Audit Logs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Audit Logs</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-1"></i>
            Filter Logs
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/audit-logs') ?>" method="get">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="event_type" class="form-label">Event Type</label>
                        <select name="event_type" id="event_type" class="form-select">
                            <option value="">All Event Types</option>
                            <?php foreach ($eventTypes as $type): ?>
                            <option value="<?= $type['event_type'] ?>" <?= ($type['event_type'] === $_GET['event_type'] ?? '') ? 'selected' : '' ?>>
                                <?= $type['event_type'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">All Users</option>
                            <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>" <?= ($user['id'] == ($_GET['user_id'] ?? '')) ? 'selected' : '' ?>>
                                <?= $user['username'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Date From</label>
                        <input type="date" class="form-control" id="date_from" name="date_from" value="<?= $_GET['date_from'] ?? '' ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="date_to" class="form-label">Date To</label>
                        <input type="date" class="form-control" id="date_to" name="date_to" value="<?= $_GET['date_to'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="resource_id" class="form-label">Resource ID</label>
                        <input type="text" class="form-control" id="resource_id" name="resource_id" value="<?= $_GET['resource_id'] ?? '' ?>">
                    </div>
                    <div class="col-md-9 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                        <a href="<?= site_url('admin/audit-logs') ?>" class="btn btn-secondary me-2">Reset</a>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Export
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                <li><a class="dropdown-item" href="<?= site_url('admin/export-audit-logs?' . http_build_query($_GET) . '&format=csv') ?>">CSV</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('admin/export-audit-logs?' . http_build_query($_GET) . '&format=pdf') ?>">PDF</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('admin/export-audit-logs?' . http_build_query($_GET) . '&format=json') ?>">JSON</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Audit Log Records
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="auditLogTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Type</th>
                            <th>Resource</th>
                            <th>User</th>
                            <th>IP Address</th>
                            <th>Timestamp</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= $log['id'] ?></td>
                            <td><?= $log['event_type'] ?></td>
                            <td><?= $log['resource_id'] ?></td>
                            <td>
                                <?php 
                                foreach ($users as $user) {
                                    if ($user['id'] == $log['user_id']) {
                                        echo $user['username'];
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $log['ip_address'] ?></td>
                            <td><?= $log['timestamp'] ?></td>
                            <td>
                                <?php 
                                $details = json_decode($log['details'], true);
                                if (is_array($details)) {
                                    echo '<pre class="small">' . json_encode($details, JSON_PRETTY_PRINT) . '</pre>';
                                } else {
                                    echo $log['details'];
                                }
                                ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#logModal<?= $log['id'] ?>">
                                    View
                                </button>
                                <!-- Button to verify log integrity -->
                                <a href="<?= site_url('admin/verify-log/' . $log['id']) ?>" class="btn btn-sm btn-secondary">Verify</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <?= $pager->links() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal for viewing log details -->
<?php foreach ($logs as $log): ?>
<div class="modal fade" id="logModal<?= $log['id'] ?>" tabindex="-1" aria-labelledby="logModalLabel<?= $log['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logModalLabel<?= $log['id'] ?>">Log Entry #<?= $log['id'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-4"><strong>Event Type:</strong></div>
                    <div class="col-8"><?= $log['event_type'] ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4"><strong>Resource ID:</strong></div>
                    <div class="col-8"><?= $log['resource_id'] ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4"><strong>User:</strong></div>
                    <div class="col-8">
                        <?php 
                        foreach ($users as $user) {
                            if ($user['id'] == $log['user_id']) {
                                echo $user['username'];
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4"><strong>IP Address:</strong></div>
                    <div class="col-8"><?= $log['ip_address'] ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4"><strong>User Agent:</strong></div>
                    <div class="col-8"><?= $log['user_agent'] ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4"><strong>Timestamp:</strong></div>
                    <div class="col-8"><?= $log['timestamp'] ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-12"><strong>Details:</strong></div>
                    <div class="col-12">
                        <?php 
                        $details = json_decode($log['details'], true);
                        if (is_array($details)) {
                            echo '<pre class="small">' . json_encode($details, JSON_PRETTY_PRINT) . '</pre>';
                        } else {
                            echo $log['details'];
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize DataTable (optional)
        $('#auditLogTable').DataTable({
            paging: false, // We're using CI pagination
            searching: false // We're using our own filters
        });
    });
</script>
<?= $this->endSection() ?> 