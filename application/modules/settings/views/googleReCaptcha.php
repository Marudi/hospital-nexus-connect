<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Google ReCaptcha</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('settings'); ?></li>
                                        <li class="breadcrumb-item active">Google ReCaptcha</li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->

        <div class="col-md-8">
            <section class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> Google ReCaptcha V3 Settings</h4> 
                                        
                                    </div>
            
                <div class="card-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="settings/updateGoogleRecaptcha" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Site Key </label>

                                    <input type="text" class="form-control" name="site_key" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($captcha->site_key)) {
                                                                                                                                echo $captcha->site_key;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Secret Key </label>

                                    <input type="text" class="form-control" name="secret_key" id="exampleInputEmail1" value='<?php
                                                                                                                                if (!empty($captcha->secret_key)) {
                                                                                                                                    echo $captcha->secret_key;
                                                                                                                                }
                                                                                                                                ?>' placeholder="">

                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($captcha->id)) {
                                                                            echo $captcha->id;
                                                                        }
                                                                        ?>'>

<div class="row">
    <div class="col-md-10">
    <code>
                                Without Site Key and Secret Key Frontend contact form will not work.
                                 Create Google ReCaptcha Key Here By selecting reCAPTCHA v3
: <a target="_blank" href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>
                            </code>
    </div>
    <div class="form-group pull-right col-md-2">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                </div>

</div>
                                
                                

                            </form>
                           
                        </div>





                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-8">
            <section class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> Google ReCaptcha V3 Settings for login/Signup</h4> 
                                        
                                    </div>
            
                <div class="card-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="settings/updateGoogleReCaptchaForLogin" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Site Key </label>

                                    <input type="text" class="form-control" name="site_key_login" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($captcha->site_key_login)) {
                                                                                                                                echo $captcha->site_key_login;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Secret Key </label>

                                    <input type="text" class="form-control" name="secret_key_login" id="exampleInputEmail1" value='<?php
                                                                                                                                if (!empty($captcha->secret_key_login)) {
                                                                                                                                    echo $captcha->secret_key_login;
                                                                                                                                }
                                                                                                                                ?>' placeholder="">

                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($captcha->id)) {
                                                                            echo $captcha->id;
                                                                        }
                                                                        ?>'>

<div class="row">
    <div class="col-md-10">
    <code>
                                Without Site Key and Secret Key Login/Signup form will not work.
                                 Create Google ReCaptcha Key Here By selecting reCAPTCHA v3
: <a target="_blank" href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>
                            </code>
    </div>
    <div class="form-group pull-right col-md-2">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                </div>

</div>
                                
                                

                            </form>
                           
                        </div>





                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/email/settings.js"></script>