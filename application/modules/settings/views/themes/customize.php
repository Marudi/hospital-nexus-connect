<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo lang('customize_theme'); ?>
            <small><?php echo $theme['name']; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard'); ?></a></li>
            <li><a href="<?php echo site_url('admin/settings'); ?>"><?php echo lang('settings'); ?></a></li>
            <li><a href="<?php echo site_url('admin/settings/themes'); ?>"><?php echo lang('themes'); ?></a></li>
            <li class="active"><?php echo lang('customize'); ?></li>
        </ol>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('message')): ?>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo lang('theme_options'); ?></h3>
                    </div>
                    <form action="<?php echo site_url('admin/settings/themes/save_settings/' . $theme['id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if(empty($theme_options)): ?>
                            <div class="alert alert-info">
                                <?php echo lang('no_customization_options'); ?>
                            </div>
                            <?php else: ?>
                                <?php foreach($theme_options as $section => $options): ?>
                                <div class="theme-section">
                                    <h4 class="section-title"><?php echo $section; ?></h4>
                                    <hr>
                                    
                                    <?php foreach($options as $option): ?>
                                    <div class="form-group">
                                        <label><?php echo $option['label']; ?></label>
                                        <?php if(isset($option['description'])): ?>
                                        <p class="help-block"><?php echo $option['description']; ?></p>
                                        <?php endif; ?>
                                        
                                        <?php switch($option['type']): 
                                            case 'text': ?>
                                                <input type="text" class="form-control" name="theme_options[<?php echo $option['id']; ?>]" value="<?php echo set_value('theme_options[' . $option['id'] . ']', isset($theme_settings[$option['id']]) ? $theme_settings[$option['id']] : $option['default']); ?>">
                                            <?php break; ?>
                                            
                                            <?php case 'textarea': ?>
                                                <textarea class="form-control" rows="3" name="theme_options[<?php echo $option['id']; ?>]"><?php echo set_value('theme_options[' . $option['id'] . ']', isset($theme_settings[$option['id']]) ? $theme_settings[$option['id']] : $option['default']); ?></textarea>
                                            <?php break; ?>
                                            
                                            <?php case 'select': ?>
                                                <select class="form-control" name="theme_options[<?php echo $option['id']; ?>]">
                                                    <?php foreach($option['choices'] as $value => $label): ?>
                                                    <option value="<?php echo $value; ?>" <?php echo set_select('theme_options[' . $option['id'] . ']', $value, (isset($theme_settings[$option['id']]) ? $theme_settings[$option['id']] : $option['default']) == $value); ?>><?php echo $label; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php break; ?>
                                            
                                            <?php case 'color': ?>
                                                <div class="input-group my-colorpicker2">
                                                    <input type="text" class="form-control" name="theme_options[<?php echo $option['id']; ?>]" value="<?php echo set_value('theme_options[' . $option['id'] . ']', isset($theme_settings[$option['id']]) ? $theme_settings[$option['id']] : $option['default']); ?>">
                                                    <div class="input-group-addon">
                                                        <i></i>
                                                    </div>
                                                </div>
                                            <?php break; ?>
                                            
                                            <?php case 'image': ?>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="theme_options[<?php echo $option['id']; ?>]" value="<?php echo set_value('theme_options[' . $option['id'] . ']', isset($theme_settings[$option['id']]) ? $theme_settings[$option['id']] : $option['default']); ?>" id="image-<?php echo $option['id']; ?>">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-flat" onclick="browseImages('image-<?php echo $option['id']; ?>')">
                                                            <i class="fa fa-picture-o"></i> <?php echo lang('browse'); ?>
                                                        </button>
                                                    </span>
                                                </div>
                                                <?php if(isset($theme_settings[$option['id']]) && !empty($theme_settings[$option['id']])): ?>
                                                <div class="image-preview mt-2">
                                                    <img src="<?php echo $theme_settings[$option['id']]; ?>" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                                                </div>
                                                <?php endif; ?>
                                            <?php break; ?>
                                            
                                            <?php case 'checkbox': ?>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="theme_options[<?php echo $option['id']; ?>]" value="1" <?php echo set_checkbox('theme_options[' . $option['id'] . ']', '1', (isset($theme_settings[$option['id']]) ? $theme_settings[$option['id']] : $option['default']) == 1); ?>>
                                                        <?php echo $option['checkbox_label']; ?>
                                                    </label>
                                                </div>
                                            <?php break; ?>
                                            
                                            <?php case 'number': ?>
                                                <input type="number" class="form-control" name="theme_options[<?php echo $option['id']; ?>]" value="<?php echo set_value('theme_options[' . $option['id'] . ']', isset($theme_settings[$option['id']]) ? $theme_settings[$option['id']] : $option['default']); ?>" <?php echo isset($option['min']) ? 'min="' . $option['min'] . '"' : ''; ?> <?php echo isset($option['max']) ? 'max="' . $option['max'] . '"' : ''; ?> <?php echo isset($option['step']) ? 'step="' . $option['step'] . '"' : ''; ?>>
                                            <?php break; ?>
                                            
                                            <?php case 'custom_css': ?>
                                                <textarea class="form-control code-editor" rows="10" name="theme_options[<?php echo $option['id']; ?>]" data-mode="css"><?php echo set_value('theme_options[' . $option['id'] . ']', isset($theme_settings[$option['id']]) ? $theme_settings[$option['id']] : $option['default']); ?></textarea>
                                            <?php break; ?>
                                            
                                            <?php case 'custom_js': ?>
                                                <textarea class="form-control code-editor" rows="10" name="theme_options[<?php echo $option['id']; ?>]" data-mode="javascript"><?php echo set_value('theme_options[' . $option['id'] . ']', isset($theme_settings[$option['id']]) ? $theme_settings[$option['id']] : $option['default']); ?></textarea>
                                            <?php break; ?>
                                            
                                        <?php endswitch; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> <?php echo lang('save_changes'); ?>
                            </button>
                            <a href="<?php echo site_url('admin/settings/themes/reset_settings/' . $theme['id']); ?>" class="btn btn-warning">
                                <i class="fa fa-refresh"></i> <?php echo lang('reset_to_defaults'); ?>
                            </a>
                            <a href="<?php echo site_url('admin/settings/themes'); ?>" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> <?php echo lang('back'); ?>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo lang('theme_information'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="theme-preview text-center">
                            <img src="<?php echo $theme['preview_image']; ?>" alt="<?php echo $theme['name']; ?>" class="img-responsive">
                        </div>
                        <hr>
                        <h4><?php echo $theme['name']; ?> <small>v<?php echo $theme['version']; ?></small></h4>
                        <p><?php echo $theme['description']; ?></p>
                        <p><strong><?php echo lang('author'); ?>:</strong> <?php echo $theme['author']; ?></p>
                        <?php if(isset($theme['website'])): ?>
                        <p><strong><?php echo lang('website'); ?>:</strong> <a href="<?php echo $theme['website']; ?>" target="_blank"><?php echo $theme['website']; ?></a></p>
                        <?php endif; ?>
                        
                        <a href="<?php echo site_url('admin/settings/themes/preview/' . $theme['id']); ?>" class="btn btn-info btn-block" target="_blank">
                            <i class="fa fa-eye"></i> <?php echo lang('preview_theme'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.theme-section {
    margin-bottom: 30px;
}
.section-title {
    margin-top: 0;
    color: #3c8dbc;
}
.theme-preview {
    margin-bottom: 15px;
}
.theme-preview img {
    max-width: 100%;
    border: 1px solid #ddd;
    border-radius: 3px;
}
.image-preview {
    margin-top: 10px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize colorpicker
    $('.my-colorpicker2').colorpicker();
    
    // Initialize code editors if available
    if(typeof CodeMirror !== 'undefined') {
        $('.code-editor').each(function() {
            var mode = $(this).data('mode') || 'text/html';
            CodeMirror.fromTextArea(this, {
                lineNumbers: true,
                mode: mode,
                theme: 'default'
            });
        });
    }
});

function browseImages(inputId) {
    // Open media browser or file manager
    // This is a placeholder - implement according to your file manager
    window.open('<?php echo site_url('admin/media/browse'); ?>?target=' + inputId, 'mediaBrowser', 'width=800,height=600');
}
</script> 