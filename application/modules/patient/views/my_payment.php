<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('patient'); ?>  <?php echo lang('payments'); ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('patient'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('payments'); ?></li>
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
      <link href="common/extranal/css/patient/my_payments.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('my'); ?> <?php echo lang('payments'); ?> </h4> 
                                      
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('invoice_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('doctor'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('sub_total'); ?></t>
                                <th><?php echo lang('discount'); ?></th>
                                <th><?php echo lang('grand_total'); ?></th>
                                <th><?php echo lang('paid'); ?> <?php echo lang('amount'); ?></th>
                                <th><?php echo lang('due'); ?></th>
                                <th><?php echo lang('remarks'); ?></th>
                                <th class="option_th no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                      

                        <?php foreach ($payments as $payment) { ?>
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
                                <td><?php
                                    if (!empty($payment->doctor)) {
                                        echo $this->db->get_where('doctor', array('id' => $payment->doctor))->row()->name;
                                    }
                                    ?></td>
                                <td><?php echo date('d/m/y', $payment->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->amount; ?></td>              
                                <td><?php echo $settings->currency; ?> <?php
                                    if (!empty($payment->flat_discount)) {
                                        echo $payment->flat_discount;
                                    } else {
                                        echo '0';
                                    }
                                    ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $grand_total = $payment->gross_total; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $amount_received = $this->finance_model->getDepositAmountByPaymentId($payment->id); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $grand_total - $amount_received; ?></td>
                                <td><?php echo $payment->remarks; ?></td>
                                <td class="no-print"> 
                                    <a class="btn btn-soft-primary btn-xs" title="<?php echo lang('invoice'); ?>" href="patient/myInvoice?id=<?php echo $payment->id; ?>"><i class="fas fa-file-invoice"></i> <?php echo lang('invoice'); ?></a>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/patient/my_payments.js"></script>
