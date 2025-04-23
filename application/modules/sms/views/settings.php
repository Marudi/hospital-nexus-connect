<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('sms_settings'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('sms'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('sms_settings'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <div class="col-md-8">
            <section class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <i class="fa fa-gear"></i>  <?php echo $settings->name; ?> <?php echo lang('sms_settings'); ?></h4> 
                                       
                                    </div>
              
                <div class="card-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <?php echo validation_errors(); ?>
                                        <form role="form" action="sms/addNewSettings" method="post" enctype="multipart/form-data">

                                            <?php if ($settings->name == 'Clickatell') { ?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('username'); ?></label>
                                                    <input type="text" class="form-control" name="username"  value='<?php
                                                    if (!empty($settings->username)) {
                                                        echo $settings->username;
                                                    }
                                                    ?>' placeholder="" <?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('api'); ?> <?php echo lang('password'); ?></label>
                                                    <input type="password" class="form-control" name="password"  placeholder="********">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('api'); ?> <?php echo lang('id'); ?></label>
                                                    <input type="text" class="form-control" name="api_id"  value='<?php
                                                    if (!empty($settings->api_id)) {
                                                        echo $settings->api_id;
                                                    }
                                                    ?>' placeholder="" <?php
                                                           if (!empty($settings->username)) {
                                                               echo $settings->username;
                                                           }
                                                           ?> <?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?>>
                                                </div>
                                            <?php } ?>


                                            <?php if ($settings->name == 'MSG91') { ?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php echo lang('authkey'); ?></label>
                                                    <input type="text" class="form-control" name="authkey"  value='<?php
                                                    if (!empty($settings->authkey)) {
                                                        echo $settings->authkey;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php echo lang('sender'); ?> </label>   
                                                    <input type="text" class="form-control" name="sender"  value='<?php
                                                    if (!empty($settings->sender)) {
                                                        echo $settings->sender;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                            <?php } ?>
                                            <?php if ($settings->name == 'Twilio') { ?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('sid'); ?></label>
                                                    <input type="text" class="form-control" name="sid"  value='<?php
                                                    if (!empty($settings->sid)) {
                                                        echo $settings->sid;
                                                    }
                                                    ?>' placeholder="" <?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $settings->name; ?> <?php echo lang('token'); ?> <?php echo lang('password'); ?></label>
                                                    <input type="text" class="form-control" name="token" value='<?php
                                                    if (!empty($settings->token)) {
                                                        echo $settings->token;
                                                    }
                                                    ?>'<?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?>  >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('sendernumber'); ?></label>
                                                    <input type="text" class="form-control" name="sendernumber"  value='<?php
                                                    if (!empty($settings->sendernumber)) {
                                                        echo $settings->sendernumber;
                                                    }
                                                    ?>' <?php
                                                           if (!$this->ion_auth->in_group('admin')) {
                                                               echo 'disabled';
                                                           }
                                                           ?>>
                                                </div>
                                            <?php } ?>
                                            <?php if ($settings->name == '80Kobo') { ?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                                                    <input type="text" class="form-control" name="email"  value='<?php
                                                    if (!empty($settings->email)) {
                                                        echo $settings->email;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php echo lang('password'); ?> </label>   
                                                    <input type="password" class="form-control" name="password"  value='<?php
                                                    if (!empty($settings->password)) {
                                                        echo $settings->password;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php echo lang('sender'); ?> <?php echo lang('name'); ?></label>
                                                    <input type="text" class="form-control" name="sender_name"  value='<?php
                                                    if (!empty($settings->sender_name)) {
                                                        echo $settings->sender_name;
                                                    }
                                                    ?>' placeholder="">
                                                    <p> <?php echo lang('maximum_11_characters'); ?> </p>
                                                </div>
                                            <?php } ?>
                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($settings->id)) {
                                                echo $settings->id;
                                            }
                                            ?>'>
                                            <div class="form-group pull-right">
                                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/sms/settings.js"></script>