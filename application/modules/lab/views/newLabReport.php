<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('lab_report'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('lab'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('lab_report'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->

        <link href="common/extranal/css/lab/lab.css" rel="stylesheet">

        <style>
            body {
                print-color-adjust: exact;
            }

            hr {
                border-top: 1px solid #000 !important;
                width: 100%;
            }

            h1,
            h3,
            h2,
            h4,
            h5,
            h6 {
                margin: 0px;
            }

            p {
                margin: 3px 0px;
                font-size: .85rem;
            }

            .flex-wrapper {
                display: flex;
                /* min-height: 100vh; */
                min-height: 1000px;
                flex-direction: column;
                justify-content: flex-start;
            }

            #footer {
                margin-top: auto;
            }

            .panel {
                border: 0px solid #5c5c47;
                background: #fff !important;
                height: 100%;
                margin: 20px 5px 5px 5px;
                border-radius: 0px !important;
                min-height: 700px;
            }

            .panel-body {
                padding: 15px 15px !important;
            }

            .table-qr-hr {
                margin-top: 10px !important;
                margin-bottom: 15px !important;
            }

            .info_text {
                font-size: 11px;
            }

            .control_label {
                font-size: 12px;
                width: 50px;
            }

            .reportBlock table {
                border: 1px solid black;
            }

            .reportBlock table td {
                border: 1px solid black;
            }

            @media screen {
                .table-qr-hr_oo {
                    margin-top: 0px !important;
                }
            }

            @media print {
                @page {
                    size: auto;
                    margin: 0;
                    padding-left: 10px;
                    padding-right: 10px;

                }

                body {
                    print-color-adjust: exact;
                }

                .col-md-7 {
                    padding: 0px !important;
                }

                .panel {
                    margin: 0px !important;
                    padding: 0px !important;
                }

                .panel-body {
                    padding: 0px !important;
                }

                .wrapper {
                    margin: 0px !important;
                    padding: 0px !important;
                }

                .flex-wrapper {
                    margin-bottom: 150px;
                }

                #invoice_header {
                    top: 50px;
                    position: fixed;
                    height: 250px;
                    width: 100% !important;

                }

                .page_breaker {
                    margin-top: 550px !important;
                    page-break-inside: avoid !important;
                    border-top: 1px solid black;
                }

                .table-qr-hr_oo {
                    margin-top: 270px !important;
                }

                .image_bar {
                    vertical-align: middle !important;
                }

                .invoice_footer {
                    /* right: 0; */
                    height: 50px;
                    position: fixed !important;
                    bottom: 70px !important;



                }


                #footer_done {
                    width: 30%;
                }

                #footer_third {
                    width: 100%;
                    /* float: right; */

                }

                #footer_second {
                    width: 40%;


                }
            }
        </style>

        <style>
            .site_height {
                min-height: 1500px;
            }

            @media print {
                .site_height {
                    min-height: auto;
                }
            }
        </style>

<div class="row">
        <section class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="flex-wrapper" style="border: 1px solid #000;">
                        <?php $patient = $this->db->get_where('patient', array('id' => $lab->patient))->row(); ?>
                        <?php if ($redirect != 'download1') { ?>
                            <div id="invoice_header">
                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 25%">
                                            <img alt="" src="<?php echo site_url($this->settings_model->getSettings()->logo); ?>" width="150" height="auto" style="margin-top:-45px; margin-left: 5px;">
                                        </td>
                                        <td>
                                            <h4 style="margin-bottom: 10px; font-weight: 800; margin-top: -20px;"><?php echo $settings->title; ?></h4>
                                            <h6 style="margin-bottom: 10px;"><?php echo $settings->address; ?></h6>
                                            <h4 style="line-height: 20px"><?php echo lang('phone'); ?>: <br><?php echo $settings->phone; ?></h4>
                                        </td>
                                        <td>
                                            <table style="margin-top: 10px;">
                                                <tr>
                                                    <td colspan="2">
                                                        <label class="control_label"><?php echo lang('name'); ?></label> <span class="info_text">: <?php echo $patient->name; ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $age = explode('-', $patient->age);
                                                    if (count($age) == 3) {
                                                    ?>
                                                        <td style="padding-right: 10px;"><label class="control_label"><?php echo lang('age'); ?></label> <span class="info_text">: <?php echo $age[0] . " Y " . $age[1] . " M " . $age[2] . " D"; ?></td></span>
                                                    <?php } else { ?>
                                                        <td style="padding-right: 10px;"><label class="control_label"><?php echo lang('age'); ?></label> <span class='info_text'>: </span></td>
                                                    <?php }
                                                    ?>
                                                    <td>
                                                        <label class="control_label"><?php echo lang('gender'); ?></label> <span class="info_text">: <?php echo $patient->sex; ?></span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="padding-right: 10px;"><label class="control_label">HN</label> <span class="info_text">: 0000000<?php echo $patient->id; ?></span></td>
                                                    <td><label class="control_label"><?php echo lang('phone'); ?></label> <span class="info_text">: <?php echo $patient->phone; ?></span></td>
                                                </tr>
                                                <?php
                                                $doctor_details = "";
                                                $invoice_details = "";
                                                $invoice_details = $this->db->get_where('payment', array('id' => $lab->invoice_id))->row();
                                                if ($invoice_details) {
                                                    if ($invoice_details->doctor) {
                                                        $doctor_details = $this->db->get_where('doctor', array('id' => $invoice_details->doctor))->row();
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td style="padding-right: 10px;"><label class="control_label">VN</label> <span class="info_text">: 0000000<?php echo $lab->invoice_id; ?></span></td>
                                                    <td><label class="control_label">VN Date</label> <span class="info_text">: <?php
                                                                                                                                if ($invoice_details) {
                                                                                                                                    echo date('d/m/Y h:i A', $invoice_details->date);
                                                                                                                                }
                                                                                                                                ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <label class="control_label"><?php echo lang('doctor'); ?></label>
                                                        <?php if ($doctor_details) { ?>
                                                            <span class="info_text">: <?php echo $doctor_details->name; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php if ($doctor_details) { ?>
                                                            <span class="info_text"><?php echo $doctor_details->profile; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <hr class="table-qr-hr">
                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 50%; padding-left: 20px; display: inline-flex">
                                            <label style="margin-bottom: 10px;">HN:</label>
                                            <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $patient->id; ?>&print=true" />
                                        </td>

                                        <td style="width: 50%; text-align: right; padding-right: 20px; display: inline-flex; justify-content: end;">
                                            <label style="margin-bottom: 10px;">VN:</label>
                                            <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $lab->invoice_id; ?>&print=true" />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <hr class="table-qr-hr table-qr-hr_oo">
                        <div class="reportBlock ck-content" style="padding: 10px">
                            <?php echo $lab->report; ?>
                        </div>
                        <div id="footer" style="padding: 10px;">
                            <?php
                            $signature = "";
                            if ($lab->signed_by) {
                                $laboratorist = $this->db->get_where('laboratorist', array('ion_user_id' => $lab->signed_by))->row();

                                if ($laboratorist) {
                                    $signature = $laboratorist->signature;
                                }
                            ?>

                            <?php } ?>
                            <!-- <hr style="margin: 10px 0px !important;"> -->
                            <div class="invoice_footer">
                                <!-- <img src="<?php echo $signature; ?>" width="100%" height="80px; margin-bottom: 100px;"> -->
                                <table style="width: 100%">
                                    <tr>
                                        <td id="footer_done" style="padding-right: 20px;"><span class="info_text"><?php echo lang('done_by'); ?>: <?php echo $lab->done_by; ?></span></td>
                                        <td id="footer_second">
                                            <span class='info_text'><?php $lab->test_status_date != null ? date('d/m/Y h:i A') : ""; ?></span>
                                        </td>
                                        <td id="footer_third" style="text-align: right;">
                                            <p style="font-weight: bold">
                                                <?php
                                                if ($lab->updated_on) {
                                                    echo lang('updated').': '.date('l d M Y h:s A', $lab->updated_on);
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php if ($redirect != 'download') { ?>
                <!-- <div class="col-md-12 invoice_footer ff">

                                <?php //echo $settings->footer_invoice_message; 
                                ?>


                            </div> -->
            <?php } ?>
        </section>
        <?php if ($redirect != 'download') { ?>
            <section class="col-md-3 no-print">
                <div class="card col-md-6" style="background: transparent !important;">
                    <a class='btn btn-warning' onclick="window.print()"><i class='fa fa-print'></i> <?php echo lang('print'); ?></a><br>
                    <a class='btn btn-success' href='<?php echo site_url('lab/testPdf?id=' . $lab->id); ?>'><i class='fa fa-download'></i> <?php echo lang('download'); ?></a><br>
                    <a class='btn btn-danger' href="<?php echo site_url('lab?id=' . $lab->id); ?>"><i class='fa fa-edit'></i> <?php echo lang('edit_report'); ?></a><br>
                    <!-- <a href="lab/sendLabreport?id=<?php echo $lab->id; ?>" class="btn  btn-info send"> <i class="fa fa-paper-plane"></i> <?php echo lang('send_report'); ?> </a> -->
                    <form role="form" style="background-color:#f3f3f3 ;" action="lab/sendLabreport" method="post" enctype="multipart/form-data">
                        <div class="radio radio_button">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios2" value="patient" checked="checked">
                                <?php echo lang('send_invoice_to_patient'); ?>
                            </label>
                        </div>
                        <div class="radio radio_button">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios2" value="other">
                                <?php echo lang('send_invoice_to_others'); ?>
                            </label>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $lab->id; ?>">
                        <div class="radio other">
                            <label>
                                <?php echo lang('email'); ?> <?php echo lang('address'); ?>
                                <input type="email" name="other_email" value="" class="form-control">
                            </label>

                        </div>

                        <button type="submit" name="submit" class="btn btn-info  pull-left"><i class="fa fa-location-arrow"></i> <?php echo lang('send'); ?></button>

                    </form>
                </div>
            </section>
        <?php } ?>
        <!-- page end-->
</div>
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_email = "<?php echo lang('select_email'); ?>";
</script>
<script src="common/extranal/js/lab/lab.js"></script>

<script>
    $(document).ready(function() {
        var prevRowHeight = 0;
        $("p, tr, img").each(function() {
            console.log(prevRowHeight);
            var maxHeight = 750;
            var eachRowHeight = $(this).height();
            if ((prevRowHeight + eachRowHeight) > maxHeight) {
                prevRowHeight = 0;
                $(this).before('<div class="page_breaker"></div>');
                console.log("add page break before");
            }
            prevRowHeight = prevRowHeight + $(this).height();
        });

    });
</script>