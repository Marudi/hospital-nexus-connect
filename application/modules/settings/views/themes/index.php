<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo lang('themes'); ?>
            <small><?php echo lang('manage_themes'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard'); ?></a></li>
            <li><a href="<?php echo site_url('admin/settings'); ?>"><?php echo lang('settings'); ?></a></li>
            <li class="active"><?php echo lang('themes'); ?></li>
        </ol>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('message')): ?>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php endif; ?>
        
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo lang('available_themes'); ?></h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('admin/settings/themes/install'); ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> <?php echo lang('install_theme'); ?>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php if(empty($themes)): ?>
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <?php echo lang('no_themes_found'); ?>
                        </div>
                    </div>
                    <?php else: ?>
                        <?php foreach($themes as $theme): ?>
                        <div class="col-md-4">
                            <div class="theme-box">
                                <div class="theme-preview">
                                    <img src="<?php echo $theme['preview_image']; ?>" alt="<?php echo $theme['name']; ?>" class="img-responsive">
                                    <?php if($active_theme['id'] == $theme['id']): ?>
                                    <div class="active-badge">
                                        <span class="label label-success"><?php echo lang('active'); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="theme-info">
                                    <h4><?php echo $theme['name']; ?> <small>v<?php echo $theme['version']; ?></small></h4>
                                    <p><?php echo $theme['description']; ?></p>
                                    <p class="text-muted"><?php echo lang('author'); ?>: <?php echo $theme['author']; ?></p>
                                </div>
                                <div class="theme-actions">
                                    <?php if($active_theme['id'] != $theme['id']): ?>
                                    <a href="<?php echo site_url('admin/settings/themes/activate/' . $theme['id']); ?>" class="btn btn-primary btn-sm">
                                        <i class="fa fa-check"></i> <?php echo lang('activate'); ?>
                                    </a>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo site_url('admin/settings/themes/preview/' . $theme['id']); ?>" class="btn btn-info btn-sm" target="_blank">
                                        <i class="fa fa-eye"></i> <?php echo lang('preview'); ?>
                                    </a>
                                    
                                    <?php if($theme['customizable']): ?>
                                    <a href="<?php echo site_url('admin/settings/themes/customize/' . $theme['id']); ?>" class="btn btn-default btn-sm">
                                        <i class="fa fa-paint-brush"></i> <?php echo lang('customize'); ?>
                                    </a>
                                    <?php endif; ?>
                                    
                                    <?php if($active_theme['id'] != $theme['id'] && $theme['id'] !== 'default'): ?>
                                    <a href="<?php echo site_url('admin/settings/themes/delete/' . $theme['id']); ?>" class="btn btn-danger btn-sm delete-theme">
                                        <i class="fa fa-trash"></i> <?php echo lang('delete'); ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.theme-box {
    border: 1px solid #ddd;
    margin-bottom: 20px;
    background: #fff;
    border-radius: 3px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.theme-preview {
    position: relative;
    height: 200px;
    overflow: hidden;
    border-bottom: 1px solid #eee;
}
.theme-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.active-badge {
    position: absolute;
    top: 10px;
    right: 10px;
}
.theme-info {
    padding: 15px;
    min-height: 120px;
}
.theme-info h4 {
    margin-top: 0;
}
.theme-actions {
    padding: 10px 15px;
    border-top: 1px solid #eee;
    background: #f9f9f9;
    text-align: center;
}
.theme-actions .btn {
    margin: 0 2px;
}
</style>

<script>
$(document).ready(function() {
    $('.delete-theme').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        if(confirm('<?php echo lang('confirm_delete_theme'); ?>')) {
            window.location.href = url;
        }
    });
});
</script> 