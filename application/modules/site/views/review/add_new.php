<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">  <?php
                if (!empty($review->id))
                    echo  lang('edit');
                else
                    echo  lang('add');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('review'); ?></li>
                                        <li class="breadcrumb-item active">  <?php
                if (!empty($review->id))
                    echo  lang('edit');
                else
                    echo  lang('add');
                ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <div class="col-md-7">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">    <?php
                if (!empty($review->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_review');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_review');
                ?> </h4> 
                                       
                                    </div>
          
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="site/review/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">    
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="name"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('name');
                                            }
                                            if (!empty($review->name)) {
                                                echo $review->name;
                                            }
                                            ?>' placeholder="" required="">   
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('designation'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="designation"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('designation');
                                            }
                                            if (!empty($review->designation)) {
                                                echo $review->designation;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('review'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="review"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('review');
                                            }
                                            if (!empty($review->review)) {
                                                echo $review->review;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('status'); ?> &#42;</label>
                                            <select class="form-control m-bot15" name="status" value='' required="">
                                                <option value="Active" <?php
                                                if (!empty($setval)) {
                                                    if ($review->status == set_value('status')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($review->status)) {
                                                    if ($review->status == 'Active') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('active'); ?> 
                                                </option>
                                                 <option value="Inactive" <?php
                                                if (!empty($setval)) {
                                                    if ($review->status == set_value('status')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($review->status)) {
                                                    if ($review->status == 'Inactive') {
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
                                        if (!empty($review->id)) {
                                            echo $review->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                    </form>
                                </div>
                            </section>
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