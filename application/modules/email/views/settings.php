<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('email_settings'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('email'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('email_settings'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->

        <div class="col-md-8">
            <section class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('email_settings'); ?></h4> 
                                       
                                    </div>
                
                <div class="card-body">
                <div class="table-responsive adv-table">
                        <div class="clearfix">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="email/addNewSettings" class="clearfix" method="post" enctype="multipart/form-data">
                                <?php if ($settings->type == 'Domain Email') { ?> 
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('admin'); ?> <?php echo lang('email'); ?></label>

                                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->admin_email)) {
                                            echo $settings->admin_email;
                                        }
                                        ?>' placeholder="From which you want to send the email">

                                    </div>

                                    <code>
                                        <?php echo lang('email_settings_instruction_1') ?>
                                        <br>
                                        <?php echo lang('email_settings_instruction_2') ?>
                                    </code>
                                <?php } ?>
                                <?php if ($settings->type == 'Smtp') { ?> 
                                    <div class="form-group emailSelectCompany">
                                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?> <?php echo lang('company'); ?></label>
                                        <select class="form-control m-bot15  pos_select" id="emailCompany" name="email_company" value='' required=""> 
                                            <option><?php echo lang('select'); ?></option>
                                            <option value="gmail" <?php
                                            if ($settings->mail_provider == 'gmail') {
                                                echo 'selected';
                                            }
                                            ?> ><?php echo lang('gmail'); ?></option>
                                            <option value="yahoo" <?php
                                            if ($settings->mail_provider == 'yahoo') {
                                                echo 'selected';
                                            }
                                            ?> ><?php echo lang('yahoo_mail'); ?></option>

                                            <option value="zoho" <?php
                                            if ($settings->mail_provider == 'zoho') {
                                                echo 'selected';
                                            }
                                            ?> ><?php echo lang('zoho_mail'); ?></option>
                                        </select>

                                    </div>
                                   
                                    <div class="form-group input-group m-bot15">
                                        <?php
                                        if (!empty($settings->user)) {
                                            $extension = explode("@", $settings->user);
                                        }
                                        ?>
                                        <input type="text" class="form-control" name="user" pattern="[^@,]+" id="emailAddress" value='<?php
                                        if (!empty($settings->user)) {
                                            echo $extension[0];
                                        }
                                        ?>' placeholder="Email user" required="">
                                        <span class="input-group-text" id="mailExtension"><?php
                                            if (!empty($settings->user)) {
                                                echo '@' . $extension[1];
                                            }
                                            ?></span> 
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?> <?php lang('app')?> <?php echo lang('password'); ?></label>

                                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->password)) {
                                            echo base64_decode($settings->password);
                                        }
                                        ?>' placeholder="<?php echo lang('email') . " " . lang('password'); ?>" required="">
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="id" value='<?php
                                if (!empty($settings->id)) {
                                    echo $settings->id;
                                }
                                ?>'>
                                <input type="hidden" name="type" value='<?php
                                if (!empty($settings->type)) {
                                    echo $settings->type;
                                }
                                ?>'>
                                <code>
                                    <?php echo lang('yahoo_mail_password_instruction1') ?>
                                    <br>
                                    >><?php echo lang('yahoo_mail_password_instruction2') ?><br>
                                    >> <?php echo lang('yahoo_mail_password_instruction3') ?><br>
                                    <?php echo lang('yahoo_mail_password_instruction4') ?>
                                </code>
                                <div class="form-group pull-right">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
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