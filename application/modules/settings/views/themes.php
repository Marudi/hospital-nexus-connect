<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo lang('themes'); ?>
            <small><?php echo lang('manage_themes'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard'); ?></a></li>
            <li><a href="<?php echo site_url('settings'); ?>"><?php echo lang('settings'); ?></a></li>
            <li class="active"><?php echo lang('themes'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($this->session->flashdata('message')): ?>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php endif; ?>
        
        <!-- Active Theme Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo lang('active_theme'); ?></h3>
            </div>
            <div class="box-body">
                <?php if(isset($active_theme) && !empty($active_theme)): ?>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <img src="<?php echo $active_theme['thumbnail']; ?>" class="img-responsive" style="max-height: 180px; margin: 0 auto; border: 1px solid #eee;">
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <h3><?php echo $active_theme['name']; ?> <span class="label label-success"><?php echo lang('active'); ?></span></h3>
                        <p class="text-muted"><?php echo $active_theme['description']; ?></p>
                        <p><strong><?php echo lang('version'); ?>:</strong> <?php echo $active_theme['version']; ?></p>
                        <p><strong><?php echo lang('author'); ?>:</strong> <?php echo $active_theme['author']; ?></p>
                        
                        <div class="theme-actions">
                            <?php if(isset($active_theme['has_config']) && $active_theme['has_config']): ?>
                            <a href="<?php echo site_url('settings/themes/customize/'.$active_theme['id']); ?>" class="btn btn-primary">
                                <i class="fa fa-sliders"></i> <?php echo lang('customize'); ?>
                            </a>
                            <?php endif; ?>
                            
                            <a href="<?php echo site_url('settings/themes/preview/'.$active_theme['id']); ?>" class="btn btn-default" target="_blank">
                                <i class="fa fa-eye"></i> <?php echo lang('preview'); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="callout callout-warning">
                    <h4><?php echo lang('no_active_theme'); ?></h4>
                    <p><?php echo lang('no_active_theme_message'); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.Active Theme Box -->
        
        <!-- Available Themes Box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo lang('available_themes'); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadThemeModal">
                        <i class="fa fa-upload"></i> <?php echo lang('upload_theme'); ?>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <?php if(isset($themes) && !empty($themes)): ?>
                <div class="row">
                    <?php foreach($themes as $theme): ?>
                    <?php if($theme['id'] != $active_theme['id']): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="theme-item">
                            <div class="theme-thumbnail">
                                <img src="<?php echo $theme['thumbnail']; ?>" class="img-responsive" style="max-height: 150px; margin: 0 auto; border: 1px solid #eee;">
                            </div>
                            <div class="theme-details">
                                <h4><?php echo $theme['name']; ?></h4>
                                <p class="text-muted theme-description"><?php echo $theme['description']; ?></p>
                                <p><small><strong><?php echo lang('version'); ?>:</strong> <?php echo $theme['version']; ?> | <strong><?php echo lang('author'); ?>:</strong> <?php echo $theme['author']; ?></small></p>
                                
                                <div class="theme-actions">
                                    <a href="<?php echo site_url('settings/themes/activate/'.$theme['id']); ?>" class="btn btn-primary btn-sm theme-activate">
                                        <i class="fa fa-check"></i> <?php echo lang('activate'); ?>
                                    </a>
                                    
                                    <a href="<?php echo site_url('settings/themes/preview/'.$theme['id']); ?>" class="btn btn-default btn-sm" target="_blank">
                                        <i class="fa fa-eye"></i> <?php echo lang('preview'); ?>
                                    </a>
                                    
                                    <?php if($theme['id'] != 'default'): ?>
                                    <a href="<?php echo site_url('settings/themes/delete/'.$theme['id']); ?>" class="btn btn-danger btn-sm theme-delete pull-right">
                                        <i class="fa fa-trash"></i> <?php echo lang('delete'); ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="callout callout-info">
                    <h4><?php echo lang('no_themes_available'); ?></h4>
                    <p><?php echo lang('no_themes_available_message'); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.Available Themes Box -->
    </section>
    <!-- /.content -->
</div>

<!-- Theme Upload Modal -->
<div class="modal fade" id="uploadThemeModal" tabindex="-1" role="dialog" aria-labelledby="uploadThemeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="uploadThemeModalLabel"><?php echo lang('upload_theme'); ?></h4>
            </div>
            <?php echo form_open_multipart('settings/themes/upload', array('id' => 'uploadThemeForm')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="themeZip"><?php echo lang('theme_zip_file'); ?></label>
                    <input type="file" id="themeZip" name="theme_file" accept=".zip" required>
                    <p class="help-block"><?php echo lang('theme_zip_help'); ?></p>
                </div>
                <div id="uploadResponse"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('cancel'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo lang('upload'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<style>
    .theme-item {
        border: 1px solid #eee;
        margin-bottom: 20px;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .theme-thumbnail {
        padding: 10px;
        background: #f9f9f9;
        text-align: center;
        min-height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .theme-details {
        padding: 15px;
    }
    .theme-description {
        min-height: 40px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .theme-actions {
        margin-top: 10px;
    }
</style>

<script>
$(function() {
    // Theme activation via AJAX
    $('.theme-activate').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var themeItem = $(this).closest('.theme-item');
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.status == 'success') {
                    // Reload page to show new active theme
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('<?php echo lang('error_activating_theme'); ?>');
            }
        });
    });
    
    // Theme deletion via AJAX
    $('.theme-delete').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var themeItem = $(this).closest('.theme-item');
        
        if(confirm('<?php echo lang('confirm_delete_theme'); ?>')) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response.status == 'success') {
                        themeItem.closest('.col-md-4').fadeOut(500, function() {
                            $(this).remove();
                        });
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('<?php echo lang('error_deleting_theme'); ?>');
                }
            });
        }
    });
    
    // Theme upload via AJAX
    $('#uploadThemeForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#uploadResponse').html('<div class="alert alert-info"><i class="fa fa-spinner fa-spin"></i> <?php echo lang('uploading_theme'); ?></div>');
            },
            success: function(response) {
                if(response.status == 'success') {
                    $('#uploadResponse').html('<div class="alert alert-success">' + response.message + '</div>');
                    // Reload page after 2 seconds
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    $('#uploadResponse').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                $('#uploadResponse').html('<div class="alert alert-danger"><?php echo lang('error_uploading_theme'); ?></div>');
            }
        });
    });
});
</script> 