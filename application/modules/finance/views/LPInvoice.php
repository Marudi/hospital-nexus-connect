
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Last Paid Invoice</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active">Last Paid</li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- invoice start-->
        <link href="common/extranal/css/finance/LPinvoice.css" rel="stylesheet">
        <section>
            <div class="card panel-primary">

                <div class="card-body">
                    <div class="row invoice-list">
                        <div class="text-center corporate-id">
                            <h2>
                                <?php echo $settings->title ?>
                            </h2>
                            <h5>
                                <?php echo $settings->address ?>
                            </h5>
                            <h5>
                                Tel: <?php echo $settings->phone ?>
                            </h5>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h6><?php echo lang('payment_to'); ?>:</h6>
                            <p>
                                <?php echo $settings->title; ?> <br>
                                <?php echo $settings->address; ?><br>
                                Tel:  <?php echo $settings->phone; ?>
                            </p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h6><?php echo lang('bill_to'); ?>:</h6>
                            <p>
                                <?php
                                $patient_info = $this->db->get_where('patient', array('id' => $patient_id))->row();
                                echo $patient_info->name . ' <br>';
                                echo $patient_info->address . '  <br/>';
                                P: echo $patient_info->phone
                                ?>
                            </p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h6><?php echo lang('invoice_info'); ?></h6>
                            <ul class="unstyled">
                                <li><?php echo lang('invoice_status'); ?>		: <strong class="invoice_status"><?php
                                        if (!empty($payments)) {
                                            echo 'Paid';
                                        } else {
                                            echo '';
                                        }
                                        ?></strong> </li>
                            </ul>
                        </div>
                    </div>



                    <?php
                    $gross_total = array();


                    if (!empty($payments)) {
                        ?>
                        <header class="h4"><?php echo lang('general_invoice'); ?></header>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo lang('category'); ?></th>
                                    <th><?php echo lang('date'); ?></th>
                                    <th><?php echo lang('amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($payments as $payment) {
                                    $gross_total[] = $payment->gross_total;
                                    $amount[] = $payment->amount;
                                    $flat_vat[] = $payment->flat_vat;
                                    $discount[] = $payment->flat_discount;
                                }
                                ?>
                                <?php
                                $i = 0;
                                foreach ($payments as $payment) {
                                    if (!empty($payment->category_name)) {
                                        $category_name = $payment->category_name;
                                        $category_name1 = explode(',', $category_name);
                                        foreach ($category_name1 as $category_name2) {
                                            $category_name3 = explode('*', $category_name2);
                                            if ($category_name3[1] > 0) {
                                                ?>                
                                                <tr>
                                                    <td><?php echo $i = $i + 1; ?></td>
                                                    <td><?php echo $category_name3[0]; ?> </td>
                                                    <td><?php echo date('m/d/y', $payment->date); ?> </td>
                                                    <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                                </tr> 
                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-4 invoice-block pull-right">
                                <ul class="unstyled amounts">
                                    <li><strong><?php echo lang('sub_total_amount'); ?> : </strong><?php echo $settings->currency; ?> <?php
                                        if (!empty($amount)) {
                                            echo array_sum($amount);
                                        }
                                        ?></li>
                                    <?php if (!empty($discount)) { ?>
                                        <li><strong>Discount</strong> <?php
                                        ?> <?php echo array_sum($discount); ?> </li>
                                    <?php } ?>
                                    <?php if (!empty($flat_vat)) { ?>
                                        <li><strong>VAT :</strong>   <?php ?> % = <?php echo $settings->currency . ' ' . array_sum($flat_vat); ?></li>
                                    <?php } ?>
                                        <li class="vat_amount"><strong>Total : </strong><?php echo $settings->currency; ?> <?php
                                        if (!empty($gross_total)) {
                                            echo array_sum($gross_total);
                                        }
                                        ?></li>
                                </ul>
                            </div>
                        </div>

                    <?php } ?>

                    <?php
                    $ot_gross_total = array();

                    if (!empty($ot_payments)) {
                        ?>
                        <header class="h4"><?php echo lang('ot_invoice'); ?></header>
                        <?php
                        $ot_gross_total = array();
                        foreach ($ot_payments as $ot_payment) {
                            $ot_gross_total[] = $ot_payment->gross_total;
                            $ot_amount[] = $ot_payment->amount;

                            $ot_discount[] = $ot_payment->flat_discount;
                        }
                        ?>

                        <table class="table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo lang('date'); ?></th>
                                    <th><?php echo lang('amount'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($ot_payments as $ot_payment) {
                                    if ($ot_payment->patient == $patient_id) {
                                        ?>
                                        }
                                        <tr>
                                            <td><?php echo $i = $i + 1; ?></td>
                                            <td><?php echo date('m/d/y', $payment->date); ?> </td>
                                            <td class=""><?php echo $settings->currency; ?> <?php echo $ot_payment->gross_total; ?> </td>
                                        </tr> 
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>

                        </table>

                        <div class="row">
                            <div class="col-lg-4 invoice-block pull-right">
                                <ul class="unstyled amounts">
                                    <li><strong><?php echo lang('sub_total_amount'); ?> : </strong><?php echo $settings->currency; ?> <?php
                                        if (!empty($ot_amount)) {
                                            echo array_sum($ot_amount);
                                        }
                                        ?></li>
                                    <?php if (!empty($ot_discount)) { ?>
                                        <li><strong>Discount</strong> <?php ?> <?php echo array_sum($ot_discount); ?> </li>
                                    <?php } ?>
                                    <?php if (!empty($ot_flat_vat)) { ?>
                                        <li><strong>VAT :</strong>   <?php ?> % = <?php echo $settings->currency . ' ' . array_sum($ot_flat_vat); ?></li>
                                    <?php } ?>
                                    <li class="vat_amount"><strong >Total : </strong><?php echo $settings->currency; ?> <?php
                                        if (!empty($ot_gross_total)) {
                                            echo array_sum($ot_gross_total);
                                        }
                                        ?></li>
                                </ul>
                            </div>
                        </div>

                    <?php } ?>


                    <div class="row">
                        <div class="col-lg-4 invoice-block">
                            <ul class="unstyled amounts">         
                                <li class=""><strong>Total Amount to be paid : </strong><?php echo $settings->currency; ?> <?php
                                    if (!empty($ot_gross_total) || !empty($gross_total)) {
                                        echo array_sum($ot_gross_total) + array_sum($gross_total);
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="text-center invoice-btn">
                        <a class="btn btn-soft-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
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
<script src="common/extranal/js/finance/LPinvoice.js"></script>
