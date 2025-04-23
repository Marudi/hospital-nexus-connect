<!--main content start-->
<!DOCTYPE html>
<html lang="en" <?php if ($this->db->get('settings')->row()->language == 'arabic') { ?> dir="rtl" <?php } ?>>
    <link href="common/css/bootstrap.min.css" rel="stylesheet">
    <link href="common/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Ubuntu&display=swap');
    </style>
    <link rel="stylesheet" type="textscss" href="common/assets/DataTables/DataTables-1.10.16/custom/css/datatable-responsive-cdn-version-1-0-7.css" />
    <link href="common/extranal/css/payroll/downloadInvoice.css" rel="stylesheet" />
     <link href="common/extranal/css/payroll/invoice_logical.css" rel="stylesheet" />
    <section class="col-md-12">

       <div class="panel panel-primary" id="invoice">

                        <div class="panel-body invoice-all">
                            <div class="row invoice-list">

                                <div class="col-md-12 invoice_head clearfix logotitle">

                                    <div class="col-md-6 text-left invoice_head_left">
                                        <h3>
                                            <?php echo $settings->title ?>
                                        </h3>
                                        <h4>
                                            <?php echo $settings->address ?>
                                        </h4>
                                        <h4>
                                            Tel: <?php echo $settings->phone ?>
                                        </h4>
                                    </div>
                                    <div class="col-md-6 text-right invoice_head_right">
                                        <img class="img_logo" alt="" src="<?php echo $this->settings_model->getSettings()->logo; ?>" width="100">
                                    </div>



                                </div>

                    <div class="col-md-12 title" >
                        <h4 class="text-center invoice_lang">
                            <?php echo lang('payroll') ?> <?php echo lang('invoice') ?>
                        </h4>
                    </div>




                    <div class="col-md-12 invoice-box">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="col-md-6 p_details clearfix"> 
                                                <div class="paragraphprint">
                                                    <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>
                                                    <label class="control-label"><?php echo lang('name'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($staff)) {
                                                            echo $staff->name . ' <br>';
                                                        }
                                                        ?>
                                                    </span>  
                                                </div>
                                                <div class="paragraphprint">
                                                    <label class="control-label"><?php echo lang('id'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($staff)) {
                                                            echo $staff->ion_user_id . ' <br>';
                                                        }
                                                        ?>
                                                    </span></div>
                                                <div class="paragraphprint"><label class="control-label"> <?php echo lang('address'); ?> </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($staff)) {
                                                            echo $staff->address . ' <br>';
                                                        }
                                                        ?>
                                                    </span></div>
                                                <div class="paragraphprint">
                                                    <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($staff)) {
                                                            echo $staff->phone . ' <br>';
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="col-md-6 p_details1 clearfix">
                                                <div class="paragraphprint">

                                                    <label class="control-label"><?php echo lang('payroll') . " " . lang('id'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($result)) {
                                                            echo $result->id . ' <br>';
                                                        }
                                                        ?>
                                                    </span>

                                                </div>
                                                <div class="paragraphprint">

                                                    <label class="control-label"><?php echo lang('paid_on'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($result)) {
                                                            echo $result->paid_on . ' <br>';
                                                        }
                                                        ?>
                                                    </span>

                                                </div>

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>




                    <table class="table table-striped table-hover detailssale" id="customers"> 

                        <thead class="theadd">

                            <tr class="description_head">
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('type'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $earning_total = 0;
                            if ($result->earning != null) {
                                $earnings = explode('#', $result->earning);
                                foreach ($earnings as $earning) {
                                    $earning = explode('_', $earning);
                                    $earning_total += $earning[1];
                                    ?>  

                                    <tr class="description">
                                        <td class="test_name"><?php echo $earning[0]; ?> </td>
                                        <td class="test_name"><?php echo lang('earning'); ?> </td>
                                        <td class="test_name"> <?php echo $earning[1]; ?> </td>
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            $deduction_total = 0;
                            if ($result->deduction != null) {
                                $deductions = explode('#', $result->deduction);
                                foreach ($deductions as $deduction) {
                                    $deduction = explode('_', $deduction);
                                    $deduction_total += $deduction[1];
                                    ?>  

                                    <tr class="description">
                                        <td class="test_name"><?php echo $deduction[0]; ?> </td>
                                        <td class="test_name"><?php echo lang('deduction'); ?> </td>
                                        <td class="test_name"> <?php echo $deduction[1]; ?> </td>
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>

                            <?php
                            $expense_total = 0;
                            if ($result->expense != null) {
                                $expense_total = $result->expense;
                                ?>  

                                <tr class="description">
                                    <td class="test_name"><?php echo lang('expense'); ?> </td>
                                    <td class="test_name"><?php echo lang('expense'); ?> </td>
                                    <td class="test_name"> <?php echo $result->expense; ?> </td>
                                </tr> 
                                <?php
                            }
                            ?>

                        </tbody>




                    </table>

                                <table class="info_position">
                        <tr class="lasttr">
                            <td class="width_test1"></td>
                            <td  class="width_test2"></td>
                            <td  class="width_test2"></td>
                            <td class="font_size_text"><li><strong><?php echo lang('earning'); ?> : </li></td>
                        <td class="details_cal"></strong><?php echo $settings->currency . " " . $earning_total; ?></td> 
                        </tr>
                        <tr class="lasttr">
                            <td class="width_test1"></td>
                            <td  class="width_test2"></td>
                            <td  class="width_test3"></td>
                            <td class="font_size_text"><li><strong><?php echo lang('deduction'); ?> : </strong></li></td>
                        <td class="details_cal1"></strong><?php echo $settings->currency; ?> <?php echo $deduction_total; ?></td> 
                        </tr>
                        <tr class="lasttr">
                            <td class="width_test2"></td>
                            <td  class="width_test2"></td>
                            <td  class="width_test2"></td>
                            <td class="details_cal2"><li><strong><?php echo lang('expense'); ?> : </strong></li></td>
                        <td class="details_cal3"></strong><?php echo $settings->currency; ?> <?php echo $expense_total; ?></td> 
                        </tr>
                        <tr class="lasttr total_tr">
                            <td class="width_test2"></td>
                            <td  class="width_test2"></td>
                            <?php
                            if (($earning_total - $deduction_total + $expense_total) > 99999) {
                                $width1 = "width_1_1";
                                $width2 = "width_2_1";
                                $width3 = "width_3_1";
                            } else if (($earning_total - $deduction_total + $expense_total) > 999999) {
                                $width1 = "width_1_2";
                                $width2 = "width_2_2";
                                $width3 = "width_3_3";
                            } else {
                                $width1 = "width_1_3";
                                $width2 = "width_2_3";
                                $width3 = "width_3_3";
                            }
                            ?>
                            <td  class=" <?php echo $width1; ?>"></td>
                            <td class=" <?php echo $width2; ?>  font_size_text"><li><strong><?php echo lang('total'); ?> : </strong></li></td>
                        <td class=" <?php echo $width3; ?> details_cal1"></strong><?php echo $settings->currency; ?> <?php echo $earning_total - $deduction_total + $expense_total; ?></td> 
                        </tr>
                    </table>


                </div>

                <div class="col-md-12 divFooter"><strong>  </strong></div>
            </div>
        </div>
                </section>




                <link rel="stylesheet" href="common/extranal/css/finance/invoiceAll.css"/>
             


                <script src="common/js/codearistos.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>



                </section>
            
                    </html>
              
       


