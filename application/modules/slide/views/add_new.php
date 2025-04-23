<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php
                if (!empty($slide->id))
                    echo lang('edit_slide');
                else
                    echo  lang('add_slide');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('website'); ?></li>
                                        <li class="breadcrumb-item active"><?php
                if (!empty($slide->id))
                    echo lang('edit_slide');
                else
                    echo  lang('add_slide');
                ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
        <h4 class="card-title mb-0 col-lg-8">   <?php
                if (!empty($slide->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_slide');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_slide');
                ?></h4> 
        </div>
          
         
            <div class="card-body">
            <div class="table-responsive adv-table">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="">
                                <div class="">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="slide/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">    
                                            <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                                            <input type="text" class="form-control" name="title"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('title');
                                            }
                                            if (!empty($slide->title)) {
                                                echo $slide->title;
                                            }
                                            ?>' placeholder="">   
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('text1'); ?></label>
                                            <input type="text" class="form-control" name="text1"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('text1');
                                            }
                                            if (!empty($slide->text1)) {
                                                echo $slide->text1;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('text2'); ?></label>
                                            <input type="text" class="form-control" name="text2"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('text2');
                                            }
                                            if (!empty($slide->text2)) {
                                                echo $slide->text2;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('text3'); ?></label>
                                            <input type="text" class="form-control" name="text3"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('text3');
                                            }
                                            if (!empty($slide->text3)) {
                                                echo $slide->text3;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('position'); ?></label>
                                            <input type="text" class="form-control" name="position"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('position');
                                            }
                                            if (!empty($slide->position)) {
                                                echo $slide->position;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                                            <select class="form-control m-bot15" name="status" value=''>
                                                <option value="Active" <?php
                                                if (!empty($setval)) {
                                                    if ($slide->status == set_value('status')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($slide->status)) {
                                                    if ($slide->status == 'Active') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('active'); ?> 
                                                </option>
                                                 <option value="Inactive" <?php
                                                if (!empty($setval)) {
                                                    if ($slide->status == set_value('status')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($slide->status)) {
                                                    if ($slide->status == 'Inactive') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('in_active'); ?> 
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image</label>
                                            <input type="file" name="img_url">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($slide->id)) {
                                            echo $slide->id;
                                        }
                                        ?>'>
                                        <div class="pull-right">
                                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>  
                    </div> 
                </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div></div>
<!--main content end-->
<!--footer start-->
