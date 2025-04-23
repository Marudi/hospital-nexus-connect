<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('patient'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('patient'); ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <link href="common/extranal/css/patient/patient.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8">  <?php echo lang('patient'); ?> <?php echo lang('database'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                                           
                                        </div>
                                    </div>
           
            <div class="card-body">

            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient_id'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                    <th><?php echo lang('due_balance'); ?></th>
                                <?php } ?>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('register_new_patient'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
            <div class="modal-body row">
                <form role="form" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">
<div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control" name="name" value='' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast;</label>
                        <input type="email" class="form-control" name="email" value='' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?> &ast;</label>
                        <input type="password" class="form-control" name="password" placeholder="" autocomplete="off" required>
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast;</label>
                        <input type="text" class="form-control" name="address" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast;</label>
                        <input type="number" class="form-control" name="phone" value='' placeholder="" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                                                    if (!empty($patient->sex)) {
                                                        if ($patient->sex == 'Male') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Male </option>
                            <option value="Female" <?php
                                                    if (!empty($patient->sex)) {
                                                        if ($patient->sex == 'Female') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Female </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Cross Continuity"; ?></label>
                        <select class="form-control m-bot15" name="cross_con" value=''>

                            <option value="Yes" <?php
                                                    if (!empty($patient->cross_con)) {
                                                        if ($patient->cross_con == 'Yes') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Yes </option>
                            <option value="No" <?php
                                                    if (!empty($patient->cross_con)) {
                                                        if ($patient->cross_con == 'No') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> No </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?> </label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" onkeypress="return false;">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="">
                            <label><?php echo lang('age'); ?></label>

                        </div>
                        <div class="">


                            <div class="input-group m-bot15">

                                <input type="number" min="0" max="150" class="form-control" name="years" value='' placeholder="<?php echo lang('years'); ?>">
                                <span class="input-group-text"><?php echo lang('y'); ?></span>
                                <input type="number" class="form-control " min="0" max="12" name="months" value='' placeholder="<?php echo lang('months'); ?>">
                                <span class="input-group-text"><?php echo lang('m'); ?></span>
                                <input type="number" class="form-control" name="days" min="0" max="29" value='' placeholder="<?php echo lang('days'); ?>">
                                <span class="input-group-text"><?php echo lang('d'); ?></span>
                            </div>


                        </div>



                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                                                                if (!empty($patient->bloodgroup)) {
                                                                                    if ($group->group == $patient->bloodgroup) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>> <?php echo $group->group; ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15" id="doctorchoose1" name="doctor" value=''>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div>

                    <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img src="" alt="" />

                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                <div>
                                    <span class="btn  btn-soft-primary btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url" />
                                    </span>
                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>
                 


                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
</div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->







<!-- Edit Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('edit_patient'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         
            <div class="modal-body row">
                <form role="form" id="editPatientForm" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">
<div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control" name="name" value='' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="email" class="form-control" name="email" value='' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('change'); ?><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" placeholder="" autocomplete="off">
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast;</label>
                        <input type="text" class="form-control" name="address" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast;</label>
                        <input type="text" class="form-control" name="phone" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                                                    if (!empty($patient->sex)) {
                                                        if ($patient->sex == 'Male') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Male </option>
                            <option value="Female" <?php
                                                    if (!empty($patient->sex)) {
                                                        if ($patient->sex == 'Female') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Female </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Cross Continuity"; ?></label>
                        <select class="form-control m-bot15" name="cross_con" value=''>

                            <option value="Yes" <?php
                                                    if (!empty($patient->cross_con)) {
                                                        if ($patient->cross_con == 'Yes') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> Yes </option>
                            <option value="No" <?php
                                                    if (!empty($patient->cross_con)) {
                                                        if ($patient->cross_con == 'No') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> No </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?> &ast;</label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" onkeypress="return false;">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="">
                            <label><?php echo lang('age'); ?></label>

                        </div>
                        <div class="">
                            <div class="input-group m-bot15">
                                <input type="number" min="0" max="150" class="form-control" name="years" value='' placeholder="<?php echo lang('years'); ?>">
                                <span class="input-group-text"><?php echo lang('y'); ?></span>
                                <input type="number" class="form-control input-group-addon" min="0" max="12" name="months" value='' placeholder="<?php echo lang('months'); ?>">
                                <span class="input-group-text"><?php echo lang('m'); ?></span>
                                <input type="number" class="form-control input-group-addon" name="days" min="0" max="29" value='' placeholder="<?php echo lang('days'); ?>">
                                <span class="input-group-text"><?php echo lang('d'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                                                                if (!empty($patient->bloodgroup)) {
                                                                                    if ($group->group == $patient->bloodgroup) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>> <?php echo $group->group; ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15" id="doctorchoose" name="doctor" value=''>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div>

                    <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img src="" id="img" alt="" />

                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                <div>
                                    <span class="btn btn-soft-primary btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url" />
                                    </span>
                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>

                  

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value='<?php
                                                            if (!empty($patient->patient_id)) {
                                                                echo $patient->patient_id;
                                                            }
                                                            ?>'>





<div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                                                        </div>

                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<!-- Edit Patient Modal-->












<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('patient'); ?> <?php echo lang('info'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body row">
                <form role="form" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group last col-md-4">
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">

                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('patient_id'); ?>: <span class="patientIdClass"></span></label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <div class="nameClass"></div>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <div class="emailClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('age'); ?></label>
                        <div class="ageClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <div class="addressClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('gender'); ?></label>
                        <div class="genderClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <div class="phoneClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <div class="bloodgroupClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('birth_date'); ?></label>
                        <div class="birthdateClass"></div>
                    </div>






                    <div class="form-group col-md-4">
                    </div>
                    <div class="form-group col-md-4">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <div class="doctorClass"></div>
                    </div>




                </div>


                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/patient/patient.js"></script>