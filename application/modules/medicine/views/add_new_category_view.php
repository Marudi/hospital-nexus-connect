<!--sidebar end--> 
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php
                if (!empty($medicine->id))
                    echo lang('edit_medicine_category');
                else
                    echo lang('add_medicine_category');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('medicine'); ?></li>
                                        <li class="breadcrumb-item active"> <?php
                if (!empty($medicine->id))
                    echo lang('edit_medicine_category');
                else
                    echo lang('add_medicine_category');
                ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="col-md-6 row">
            <div class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                if (!empty($medicine->id))
                    echo lang('edit_medicine_category');
                else
                    echo lang('add_medicine_category');
                ?></h4>
                                    </div>
          
            
                        <div class="card-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="medicine/addNewCategory" class="clearfix" method="post" enctype="multipart/form-data">
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php  echo lang('category'); ?> <?php  echo lang('name'); ?> &ast; </label>
                                            <input type="text" class="form-control" name="category"  value='<?php
                                            if (!empty($medicine->category)) {
                                                echo $medicine->category;
                                            }
                                            ?>' placeholder="" required="">    
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('description'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="description"  value='<?php
                                            if (!empty($medicine->description)) {
                                                echo $medicine->description;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($medicine->id)) {
                                            echo $medicine->id;
                                        }
                                        ?>'>
                                        <div class="form-group pull-right">
                                        <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?></button>
                                        </div>
                                    </form>
                        </div>
                    
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
<!--main content end-->
<!--footer start-->
