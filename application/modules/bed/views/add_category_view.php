<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">    <?php
                if (!empty($bed->id))
                    echo  lang('edit_bed_category');
                else
                    echo  lang('add_bed_category');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('bed'); ?></li>
                                        <li class="breadcrumb-item active">   <?php
                if (!empty($bed->id))
                    echo  lang('edit_bed_category');
                else
                    echo  lang('add_bed_category');
                ?></li>
                                     
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                if (!empty($bed->id))
                    echo  lang('edit_bed_category');
                else
                    echo  lang('add_bed_category');
                ?></h4> 
                                        
                                    </div>
           
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="bed/addCategory" method="post" enctype="multipart/form-data">
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"><?php echo lang('category'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="category" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('category');
                                            }
                                            if (!empty($bed->category)) {
                                                echo $bed->category;
                                            }
                                            ?>' placeholder="" required="">    
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                                            <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('description');
                                            }
                                            if (!empty($bed->description)) {
                                                echo $bed->description;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($bed->id)) {
                                            echo $bed->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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
</div>
</div>
<!--main content end-->
<!--footer start-->
