<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('send_sms'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('sms'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('send_sms'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
          <link href="common/extranal/css/sms/sendview.css" rel="stylesheet">
          <style>
                            .waves-light{
                                margin-right:6px;
                            }
                        </style>
        <div class="col-md-9">
            <section class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('send_sms'); ?></h4> 

                                       
                                        <div id="templatebar" class="pull-right col-lg-4 btn-toolbar pull-right">
                        <button class='btn btn-soft-primary waves-effect waves-light w-xs' onclick="location.href = 'sms/sent'" type="button">
                            <?php echo lang('sent_messages'); ?></button>
                        <button class='btn btn-soft-primary waves-effect waves-light w-xs' onclick="location.href = 'sms/manualSMSTemplate'" type="button">
                            <?php echo lang('template'); ?></button>
                            <button class='btn btn-soft-primary waves-effect waves-light w-xs' data-bs-toggle="modal"
                                                    data-bs-target="#myModal1" type="button">
                                                <?php echo lang('add'); ?> <?php echo lang('template'); ?></button>
                    </div>

                                 
                                    </div>
                
                <!-- <header class="panel-heading">
                    <?php echo lang('send_sms'); ?>

                    <div id="templatebar" class="pull-right col-lg-4 btn-toolbar pull-right">
                        <button class='btn btn-soft-primary waves-effect waves-light w-xs' onclick="location.href = 'sms/sent'" type="button">
                            <?php echo lang('sent_messages'); ?></button>
                        <button class='btn btn-soft-primary waves-effect waves-light w-xs' onclick="location.href = 'sms/manualSMSTemplate'" type="button">
                            <?php echo lang('template'); ?></button>
                        <button class='btn btn-soft-primary waves-effect waves-light w-xs' data-toggle="modal" data-target="#myModal1" type="button">
                            <?php echo lang('add'); ?> <?php echo lang('template'); ?></button>
                    </div>

                </header> -->

                <div class="card-body">  
                    <form role="form" name="myform" id="myform" class="clearfix" action="sms/send" method="post">
                        <label class="control-label">         
                            <?php echo lang('send_sms_to'); ?>
                        </label>    
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios1" value="allpatient">
                                <?php echo lang('all_patient'); ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios2" value="alldoctor">
                                <?php echo lang('all_doctor'); ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios2" value="bloodgroupwise">
                                <?php echo lang('donor'); ?> 
                            </label>
                        </div>


                        <div class="radio pos_client">
                            <label>
                                <?php echo lang('select_blood_group'); ?>
                                <select class="form-control m-bot15" name="bloodgroup" value=''>
                                    <?php foreach ($groups as $group) { ?>
                                        <option value="<?php echo $group->group; ?>"> <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                                </select>
                            </label>

                        </div>




                        <div class="radio">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios2" value="single_patient">
                                <?php echo lang('single_patient'); ?>
                            </label>
                        </div>

                        <div class="radio single_patient">
                            <label>
                                <?php echo lang('select_patient'); ?>
                                <select class="form-control m-bot15" id='patientchoose' name="patient" value=''>
                                   
                                </select>
                            </label>

                        </div>



                        <div class="">
                            <label>
                                <?php echo lang('select_template'); ?>
                                <select class="form-control m-bot15" id='selUser5' name="templatess">
                                  
                                </select>
                            </label>

                        </div>



                        <div class="form-group">
                            <label class="control-label"><?php echo lang('message'); ?> &ast;</label><br>
                            <?php
                            $count = 0;
                            foreach ($shortcode as $shortcodes) {
                                ?>
                                <input type="button" name="myBtn" value="<?php echo $shortcodes->name; ?>" onClick="addtext(this);">
                                <?php
                                $count+=1;
                                if ($count === 7) {
                                    ?>
                                    <br>
                                    <?php
                                }
                            }
                            ?> <br><br>
                            <textarea class="" id="editor1" name="message" value="" cols="70" rows="10"></textarea>
                        </div>
                        <input type="hidden" name="id" value=''>

                        <div class="form-group col-md-12 pull-right">
                            <button type="submit" name="submit" class="btn btn-info pull-right"><i class="fa fa-location-arrow"></i> <?php echo lang('send_email'); ?></button>
                        </div>

                    </form>
                </div>
            </section>
        </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->







<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('add_new'); ?> <?php echo lang('template'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
          
            <div class="modal-body">
                <?php echo validation_errors(); ?>
                <form role="form" name="myform1" action="sms/addNewManualTemplate" method="post" enctype="multipart/form-data">                                                                                    

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('templatename'); ?> &ast;</label>
                        <input type="text" class="form-control" name="name"  value='<?php
                        if (!empty($templatename->name)) {
                            echo $templatename->name;
                        }
                        if (!empty($setval)) {
                            echo set_value('name');
                        }
                        ?>' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('message'); ?> <?php echo lang('template'); ?> &ast;</label><br>
                        <?php
                        $count1 = 0;
                        foreach ($shortcode as $shortcodes) {
                            ?>
                            <input type="button" name="myBtn" value="<?php echo $shortcodes->name; ?>" onClick="addtext1(this);">
                            <?php
                            $count1+=1;
                            if ($count1 === 7) {
                                ?>
                                <br>
                                <?php
                            }
                        }
                        ?> <br><br>

                        <textarea class="form-control" id="editor2"name="message" value='<?php
                        if (!empty($templatename->message)) {
                            echo $templatename->message;
                        }
                        if (!empty($setval)) {
                            echo set_value('message');
                        }
                        ?>' cols="70" rows="10"placeholder="" required> <?php
                                      if (!empty($templatename->message)) {
                                          echo $templatename->message;
                                      }
                                      if (!empty($setval)) {
                                          echo set_value('message');
                                      }
                                      ?>
                        </textarea>
                    </div>
                    <input type="hidden" name="id" value='<?php
                    if (!empty($templatename->id)) {
                        echo $templatename->id;
                    }
                    ?>'>
                    <input type="hidden" name="type" value='sms'>
                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="common/js/codearistos.min.js"></script>


<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script type="text/javascript">var select_template = "<?php echo lang('select_template'); ?>";</script>
<script src="common/extranal/js/sms/sendview.js"></script>