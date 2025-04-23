<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('contact'); ?> <?php echo lang('email_settings'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('email'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('contact'); ?> <?php echo lang('email_settings'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <div class="col-md-8">
            <section class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('contact'); ?> <?php echo lang('email_settings'); ?></h4> 
                                       
                                    </div>
               
                <div class="card-body">
                <div class="table-responsive adv-table">
                        <div class="clearfix">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="email/updateContactEmailSettings" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('contact'); ?> <?php echo lang('email'); ?></label>
                                    <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                    if (!empty($settings->admin_email)) {
                                        echo $settings->admin_email;
                                    }
                                    ?>' placeholder="From which you want to send the email">
                                </div>

                                <code>
                                    <?php echo lang('email_settings_instruction_1')?>
                                     <br>
                                    <?php echo lang('email_settings_instruction_2')?>
                                </code>


                                <input type="hidden" name="id" value='<?php
                                if (!empty($settings->id)) {
                                    echo $settings->id;
                                }
                                ?>'>
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
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
