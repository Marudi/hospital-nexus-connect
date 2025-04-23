
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Print Label</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('lab'); ?></li>
                                        <li class="breadcrumb-item active">Print Label</li>
                                       
                                        
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

            h1, h3, h2, h4, h5, h6 {
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

            /*            .panel {
                            border: 0px solid #5c5c47;
                            background: #fff !important;
                            height: 100%;
                            margin: 20px 5px 5px 5px;
                            border-radius: 0px !important;
                            min-height: 700px;
                        }
            
                        .panel-body {
                            padding: 15px 15px !important; 
                        }*/

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

                .wrapper  {
                    margin: 0px !important;
                    padding: 0px !important;
                }

                .flex-wrapper {
                    margin-bottom: 150px;
                }

                #labelTable td {
                    padding-bottom: 5px;
                }
            }
        </style>

<div class="row">
        <section class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="flex-wrapper">
                        <div style="display: flex; max-width: 4.9in; margin-top: 20px;">
                            <div>
                                <table id="labelTable">
                                    <tr>
                                        <td>PID: <?php echo $patient->id; ?></td>
                                        <td>Invoice ID: <?php echo $lab->invoice_id; ?></td>
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

                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Gender: <?php echo $patient->sex; ?></td>
                                        <td>Date: <?php echo date('d/m/Y', $lab->date) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ref By:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Test: <?php
                                            $i = 0;
                                            foreach ($labels as $label) {
                                                if ($i == 0) {
                                                    echo $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                                    //echo $this->finance_model->getPaymentCategoryById($label->category_id);
                                                } else {
                                                    echo ', ' . $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                                }
                                                $i++;
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Film: <br><input type="text" style="width: 85%">
                                        </td>
                                        <td>
                                            Paper Print: <br><input type="text" style="width: 85%">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center; padding-top: 10px;">
                                            <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $patient->id; ?>&print=true" />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $lab->invoice_id; ?>&print=true&orientation=vertical" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-md-3 no-print">
            <div class="card col-md-6" style="background: transparent !important;">
                <a class='btn btn-warning btn-md' onclick="window.print()"><i class='fa fa-print'></i> Print</a><br>
                <a class='btn btn-danger' href="<?php echo site_url('lab/labLabel90?id=' . $lab->id); ?>"><i class='fa fa-undo'></i> Rotate 90 Deg</a><br>
                <a class='btn btn-success' href='<?php echo site_url('lab/testPdf?id=' . $lab->id); ?>'><i class='fa fa-download'></i> Download</a><br>
                <a class='btn btn-danger' href="<?php echo site_url('lab?id=' . $lab->id); ?>"><i class='fa fa-edit'></i> Edit Report</a><br>
            </div>
        </section>
</div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script src="common/extranal/js/lab/lab.js"></script>

