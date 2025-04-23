<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">

    <div class="container-fluid">

    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('pharmacist'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('human_resources'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('pharmacist'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('add_new'); ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="card col-lg-7">
                            <div class="card-header table_header">
                                        <h4 class="card-title mb-0"> <?php
                                                                            if (!empty($doctor->id))
                                                                                echo lang('edit_doctor');
                                                                            else
                                                                                echo lang('add_doctor');
                                                                            ?></h4> 
                                        
                                    </div>
            
                                    <div class="card-body">  
                                        <div class="table-responsive adv-table">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <form role="form" action="doctor/addNew" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast; </label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('name');
                                                                                                                    }
                                                                                                                    if (!empty($doctor->name)) {
                                                                                                                        echo $doctor->name;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast; </label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                                                                                                        if (!empty($setval)) {
                                                                                                                            echo set_value('email');
                                                                                                                        }
                                                                                                                        if (!empty($doctor->email)) {
                                                                                                                            echo $doctor->email;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                                <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast; </label>
                                <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                                                                                                        if (!empty($setval)) {
                                                                                                                            echo set_value('address');
                                                                                                                        }
                                                                                                                        if (!empty($doctor->address)) {
                                                                                                                            echo $doctor->address;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast; </label>
                                <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                                                                                                        if (!empty($setval)) {
                                                                                                                            echo set_value('phone');
                                                                                                                        }
                                                                                                                        if (!empty($doctor->phone)) {
                                                                                                                            echo $doctor->phone;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('department'); ?></label>
                                <select class="form-control m-bot15" name="department" value=''>
                                    <?php foreach ($departments as $department) { ?>
                                        <option value="<?php echo $department->id; ?>" <?php
                                                                                        if (!empty($setval)) {
                                                                                            if ($department->id == set_value('department')) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        if (!empty($doctor->department)) {
                                                                                            if ($department->id == $doctor->department) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        ?>> <?php echo $department->name; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('signature'); ?> &ast; </label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class">
                                            <img src="<?php

                                                        if (!empty($doctor->signature)) {
                                                            echo $doctor->signature;
                                                        }
                                                        ?>" alt="" />
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Signature</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input type="file" class="default" name="signature" />
                                            </span>

                                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="form-group last col-md-6">
                                <label class="control-label">Image Upload</label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class">
                                            <img src="<?php

                                                        if (!empty($doctor->img_url)) {
                                                            echo $doctor->img_url;
                                                        }
                                                        ?>" alt="" />
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
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
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('profile'); ?> &ast; </label>
                                <textarea class="form-control ckeditor" id="editor1" name="profile" value="<?php
                                                                                                            if (!empty($setval)) {
                                                                                                                echo set_value('profile');
                                                                                                            }
                                                                                                            if (!empty($doctor->profile)) {
                                                                                                                echo $doctor->profile;
                                                                                                            }
                                                                                                            ?>" rows="50" cols="20"></textarea>


                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                <input  class="form-control" type="file" name="img_url">
                            </div>
                            <input type="hidden" name="id" value='<?php
                                                                    if (!empty($doctor->id)) {
                                                                        echo $doctor->id;
                                                                    }
                                                                    ?>'>
                           <div class="col-md-12 pull-right" style="margin-top: 10px;">
                                                                                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                                                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- page end-->
    </div>
</div>
<!--main content end-->
<!--footer start-->
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/doctor/doctor.js"></script>