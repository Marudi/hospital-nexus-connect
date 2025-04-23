<link href="common/extranal/css/attendance.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('attendance'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('attendance'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('attendance'); ?></h4> 
                                        <!-- <div class="col-lg-4 no-print pull-right">  -->
                                        <!-- <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"></button> -->
                                           
                                        <!-- </div> -->
                                    </div>
            <!-- <header class="panel-heading">
                <?php echo lang('attendance'); ?>    
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">

                        </div>
                    </a>
                </div>
            </header> -->
            <div class="card-body">
                <div class="row row_margin">
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <div class="col-md-3">
                            <select class="form-control" id="staff_select">

                            </select>
                        </div>
                    <?php } ?>
                    <div class="col-md-3">
                        <select class="form-control ca_select2" id="attendance_month">
                            <?php
                            foreach ($months as $month) {
                                if ($month == date('F')) {
                                    ?>
                                    <option value="<?php echo $month; ?>" selected><?php echo $month; ?></option>
                                    <?php
                                    break;
                                } else {
                                    ?>
                                    <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control ca_select2" id="attendance_year">
                            <?php foreach ($years as $year) {
                                ?>
                                <option value="<?php echo $year; ?>" <?php if ($year == date('Y')) { ?>selected<?php } ?>><?php echo $year; ?></option>
    <?php }
?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success applyAttendanceFilter"><?php echo lang('apply'); ?></button>
                    </div>
                </div>
                <div class="row attendanceDiv">
                    <div class="col-md-12 attendanceDiv_col">
                    <table class="table mb-0" id="">
                        <!-- <table class="table table-bordered table-striped table-responsive"> -->
                            <thead class="thead-dark">
                            <th><?php echo lang('staff') ?></th>
                            <?php for ($i = 1; $i <= date('t'); $i++) {
                                ?>
                                <th class="text_center"><?php echo $i; ?></th>
    <?php }
?>
                            <th><?php echo lang('total') ?></th>
                            </thead>
                            <tbody>
                                    <?php for ($j = 0; $j < $total_employees; $j++) { 
                                        $count=0
                                        ?>
                                    <tr>
                                        <?php for ($i = 0; $i <= (date('t')); $i++) {
                                            if ($i == 0) {
                                                ?>
                                                <td><?php echo $details[$j][$i] ?></td>
        <?php } else if ($i == (date('t')+1 )) { ?>
                                                <td><?php echo $details[$j][$i] ?></td>
                                                <?php } else { ?>
                                                <td><?php if ($details[$j][$i] == 'no') { ?>
                                                        <button class="<?php if ($this->ion_auth->in_group('admin') || $i > date('d') - 1) { ?> markAttandance <?php } ?> markAttendance_css"  data-employee="<?php echo $employee[$j]; ?>" data-id="<?php echo $i . '-' . date('m-Y'); ?>"><i class="fas fa-times"></i></button>
                                                    <?php } else if ($details[$j][$i] == 'yes') {
                                                        $count+=1;
                                                        ?>
                                                        <button class="<?php if (1 == 1) { ?> markAttandance <?php } ?> markAttendance_css"  data-employee="<?php echo $employee[$j]; ?>" data-id="<?php echo $i . '-' . date('m-Y'); ?>"><i class="fas fa-check"></i></button>
                                                    <?php } else { ?>
                                                        <button class="<?php if ($this->ion_auth->in_group('admin') || $i > date('d') - 1) { ?> markAttandance <?php } ?> markAttendance_css"  data-employee="<?php echo $employee[$j]; ?>" data-id="<?php echo $i . '-' . date('m-Y'); ?>"><i class="fas fa-times"></i></button>
                                                  <?php  }
                                                    ?></td>
                                                   
        <?php }
    } ?>
     <td><?php echo $count;?></td>
                                    </tr>
<?php } ?>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->






<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('add_new_leave') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_new_leave'); ?></h4> -->
            </div>
            <div class="modal-body row">
                <form role="form" action="leave/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('choose_staff'); ?> &#42;</label>
                        <select name="staff" class="" id="add_leave_staff" required=""></select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('leave_type'); ?> &#42;</label>
                        <select name="leave_type" class="ca_select2" id="ca_select2" required="">
<?php foreach ($leave_types as $leaveType) { ?>
                                <option value="<?php echo $leaveType->name; ?>"><?php echo $leaveType->name; ?></option>
<?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('select_duration'); ?></label>
                        <div class="duration_select">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input leave_duration" type="radio" name="duration" id="inlineRadio1" value="single">
                                <label class="form-check-label" for="inlineRadio1"><?php echo lang('single'); ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input leave_duration" type="radio" name="duration" id="inlineRadio2" value="multiple">
                                <label class="form-check-label" for="inlineRadio2"><?php echo lang('multiple'); ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input leave_duration" type="radio" name="duration" id="inlineRadio3" value="halfday">
                                <label class="form-check-label" for="inlineRadio3"><?php echo lang('halfday'); ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6 singleDate">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control single_date_picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="" required>
                    </div>

                    <div class="form-group col-md-6 multiDate">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control " name="date2" id="multi_date_picker" placeholder="" readonly="" multiple="">
                    </div>

                    <div class="col-md-6"></div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('reason_for_leave'); ?></label>
                        <textarea  class="form-control reason_class" name="reason" rows="5" required></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                        <select name="status" class="ca_select2" required>
                            <option value="approved"><?php echo lang('approved'); ?></option>
                            <option value="pending"><?php echo lang('pending'); ?></option>
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
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"> <?php echo lang('edit_leave') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body">
                <form role="form" id="editLeaveForm" class="clearfix" action="leave/updateLeave" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('choose_staff'); ?></label>
                        <select name="staff" class="" id="edit_leave_staff"></select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('leave_type'); ?></label>
                        <select name="leave_type" class="ca_select2" id="edit_Leave_select2">
<?php foreach ($leave_types as $leaveType) { ?>
                                <option value="<?php echo $leaveType->name; ?>"><?php echo $leaveType->name; ?></option>
<?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('select_duration'); ?></label>
                        <div class="duration_select1">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input edit_leave_duration" type="radio" name="duration" id="single" value="single">
                                <label class="form-check-label" for="inlineRadio1"><?php echo lang('single'); ?></label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input edit_leave_duration" type="radio" name="duration" id="halfday2" value="halfday">
                                <label class="form-check-label" for="inlineRadio3"><?php echo lang('halfday'); ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6 singleDate">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control single_date_picker" name="date" id="editDate" value='' placeholder="" readonly="" required>
                    </div>

                    <div class="form-group col-md-6 multiDate">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control " name="date2" id="edit_multi_date_picker" placeholder="" readonly="" multiple="">
                    </div>

                    <div class="col-md-6"></div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('reason_for_leave'); ?></label>
                        <textarea  class="form-control reason_class" name="reason" rows="5" required></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                        <select name="status" id="editLeaveStatus" class="ca_select2" required>
                            <option value="approved"><?php echo lang('approved'); ?></option>
                            <option value="pending"><?php echo lang('pending'); ?></option>
                        </select>
                    </div>
                    <input type="hidden" name="id" id="editLeaveId">
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



<div class="modal fade" id="attendanceModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('attendance') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body">
                <form role="form" id="attendanceForm" class="clearfix" action="attendance/updateAttendance" method="post" enctype="multipart/form-data">

                    <div class="col-md-12 row">
                        <div class="form-group col-md-6">
                            <label><?php echo lang('clock_in'); ?></label>
                            <input type="text" class="form-control timepicker-default readonly" name="clock_in"  required="true" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label><?php echo lang('clock_out'); ?></label>
                            <input type="text" class="form-control timepicker-default" name="clock_out" readonly="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="checkbox" id="halfday" name="halfday" value="halfday" class="custom-control-input2">
                                <label class="custom-control-label" for="customRadioInline2"><?php echo lang('halfday'); ?></label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="checkbox" id="late" name="late" value="late" class="custom-control-input1">
                                <label class="custom-control-label" for="customRadioInline1"><?php echo lang('late'); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('work_from'); ?></label>
                            <input type="text" class="form-control" name="work_from" value="office" required>
                        </div>
                    </div>

                    <input type="hidden" id="attendanceDate" name="date">
                    <input type="hidden" id="staffId" name="id">

                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>


                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>






<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script type="text/javascript">var select_staff = "<?php echo lang('select_staff'); ?>";</script>
<script src="common/extranal/js/attendance.js"></script>