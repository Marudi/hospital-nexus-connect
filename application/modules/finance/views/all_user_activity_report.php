<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">User Activities</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active">User Activities</li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
         <link href="common/extranal/css/finance/all_user_activity_report.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('activities_by'); ?> <strong class="activities_by" ><?php echo lang('all_users'); ?></strong> (<?php echo lang('today'); ?>)</h4> 
                                        
                                    </div>
         
            <div class="card-body">
            <!-- <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('today'); ?> <?php echo lang('report'); ?></h4> 
                                        
                                    </div> -->
              
                <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th class="option_th option_th_up"><?php echo lang('user'); ?> <?php echo lang('name'); ?></th>
                                <th class="option_th option_th_up"><?php echo lang('bill_amount'); ?></th>
                                <th class="option_th option_th_up"><?php echo lang('payment_received'); ?></th>
                                <th class="option_th option_th_up"><?php echo lang('due_amount'); ?></th>
                                <th class="option_th no-print option_th_up"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                      
                        <?php foreach ($accountants as $accountant) { ?>
                            <tr class="">
                                <td><?php echo $accountant->name; ?></td>
                                <td><?php echo $settings->currency; ?><?php
                                    $total = array();
                                    $ot_total = array();

                                    $accountant_ion_user_id = $accountant->ion_user_id;
                                    foreach ($payments as $payment) {
                                        if ($payment->user == $accountant_ion_user_id) {
                                            $total[] = $payment->gross_total;
                                        }
                                    }
                                    foreach ($ot_payments as $ot_payment) {
                                        if ($ot_payment->user == $accountant_ion_user_id) {
                                            $ot_total[] = $ot_payment->gross_total;
                                        }
                                    }

                                    $total = array_sum($total);
                                    if (empty($total)) {
                                        $total = 0;
                                    }

                                    $ot_total = array_sum($ot_total);
                                    if (empty($ot_total)) {
                                        $ot_total = 0;
                                    }

                                    echo $bill_total = $total + $ot_total;
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?><?php
                                    $deposit_total = array();
                                    foreach ($deposits as $deposit) {
                                        if ($deposit->user == $accountant_ion_user_id) {
                                            $deposit_total[] = $deposit->deposited_amount;
                                        }
                                    }

                                    $deposit_total = array_sum($deposit_total);
                                    if (empty($deposit_total)) {
                                        $deposit_total = 0;
                                    }
                                    echo $deposit_total;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $bill_total - $deposit_total; ?>
                                </td>
                                <td class="no-print">
                                    <a class="btn btn-soft-info btn-xs btn_width add_payment_button" href="finance/allUserActivityReport?user=<?php echo $accountant_ion_user_id; ?>"><i class="fa fa-info"></i> Details</a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php foreach ($receptionists as $receptionist) { ?>
                            <tr class="">
                                <td><?php echo $receptionist->name; ?></td>
                                <td><?php echo $settings->currency; ?><?php
                                    $total_receptionist = array();
                                    $ot_total_receptionist = array();

                                    $receptionist_ion_user_id = $receptionist->ion_user_id;
                                    foreach ($payments as $payment1) {
                                        if ($payment1->user == $receptionist_ion_user_id) {
                                            $total_receptionist[] = $payment1->gross_total;
                                        }
                                    }
                                    foreach ($ot_payments as $ot_payment1) {
                                        if ($ot_payment1->user == $receptionist_ion_user_id) {
                                            $ot_total_receptionist[] = $ot_payment1->gross_total;
                                        }
                                    }

                                    $total_receptionist = array_sum($total_receptionist);
                                    if (empty($total_receptionist)) {
                                        $total_receptionist = 0;
                                    }

                                    $ot_total_receptionist = array_sum($ot_total_receptionist);
                                    if (empty($ot_total_receptionist)) {
                                        $ot_total_receptionist = 0;
                                    }

                                    echo $bill_total_receptionist = $total_receptionist + $ot_total_receptionist;
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?><?php
                                    $deposit_total_receptionist = array();
                                    foreach ($deposits as $deposit) {
                                        if ($deposit->user == $receptionist_ion_user_id) {
                                            $deposit_total_receptionist[] = $deposit->deposited_amount;
                                        }
                                    }

                                    $deposit_total_receptionist = array_sum($deposit_total_receptionist);
                                    if (empty($deposit_total_receptionist)) {
                                        $deposit_total_receptionist = 0;
                                    }
                                    echo $deposit_total_receptionist;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $bill_total_receptionist - $deposit_total_receptionist; ?>
                                </td>
                                <td class="no-print">
                                    <a class="btn btn-soft-info btn-xs btn_width add_payment_button" href="finance/allUserActivityReport?user=<?php echo $receptionist_ion_user_id; ?>"><i class="fa fa-info"></i> Details</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </section>
        <!-- page end-->
        </div></div></div>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/finance/all_user_activity_report.js"></script>