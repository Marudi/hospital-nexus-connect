
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('payments'); ?> <?php echo lang('doctor'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active"><?php echo lang('payments'); ?> <?php echo lang('doctor'); ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
         <link href="common/extranal/css/finance/doc_com_view.css" rel="stylesheet">
         <div class="row">
    <div class=" col-md-7">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('payments'); ?> || <?php echo lang('doctor'); ?> : <?php echo $this->doctor_model->getDoctorById($doctor)->name; ?></h4> 
                                      
                                    </div>
          <div class="row">
              <div class="col-md-3"></div>
                <div class=" card-body col-md-7">
                    <section>
                        <form role="form" class="panel-body" action="finance/docComDetails" method="post" enctype="multipart/form-data">
                            <div class="form-group no-print">
                            <div class="row">
                              
                                <div class="col-md-6">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control dpd1 no-print" name="date_from" value="<?php
                                        if (!empty($from)) {
                                            echo $from;
                                        }
                                        ?>" placeholder="<?php echo lang('date_from'); ?>">
                                        <span class="input-group-text">To</span>
                                        <input type="text" class="form-control dpd2 no-print" name="date_to" value="<?php
                                        if (!empty($to)) {
                                            echo $to;
                                        }
                                        ?>" placeholder="<?php echo lang('date_to'); ?>">
                                        <input type="hidden" class="form-control dpd2 no-print" name="doctor" value="<?php
                                        if (!empty($doctor)) {
                                            echo $doctor;
                                        }
                                        ?>">
                                    </div>
                                    <div class="row"></div>
                                    <span class="help-block"></span> 
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-info range_submit no-print">Filter</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="col-md-2"></div>
                                    </div>
                <!-- <div class="col-md-5 panel-body">
                    <button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
                </div> -->
            <!-- </div> -->
            
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('invoice_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>   
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('total'); ?></th>
                                <th><?php echo lang('doctors_commission'); ?></th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php foreach ($payments as $payment) { 
                            $gross_total[]=$payment->gross_total; ;
                            ?>
                            <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                            <tr class="">

                                <td>
                                    <?php
                                    echo $payment->id;
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if (!empty($patient_info)) {
                                        echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                    }
                                    ?>
                                </td>


                                <td><?php echo date('d/m/y', $payment->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                                <td><?php echo $settings->currency; ?> <?php
                                    if (!empty($payment->doctor)) {
                                        $doc_com[] = $payment->doctor_amount;
                                        echo $payment->doctor_amount;
                                    }
                                    ?></td>
                            </tr>
                        <?php } ?>
                        <tfoot>
                            <td colspan="3"></td>
                            <td>
                                  <strong>Total: <?php echo $settings->currency.' '. array_sum($gross_total);?> </strong> 
                            </td>
                            <td>
                            <strong>Total:   <?php echo  $settings->currency.' '.array_sum($doc_com);?> </strong> 
                            </td>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            <style>
               
                    .weather-bg .degree {
                font-size: 46px;
            }
            .weather-bg {
                background: #4BAFC8;
                border-radius: 4px 4px 0 0;
                -webkit-border-radius: 4px 4px 0 0;
                color: #fff;
                text-align: center;
                font-size: 16px;
                font-weight: 300;
            }
            .text_bar{
                padding-top: 25px
            }
            </style>
            <section class="card-body col-md-5" style="margin-top: 15%;">
                <div class="weather-bg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text_bar">
                                <i class="fa fa-money-check"></i>
                                <?php echo lang('total_doctors_commission'); ?>
                            </div>
                            <div class="col-md-6">
                                <div class="degree">
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($doc_com)) {
                                        $total_doc_com = array_sum($doc_com);
                                    } else {
                                        $total_doc_com = 0;
                                    }

                                    echo $total_doc_com;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <!-- page end-->
    </div> </div>
</div>
</div>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script type="text/javascript">var doctor_name = "<?php echo $this->doctor_model->getDoctorById($doctor)->name; ?>";</script>
<script src="common/extranal/js/finance/doc_com_view.js"></script>
