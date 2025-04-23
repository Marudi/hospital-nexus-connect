<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Security Alerts<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Security Alerts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Security Alerts</li>
    </ol>
    
    <?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-1"></i>
            Filter Alerts
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/security-alerts') ?>" method="get">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="alert_type" class="form-label">Alert Type</label>
                        <select name="alert_type" id="alert_type" class="form-select">
                            <option value="">All Alert Types</option>
                            <?php foreach ($alertTypes as $type): ?>
                            <option value="<?= $type['alert_type'] ?>" <?= ($type['alert_type'] === $_GET['alert_type'] ?? '') ? 'selected' : '' ?>>
                                <?= $type['alert_type'] ?>
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
                        <label for="resolved" class="form-label">Status</label>
                        <select name="resolved" id="resolved" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="0" <?= (isset($_GET['resolved']) && $_GET['resolved'] === '0') ? 'selected' : '' ?>>Unresolved</option>
                            <option value="1" <?= (isset($_GET['resolved']) && $_GET['resolved'] === '1') ? 'selected' : '' ?>>Resolved</option>
                        </select>
                    </div>
                    <div class="col-md-9 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                        <a href="<?= site_url('admin/security-alerts') ?>" class="btn btn-secondary me-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-exclamation-triangle me-1"></i>
            Security Alert Records
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="alertsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Alert Type</th>
                            <th>User</th>
                            <th>Timestamp</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alerts as $alert): ?>
                        <tr class="<?= $alert['resolved'] ? 'table-success' : 'table-danger' ?>">
                            <td><?= $alert['id'] ?></td>
                            <td><?= $alert['alert_type'] ?></td>
                            <td>
                                <?php 
                                foreach ($users as $user) {
                                    if ($user['id'] == $alert['user_id']) {
                                        echo $user['username'];
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $alert['timestamp'] ?></td>
                            <td><?= $alert['resolved'] ? '<span class="badge bg-success">Resolved</span>' : '<span class="badge bg-danger">Unresolved</span>' ?></td>
                            <td>
                                <?php 
                                $details = json_decode($alert['details'], true);
                                if (is_array($details)) {
                                    echo '<pre class="small">' . json_encode($details, JSON_PRETTY_PRINT) . '</pre>';
                                } else {
                                    echo $alert['details'];
                                }
                                ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#alertModal<?= $alert['id'] ?>">
                                    View
                                </button>
                                <?php if (!$alert['resolved']): ?>
                                <a href="<?= site_url('admin/resolve-alert/' . $alert['id']) ?>" class="btn btn-sm btn-warning">Resolve</a>
                                <?php endif; ?>
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

<!-- Modal for viewing alert details -->
<?php foreach ($alerts as $alert): ?>
<div class="modal fade" id="alertModal<?= $alert['id'] ?>" tabindex="-1" aria-labelledby="alertModalLabel<?= $alert['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel<?= $alert['id'] ?>">Alert #<?= $alert['id'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-4"><strong>Alert Type:</strong></div>
                    <div class="col-8"><?= $alert['alert_type'] ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4"><strong>User:</strong></div>
                    <div class="col-8">
                        <?php 
                        foreach ($users as $user) {
                            if ($user['id'] == $alert['user_id']) {
                                echo $user['username'];
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4"><strong>Timestamp:</strong></div>
                    <div class="col-8"><?= $alert['timestamp'] ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4"><strong>Status:</strong></div>
                    <div class="col-8">
                        <?= $alert['resolved'] ? '<span class="badge bg-success">Resolved</span>' : '<span class="badge bg-danger">Unresolved</span>' ?>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12"><strong>Details:</strong></div>
                    <div class="col-12">
                        <?php 
                        $details = json_decode($alert['details'], true);
                        if (is_array($details)) {
                            echo '<pre class="small">' . json_encode($details, JSON_PRETTY_PRINT) . '</pre>';
                        } else {
                            echo $alert['details'];
                        }
                        ?>
                    </div>
                </div>
                <?php if ($alert['resolved']): ?>
                <div class="row mb-2">
                    <div class="col-4"><strong>Resolved By:</strong></div>
                    <div class="col-8">
                        <?php 
                        foreach ($users as $user) {
                            if ($user['id'] == $alert['resolved_by']) {
                                echo $user['username'];
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4"><strong>Resolution Notes:</strong></div>
                    <div class="col-8"><?= $alert['resolution_notes'] ?></div>
                </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <?php if (!$alert['resolved']): ?>
                <a href="<?= site_url('admin/resolve-alert/' . $alert['id']) ?>" class="btn btn-warning">Resolve</a>
                <?php endif; ?>
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
        $('#alertsTable').DataTable({
            paging: false, // We're using CI pagination
            searching: false // We're using our own filters
        });
    });
</script>
<?= $this->endSection() ?> 