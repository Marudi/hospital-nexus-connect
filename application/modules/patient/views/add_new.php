<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">   <?php
                if (!empty($patient->id)) {
                    echo lang('edit_patient');
                } else {
                    echo lang('add_new_patient');
                }
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"> <?php echo lang('patient'); ?></li>
                                        <li class="breadcrumb-item active">   <?php
                if (!empty($patient->id)) {
                    echo lang('edit_patient');
                } else {
                    echo lang('add_new_patient');
                }
                ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/patient/add_new.css" rel="stylesheet">
        <div class="col-md-7">
        <section class="card">
          
             <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                if (!empty($patient->id)) {
                    echo lang('edit_patient');
                } else {
                    echo lang('add_new_patient');
                }
                ?></h4> 
             </div>                 
           
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                          <form role="form" action="patient/addNew" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <div class="col-md-6">
                                        <div class="form-group">

                                            <div class="">
                                                <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                            </div>
                                            <div class="">
                                                <select class="form-control m-bot15 js-example-basic-single" name="doctor" value=''>
                                                    <?php foreach ($doctors as $doctor) { ?>
                                                        <option value="<?php echo $doctor->id; ?>" <?php
                                                                                                    if (!empty($patient->doctor)) {
                                                                                                        if ($patient->doctor == $doctor->id) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>><?php echo $doctor->name; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="name" value='<?php
                                                                                                        if (!empty($setval)) {
                                                                                                            echo set_value('name');
                                                                                                        }
                                                                                                        if (!empty($patient->name)) {
                                                                                                            echo $patient->name;
                                                                                                        }
                                                                                                        ?>' placeholder="" required="">
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast;</label>
                                            <input type="email" class="form-control" name="email" value='<?php
                                                                                                            if (!empty($patient->email)) {
                                                                                                                echo $patient->email;
                                                                                                            }
                                                                                                            ?>' placeholder="" required="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('password'); ?> &ast;</label>
                                            <input type="password" class="form-control" name="password" placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="address" value='<?php
                                                                                                            if (!empty($setval)) {
                                                                                                                echo set_value('address');
                                                                                                            }
                                                                                                            if (!empty($patient->address)) {
                                                                                                                echo $patient->address;
                                                                                                            }
                                                                                                            ?>' placeholder="" required="">
                                        </div>
                                        <!--   onKeyPress="if(this.value.length==11) return false;" -->
                                       
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="phone" value='<?php
                                                                                                            if (!empty($setval)) {
                                                                                                                echo set_value('phone');
                                                                                                            }
                                                                                                            if (!empty($patient->phone)) {
                                                                                                                echo $patient->phone;
                                                                                                            }
                                                                                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                                            <select class="form-control m-bot15" name="sex" value=''>
                                                <option value="Male" <?php
                                                                        if (!empty($setval)) {
                                                                            if (set_value('sex') == 'Male') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        if (!empty($patient->sex)) {
                                                                            if ($patient->sex == 'Male') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>> Male </option>
                                                <option value="Female" <?php
                                                                        if (!empty($setval)) {
                                                                            if (set_value('sex') == 'Female') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        if (!empty($patient->sex)) {
                                                                            if ($patient->sex == 'Female') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>> Female </option>
                                            </select>
                                        </div>
                                        <div class="form-group ">
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
                                        <div class="form-group">
                                            <label><?php echo lang('birth_date'); ?></label>
                                            <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="<?php
                                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                                        echo set_value('birthdate');
                                                                                                                                                                    }
                                                                                                                                                                    if (!empty($patient->birthdate)) {
                                                                                                                                                                        echo $patient->birthdate;
                                                                                                                                                                    }
                                                                                                                                                                    ?>" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <div class="">
                                                <label><?php echo lang('age'); ?></label>

                                            </div>
                                            <div class="">

                                                <?php
                                                if (!empty($patient->age)) {
                                                    $age = explode('-', $patient->age);
                                                } ?>
                                                <div class="input-group m-bot15">

                                                    <input type="number" min="0" max="150" class="form-control" name="years" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('years');
                                                                                                                                    }
                                                                                                                                    if (!empty($patient->age)) {
                                                                                                                                        echo $age[0];
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="<?php echo lang('years'); ?>">
                                                    <span class="input-group-text"><?php echo lang('years'); ?></span>
                                                    <input type="number" class="form-control input-group-addon" min="0" max="12" name="months" value='<?php
                                                                                                                                                        if (!empty($setval)) {
                                                                                                                                                            echo set_value('months');
                                                                                                                                                        }
                                                                                                                                                        if (!empty($patient->age)) {
                                                                                                                                                            echo $age[1];
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="<?php echo lang('months'); ?>">
                                                    <span class="input-group-text"><?php echo lang('months'); ?></span>
                                                    <input type="number" class="form-control input-group-addon" name="days" min="0" max="29" value='<?php
                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                        echo set_value('days');
                                                                                                                                                    }
                                                                                                                                                    if (!empty($patient->age)) {
                                                                                                                                                        echo $age[2];
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="<?php echo lang('days'); ?>">
                                                    <span class="input-group-text"><?php echo lang('days'); ?></span>
                                                </div>


                                            </div>



                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                                            <select class="form-control m-bot15" name="bloodgroup" value=''>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option value="<?php echo $group->group; ?>" <?php
                                                                                                    if (!empty($setval)) {
                                                                                                        if ($group->group == set_value('bloodgroup')) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    if (!empty($patient->bloodgroup)) {
                                                                                                        if ($group->group == $patient->bloodgroup) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>> <?php echo $group->group; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                            </div>
                                                                                                </div>
                                        <div class="form-group last col-md-6">
                                            <label class="control-label">Image Upload</label>
                                            <div class="">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail img_class">
                                                        <img src="<?php
                                                                    
                                                                    if (!empty($patient->img_url)) {
                                                                        echo $patient->img_url;
                                                                    }
                                                                    ?>" id="img" alt="" />

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

                                        <?php if (empty($id)) { ?>

                                            <div class="form-group sms_send">
                                                <div class="payment_label">
                                                </div>
                                                <div class="">
                                                    <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                                                </div>
                                            </div>

                                        <?php } ?>

                                        <input type="hidden" name="id" value='<?php
                                                                                if (!empty($patient->id)) {
                                                                                    echo $patient->id;
                                                                                }
                                                                                ?>'>
                                        <input type="hidden" name="p_id" value='<?php
                                                                                if (!empty($patient->patient_id)) {
                                                                                    echo $patient->patient_id;
                                                                                }
                                                                                ?>'>
                                        <section class="pull-right">
                                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                        </section>
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