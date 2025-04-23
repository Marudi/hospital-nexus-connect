<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('holiday'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('schedule'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('holiday'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('holiday'); ?> (<?php echo $this->db->get_where('doctor', array('id' => $doctorr))->row()->name; ?>)</h4> 
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
                                <th> <?php echo lang('date'); ?></th>
                                <th> <?php echo lang('options'); ?></th>

                            </tr>
                        </thead>
                        <tbody>  
                      
                        <?php
                        $i = 0;
                        foreach ($holidays as $holiday) {
                            $i = $i + 1;
                            ?> 
                            <tr class="">
                                <td> <?php echo $i; ?></td>
                                <td> <?php echo date('d-m-Y', $holiday->date); ?></td> 
                                <td>
                                    <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $holiday->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                    <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="schedule/deleteHoliday?id=<?php echo $holiday->id; ?>&doctor=<?php echo $doctorr; ?>&redirect=schedule/holidays?doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                </td>
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




<!-- Add Holiday Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('add'); ?> <?php echo lang('holiday'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
        
            <div class="modal-body">
                <form role="form" action="schedule/addHoliday" class='clearfix' method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control default-date-picker" name="date" autocomplete="off" value='' required="">
                        </div>

                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="redirect" value='schedule/holidays?doctor=<?php echo $doctorr; ?>'>
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
<!-- Add Holiday Modal-->





<!-- Edit Holiday Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('edit'); ?> <?php echo lang('holiday'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
            <div class="modal-body">
                <form role="form" id="editHolidayForm" action="schedule/addHoliday" class='clearfix' method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control default-date-picker" name="date" autocomplete="off" value='' required="">
                        </div>

                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="redirect" value='schedule/holidays?doctor=<?php echo $doctorr; ?>'>
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
<!-- Edit Holiday Modal-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/schedule/holidays.js"></script>