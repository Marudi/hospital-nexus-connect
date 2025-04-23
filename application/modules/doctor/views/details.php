
 <link href="common/extranal/css/doctor/details.css" rel="stylesheet">
 <!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
        <!-- page start-->
        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('doctor'); ?> <?php echo lang('details'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('doctor'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('details'); ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
        <section class="col-md-9">
               
            <section class="card">
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#todays" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('todays'); ?> <?php echo lang('appointments'); ?></span> 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#patient" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('patient'); ?></span> 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#prescription1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('prescription'); ?></span>   
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#schedule" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('schedule'); ?></span>    
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#holiday" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('holidays'); ?></span>    
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#calendar" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('calendar'); ?></span>    
                                                </a>
                                            </li>
                                        </ul>
                
                <div class="col-md-12">
                    <div class="tab-content">
                        <div id="todays" class="tab-pane" role="tabpanel">
                            <div class="card-body">
                                <div class="col-lg-12 no-print pull-right" style="padding-bottom: 5px;">
                                   
                                    <button type="button" class="btn btn-info waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#addAppointmentModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                                </div>
                                <div class="table-responsive adv-table">
                                            <table class="table mb-0 appointment_edit">
                                
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo lang('patient_id'); ?></th>
                                                <th><?php echo lang('patient'); ?></th>
                                                <th><?php echo lang('status'); ?></th>
                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($todays_appointments as $todays_appointment) {
                                                $patient_details = $this->patient_model->getPatientById($todays_appointment->patient);
                                                if (!empty($patient_details)) {
                                                    ?>
                                                    <tr class="">
                                                        <td><?php echo date('d-m-Y', $todays_appointment->date); ?></td>
                                                        <td><?php echo $todays_appointment->patient; ?></td>
                                                        <td><?php echo $patient_details->name; ?></td>
                                                        <td><?php echo $todays_appointment->status; ?></td>
                                                        <td class="no-print">
                                                            <button type="button" class="btn btn-soft-info waves-effect waves-light btn-xs  editAppointmentButton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $todays_appointment->id; ?>"><i class="fa fa-edit"></i> </button>   
                                                            <a class="btn btn-soft-info waves-effect waves-light btn-xs delete_button" title="<?php echo lang('delete'); ?>" href="appointment/delete?id=<?php echo $todays_appointment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                                            <a class="btn btn-soft-info waves-effect waves-light btn-xs green button_his" title="<?php echo lang('history'); ?>"  href="patient/medicalHistory?id=<?php echo $todays_appointment->patient; ?>"><i class="fa fa-stethoscope"></i> <?php echo lang('patient'); ?> <?php echo lang('history'); ?></a>
                                                            <?php if ($todays_appointment->status == 'Confirmed') { ?>
                                                                <a class="btn btn-soft-info waves-effect waves-light btn-xs detailsbutton button_his" title=" <?php echo lang('start_live'); ?>"  href="meeting/instantLive?id=<?php echo $todays_appointment->id; ?> " target="_blank" onclick="return confirm('Are you sure you want to start a live meeting with this patient? SMS and Email notification will be sent to the Patient.');"><i class="fa fa-headphones"></i> <?php echo lang('live'); ?> </a>
                                                            <?php } ?>
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
                        </div>



                        <div id="patient" class="tab-pane">
                            <div class="card-body">
                                <div class="table-responsive adv-table">
                                            
                                    <?php if (!empty($appointment_patients)) { ?>
                                        <table class="table mb-0 patient_datatable" id="editable-sample">
                                        
                                            <thead>
                                                <tr>
                                                    <th><?php echo lang('patient_id'); ?></th>
                                                    <th><?php echo lang('patient'); ?> <?php echo lang('name'); ?></th>
                                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($appointment_patients as $appointment_patient) {
                                                    $appointed_patient = $this->patient_model->getPatientById($appointment_patient);
                                                    ?>
                                                    <tr class="">

                                                        <td><?php echo $appointed_patient->id; ?></td>
                                                        <td><?php echo $appointed_patient->name; ?></td>
                                                        <td class="no-print">
                                                            <a class="btn btn-soft-primary green button_his" title="<?php echo lang('history'); ?>"  href="patient/medicalHistory?id=<?php echo $appointed_patient->id; ?>"><i class="fa fa-stethoscope"></i> <?php echo lang('history'); ?></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div id="prescription1" class="tab-pane"> <div class="">
                        <div class="card-body">
                                <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                                    <div class="col-lg-12 no-print pull-right" style="padding-bottom: 5px;">
                                        <a class="btn btn-info waves-effect waves-light w-xs btn-xs" href="prescription/addPrescriptionView">
                                            <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?> 
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="table-responsive adv-table">
                                    <table class="table mb-0" id="editable-sample">
                                   
                                        <thead>
                                            <tr>

                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo lang('patient'); ?></th>
                                                <th><?php echo lang('medicine'); ?></th>
                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($prescriptions as $prescription) { ?>
                                                <tr class="">
                                                    <td><?php echo date('m/d/Y', $prescription->date); ?></td>
                                                    <td><?php echo $this->patient_model->getPatientById($prescription->patient)->name; ?></td>
                                                    <td>

                                                        <?php
                                                        if (!empty($prescription->medicine)) {
                                                            $medicine = explode('###', $prescription->medicine);
                                                            foreach ($medicine as $key => $value) {
                                                                $medicine_id = explode('***', $value);
                                                                $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                                                                $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . ' Days<br>';
                                                                rtrim($medicine_name_with_dosage, ',');
                                                                echo '<p>' . $medicine_name_with_dosage . '</p>';
                                                            }
                                                        }
                                                        ?>


                                                    </td>
                                                    <td class="no-print">
                                                        <a class="btn btn-soft-info btn-xs btn_width" href="prescription/viewPrescription?id=<?php echo $prescription->id; ?>"><i class="fa fa-eye"> <?php echo lang('view'); ?> </i></a> 
                                                        <?php if ($this->ion_auth->in_group('Doctor')) { ?>
                                                            <a class="btn btn-soft-info btn-xs btn_width" href="prescription/editPrescription?id=<?php echo $prescription->id; ?>" "><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></a>   
                                                            <a class="btn btn-soft-info btn-xs btn_width delete_button" href="prescription/delete?id=<?php echo $prescription->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div id="schedule" class="tab-pane"> <div class="">
                        <div class="card-body">
                                <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                                    <div class="col-lg-12 no-print pull-right" style="padding-bottom: 5px;">
                                   
                                   <button type="button" class="btn btn-info waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                   data-bs-target="#addScheduleModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                             </div>
                                   
                                <?php } ?>
                                <div class="table-responsive adv-table">
                                    <table class="table mb-0" id="editable-samplee">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> <?php echo lang('weekday'); ?></th>
                                                <th> <?php echo lang('start_time'); ?></th>
                                                <th> <?php echo lang('end_time'); ?></th>
                                                <th> <?php echo lang('duration'); ?></th>
                                                <th> <?php echo lang('options'); ?></th>

                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <?php
                                            $i = 0;
                                            foreach ($schedules as $schedule) {
                                                $i = $i + 1;
                                                ?>
                                                <tr class="">
                                                    <td class=""> <?php echo $i; ?></td> 
                                                    <td> <?php echo $schedule->weekday; ?></td> 
                                                    <td><?php echo $schedule->s_time; ?></td>
                                                    <td><?php echo $schedule->e_time; ?></td>
                                                    <td><?php echo $schedule->duration * 5 . ' ' . lang('minitues'); ?></td>
                                                    <td>
                                                       
                                                        <a class="btn btn-soft-info btn-xs btn_width delete_button" href="schedule/deleteSchedule?id=<?php echo $schedule->id; ?>&doctor=<?php echo $schedule->doctor; ?>&weekday=<?php echo $schedule->weekday; ?>&all=all" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>



                        <div id="holiday" class="tab-pane"> <div class="">
                        <div class="card-body">
                            <div class="col-lg-12 no-print pull-right" style="padding-bottom: 5px;">
                                   
                                   <button type="button" class="btn btn-info waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                   data-bs-target="#holidayModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                             </div>
                                
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
                                                    <button type="button" class="btn btn-soft-info btn-xs btn_width editHoliday" data-toggle="modal" data-id="<?php echo $holiday->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                                    <a class="btn btn-soft-info btn-xs btn_width delete_button" href="schedule/deleteHoliday?id=<?php echo $holiday->id; ?>&doctor=<?php echo $doctor->id; ?>&redirect=doctor/details" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>


                        <div id="calendar" class="tab-pane active" style="padding: 10px;"> 
                            
                               
                           
                        </div>


                 
                    </div>
                </div>
            </section>


                                        
        </section>





        <section class="col-md-3 col-sm-12 card">
                <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('profile'); ?></h4> 
                                        
                                    </div>
        


            <section class="card-body">
                <aside class="profile-nav">
                    <section class="">
                        

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                            <div class="row">
                        <div class="user-heading round col-md-6">
                            <?php if (!empty($doctor->img_url)) { ?>
                                <a href="#">
                                    <img class="card-img-top img-fluid rounded-circle avatar-xl" src="<?php echo $doctor->img_url; ?>" alt="">
                                </a>
                            <?php } ?>
                            </div>
                            <div class="col-md-6" style="padding-top: 20px;">
                                    <h4 class=""> <?php echo $doctor->name; ?> </h4>
                                    <p class="card-text"> <?php echo $doctor->email; ?> </p>
                            </div>
                        
                        </div>
                            </li>
                            <li class="list-group-item"> <?php echo lang('doctor'); ?> <?php echo lang('name'); ?><span class="label pull-right r-activity float-end"><?php echo $doctor->name; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('doctor_id'); ?> <span class="label pull-right r-activity float-end"><?php echo $doctor->id; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('profile'); ?><span class="label pull-right r-activity float-end"><?php echo $doctor->profile; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('address'); ?><span class="label pull-right r-activity float-end"><?php echo $doctor->address; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('phone'); ?><span class="label pull-right r-activity float-end"><?php echo $doctor->phone; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('email'); ?><span class="label pull-right r-activity float-end"><?php echo $doctor->email; ?></span></li>
                        </ul>

                    </section>
                </aside>
            </section>

        </section>

        </div>


        <!-- page end-->
                            </div>
                            </div>
                            </div>
<!--main content end-->
<!--footer start-->




<!-- Add Patient Material Modal-->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title"  placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>

                    <div class="form-group col-md-6">
                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->


<!-- Add Medical History Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_medical_history'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Medical History Modal-->

<!-- Edit Medical History Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_medical_history'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="medical_historyEditForm" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="cmodal">
    <div class="modal-dialog modal-lg med_his" role="document">
        <div class="modal-content">
          
            <div id='medical_history'>
                
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>



<!-- Add Appointment Modal-->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              
                <h5 class="modal-title">   <?php echo lang('add_appointment'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" action="appointment/addNew" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="col-md-4">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15  pos_select" id="pos_select" name="patient" value=''> 

                        </select>
                    </div>

                    <div class="pos_client clearfix">
                        <div class="row">
                        <div class="col-md-6 payment pad_bot">
                            
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                            
                                <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                            
                        </div>
                        <div class="col-md-6 payment pad_bot">
                          
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                             
                                <input type="text" class="form-control pay_in" name="p_email" value='' placeholder="">
                            
                        </div>
                        <div class="col-md-6 payment pad_bot">
                            
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            
                                <input type="text" class="form-control pay_in" name="p_phone" value='' placeholder="">
                            
                        </div>
                        <div class="col-md-6 payment pad_bot">
                           
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                                <input type="text" class="form-control pay_in" name="p_age" value='' placeholder="">
                           
                        </div> 
                        <div class="col-md-6 payment pad_bot">
                            
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            
                            
                                <select class="form-control m-bot15" name="p_gender" value=''>

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
                    </div>

                    <div class="col-md-4 doctor_div">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label>
                        <select class="form-control js-example-basic-single" id="adoctors" name="doctor" value=''>  
                            <option value="">Select .....</option>
                            <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                        </select>
                    </div>


                    <div class="col-md-4">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date" readonly="" name="date"  value='' placeholder="">
                    </div>

                    <div class="col-md-6">
                        <label class=""><?php echo lang('available_slots'); ?></label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                        </select>
                    </div>



                    <div class="col-md-6">
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

                    <div class="col-md-8"> 
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks"  value='' placeholder="">
                    </div>


                    <div class="col-md-6"> 
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div>

                    <input type="hidden" name="redirect" value='doctor/details'>
<input type="hidden" name="discount" value="0">
                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Appointment Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="editAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">   <?php echo lang('edit_appointment'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" id="editAppointmentForm" action="appointment/addNew" class="clearfix row" method="post" enctype="multipart/form-data">
                                </div class="row">
                    <div class="col-md-4">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15  pos_select1 patient" id="pos_select1" name="patient" value=''> 

                        </select>
                    </div>
                    

                    <div class="col-md-4 doctor_div1">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single doctor" id="adoctors1" name="doctor" value=''>  
                            <option value="">Select .....</option>
                            <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                        </select>
                    </div>


                    <div class="col-md-4 "> 
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" readonly="" id="date1" name="date"  value='' placeholder="">
                    </div>

                    <div class="col-md-6">
                        <label class=""><?php echo lang('available_slots'); ?></label>
                        <select class="form-control" name="time_slot" id="aslots1" value=''> 

                        </select>
                    </div>




                    <div class="col-md-6">
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

                    <div class="col-md-8">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks"  value='' placeholder="">
                    </div>


                    <div class="col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div>



                    <input type="hidden" name="redirect" value='doctor/details'>
                    <input type="hidden" name="id" id="appointment_id" value=''>

                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>

                </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->


<!-- Add Holiday Modal-->
<div class="modal fade" id="holidayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo lang('add'); ?>   <?php echo lang('holiday'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body">
                <form role="form" action="schedule/addHoliday" class="clearfix row" method="post" enctype="multipart/form-data">
                        <div class="form-group" style="padding-bottom: 5px !important;">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control default-date-picker" name="date" id="validationCustom01" value='' autocomplete="off" required="required">
                        </div>

                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctor->id; ?>'>
                    <input type="hidden" name="redirect" value='doctor/details'>
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
<div class="modal fade" id="editHolidayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"><?php echo lang('edit'); ?>   <?php echo lang('holiday'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" id="editHolidayForm" action="schedule/addHoliday" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="form-group"  style="padding-bottom: 5px !important;">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control default-date-picker" name="date"  value='' autocomplete="off" required="">
                        </div>
                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctor->id; ?>'>
                    <input type="hidden" name="redirect" value='doctor/details'>
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



<!-- Add Time Slot Modal-->
<div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"><?php echo lang('edit'); ?>   <?php echo lang('schedule'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" action="schedule/addSchedule" class="clearfix row" method="post" enctype="multipart/form-data">

                
                    <div class="form-group col-md-4 weekday_div">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <select class="form-control m-bot15" id="weekday" name="weekday" value=''>  
                            <option value="Friday"><?php echo lang('friday') ?></option>
                            <option value="Saturday"><?php echo lang('saturday') ?></option>
                            <option value="Sunday"><?php echo lang('sunday') ?></option>
                            <option value="Monday"><?php echo lang('monday') ?></option>
                            <option value="Tuesday"><?php echo lang('tuesday') ?></option>
                            <option value="Wednesday"><?php echo lang('wednesday') ?></option>
                            <option value="Thursday"><?php echo lang('thursday') ?></option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker timepickers_time">
                                               
                                                        
                                                        <input type="text" class="form-control timepicker-default1" name="s_time" id="s_time" value='' required autocomplete="off">
                                                        <div class="input-group-text"><button class="btn btn-default" type="button"><i class="fa fa-clock"></i></button>
                            </div>
                                                 
                           
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker col-md-4">
                    
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker timepickere_time">
                                
                            <input type="text" class="form-control timepicker-default1" name="e_time" id="e_time" value='' required autocomplete="off">
                            <div class="input-group-text">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"><?php echo lang('appointment') ?> <?php echo lang('duration') ?> </label>
                        <select class="form-control" name="duration" value=''>

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

                    <input type="hidden" name="doctor" id="doctorchoose" value='<?php echo $doctor_id; ?>'>
                    <input type="hidden" name="redirect" value='doctor/details'>
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
<div class="modal fade" id="editSceduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"><?php echo lang('edit'); ?>   <?php echo lang('edit'); ?>  <?php echo lang('time_slot'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body">
                <form role="form" id="editTimeSlotForm" action="schedule/addSchedule" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                                <input type="text" class="form-control timepicker-default" name="s_time"  value=''>
                                <div class="input-group-text"><button class="btn btn-default" type="button"><i class="fa fa-clock"></i></button>
                           
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                                <input type="text" class="form-control timepicker-default" name="e_time"  value=''>
                                <div class="input-group-text"><button class="btn btn-default" type="button"><i class="fa fa-clock"></i></button>
                           
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

                    <input type="hidden" name="doctor" value="<?php echo $doctorr; ?>">
                    <input type="hidden" name="redirect" value='doctor/details'>
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
<!-- Edit Time Slot Modal-->



<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/doctor/details.js"></script>

