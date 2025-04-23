<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo lang('install_theme'); ?>
            <small><?php echo lang('upload_new_theme'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard'); ?></a></li>
            <li><a href="<?php echo site_url('admin/settings'); ?>"><?php echo lang('settings'); ?></a></li>
            <li><a href="<?php echo site_url('admin/settings/themes'); ?>"><?php echo lang('themes'); ?></a></li>
            <li class="active"><?php echo lang('install'); ?></li>
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
                        <h3 class="box-title"><?php echo lang('upload_theme'); ?></h3>
                    </div>
                    <form action="<?php echo site_url('admin/settings/themes/upload'); ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="theme_file"><?php echo lang('theme_zip_file'); ?></label>
                                <input type="file" id="theme_file" name="theme_file" accept=".zip" required>
                                <p class="help-block"><?php echo lang('theme_zip_instructions'); ?></p>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-upload"></i> <?php echo lang('upload_and_install'); ?>
                            </button>
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
                        <h3 class="box-title"><?php echo lang('theme_requirements'); ?></h3>
                    </div>
                    <div class="box-body">
                        <p><?php echo lang('theme_requirements_intro'); ?></p>
                        <ul>
                            <li><?php echo lang('theme_requirement_zip'); ?></li>
                            <li><?php echo lang('theme_requirement_structure'); ?></li>
                            <li><?php echo lang('theme_requirement_config'); ?></li>
                            <li><?php echo lang('theme_requirement_preview'); ?></li>
                        </ul>
                        
                        <div class="callout callout-info">
                            <h4><?php echo lang('theme_structure_heading'); ?></h4>
                            <pre>theme-name/
├── theme.json
├── preview.jpg
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
└── views/
    ├── layouts/
    ├── partials/
    └── pages/</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> 