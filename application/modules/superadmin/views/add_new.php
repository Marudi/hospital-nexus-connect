<!--sidebar end-->
  <link href="common/extranal/css/superadmin/superadmin.css" rel="stylesheet">
  <div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('add_new'); ?> <?php echo lang('superadmin'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('superadmin'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('add_new'); ?></li>
                                       
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="col-md-7">
            <div class="card">
                 <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php
                    if (!empty($superadmin->id))
                        echo lang('edit_superadmin');
                    else
                        echo lang('add_superadmin');
                    ?></h4> 
                                        
                                    </div>
              
                <div class="card-body col-md-12">
                <div class="table-responsive adv-table">
                        <div class="clearfix">

                            <div class="col-lg-12">
                                <!-- <section class="card"> -->
                                    <!-- <div class="card-body"> -->
                                        <!-- <div class="col-lg-12">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                                <?php echo validation_errors(); ?>
                                                <?php echo $this->session->flashdata('feedback'); ?>
                                            </div>
                                            <div class="col-lg-3"></div>
                                        </div> -->
                                        <form role="form" action="superadmin/addNew" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                                                    <input type="text" class="form-control" name="name"  value='<?php
                                                    if (!empty($setval)) {
                                                        echo set_value('name');
                                                    }
                                                    if (!empty($superadmin->name)) {
                                                        echo $superadmin->name;
                                                    }
                                                    ?>' required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast;</label>
                                                    <input type="email" class="form-control" name="email"  value='<?php
                                                    if (!empty($setval)) {
                                                        echo set_value('email');
                                                    }
                                                    if (!empty($superadmin->email)) { 
                                                        echo $superadmin->email;
                                                    }
                                                    ?>' placeholder="" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('password'); ?> &ast;</label>
                                                    <input type="password" class="form-control" name="password"  placeholder="********" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast;</label>
                                                    <input type="text" class="form-control" name="address"  value='<?php
                                                    if (!empty($setval)) {
                                                        echo set_value('address');
                                                    }
                                                    if (!empty($superadmin->address)) {
                                                        echo $superadmin->address;
                                                    }
                                                    ?>' placeholder="" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast;</label>
                                                    <input type="number" class="form-control" name="phone"  value='<?php
                                                    if (!empty($setval)) {
                                                        echo set_value('phone');
                                                    }
                                                    if (!empty($superadmin->phone)) {
                                                        echo $superadmin->phone;
                                                    }
                                                    ?>' placeholder="" required>
                                                </div>

                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="control-label"><?php echo lang('upload_image'); ?></label>
                                                <div class="">
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail <?php if (!empty($superadmin->img_url)) { ?> img_url <?php } else { ?> img_url1 <?php } ?>">
                                                            <img src="<?php
                                                            if (!empty($superadmin->img_url)) {
                                                                echo $superadmin->img_url;
                                                            }
                                                            ?>" id="img" alt="" />
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                                                        <div>
                                                            <span class="btn btn-soft-info btn-file">
                                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                <input type="file" class="default" name="img_url"/>
                                                            </span>
                                                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> <?php echo lang('remove'); ?></a>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group pos_client"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('module_permission'); ?></label> 
                                                    <br>
                                                    <input type='checkbox' value = "home" name="module[]"

                                                           <?php
                                                           if (!empty($superadmin->id)) {
                                                               $modules = $this->superadmin_model->getSuperadminById($superadmin->id)->module;
                                                               $modules1 = explode(',', $modules);
                                                               if (in_array('home', $modules1)) {
                                                                   echo 'checked';
                                                               }
                                                           } else {
                                                               echo 'checked';
                                                           }
                                                           ?>
                                                           > <?php echo lang('dashboard'); ?> 
                                                    <br>
                                                    <input type='checkbox' value = "hospital" name="module[]"

                                                           <?php
                                                           if (!empty($superadmin->id)) {
                                                               $modules = $this->superadmin_model->getSuperadminById($superadmin->id)->module;
                                                               $modules1 = explode(',', $modules);
                                                               if (in_array('hospital', $modules1)) {
                                                                   echo 'checked';
                                                               }
                                                           } else {
                                                               echo 'checked';
                                                           }
                                                           ?>
                                                           > <?php echo lang('hospital'); ?>

                                                    <br>
                                                    <input type='checkbox' value = "package" name="module[]"  <?php
                                                    if (!empty($superadmin->id)) {
                                                        if (in_array('package', $modules1)) {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?>> <?php echo lang('package'); ?>                              


                                                    <br>
                                                    <input type='checkbox' value = "request" name="module[]"  <?php
                                                    if (!empty($superadmin->id)) {
                                                        if (in_array('request', $modules1)) {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?>> <?php echo lang('request'); ?>
                                                    <br>
                                                    <input type='checkbox' value = "superadmin" name="module[]" <?php
                                                    if (!empty($superadmin->id)) {
                                                        if (in_array('superadmin', $modules1)) {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?>> <?php echo lang('superadmin'); ?>

                                                    <br>
                                                    <input type='checkbox' value = "email" name="module[]" <?php
                                                    if (!empty($superadmin->id)) {
                                                        if (in_array('email', $modules1)) {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?>> <?php echo lang('email'); ?>

                                                    <br>
                                                    <input type='checkbox' value = "pgateway" name="module[]" <?php
                                                    if (!empty($superadmin->id)) {
                                                        if (in_array('pgateway', $modules1)) {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?>> <?php echo lang('payment_gateway'); ?>
                                                    <br>
                                                    <input type='checkbox' value = "slide" name="module[]" <?php
                                                    if (!empty($superadmin->id)) {
                                                        if (in_array('slide', $modules1)) {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?>> <?php echo lang('slides'); ?>
                                                    <br>
                                                    <input type='checkbox' value = "service" name="module[]" <?php
                                                    if (!empty($superadmin->id)) {
                                                        if (in_array('service', $modules1)) {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?>> <?php echo lang('service'); ?>
                                                    <br>
                                                    <input type='checkbox' value = "systems" name="module[]" <?php
                                                    if (!empty($superadmin->id)) {
                                                        if (in_array('systems', $modules1)) {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?>> <?php echo lang('report'); ?>
                                                </div>
                                           
                                                <input type="hidden" name="id" value='<?php
                                                if (!empty($superadmin->id)) {
                                                    echo $superadmin->id;
                                                }
                                                ?>'>
                                                <button type="submit" name="submit" class="btn btn-info btn-group pull-right"><?php echo lang('submit'); ?></button>
                                                </div>
                                        </form>
                                    <!-- </div> -->
                                <!-- </section> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->
