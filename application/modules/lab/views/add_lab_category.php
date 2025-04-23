<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">  <?php
                if (!empty($category->id))
                    echo lang('edit_lab_test');
                else
                    echo lang('add_lab_test');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('lab'); ?></li>
                                        <li class="breadcrumb-item active">  <?php
                if (!empty($category->id))
                    echo lang('edit_lab_test');
                else
                    echo lang('add_lab_test');
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
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                                                if (!empty($category->id))
                                                    echo lang('edit_lab_test');
                                                else
                                                    echo lang('add_lab_test');
                                                ?></h4> 
                                    
                                    </div>
          
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="lab/addLabCategory" method="post" enctype="multipart/form-data">
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"><?php echo lang('test_name'); ?> &ast; </label>
                                            <input type="text" class="form-control" name="category"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('category');
                                            }
                                            if (!empty($category->category)) {
                                                echo $category->category;
                                            }
                                            ?>' placeholder="" required="">    
                                        </div> 

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('description'); ?> &ast; </label>
                                            <input type="text" class="form-control" name="description"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('description');
                                            }
                                            if (!empty($category->description)) {
                                                echo $category->description;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('reference_value'); ?> &ast; </label>
                                            <input type="text" class="form-control" name="reference_value"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('reference_value');
                                            }
                                            if (!empty($category->reference_value)) {
                                                echo $category->reference_value;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                       

                                       

                                        <input type="hidden" name="id" value='<?php
                                                if (!empty($category->id)) {
                                                    echo $category->id;
                                                }
                                                ?>'>
                                        <div class="pull-right">        
                                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                        </div>
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
<!--main content end-->
<!--footer start-->
