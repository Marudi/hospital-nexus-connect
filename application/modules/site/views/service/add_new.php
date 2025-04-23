<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">  <?php
                if (!empty($service->id))
                    echo  lang('edit');
                else
                    echo  lang('add');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('service'); ?></li>
                                        <li class="breadcrumb-item active">  <?php
                if (!empty($service->id))
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
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                if (!empty($service->id))
                    echo lang('edit_service');
                else
                    echo lang('add_service');
                ?> </h4> 
                                       
                                    </div>
            
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <form role="form" action="site/service/addNew" method="post" enctype="multipart/form-data">
                            <div class="form-group">    
                                <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                                <input type="text" class="form-control" name="title"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('title');
                                }
                                if (!empty($service->title)) {
                                    echo $service->title;
                                }
                                ?>' placeholder="" required="">   
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                                <input type="text" class="form-control" name="description"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('description');
                                }
                                if (!empty($service->description)) {
                                    echo $service->description;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" name="img_url">
                            </div>
                            <input type="hidden" name="id" value='<?php
                            if (!empty($service->id)) {
                                echo $service->id;
                            }
                            ?>'>
                            <button type="submit" name="submit" class="btn btn-info">Submit</button>
                        </form>
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
