<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('print') ?> <?php echo lang('label') ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('bed'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('print') ?> <?php echo lang('label') ?></li>
                                     
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <!-- <header class="panel-heading no-print"><?php echo lang('print') ?> <?php echo lang('label') ?></header> -->
        <div class="row">
        <section class="col-md-7" >
            <div class="card" style="padding: 20px;" id="printzone">
                <div class="card-body">
                    <div class="row">
                        <?php for ($i = 1; $i < 7; $i++) { ?>
                            <div class=" labelSection col-md-6">
                                <div style="margin-bottom: 50px;">
                                    <table id="labelTable" style="float: left;">
                                        <tr>
                                            <td>PID: <?php echo $patient->id; ?></td>
                                            <td>Admission ID: <?php echo $bed->id; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Patient: <?php echo $patient->name; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $age = explode('-', $patient->age);
                                            if (count($age) == 3) {
                                            ?>
                                                <td>Age: <?php echo $age[0] . " Y " . $age[1] . " M " . $age[2] . " D"; ?></td>
                                            <?php } else { ?>
                                                <td>Age: </td>
                                            <?php }
                                            ?>

                                            <td>Bed Id: <?php echo $bed->bed_display_id; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender: <?php echo $patient->sex; ?></td>
                                            <td>Date: <?php echo date('d-m-Y H:i', $bed->a_timestamp); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ref By: <?php echo $this->doctor_model->getDoctorById($bed->doctor)->name; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: center; padding-top: 10px;">
                                                <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $patient->id; ?>&print=true" />
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="barcodeVertical" style="float: right">
                                        <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $bed->id; ?>&print=true&orientation=vertical" />
                                    </div>

                                </div>


                            </div>
                        <?php } ?>
                    </div>

                </div>

            </div>
        </section>
        <section class="col-md-3 no-print">
            <div class="panel" style="background: transparent !important;">
                <a class='btn btn-warning' onclick="window.print()"><i class='fa fa-print'></i> Print</a><br>
                <!-- <a class='btn btn-danger' href="<?php echo site_url('bed/labLabel90?id=' . $bed->id); ?>"><i class='fa fa-undo'></i> Rotate 90 Deg</a><br>
                <a class='btn btn-success' href='<?php echo site_url('bed/testPdf?id=' . $bed->id); ?>'><i class='fa fa-download'></i> Download</a><br>
                <a class='btn btn-danger' href="<?php echo site_url('bed?id=' . $bed->id); ?>"><i class='fa fa-edit'></i> Edit Report</a><br> -->
            </div>
        </section>
    </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->



<link href="common/extranal/css/bed/bed.css" rel="stylesheet">

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

    /*                    #footer {
                            position: absolute;
                            bottom: 10px;
                            right: 20;
                            left: 20;
                        }*/

    .flex-wrapper {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        justify-content: flex-start;
    }

    #footer {
        margin-top: auto;
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

    #labelTable td {
        padding-bottom: 5px;
    }

    .labelSection {
        width: 50%;
    }

    #labelTable {
        width: 90%;
    }

    .barcodeVertical {
        width: 10%;
        margin-top: -207px;
    }

    @media print {
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

        #labelTable td {
            padding-bottom: 5px;
        }

        .labelSection {
            width: 50%;
            float: left;
            margin-bottom: 10%;
        }

        #labelTable {
            width: 90%;
        }

        .barcodeVertical {
            width: 10%; 
          
        }
    }
</style>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script src="common/extranal/js/bed/bed.js"></script>

<script>
    $(document).ready(function(){
        function printPageArea(areaID){
            var printContent = document.getElementById(areaID).innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
}
    });
</script>