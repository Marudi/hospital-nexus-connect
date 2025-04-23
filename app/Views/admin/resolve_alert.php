<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Resolve Security Alert<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Resolve Security Alert</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('admin/security-alerts') ?>">Security Alerts</a></li>
        <li class="breadcrumb-item active">Resolve Alert #<?= $alert['id'] ?></li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-exclamation-triangle me-1"></i>
            Alert Details
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-2">
                        <strong>Alert ID:</strong> <?= $alert['id'] ?>
                    </div>
                    <div class="mb-2">
                        <strong>Alert Type:</strong> <?= $alert['alert_type'] ?>
                    </div>
                    <div class="mb-2">
                        <strong>User ID:</strong> <?= $alert['user_id'] ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <strong>Timestamp:</strong> <?= $alert['timestamp'] ?>
                    </div>
                    <div class="mb-2">
                        <strong>Status:</strong> <span class="badge bg-danger">Unresolved</span>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <strong>Details:</strong>
                    <pre class="mt-2 p-2 border rounded bg-light"><?php 
                    $details = json_decode($alert['details'], true);
                    echo json_encode($details, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    ?></pre>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-check-circle me-1"></i>
            Resolve Alert
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/resolve-alert/' . $alert['id']) ?>" method="post">
                <div class="mb-3">
                    <label for="resolution_notes" class="form-label">Resolution Notes <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="resolution_notes" name="resolution_notes" rows="5" required placeholder="Describe the actions taken to address this security alert..."><?= old('resolution_notes') ?></textarea>
                    <div class="form-text">Please provide detailed information about how this security issue was investigated and resolved.</div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="<?= site_url('admin/security-alerts') ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Resolve Alert</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 