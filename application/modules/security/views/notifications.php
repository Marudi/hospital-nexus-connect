<!-- Security Alerts Dropdown -->
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-shield"></i>
        <?php if ($unread_count > 0): ?>
        <span class="label <?php echo ($critical_count > 0) ? 'label-danger' : (($high_count > 0) ? 'label-warning' : 'label-info'); ?>"><?php echo $unread_count; ?></span>
        <?php endif; ?>
    </a>
    <ul class="dropdown-menu">
        <li class="header">
            <?php if ($unread_count == 0): ?>
                No unread security alerts
            <?php else: ?>
                You have <?php echo $unread_count; ?> unread security alert<?php echo ($unread_count > 1) ? 's' : ''; ?>
                <?php if ($critical_count > 0): ?>
                    <span class="label label-danger"><?php echo $critical_count; ?> critical</span>
                <?php endif; ?>
                <?php if ($high_count > 0): ?>
                    <span class="label label-warning"><?php echo $high_count; ?> high</span>
                <?php endif; ?>
            <?php endif; ?>
        </li>
        <li>
            <ul class="menu">
                <?php if (empty($recent_alerts)): ?>
                    <li>
                        <a href="<?php echo site_url('security/alerts'); ?>">
                            <i class="fa fa-check-circle text-success"></i> No recent security alerts
                        </a>
                    </li>
                <?php else: ?>
                    <?php foreach ($recent_alerts as $alert): ?>
                        <li>
                            <a href="<?php echo site_url('security/alerts/detail/' . $alert['id']); ?>">
                                <i class="fa <?php 
                                    echo ($alert['severity'] == 'critical') ? 'fa-ban text-red' : 
                                        (($alert['severity'] == 'high') ? 'fa-warning text-yellow' : 
                                        (($alert['severity'] == 'medium') ? 'fa-info text-blue' : 'fa-info-circle text-aqua')); 
                                ?>"></i>
                                <span class="text-<?php 
                                    echo ($alert['severity'] == 'critical') ? 'red' : 
                                        (($alert['severity'] == 'high') ? 'yellow' : 
                                        (($alert['severity'] == 'medium') ? 'blue' : 'aqua')); 
                                ?>"><?php echo ucfirst($alert['severity']); ?>:</span>
                                <?php echo substr($alert['message'], 0, 40); ?><?php echo (strlen($alert['message']) > 40) ? '...' : ''; ?>
                                <span class="pull-right text-muted small">
                                    <?php 
                                    $time_diff = time() - strtotime($alert['created_at']);
                                    if ($time_diff < 60) {
                                        echo floor($time_diff) . 's ago';
                                    } elseif ($time_diff < 3600) {
                                        echo floor($time_diff / 60) . 'm ago';
                                    } elseif ($time_diff < 86400) {
                                        echo floor($time_diff / 3600) . 'h ago';
                                    } else {
                                        echo floor($time_diff / 86400) . 'd ago';
                                    }
                                    ?>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </li>
        <li class="footer">
            <div class="row">
                <div class="col-xs-6">
                    <a href="<?php echo site_url('security/alerts'); ?>">View All</a>
                </div>
                <?php if ($unread_count > 0): ?>
                <div class="col-xs-6 text-right">
                    <a href="<?php echo site_url('security/alerts/mark_all_read'); ?>" 
                       onclick="return confirm('Are you sure you want to mark all alerts as read?');">
                        Mark All Read
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </li>
    </ul>
</li> 