<html>
    <head>
        <base href="<?php echo base_url(); ?>">
        <link href="common/css/bootstrap.min.css"  rel="stylesheet" type="text/css" media="screen" >
        <link href="common/css/bootstrap-reset.css"  rel="stylesheet" type="text/css" media="screen" >
        <!--external css-->
        <link href="common/assets/fontawesome5pro/css/all.min.css"  rel="stylesheet" type="text/css" media="screen"  />
        <link href="common/assets/DataTables/datatables.min.css"  rel="stylesheet" type="text/css" media="screen"  />
        <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.min.css"  rel="stylesheet" type="text/css" media="screen"  />
        <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.css"  rel="stylesheet" type="text/css" media="screen"  />


        <link href="common/css/style.css"  rel="stylesheet" type="text/css" media="screen" >

        <link  rel="stylesheet" type="text/css" media="screen"  href="common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css" />
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
        <link href="common/css/invoice-print.css"  rel="stylesheet" type="text/css" media="screen"  media="print">
        <link href="common/assets/fullcalendar/fullcalendar.css"  rel="stylesheet" type="text/css" media="screen" >
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/select2/css/select2.min.css"/>
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/css/lightbox.css"/>
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

        <link  rel="stylesheet" type="text/css" media="screen"  href="common/css/bootstrap-select.min.css">
        <link  rel="stylesheet" type="text/css" media="screen"  href="common/css/bootstrap-select-country.min.css">
        <link  rel="stylesheet" type="text/css" media="screen"  href="common/extranal/toast.css">
        <!-- Google Fonts -->

        <link href="common/extranal/css/medical_history_calendar_modal.css"  rel="stylesheet" type="text/css" media="screen" >


        <link href="common/css/style-responsive.css"  rel="stylesheet" type="text/css" media="screen"  />
    </head>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        h1, h2, h3, h4, h5, h6, p {
            font-family:  'Open Sans', sans-serif !important;
        }

        .invoice-list h4 {
            font-weight: 300;
            font-size: 16px;
        }

        h3, .h3 {
            font-size: 24px;
        }
        
        .text-center {
            text-align: center !important;
        }
        
        .col-md-6 {
            width: 45%;
            float: left;
        }
        
        .col-md-12 {
            width: 98%;
            float: left;
            padding-left: 15px;
            padding-right: 15px;
        }
        
        p {
            margin: 0 0 10px;
        }
    </style>
    <body>
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <!-- invoice start-->
                <link href="common/extranal/css/lab/invoice.css" rel="stylesheet">
                <section class="col-md-12">

                    <div class="panel panel-primary" id="lab">

                        <div class="panel-body invoice_info">
                            <div class="row invoice-list">

                                <div class="text-center corporate-id">


                                    <h3>
                                        <?php echo $settings->title ?>
                                    </h3>
                                    <h4>
                                        <?php echo $settings->address ?>
                                    </h4>
                                    <h4>
                                        Tel: <?php echo $settings->phone ?>
                                    </h4>
                                    <img alt="" src="<?php echo $this->settings_model->getSettings()->logo; ?>" width="200" height="100">
                                    <h4 class="lang_lab">
                                        <?php echo lang('lab_report') ?>
                                        <hr class="lang_lab_hr">
                                    </h4>
                                </div>





                                <div class="col-md-12">
                                    <div class="col-md-6 pull-left row patient_info">
                                        <div class="col-md-12 row details">
                                            <p>
                                                <?php $patient_info = $this->db->get_where('patient', array('id' => $lab->patient))->row(); ?>
                                                <label class="control-label"><?php echo lang('patient'); ?> <?php echo lang('name'); ?> </label>
                                                <span class="patient_name"> : 
                                                    <?php
                                                    if (!empty($patient_info)) {
                                                        echo $patient_info->name . ' <br>';
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-12 row details">
                                            <p>
                                                <label class="control-label"><?php echo lang('patient_id'); ?>  </label>
                                                <span class="patient_name"> : 
                                                    <?php
                                                    if (!empty($patient_info)) {
                                                        echo $patient_info->id . ' <br>';
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-12 row details">
                                            <p>
                                                <label class="control-label"> <?php echo lang('address'); ?> </label>
                                                <span class="patient_name"> : 
                                                    <?php
                                                    if (!empty($patient_info)) {
                                                        echo $patient_info->address . ' <br>';
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-12 row details">
                                            <p>
                                                <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                                <span class="patient_name"> : 
                                                    <?php
                                                    if (!empty($patient_info)) {
                                                        echo $patient_info->phone . ' <br>';
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                        </div>


                                    </div>

                                    <div class="col-md-6 pull-right patient_info">

                                        <div class="col-md-12 row details">
                                            <p>
                                                <label class="control-label"> <?php echo lang('lab'); ?> <?php echo lang('report'); ?> <?php echo lang('id'); ?>  </label>
                                                <span class="patient_name"> : 
                                                    <?php
                                                    if (!empty($lab->id)) {
                                                        echo $lab->id;
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                        </div>


                                        <div class="col-md-12 row details">
                                            <p>
                                                <label class="control-label"><?php echo lang('date'); ?>  </label>
                                                <span class="patient_name"> : 
                                                    <?php
                                                    if (!empty($lab->date)) {
                                                        echo date('d-m-Y', $lab->date) . ' <br>';
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                        </div>

                                        <div class="col-md-12 row details">
                                            <p>
                                                <label class="control-label"><?php echo lang('doctor'); ?>  </label>
                                                <span class="patient_name"> : 
                                                    <?php
                                                    if (!empty($lab->doctor)) {
                                                        $doctor_details = $this->doctor_model->getDoctorById($lab->doctor);
                                                        if (!empty($doctor_details)) {
                                                            echo $doctor_details->name . '<br>';
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <br>

                            </div> 


                            <div class="col-md-12 panel-body">
                                <?php
                                if (!empty($lab->report)) {
                                    echo $lab->report;
                                }
                                ?>
                            </div>


                        </div>
                    </div>



                </section>
                <!-- invoice end-->
            </section>
        </section>
        <!--main content end-->
        <script src="common/js/codearistos.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
        <script type="text/javascript">var lab_id = "<?php echo $lab->id; ?>";</script>
        <script src="common/extranal/js/lab/invoice.js"></script>
    </body>
</html>