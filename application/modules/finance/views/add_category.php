<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">    <?php
                if (!empty($category->id)){
                    echo lang('edit_payment_categories');
                } else{
                    echo lang('add_payment_category');
                }
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active">   <?php
                if (!empty($category->id)){
                    echo lang('edit_payment_categories');
                } else{
                    echo lang('add_payment_category');
                }
                ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="col-md-6">
        <div class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">   <?php
                if (!empty($category->id)){
                    echo lang('edit_payment_categories');
                } else{
                    echo lang('add_payment_category');
                }
                ?></h4> 
                                      
                                    </div>
          
            <div class="card-body">
                <div class="adv-table editable-table "> 
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="finance/addCategory" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="form-group"> 
                                <label for="exampleInputEmail1"><?php echo lang('category'); ?> &ast; </label>
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
                            <input type="hidden" name="id" value='<?php
                            if (!empty($category->id)) {
                                echo $category->id;
                            }
                            ?>'>
                            <div class="form-group cl-md-12 pull-right">
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div></div></div>
<!--main content end-->
<!--footer start-->
