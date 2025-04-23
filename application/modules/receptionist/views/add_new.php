<div class="main-content">
<div class="page-content">

    <div class="container-fluid">

    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('receptionist'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('human_resources'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('receptionist'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('add_new'); ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
            <div class="card col-lg-7">
                            <div class="card-header table_header">
                                        <h4 class="card-title mb-0"><?php
                                                                                if (!empty($receptionist->id))
                                                                                    echo lang('edit_receptionist');
                                                                                else
                                                                                    echo lang('add_receptionist');
                                                                                ?></h4> 
                                        
                                    </div>
           
                                    <div class="card-body">  
                                        <div class="table-responsive adv-table">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="">
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="receptionist/addNew" method="post" enctype="multipart/form-data">
                                    <div class="row"> 
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('name');
                                                                                                                                }
                                                                                                                                if (!empty($receptionist->name)) {
                                                                                                                                    echo $receptionist->name;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?> &#42;</label>
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('email');
                                                                                                                                    }
                                                                                                                                    if (!empty($receptionist->email)) {
                                                                                                                                        echo $receptionist->email;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('password'); ?>   <?php if (empty($receptionist->id)) { ?> &#42; <?php } ?> </label>
                                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********" <?php if (empty($receptionist->id)) { ?> required="" <?php } ?>>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('address');
                                                                                                                                    }
                                                                                                                                    if (!empty($receptionist->address)) {
                                                                                                                                        echo $receptionist->address;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('phone');
                                                                                                                                    }
                                                                                                                                    if (!empty($receptionist->phone)) {
                                                                                                                                        echo $receptionist->phone;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">
                                        </div>





                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('signature'); ?> &ast; </label>
                                            <div class="">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail img_class">
                                                        <img src="<?php

                                                                    if (!empty($receptionist->signature)) {
                                                                        echo $receptionist->signature;
                                                                    }
                                                                    ?>" alt="" />
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                                                    <div>
                                                        <span class="btn btn-soft-info btn-file">
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
                                            <label class="control-label"><?php echo lang('image'); ?> </label>
                                            <div class="">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail img_class">
                                                        <img src="<?php

                                                                    if (!empty($receptionist->img_url)) {
                                                                        echo $receptionist->img_url;
                                                                    }
                                                                    ?>" alt="" />
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                                                    <div>
                                                        <span class="btn  btn-soft-info btn-file">
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
                                            <textarea class="form-control ckeditor" id="editor1" name="profile" value="" rows="50" cols="20"><?php
                                                                                                                                                if (!empty($setval)) {
                                                                                                                                                    echo set_value('profile');
                                                                                                                                                }
                                                                                                                                                if (!empty($receptionist->profile)) {
                                                                                                                                                    echo $receptionist->profile;
                                                                                                                                                }
                                                                                                                                                ?></textarea>

                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                                                                if (!empty($receptionist->id)) {
                                                                                    echo $receptionist->id;
                                                                                }
                                                                                ?>'>
                                        <div class="col-md-12 pull-right" style="margin-top: 10px;">
                                                                                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                                                                </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
</div>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/receptionist.js"></script>