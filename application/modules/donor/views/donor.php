
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('donor'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('donor'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
        <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('donor'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"> <i class="fa fa-plus-circle"></i> <?php echo lang('add_donor'); ?></button>
                                                    </div>
                                                    <?php }else{ ?>
                                                        
                                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('donor'); ?></h4> 
                                                        <?php } ?>

                                           
                                       
                                    </div>
         
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('blood_group'); ?></th>
                                <th><?php echo lang('age'); ?></th>
                                <th><?php echo lang('sex'); ?></th>
                                <th><?php echo lang('last_donation_date'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>


                        <?php foreach ($donors as $donor) { ?>
                            <tr class="">
                                <td><?php echo $donor->name; ?></td>
                                <td> <?php echo $donor->group; ?></td>
                                <td><?php echo $donor->age; ?></td>
                                <td class="center"><?php echo $donor->sex; ?></td>
                                <td><?php echo $donor->ldd; ?></td>
                                <td><?php echo $donor->phone; ?></td>
                                <td><?php echo $donor->email; ?></td>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
                                    <td class="no-print">
                                        <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $donor->id; ?>"><i class="fa fa-edit"> </i></button>   
                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="donor/delete?id=<?php echo $donor->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>

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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('add_donor') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           
            <div class="modal-body row">
                <form role="form" action="donor/addDonor" class="clearfix" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast; </label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="group" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($donor->group)) {
                                    if ($group->group == $donor->group) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input type="text" class="form-control" name="age"  value='' placeholder="" required>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"><?php echo lang('last_donation_date'); ?> &ast; </label>
                        <input class="form-control form-control-inline input-medium default-date-picker readonly" autocomplete="off" type="text" name="ldd" value="" placeholder="" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast; </label>
                        <input type="number" class="form-control" name="phone"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>
                            <option value="Male" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>

                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast; </label>
                        <input type="email" class="form-control" name="email"  value='' placeholder="" required="">
                    </div>

                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                        </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('edit_donor') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
          
            <div class="modal-body row">
                <form role="form" id="editDonorForm" class="clearfix" action="donor/addDonor" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="group" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($donor->group)) {
                                    if ($group->group == $donor->group) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input type="text" class="form-control" name="age"  value='' placeholder="" required>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"><?php echo lang('last_donation_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="ldd" value="" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>
                            <option value="Male" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>

                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email"  value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>


                        </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/donor/donor.js"></script>