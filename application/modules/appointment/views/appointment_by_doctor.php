
<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/appointment/appointment.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <?php 
                                        $doctor_ion_id = $this->ion_auth->get_user_id();
                                        $doctor_name = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->name;
                                    ?>
                                    <h4 class="mb-0"><?php echo $doctor_name; ?> <?php echo lang('appointments'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('doctor'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('appointment'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
       <div class="card">
       <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('appointments'); ?></h4> 
                                       
                                    </div>
                                    <div class="row">
        <section class="col-md-9">
       
           
                                    <div class="card">
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#calendardetails" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('appointments'); ?> <?php echo lang('calendar'); ?></span> 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#list" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo lang('appointments'); ?></span> 
                                                </a>
                                            </li>
                                            
                                            
                                        </ul>
            <!-- <div class="col-md-12">
                <header class="panel-heading tab-bg-dark-navy-blueee row">
                    <ul class="nav nav-tabs col-md-8">
                        <li class="active">
                            <a data-toggle="tab" href="#calendardetails"><?php echo lang('appointments'); ?> <?php echo lang('calendar'); ?></a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#list"><?php echo lang('appointments'); ?></a>
                        </li>

                    </ul>

                    <div class="pull-right col-md-4"><div class="pull-right custom_buttonss"></div></div>

                </header>
            </div> -->


            <div class="">
                <div class="tab-content">

                    <div id="calendardetails" class="tab-pane active">
                        <div class="">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <aside class="calendar_ui col-md-12 panel calendar_ui">
                                        <section class="">
                                            <div class="">
                                                <div id="calendarview" class="has-toolbar calendar_view"></div>
                                            </div>
                                        </section>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="list" class="tab-pane ">
                        <!-- <div class=""> -->
                            <div class="card-body">
                                <div class="table-responsive adv-table">
                                    <!-- <div class="clearfix">
                                        <button class="export" onclick="javascript:window.print();">Print</button>  
                                    </div>
                                   -->
                                    <table class="table mb-0" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th> <?php echo lang('id'); ?></th>
                                                <th> <?php echo lang('patient'); ?></th>
                                                <th> <?php echo lang('date-time'); ?></th>
                                                <th> <?php echo lang('remarks'); ?></th>
                                                <th> <?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                       

                                        <?php
                                        foreach ($appointments as $appointment) {
                                            if ($appointment->doctor == $doctor_id) {
                                                ?>
                                                <tr class="">
                                                    <td ><?php echo $appointment->id; ?></td>
                                                    <td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name; ?></td>
                                                    <td class="center"><?php echo date('d-m-Y', $appointment->date); ?> => <?php echo $appointment->time_slot; ?></td>
                                                    <td>
                                                        <?php echo $appointment->remarks; ?>
                                                    </td> 
                                                    <td>
                                                      
                                                        <a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=<?php echo $appointment->id; ?>&doctor_id=<?php echo $appointment->doctor; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
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
                        <!-- </div> -->
                    </div>

                </div>
            </div>


        </section>
        <!-- page end-->

        <section class="col-md-3">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('doctor'); ?></h4> 
                                        
                                    </div>
           


            <!-- <section class=""> -->
                <div class="card-body profile">
                <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                            <div class="row">
                        <div class="user-heading round col-md-6">
                            <?php if (!empty($mmrdoctor->img_url)) { ?>
                                <a href="#">
                                    <img class="card-img-top img-fluid rounded-circle avatar-xl" src="<?php echo $mmrdoctor->img_url; ?>" alt="">
                                </a>
                            <?php } ?>
                            </div>
                            <div class="col-md-6" style="padding-top: 20px;">
                                    <h4 class=""> <?php echo $mmrdoctor->name; ?> </h4>
                                    <p class="card-text"> <?php echo $mmrdoctor->email; ?> </p>
                            </div>
                        
                        </div>
                            </li>
                            <li class="list-group-item"> <?php echo lang('doctor'); ?> <?php echo lang('name'); ?><span class="label pull-right r-activity float-end"><?php echo $mmrdoctor->name; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('doctor_id'); ?> <span class="label pull-right r-activity float-end"><?php echo $mmrdoctor->id; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('profile'); ?><span class="label pull-right r-activity float-end"><?php echo $mmrdoctor
                            
                            
                            
                            ->profile; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('address'); ?><span class="label pull-right r-activity float-end"><?php echo $mmrdoctor->address; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('phone'); ?><span class="label pull-right r-activity float-end"><?php echo $mmrdoctor->phone; ?></span></li>
                            <li class="list-group-item">  <?php echo lang('email'); ?><span class="label pull-right r-activity float-end"><?php echo $mmrdoctor->email; ?></span></li>
                        </ul>
                </div>
               
            <!-- </section> -->
        </section>
        </div>
       </div>
        </div>
                    </div>
                    <!-- </div> -->
</div>
<!--main content end-->
<!--footer start-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i>  <?php echo lang('edit_appointment'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editAppointmentForm" action="appointment/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-3"> 
                            <label for="exampleInputEmail1"> <?php echo lang('paient'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15" id="patientchoose1" name="patient" value=''> 

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3"> 
                            <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15"id="doctorchoose1" name="doctor" value=''>  

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date-time'); ?></label>
                        <div data-date="" class="input-group date form_datetime-meridian">
                            <div class="input-group-btn"> 
                                <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                                <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                            </div>
                            <input type="text" class="form-control" readonly="" name="date"  value='' placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks"  value='' placeholder="">
                    </div>



                    <input type="hidden" name="id" value=''>


                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->
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

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var doctor_id = "<?php echo $doctor_id; ?>";</script>
<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/appointment/appointment_by_doctor.js"></script>