<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('schedule'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                       
                                        <li class="breadcrumb-item active"><?php echo lang('schedule'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('time_schedule'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                                           
                                        </div>
                                    </div>
        

            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> <?php echo lang('doctor'); ?></th>
                                <th> <?php echo lang('weekday'); ?></th>
                                <th> <?php echo lang('start_time'); ?></th>
                                <th> <?php echo lang('end_time'); ?></th>
                                <th> <?php echo lang('duration'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                    <th> <?php echo lang('options'); ?></th>
                                <?php } ?>

                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            $i = 0;
                            foreach ($schedules as $schedule) {
                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td> <?php echo $i; ?></td> 
                                    <td> <?php echo $this->doctor_model->getDoctorById($schedule->doctor)->name; ?></td>
                                    <td> <?php echo $schedule->weekday; ?></td> 
                                    <td><?php echo $schedule->s_time; ?></td>
                                    <td><?php echo $schedule->e_time; ?></td>
                                    <td><?php echo $schedule->duration * 5 . ' ' . lang('minitues'); ?></td>
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                        <td>
                                           
                                            <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="schedule/deleteSchedule?id=<?php echo $schedule->id; ?>&doctor=<?php echo $schedule->doctor; ?>&weekday=<?php echo $schedule->weekday; ?>&all=all" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
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




<!-- Add Time Slot Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('add'); ?> <?php echo lang('schedule'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
          
           
            <div class="modal-body row">
                <form role="form" action="schedule/addSchedule" class="clearfix" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 panel doctor_div">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?> &ast;</label>
                        <select class="form-control m-bot15" id="doctorchoose" name="doctor" value='' required="">
                            <?php if (!empty($prescription->doctor)) { ?>
                                <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - <?php echo $doctors->id; ?></option>  
                            <?php } ?>
                            <?php
                            if (!empty($setval)) {
                                $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                ?>
                                <option value="<?php echo $doctordetails1->id; ?>" selected="selected"><?php echo $doctordetails1->name; ?> - <?php echo $doctordetails1->id; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6 weekday_div">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?> &ast;</label>
                        <select class="form-control m-bot15" id="weekday" name="weekday" value='' required=""> 
                            <option value="Friday"><?php echo lang('friday') ?></option>
                            <option value="Saturday"><?php echo lang('saturday') ?></option>
                            <option value="Sunday"><?php echo lang('sunday') ?></option>
                            <option value="Monday"><?php echo lang('monday') ?></option>
                            <option value="Tuesday"><?php echo lang('tuesday') ?></option>
                            <option value="Wednesday"><?php echo lang('wednesday') ?></option>
                            <option value="Thursday"><?php echo lang('thursday') ?></option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?> &ast;</label>
                        <div class="input-group bootstrap-timepicker timepickers_time">
                            <input type="text" class="form-control timepicker-default1" name="s_time" id="s_time"  value='' required="" autocomplete="off">
                            <span class="input-group-text">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?> &ast;</label>
                        <div class="input-group bootstrap-timepicker timepickere_time">
                            <input type="text" class="form-control timepicker-default1" name="e_time"  id="e_time"  value='' required="" autocomplete="off">
                            <span class="input-group-text">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock"></i></button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('appointment') ?> <?php echo lang('duration') ?> &ast; </label>
                        <select class="form-control m-bot15" name="duration" value='' required="">

                            <option value="3" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '3') {
                                    echo 'selected';
                                }
                            }
                            ?> > 15 Minitues </option>

                            <option value="4" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '4') {
                                    echo 'selected';
                                }
                            }
                            ?> > 20 Minitues </option>

                            <option value="6" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '6') {
                                    echo 'selected';
                                }
                            }
                            ?> > 30 Minitues </option>

                            <option value="9" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '9') {
                                    echo 'selected';
                                }
                            }
                            ?> > 45 Minitues </option>

                            <option value="12" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '12') {
                                    echo 'selected';
                                }
                            }
                            ?> > 60 Minitues </option>

                        </select>
                    </div>

                    <input type="hidden" name="redirect" value='schedule'>
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
<!-- Add Time Slot Modal-->





<!-- Edit Time Slot Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('edit'); ?> <?php echo lang('schedule'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
          
            
            <div class="modal-body">
                <form role="form" id="editTimeSlotForm" action="schedule/addSchedule" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15 js-example-basic-single" name="doctor" value=''>  
                                <option value="">Select .....</option>
                                <?php foreach ($doctors as $doctor) { ?>
                                    <option value="<?php echo $doctor->id; ?>"<?php
                                    if (!empty($schedule->doctor)) {
                                        if ($schedule->doctor == $doctor->id) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo $doctor->name; ?> </option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="s_time"  value=''>
                            <span class="input-group-text">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="e_time"  value=''>
                            <span class="input-group-text">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <select class="form-control m-bot15" id="weekday1" name="weekday" value=''> 
                                <option value="Friday"><?php echo lang('friday') ?></option>
                                <option value="Saturday"><?php echo lang('saturday') ?></option>
                                <option value="Sunday"><?php echo lang('sunday') ?></option>
                                <option value="Monday"><?php echo lang('monday') ?></option>
                                <option value="Tuesday"><?php echo lang('tuesday') ?></option>
                                <option value="Wednesday"><?php echo lang('wednesday') ?></option>
                                <option value="Thursday"><?php echo lang('thursday') ?></option>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('appointment') ?> <?php echo lang('duration') ?> </label>
                        <select class="form-control m-bot15" name="duration" value=''>

                            <option value="3" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '3') {
                                    echo 'selected';
                                }
                            }
                            ?> > 15 Minitues </option>

                            <option value="4" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '4') {
                                    echo 'selected';
                                }
                            }
                            ?> > 20 Minitues </option>

                            <option value="6" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '6') {
                                    echo 'selected';
                                }
                            }
                            ?> > 30 Minitues </option>

                            <option value="9" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '9') {
                                    echo 'selected';
                                }
                            }
                            ?> > 45 Minitues </option>

                            <option value="12" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '12') {
                                    echo 'selected';
                                }
                            }
                            ?> > 60 Minitues </option>

                        </select>
                    </div>

                    <input type="hidden" name="redirect" value='schedule'>
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
<!-- Edit Time Slot Modal-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/schedule/schedule.js"></script>