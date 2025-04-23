<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('manage_profile'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                       
                                        <li class="breadcrumb-item active"><?php echo lang('manage_profile'); ?></li>
                                        
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->

        <div class="col-md-8 row">
        <div class="card">
                                <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('manage_profile'); ?></h4> 
                                        
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
                            <?php if (!$this->ion_auth->in_group(array('Patient', 'Doctor'))) { ?>
                                <form role="form" action="profile/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                                        <input type="text" class="form-control" name="name" value='<?php
                                                                                                    if (!empty($profile->username)) {
                                                                                                        echo $profile->username;
                                                                                                    }
                                                                                                    ?>' placeholder="" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('change_password'); ?></label>
                                        <input type="password" class="form-control" name="password" placeholder="********">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                        <input type="text" class="form-control" name="email" value='<?php
                                                                                                    if (!empty($profile->email)) {
                                                                                                        echo $profile->email;
                                                                                                    }
                                                                                                    ?>' placeholder="" <?php
                                                                                                                        if (!empty($profile->username)) {
                                                                                                                            echo $profile->username;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                    </div>
                                    <?php if ($this->ion_auth->in_group(array('Patient', 'Doctor'))) {
                                        $ion_user = $this->ion_auth->get_user_id();
                                        if ($this->ion_auth->in_group(array('Patient'))) {
                                            $img_url = $this->db->get_where('patient', array('ion_user_id' => $this->ion_auth->get_user_id()))->row();
                                        }
                                        if ($this->ion_auth->in_group(array('Doctor'))) {
                                            $img_url = $this->db->get_where('doctor', array('ion_user_id' => $this->ion_auth->get_user_id()))->row();
                                        }
                                    ?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('email_confirmation_during_appointment'); ?></label>
                                            <select name="email_notification" class="form-control" id="">
                                                <option value="Active" <?php if (!empty($img_url->email_notification == 'Active')) {
                                                                            echo 'Active';
                                                                        } ?>><?php echo lang('active'); ?></option>
                                                <option value="Inactive" <?php if (!empty($img_url->email_notification == 'Inactive')) {
                                                                                echo 'Inactive';
                                                                            } ?>><?php echo lang('inactive'); ?></option>
                                            </select>

                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label">Image Upload</label>
                                            <div class="">

                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail img_class">
                                                        <img src="<?php if (!empty($img_url->img_url)) {
                                                                        echo $img_url->img_url;
                                                                    } ?>" id="img" alt="" />

                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                                    <div>
                                                        <span class="btn btn-white btn-file">
                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                            <input type="file" class="default" name="img_url" />
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <?php } ?>
                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($profile->id)) {
                                                                                echo $profile->id;
                                                                            }
                                                                            ?>'>
                                    <div class="form-group pull-right" style="margin-top: 10px;">
                                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                    </div>
                                </form>
                            <?php } else { ?>
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#general_info" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('general_info'); ?></span> 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#email_notification" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('email_confirmation_during_appointment'); ?></span> 
                                                </a>
                                            </li>
                                </ul>
                                <!-- <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#general_info"><?php echo lang('general_info'); ?></a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#email_notification"><?php echo lang('email_confirmation_during_appointment'); ?></a>
                                    </li>
                                </ul> -->


                                <div class="card">
                                    <div class="tab-content col-md-12">
                                        <div id="general_info" class="tab-pane active">
                                            <form role="form" action="profile/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                                                    <input type="text" class="form-control" name="name" value='<?php
                                                                                                                if (!empty($profile->username)) {
                                                                                                                    echo $profile->username;
                                                                                                                }
                                                                                                                ?>' placeholder="" required="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('change_password'); ?></label>
                                                    <input type="password" class="form-control" name="password" placeholder="********">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                                    <input type="text" class="form-control" name="email" value='<?php
                                                                                                                if (!empty($profile->email)) {
                                                                                                                    echo $profile->email;
                                                                                                                }
                                                                                                                ?>' placeholder="" <?php
                                                                                                                                    if (!empty($profile->username)) {
                                                                                                                                        echo $profile->username;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="">
                                                </div>

                                                <?php
                                                $current_user_id = $this->ion_auth->user()->row()->id;
                                                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                                                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                                                $group_name = strtolower($group_name);
                                                $user_language = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->language;
                                                // echo $user_language.' salam';
                                                // die();
                                                ?>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('language'); ?></label>
                                                    <select class="form-control js-example-basic-single" name="language">
                                                        <option value=""> </option>
                                                        <option value="arabic" <?php
                                                                                if (!empty($user_language)) {
                                                                                    if ($user_language == 'arabic') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>><?php echo lang('arabic'); ?>
                                                        </option>


                                                        <option value="english" <?php
                                                                                if (!empty($user_language)) {
                                                                                    if ($user_language == 'english') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>><?php echo lang('english'); ?>
                                                        </option>

                                                        <option value="spanish" <?php
                                                                                if (!empty($user_language)) {
                                                                                    if ($user_language == 'spanish') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>><?php echo lang('spanish'); ?>
                                                        </option>
                                                        <option value="french" <?php
                                                                                if (!empty($user_language)) {
                                                                                    if ($user_language == 'french') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>><?php echo lang('french'); ?>
                                                        </option>
                                                        <option value="italian" <?php
                                                                                if (!empty($user_language)) {
                                                                                    if ($user_language == 'italian') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>><?php echo lang('italian'); ?>
                                                        </option>
                                                        <option value="portuguese" <?php
                                                                                    if (!empty($user_language)) {
                                                                                        if ($user_language == 'portuguese') {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>><?php echo lang('portuguese'); ?>
                                                        </option>




                                                    </select>
                                                </div>







                                                <?php
                                                $ion_user = $this->ion_auth->get_user_id();
                                                if ($this->ion_auth->in_group(array('Patient'))) {
                                                    $img_url = $this->db->get_where('patient', array('ion_user_id' => $this->ion_auth->get_user_id()))->row();
                                                }
                                                if ($this->ion_auth->in_group(array('Doctor'))) {
                                                    $img_url = $this->db->get_where('doctor', array('ion_user_id' => $this->ion_auth->get_user_id()))->row();
                                                }
                                                ?>
                                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('email_confirmation_during_appointment'); ?></label>
                                    <select name="email_notification" class="form-control" id="">
                                        <option value="Active" <?php if (!empty($img_url->email_notification == 'Active')) {
                                                                    echo 'Active';
                                                                } ?>><?php echo lang('active'); ?></option>
                                        <option value="Inactive" <?php if (!empty($img_url->email_notification == 'Inactive')) {
                                                                        echo 'Inactive';
                                                                    } ?>><?php echo lang('inactive'); ?></option>
                                    </select> 
                                   
                                </div>-->
                                                <div class="form-group ">
                                                    <label class="control-label">Image Upload</label>
                                                    <div class="">

                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-new thumbnail img_class">
                                                                <img src="<?php if (!empty($img_url->img_url)) {
                                                                                echo $img_url->img_url;
                                                                            } ?>" id="img" alt="" />

                                                            </div>
                                                            <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                                            <div>
                                                                <span class="btn btn-soft-primary btn-file">
                                                                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                    <input type="file" class="default" name="img_url" />
                                                                </span>
                                                                <a href="#" class="btn btn-soft-primary waves-effect waves-light fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <input type="hidden" name="id" value='<?php
                                                                                        if (!empty($profile->id)) {
                                                                                            echo $profile->id;
                                                                                        }
                                                                                        ?>'>
                                                <div class="form-group pull-right">
                                                    <button type="submit" name="submit" class="btn btn-info waves-effect waves-light pull-right"><?php echo lang('submit'); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="email_notification" class="tab-pane">
                                            <table class="table table-striped">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th><?php echo lang('email_type'); ?></th>
                                                        <th><?php echo lang('status'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
                                                        <tr>
                                                            <td> <?php echo lang('appointment') ?> <?php echo lang('creation') ?></td>
                                                            <td>
                                                                <select name="appointment_creation" id="appointment_creation" class="form-control patient_email">
                                                                    <option value="Active" <?php if (!empty($img_url->appointment_creation == 'Active')) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo lang('active'); ?></option>
                                                                    <option value="Inactive" <?php if (!empty($img_url->appointment_creation == 'Inactive')) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo lang('inactive'); ?></option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <?php echo lang('appointment') ?> <?php echo lang('confirmation') ?></td>
                                                            <td>
                                                                <select name="appointment_confirmation" id="appointment_confirmation" class="form-control patient_email">
                                                                    <option value="Active" <?php if (!empty($img_url->appointment_confirmation == 'Active')) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo lang('active'); ?></option>
                                                                    <option value="Inactive" <?php if (!empty($img_url->appointment_confirmation == 'Inactive')) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo lang('inactive'); ?></option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <?php echo lang('payment') ?> <?php echo lang('confirmation') ?></td>
                                                            <td>
                                                                <select name="payment_confirmation" id="payment_confirmation" class="form-control patient_email">
                                                                    <option value="Active" <?php if (!empty($img_url->payment_confirmation == 'Active')) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo lang('active'); ?></option>
                                                                    <option value="Inactive" <?php if (!empty($img_url->payment_confirmation == 'Inactive')) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo lang('inactive'); ?></option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <?php echo lang('meeting_schedule') ?></td>
                                                            <td>
                                                                <select name="meeting_schedule" id="meeting_schedule" class="form-control patient_email">
                                                                    <option value="Active" <?php if (!empty($img_url->meeting_schedule == 'Active')) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo lang('active'); ?></option>
                                                                    <option value="Inactive" <?php if (!empty($img_url->meeting_schedule == 'Inactive')) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo lang('inactive'); ?></option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <input type="hidden" value="<?php echo $img_url->id; ?>" name="patient_id" id="patient_id">
                                                    <?php } else { ?>

                                                        <tr>
                                                            <td> <?php echo lang('appointment') ?> <?php echo lang('confirmation') ?></td>
                                                            <td>
                                                                <select name="appointment_confirmation" id="doctor_appointment_confirmation" class="form-control doctor_email">
                                                                    <option value="Active" <?php if (!empty($img_url->appointment_confirmation == 'Active')) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo lang('active'); ?></option>
                                                                    <option value="Inactive" <?php if (!empty($img_url->appointment_confirmation == 'Inactive')) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo lang('inactive'); ?></option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <input type="hidden" value="<?php echo $img_url->id; ?>" name="doctor_id" id="doctor_id">
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="email_notification" class="tab-pane">

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/profile.js"></script>