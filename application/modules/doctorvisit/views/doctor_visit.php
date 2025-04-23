
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('doctor_visit'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('doctor'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('doctor_visit'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
       
        <section class="card">
        <div class="card-header table_header">
        <?php if ($this->ion_auth->in_group('admin')) { ?>
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('doctor_visit'); ?></h4> 

                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_doctor_visit'); ?></button>
                                           
                                        </div>
                                        <?php } else { ?>
                                            <h4 class="card-title mb-0 col-lg-12"><?php echo lang('doctor_visit'); ?></h4> 
                                            <?php } ?>
                                    </div>
          
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('doctor'); ?> <?php echo lang('name'); ?></th>
                                <th><?php echo lang('visit'); ?> <?php echo lang('description'); ?></th>
                                <th><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></th>
                                <th><?php echo lang('status'); ?></th>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
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




<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('add_doctor_visit') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           
            <div class="modal-body">
                <form role="form" action="doctorvisit/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                        <select class="form-control m-bot15 doctor" id="adoctors" name="doctor" value='' required="">  

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('visit'); ?> <?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="visit_description" id="exampleInputEmail1" value='' placeholder=""required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></label>
                        <input type="number" min="1" class="form-control" name="visit_charges" id="exampleInputEmail1"  placeholder="<?php echo $settings->currency; ?>"  required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                        <select class="js-example-basic-single" name="status">
                            <option value="active"><?php echo lang('active'); ?></option>
                            <option value="disable"><?php echo lang('in_active'); ?></option>
                        </select>

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
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('edit_doctor_visit') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           
            <div class="modal-body">
                <form role="form" id="editDoctorvisitForm" class="clearfix" action="doctorvisit/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                        <select class="form-control m-bot15 doctor" id="adoctors1" name="doctor" value='' required="">  

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('visit'); ?> <?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="visit_description" id="exampleInputEmail1" value='' placeholder=""required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></label>
                        <input type="number" min="1" class="form-control" name="visit_charges" id="exampleInputEmail1" placeholder="<?php echo $settings->currency; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                        <select class="js-example-basic-single" name="status">
                            <option value="active"><?php echo lang('active'); ?></option>
                            <option value="disable"><?php echo lang('in_active'); ?></option>
                        </select>

                    </div>


                    <input type="hidden" name="id" value=''>

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
<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script src="common/extranal/js/doctor/doctor_visit.js"></script>
