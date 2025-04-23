<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-shield"></i> Security Alert Details
                    <div class="pull-right">
                        <a href="<?php echo site_url('security/alerts'); ?>" class="btn btn-xs btn-default">
                            <i class="fa fa-arrow-left"></i> Back to Alerts
                        </a>
                    </div>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-<?php 
                            echo ($alert['severity'] == 'critical') ? 'danger' : 
                                (($alert['severity'] == 'high') ? 'warning' : 
                                (($alert['severity'] == 'medium') ? 'info' : 'success')); 
                        ?>">
                            <h4>
                                <i class="icon fa <?php 
                                    echo ($alert['severity'] == 'critical') ? 'fa-ban' : 
                                        (($alert['severity'] == 'high') ? 'fa-warning' : 
                                        (($alert['severity'] == 'medium') ? 'fa-info' : 'fa-check')); 
                                ?>"></i>
                                <?php echo ucfirst($alert['severity']); ?> Security Alert
                            </h4>
                            <p><?php echo $alert['message']; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Alert Information</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 40%;">Alert ID</th>
                                                    <td><?php echo $alert['id']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alert Type</th>
                                                    <td>
                                                        <?php 
                                                            echo isset($alert_types[$alert['alert_type']]) 
                                                                ? $alert_types[$alert['alert_type']] 
                                                                : $alert['alert_type']; 
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Severity</th>
                                                    <td>
                                                        <span class="label label-<?php 
                                                            echo ($alert['severity'] == 'critical') ? 'danger' : 
                                                                (($alert['severity'] == 'high') ? 'warning' : 
                                                                (($alert['severity'] == 'medium') ? 'primary' : 'info')); 
                                                        ?>">
                                                            <?php echo ucfirst($alert['severity']); ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        <span class="label label-<?php echo ($alert['status'] == 'unread') ? 'primary' : 'default'; ?>">
                                                            <?php echo ucfirst($alert['status']); ?>
                                                        </span>
                                                        <?php if ($alert['status'] == 'unread'): ?>
                                                            <a href="<?php echo site_url('security/alerts/mark_read/'.$alert['id']); ?>" class="btn btn-xs btn-success">
                                                                <i class="fa fa-check"></i> Mark as Read
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 40%;">Created At</th>
                                                    <td><?php echo date('Y-m-d H:i:s', strtotime($alert['created_at'])); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>IP Address</th>
                                                    <td><?php echo $alert['ip_address']; ?></td>
                                                </tr>
                                                <?php if (isset($alert['user_id']) && $alert['user_id']): ?>
                                                <tr>
                                                    <th>User ID</th>
                                                    <td>
                                                        <?php echo $alert['user_id']; ?>
                                                        <?php if (isset($alert['username'])): ?>
                                                            (<?php echo $alert['username']; ?>)
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                                <?php if (isset($alert['user_agent']) && $alert['user_agent']): ?>
                                                <tr>
                                                    <th>User Agent</th>
                                                    <td><?php echo $alert['user_agent']; ?></td>
                                                </tr>
                                                <?php endif; ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if (isset($alert['details']) && $alert['details']): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Additional Details</h3>
                            </div>
                            <div class="box-body">
                                <pre><?php echo $alert['details']; ?></pre>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group">
                            <a href="<?php echo site_url('security/alerts'); ?>" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Back to Alerts
                            </a>
                            <?php if ($alert['status'] == 'unread'): ?>
                            <a href="<?php echo site_url('security/alerts/mark_read/'.$alert['id']); ?>" class="btn btn-success">
                                <i class="fa fa-check"></i> Mark as Read
                            </a>
                            <?php endif; ?>
                            <a href="<?php echo site_url('security/alerts/delete/'.$alert['id']); ?>" class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this alert?');">
                                <i class="fa fa-trash"></i> Delete Alert
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 