<html lang="en">

    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Rizvi">
        <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
        <link rel="shortcut icon" href="uploads/favicon.png">

        <?php
        $class_name = $this->router->fetch_class();
        $class_name_lang = lang($class_name);
        if (empty($class_name_lang)) {
            $class_name_lang = $class_name;
        }
        ?>

        
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
        <link href="common/assets/DataTables/datatables.min.css" rel="stylesheet" />
        <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
        <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.css" rel="stylesheet" />


        <link href="common/css/style.css" rel="stylesheet">

        <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
        <link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
        <link href="common/css/invoice-print.css" rel="stylesheet" media="print">
        <link href="common/assets/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="common/assets/select2/css/select2.min.css"/>
        <link rel="stylesheet" type="text/css" href="common/css/lightbox.css"/>
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

        <link rel="stylesheet" href="common/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="common/css/bootstrap-select-country.min.css">
        <!-- Google Fonts -->

        <link href="common/extranal/css/medical_history_calendar_modal.css" rel="stylesheet">


        <link href="common/css/style-responsive.css" rel="stylesheet" />

      

    </head>
    <style>
        #main-content {
            margin-left: 0px !important;
        }
    </style>
    <section id="main-content">
        <section class="wrapper site-min-height">


            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-2"></div>  
                    <div class="col-md-8">
                        <div class="card">
                            <h2 class="card-header text-white panel-heading"><?php echo lang('payment_gateway'); ?> <i class='fa fa-arrow-right'></i> <?php echo lang('checkout_confirmation'); ?></h2>
                            <div class="card-body">
                                <form action="<?php echo $action; ?>/_payment" method="post" id="payuForm" name="payuForm">
                                    <input type="hidden" name="key" value="<?php echo $mkey; ?>" />
                                    <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
                                    <input type="hidden" name="txnid" value="<?php echo $tid; ?>" />
                                    <div class="form-group">
                                        <label class="control-label"> <?php echo lang('total_payable_amount'); ?></label>
                                        <input class="form-control" name="amount" value="<?php echo $amount; ?>"  readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> <?php echo lang('name'); ?></label>
                                        <input class="form-control" name="firstname" id="firstname" value="<?php echo $name; ?>" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> <?php echo lang('email'); ?></label>
                                        <input class="form-control" name="email" id="email" value="<?php echo $mailid; ?>" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> <?php echo lang('phone'); ?></label>
                                        <input class="form-control" name="phone" value="<?php echo $phoneno; ?>" readonly />
                                    </div>
                                    <div class="form-group hidden">
                                        <label class="control-label">  <?php echo lang('payment_id'); ?></label>
                                        <textarea class="form-control" name="productinfo" readonly><?php echo $productinfo; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> <?php echo lang('address'); ?></label>
                                        <input class="form-control" name="address1" value="<?php echo $address; ?>" readonly/>     
                                    </div>
                                    <div class="form-group">
                                        <input name="surl" value="<?php echo $sucess; ?>" size="64" type="hidden" />
                                        <input name="furl" value="<?php echo $failure; ?>" size="64" type="hidden" />  

                                        <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                                        <input name="curl" value="<?php echo $cancel; ?>" type="hidden" />
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="submit" value="Pay Now" class="btn btn-success" > <?php echo lang('checkout'); ?> </button>
                                    </div>
                                </form> 
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2"></div>
                </div>
                <!-- Footer -->

            </div> 






            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    <!--footer start-->

</html>
<style>

    form {
        background: #fff!important;
        padding: 50px 20px;
    }

</style>


