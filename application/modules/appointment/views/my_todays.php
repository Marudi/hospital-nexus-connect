<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
        <!-- page start-->
        <link href="common/extranal/css/appointment/appointment.css" rel="stylesheet">
        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('todays_appointments'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('todays_appointments'); ?></li>
                                        
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                                <div class="card-header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('todays_appointments'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right custom_buttons"> 
                                       
                                           
                                        </div>
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample_my_today">
                   
                        <thead>
                            <tr>
                                <th> <?php echo lang('id'); ?></th>
                                <th> <?php echo lang('patient'); ?></th>
                                <th> <?php echo lang('doctor'); ?></th>
                                <th> <?php echo lang('date-time'); ?></th>
                                <th> <?php echo lang('remarks'); ?></th>
                                <th> <?php echo lang('status'); ?></th>
                                <th> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                       





                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
        <!-- page end-->
    </div>
</div>
<!--main content end-->
<!--footer start-->



<!-- Add Appointment Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg"">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_appointment'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="appointment/addNew" method="post" class="clearfix" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label> 
                        <select class="form-control m-bot15 pos_select" id="pos_select" name="patient" value=''> 

                        </select>
                    </div>
                    <div class="pos_client clearfix col-md-6">
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                            <input type="email" class="form-control pay_in" name="p_email" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            <input type="number" class="form-control pay_in" name="p_phone" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label> 
                            <input type="number" class="form-control pay_in" name="p_age" value='' placeholder="">
                        </div> 
                        <div class="payment pad_bot"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            <select class="form-control" name="p_gender" value=''>

                                <option value="Male" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Male') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Male </option>   
                                <option value="Female" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Female') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Female </option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 panel doctor_div">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                        <select class="form-control m-bot15 " id="adoctors" name="doctor" value=''>  

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date" readonly="" name="date"  value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('appointment'); ?> <?php echo lang('status'); ?></label> 
                        <select class="form-control m-bot15" name="status" value=''>
                            <option value="Pending Confirmation" <?php
                                ?> > <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php
                                ?> > <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php
                                ?> > <?php echo lang('treated'); ?> </option>
                            <option value="Cancelled" <?php
                                ?> > <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks"  value='' placeholder="">
                    </div>
                   
                    <div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Appointment Modal-->

<div class="modal fade" role="dialog" id="cmodal">
    <div class="modal-dialog modal-xl med_his" role="document">
        <div class="modal-content">
        <!-- <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('patient').' '.lang('history'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div> -->
            <div class="modal-body row">
            <div id='medical_history'>
                <div class="col-md-12">

                </div>
            </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 pull-right">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_appointment'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editAppointmentForm" action="appointment/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label> 
                        <select class="form-control m-bot15 pos_select patient1" id="pos_select1" name="patient" value=''> 

                        </select>
                    </div>
                    <div class="pos_client1 clearfix col-md-6">
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                            <input type="email" class="form-control pay_in" name="p_email" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            <input type="number" class="form-control pay_in" name="p_phone" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label> 
                            <input type="number" class="form-control pay_in" name="p_age" value='' placeholder="">
                        </div> 
                        <div class="payment pad_bot"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            <select class="form-control" name="p_gender" value=''>

                                <option value="Male" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Male') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Male </option>   
                                <option value="Female" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Female') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Female </option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 panel doctor_div1">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                        <select class="form-control m-bot15  doctor" id="adoctors1" name="doctor" value=''>  

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date1" readonly="" name="date"  value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots1" value=''> 

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('appointment'); ?> <?php echo lang('status'); ?></label> 
                        <select class="form-control m-bot15" name="status" value=''>
                            <option value="Pending Confirmation" <?php
                                ?> > <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php
                                ?> > <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php
                                ?> > <?php echo lang('treated'); ?> </option>
                            <option value="Cancelled" <?php
                                ?> > <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div>

                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks"  value='' placeholder="">
                    </div>
                    
                    <input type="hidden" name="id" id="appointment_id" value=''>
                    <div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/appointment/appointment_my_todays.js"></script>
<script src="common/extranal/js/appointment/appointment_select2.js"></script>