<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('pservice'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('bed'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('pservice'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/bed/patient_service.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
        <?php if ($this->ion_auth->in_group(array('admin')) ) { ?>
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('service'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs no-print" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_pservice'); ?></button>
                                           
                                        </div>
                                        <?php }else{ ?>
                                            <h4 class="card-title mb-0 col-lg-12"><?php echo lang('service'); ?></h4> 
                                            <?php } ?>
                                    </div>
      
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample1">
               
                        <thead>
                            <tr>
                                <th> <?php echo lang('no'); ?></th>
                                <th> <?php echo lang('service'); ?>  <?php echo lang('code'); ?></th>
                                <th> <?php echo lang('alpha_code'); ?>  </th>
                                <th> <?php echo lang('service'); ?>  <?php echo lang('name'); ?></th>
                                <th> <?php echo lang('price'); ?></th>
                               
                                <th> <?php echo lang('active'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <th> <?php echo lang('options'); ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                       

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->




<!-- Add Pservice Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('add_pservice') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
          
            <div class="modal-body">
                <form role="form" action="pservice/addNew" class="clearfix row" method="post" enctype="multipart/form-data">

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

                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='1' <?php
                         if (!empty($pservice->id)) {
                         if ($pservice->active == "1") {
                            echo "checked";
                         }
                         }
                        ?>>
                        <label for="exampleInputEmail1"> <?php echo lang('active'); ?></label>
                    </div>

                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Pservice Modal-->







<!-- Edit Pservice Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('edit_pservice') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           
            <div class="modal-body">
                <form role="form" id="editPserviceForm" class="clearfix row" action="pservice/addNew" method="post" enctype="multipart/form-data">

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
                        
                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='1' <?php
                         if (!empty($pservice->id)) {
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
                   <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>


<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/bed/patient_service.js"></script>