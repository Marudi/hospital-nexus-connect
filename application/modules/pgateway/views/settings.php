<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('payment_gateways'); ?> <?php echo lang('settings'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('settings'); ?></li>
                                        <li class="breadcrumb-item"><?php echo lang('payment_gateways'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('settings'); ?></li>
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <div class="col-md-8 row">
            <section class="col-md-10 row">
            <div class="card">
                                   <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php
                    if (!empty($settings->name)) {
                        echo $settings->name;
                    }
                    ?> <?php echo lang('settings'); ?></h4> 
                                        
                                    </div>
               
                <div class="card-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="pgateway/addNewSettings" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1"> <?php echo lang('payment_gateway'); ?> <?php echo lang('name'); ?> &ast;</label>
                                    <input type="text" class="form-control" name="name"  value='<?php
                                    if (!empty($settings->name)) {
                                        echo $settings->name;
                                    }
                                    ?>' placeholder="" readonly>   
                                </div>
                                <?php if ($settings->name == "Pay U Money") { ?>
                                    <div class="form-group  col-md-6">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_key'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="merchant_key"  value="<?php
                                        if (!empty($settings->merchant_key)) {
                                            echo $settings->merchant_key;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="exampleInputEmail1"><?php echo lang('salt'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="salt"  value='<?php
                                        if (!empty($settings->salt)) {
                                            echo $settings->salt;
                                        }
                                        ?>' required="">
                                    </div
                                <?php } ?>
                                <?php if ($settings->name == "Paystack") { ?>
                                    <div class="form-group  col-md-6">
                                        <label for="exampleInputEmail1"> <?php echo lang('secretkey'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="secret"  value="<?php
                                        if (!empty($settings->secret)) {
                                            echo $settings->secret;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="exampleInputEmail1"><?php echo lang('public_key'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="public_key"  value='<?php
                                        if (!empty($settings->public_key)) {
                                            echo $settings->public_key;
                                        }
                                        ?>' required="">
                                    </div
                                <?php } ?>

                                <?php if ($settings->name == "PayPal") { ?>
                                    <div class="form-group  col-md-6">
                                        <label for="exampleInputEmail1"> <?php echo lang('api_username'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="APIUsername"  value="<?php
                                        if (!empty($settings->APIUsername)) {
                                            echo $settings->APIUsername;
                                        }
                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="exampleInputEmail1"><?php echo lang('api_password'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="APIPassword"  value='<?php
                                        if (!empty($settings->APIPassword)) {
                                            echo $settings->APIPassword;
                                        }
                                        ?>' required="">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="exampleInputEmail1"><?php echo lang('api_signature'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="APISignature"  value='<?php
                                        if (!empty($settings->APISignature)) {
                                            echo $settings->APISignature;
                                        }
                                        ?>' required="">
                                    </div>
                                <?php } ?>
                                <?php if ($settings->name == "Stripe") { ?>
                                    <div class="form-group  col-md-6">
                                        <label for="exampleInputEmail1"> <?php echo lang('secretkey'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="secret"  value='<?php
                                        if (!empty($settings->secret)) {
                                            echo $settings->secret;
                                        }
                                        ?>' placeholder="" required="">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="exampleInputEmail1"> <?php echo lang('publishkey'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="publish"  value='<?php
                                        if (!empty($settings->publish)) {
                                            echo $settings->publish;
                                        }
                                        ?>' required="">
                                    </div>
                                <?php } ?>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1"><?php echo lang('status'); ?> &ast;</label>
                                    <select class="form-control m-bot15" name="status" value='' required="">
                                        <option value="live" <?php
                                        if (!empty($settings->status)) {
                                            if ($settings->status == 'live') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('live'); ?> </option>
                                        <option value="test" <?php
                                        if (!empty($settings->status)) {
                                            if ($settings->status == 'test') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('test'); ?></option>
                                    </select>
                                </div>
                                <input type="hidden" name="id" value='<?php
                                if (!empty($settings->id)) {
                                    echo $settings->id;
                                }
                                ?>'>
                                 <div class="modal-footer">
                        <div class="col-md-12 pull-right">
                            <button type="submit" name="submit2" id="submit1" class="btn btn-info submit_button"> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                                    </div>
                            </form>
                        </div>
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
<script src="common/extranal/js/pgateway.js"></script>