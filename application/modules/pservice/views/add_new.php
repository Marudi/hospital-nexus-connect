<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">  <?php
                if (!empty($pservice->id))
                    echo lang('edit_pservice');
                else
                    echo lang('add_pservice');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('bed'); ?></li>
                                        <li class="breadcrumb-item active">  <?php
                if (!empty($pservice->id))
                    echo lang('edit_pservice');
                else
                    echo lang('add_pservice');
                ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/bed/patient_service.css" rel="stylesheet">
      
        <section class="col-md-6">
<div class="card"> 
     <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                if (!empty($pservice->id))
                    echo lang('edit_pservice');
                else
                    echo lang('add_pservice');
                ?></h4> 
                                       
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
                        <form role="form" action="pservice/addNew" class="clearfix" method="post" enctype="multipart/form-data">
<div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->name)) {
                            echo $pservice->name;
                        }
                        ?>' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('code'); ?></label>
                        <input type="text" class="form-control" name="code" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->code)) {
                            echo $pservice->code;
                        }
                        ?>' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('alpha_code'); ?></label>
                        <input type="text" class="form-control" name="alpha_code" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->alpha_code)) {
                            echo $pservice->alpha_code;
                        }
                        ?>' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('price'); ?></label>
                        <input type="text" class="form-control" min="0" name="price" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->price)) {
                            echo $pservice->price;
                        }
                        ?>' placeholder="" required="">
                    </div>

                   
                    <div class="form-group col-md-6">
                        
                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='' <?php
                         if (!empty($pservice->active)) {
                        if ($pservice->active=="1") {
                            echo "checked";
                        }
                    }
                        ?>>
                        <label for="exampleInputEmail1"> <?php echo lang('active'); ?></label>
                    </div>





                            <input type="hidden" name="id" value='<?php
                            if (!empty($pservice->id)) {
                                echo $pservice->id;
                            }
                            ?>'>

<div class="col-md-6 pull-right">
                            <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
</div>
</div>
                        </form>

                    </div>
                </div>

            </div>
            </div>
        </section>
    </div>
    <!-- page end-->
</div>
</div>
<!--main content end-->
<!--footer start-->
