<!--sidebar end-->
<!--main content start-->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"> <?php echo lang('live_meeting_settings'); ?></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a
                                        href="javascript: void(0);"><?php echo lang('home'); ?></a></li>

                                <li class="breadcrumb-item active"><?php echo lang('zoom'); ?></li>


                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- page start-->

            <div class="col-md-8 row">
                <form role="form" action="meeting/settings" class="clearfix" method="post"
                    enctype="multipart/form-data">
                    <div class="card">
                        

                        <div class="card-header table_header">
                            <h4 class="card-title mb-0 col-lg-12"><?php echo lang('zoom'); ?>
                                <?php echo lang('live_meeting_settings'); ?></h4>

                        </div>

                        <style type="text/css">
                        .img_thumb,
                        .img_class {
                            height: 150px;
                            width: 150px;
                        }
                        </style>
                        <div class="card-body">
                            <div class="table-responsive adv-table">
                                <div class="clearfix">
                                    <?php echo validation_errors(); ?>

                                    <div class="form-group row">
                                        <label for="api_key"
                                            class="col-md-3 col-form-label">Account ID</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="api_key"
                                                value='<?php echo !empty($settings->api_key) ? $settings->api_key : ''; ?>'
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="api_secret"
                                            class="col-md-3 col-form-label">Client ID</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="api_secret"
                                                value='<?php echo !empty($settings->secret_key) ? $settings->secret_key : ''; ?>'
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="url"
                                            class="col-md-3 col-form-label">Client Secret</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-lg" name="url" value='<?php
                                                                                                                            if (!empty($settings->url)) {
                                                                                                                                echo $settings->url;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <label for="url" class="col-md-12 col-form-label">Step 1: Go to <a href="https://marketplace.zoom.us/" target="_blank"> https://marketplace.zoom.us/</a></label>
                                    <label for="url" class="col-md-12 col-form-label">Step 2: Click Develop->Build App</label>
                                    <label for="url" class="col-md-12 col-form-label">Step 3: Select Server to server OAuth App</label>
                                    <label for="url" class="col-md-12 col-form-label">Step 4: Complete The Process</label>
                                    <input type="hidden" name="ion_user_id"
                                        value='<?php echo $doctor_details->ion_user_id; ?>'>
                                        <input type="hidden" name="doctor"
                                        value='<?php echo $doctor_details->id; ?>'>
                                    <input type="hidden" name="id"
                                        value='<?php echo !empty($settings->id) ? $settings->id : ''; ?>'>
                                    <div class="form-group row">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" name="submit"
                                                class="btn btn-info"><?php echo lang('submit'); ?></button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                    </form>
                    
            </div>
        </div>
    </div>
</div>
<!-- page end-->
</div>
</div>
</div>


<script src="common/js/codearistos.min.js"></script>