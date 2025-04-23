<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('diagnostic'); ?> <?php echo lang('result'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"> <?php echo lang('patient'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('diagnostic'); ?> <?php echo lang('result'); ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <section>
            <div class="card panel-primary">
           <link href="common/extranal/css/patient/diagnostic_report.css" rel="stylesheet">
           <div class="card-header table_header no-print">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('diagnostic_test_result'); ?></h4> 
                                      
                                    </div>
     <div class="row">          
<div class=" col-md-6">
                <div class="card-body no-print">

                     <table class="table mb-0">

                        <thead>
                            <tr>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('value'); ?></th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                        <tr class="">

                            <td><?php echo lang('invoice_id'); ?></td>
                            <td>
                                <?php
                                echo $payment->id;
                                ?>
                            </td>

                        </tr>

                        <tr class="">
                            <td><?php echo lang('date'); ?></td>
                            <td><?php echo date('d/m/y', $payment->date); ?></td>

                        </tr>


                        <tr class="">
                            <td><?php echo lang('patient_id'); ?></td>
                            <td>
                                <?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->id;
                                }
                                ?>
                            </td>

                        </tr>

                        <tr class="">
                            <td><?php echo lang('patient'); ?></td>
                            <td>
                                <?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                }
                                ?>
                            </td>

                        </tr>


                        <tr class="">
                            <td><h4> <?php echo lang('diagnostic_test'); ?></h4></td>
                            <td>
                                <?php
                                if (!empty($payment->category_name)) {
                                    $category_name = $payment->category_name;
                                    $category_name1 = explode(',', $category_name);
                                    foreach ($category_name1 as $category_name2) {
                                        $category_name3 = explode('*', $category_name2);
                                        if ($category_name3[1] > 0) {
                                            if ($category_name3[2] == 'diagnostic') {
                                                ?>                

                                                <div><?php echo $category_name3[0]; ?> </div><br>

                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>

                            </td>

                        </tr>



                        </tr>

                        </tbody>
                    </table>





                    <?php if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) { ?>
                        <div class="card-body col-md-12 no-print">
                        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('add_update'); ?> <?php echo lang('diagnostic_result'); ?> </h4> 
                                      
                                    </div>
                           
                            <form class="clearfix" action="patient/addDiagnosticReport" method="post">

                                <?php
                                $report_id = $this->patient_model->getDiagnosticReportByInvoiceId($payment->id);
                                ?>

                                <input type="hidden" name="patient" value="<?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->id;
                                }
                                ?>">
                                <input type="hidden" name="invoice" value="<?php echo $payment->id; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"></label>

                                    <textarea class="ckeditor form-control" name="report" rows="5" cols=50> <?php
                                        if (!empty($report_id)) {
                                            echo $report_id->report;
                                        }
                                        ?> 
                                    </textarea>

                                </div>

                                <input type="hidden" name="id" value="<?php
                                if (!empty($report_id)) {
                                    echo $report_id->id;
                                }
                                ?>">


                                <section class="">
                                    <button type="submit" name="submit" class="btn btn-soft-info"><?php echo lang('submit'); ?></button>
                                </section>

                            </form>

                        </div>
                    <?php } else { ?>
                        <div class="card-body col-md-12">
                        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('diagnostic_result'); ?> </h4> 
                                      
                                    </div>
                           
                            <?php
                            $report_id = $this->patient_model->getDiagnosticReportByInvoiceId($payment->id);
                            if (!empty($report_id)) {
                                ?>
                                <div class="panel bio-graph-info"> <?php echo $report_id->report; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="text-center corporate-id">
                                    <h1>
                                        <?php echo 'Not Ready!'; ?>
                                    </h1>

                                </div>
                                <?php
                            }
                            ?> 

                        </div>
                    <?php } ?>


                </div>
            </div>

                <div class="card col-md-5">
                    <div class="row invoice-list">

                        <div class="text-center corporate-id">
                            <h2>
                                <?php echo lang('diagnostic_report'); ?>
                            </h2>
                            <h3>
                                <?php echo $settings->title ?>
                            </h3>
                            <h5>
                                <?php echo $settings->address ?>
                            </h5>
                            <h5>
                                Tel: <?php echo $settings->phone ?>
                            </h5>
                        </div>
                    </div>




                     <table class="table mb-0">

                        <thead>

                        </thead>

                        <tbody>                    

                        <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                        <tr class="">

                            <td><?php echo lang('invoice_id'); ?></td>
                            <td>
                                <?php
                                echo $payment->id;
                                ?>
                            </td>

                        </tr>

                        <tr class="">
                            <td><?php echo lang('date'); ?></td>
                            <td><?php echo date('d/m/y', $payment->date); ?></td>

                        </tr>


                        <tr class="">
                            <td><?php echo lang('patient_id'); ?></td>
                            <td>
                                <?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->id;
                                }
                                ?>
                            </td>

                        </tr>

                        <tr class="">
                            <td><?php echo lang('patient'); ?></td>
                            <td>
                                <?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                }
                                ?>
                            </td>

                        </tr>


                        <tr class="">
                            <td><?php echo lang('diagnostic_test_result'); ?></td>
                            <td>
                                <?php
                                if (!empty($report_id)) {
                                    echo $report_id->report;
                                }
                                ?>

                            </td>

                        </tr>



                        </tr>

                        </tbody>
                    </table>


                    <div class="text-center invoice-btn" style="margin-top: 5px;">
                        <a class="btn btn-soft-info btn-lg invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
                    </div>


                </div>

     </div>








            </div>
        </section>
        <!-- invoice end-->
    </div>
    </div>
</div>
<!--main content end-->
<!--footer start-->


<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/patient/diagnostic_report.js"></script>


