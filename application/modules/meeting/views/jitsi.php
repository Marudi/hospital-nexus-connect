
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('live'); ?> <?php echo lang('appointment'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('meeting'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('live'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>

        <?php
        $appointment_details = $this->appointment_model->getAppointmentById($appointmentid);
        $doctor_details = $this->doctor_model->getDoctorById($appointment_details->doctor);
        $doctor_name = $doctor_details->name;
        $patient_details = $this->patient_model->getPatientById($appointment_details->patient);
        $patient_name = $patient_details->name;
        $patient_phone = $patient_details->phone;
        $patient_id = $appointment_details->patient;

        $display_name = $this->ion_auth->user()->row()->username;
        $email = $this->ion_auth->user()->row()->email;
        ?>


        <!-- page start-->
        <div class="row">
        <section class="col-md-8">
        <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('live'); ?> <?php echo lang('appointment'); ?> </h4> 
                                       
                                    </div>
            <div class="">
                <div class="tab-content"  id="meeting">
                    <input type="hidden" name="appointmentid" id="appointmentid"value="<?php echo $appointmentid; ?>">
                    <input type="hidden" name="username" id="username"value="<?php echo $display_name; ?>">
                    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                </div>
            </div>
            </div>
        </section>
        <style>
            .float_end{
                float: right;
            }
        </style>
        <section class="col-md-4">
        <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">      <?php echo lang('appointment'); ?> <?php echo lang('details'); ?> </h4> 
                                       
                                    </div>
        

            <div class="card-body">
                <div class="tab-content"  id="">
                    <aside class="profile-nav">
                        <section class="">


                            <ul class="list-group list-group-flush">
                            
                                <li class="list-group-item">  <?php echo lang('doctor'); ?> <?php echo lang('name'); ?> <span class="label pull-right r-activity float_end"><?php echo $doctor_name; ?></span></li>
                                <li class="list-group-item">  <?php echo lang('patient'); ?> <?php echo lang('name'); ?> <span class="label pull-right r-activity float_end"><?php echo $patient_name; ?></span></li>
                                <li class="list-group-item">  <?php echo lang('patient_id'); ?><span class="label pull-right r-activity float_end"><?php echo $patient_id; ?></span></li>
                                <li class="list-group-item">  <?php echo lang('appointment'); ?> <?php echo lang('date'); ?> <span class="label pull-right r-activity float_end"><?php echo date('jS F, Y', $appointment_details->date); ?></span></li>
                                <li class="list-group-item">  <?php echo lang('appointment'); ?> <?php echo lang('slot'); ?><span class="label pull-right r-activity float_end"><?php echo $appointment_details->time_slot; ?></span></li>
                            </ul>

                        </section>
                    </aside>
                </div>
            </div>
        </div>
        </section>
        </div>

        <!-- page end-->
    </div>
</div>
</div>



<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"
></script>


<script src="https://meet.jit.si/external_api.js"></script>
<script type="text/javascript">var room_id = "<?php echo $appointment_details->room_id; ?>";</script>
 <script src="common/extranal/js/meeting/jitsi.js"></script>