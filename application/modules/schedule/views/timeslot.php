<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Time slots</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('schedule'); ?></li>
                                        <li class="breadcrumb-item active">Time slots</li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8">Time slots (<?php echo $this->db->get_where('doctor', array('id' => $doctor))->row()->name; ?>)</h4> 
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
                                <th> <?php echo lang('start_time'); ?></th>
                                <th> <?php echo lang('end_time'); ?></th>
                                <th> <?php echo lang('weekday'); ?></th>
                                <th> <?php echo lang('options'); ?></th>

                            </tr>
                        </thead>
                        <tbody>  
                     
                        <?php
                        $i = 0;
                        foreach ($slots as $slot) {
                            if ($slot->weekday == 'Monday') {
                                $i = $i + 1; ?>
                                <tr class="">
                                    <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>

                        <?php
                        foreach ($slots as $slot) {
                            if ($slot->weekday == 'Tuesday') {
                                $i = $i + 1; ?>
                                <tr class="">
                                    <td style="background:#876543; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>

                        <?php
                        foreach ($slots as $slot) {
                            if ($slot->weekday == 'Wednesday') {
                                $i = $i + 1; ?>
                                <tr class="">
                                    <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>

                        <?php
                        foreach ($slots as $slot) {
                            if ($slot->weekday == 'Thursday') {
                                $i = $i + 1; ?>
                                <tr class="">
                                    <td style="background:#654321; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>

                        <?php
                        foreach ($slots as $slot) {
                            if ($slot->weekday == 'Friday') {
                                $i = $i + 1; ?>
                                <tr class="">
                                    <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>

                        <?php
                        foreach ($slots as $slot) {
                            if ($slot->weekday == 'Saturday') {
                                $i = $i + 1; ?>
                                <tr class="">
                                    <td style="background:#876543; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>


                        <?php
                        foreach ($slots as $slot) {
                            if ($slot->weekday == 'Sunday') {
                                $i = $i + 1; ?>
                                <tr class="">
                                    <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
    <?php
                            }
                        }
?>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('add'); ?> <?php echo lang('time_slots'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
            
            <div class="modal-body">
                <form role="form" action="scedule/addTimeSlot" method="post" enctype="multipart/form-data">
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
                            <select class="form-control m-bot15" id="weekday" name="weekday" value=''> 
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
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
<!-- Add Time Slot Modal-->





<!-- Edit Time Slot Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('edit'); ?>  <?php echo lang('time_slot'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editTimeSlotForm" action="scedule/addTimeSlot" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="s_time"  value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="e_time"  value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <select class="form-control m-bot15" id="weekday" name="weekday" value=''> 
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Time Slot Modal-->




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/schedule/timeslot.js"></script>
