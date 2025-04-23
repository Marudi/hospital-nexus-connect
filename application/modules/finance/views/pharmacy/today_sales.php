
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"> <?php echo lang('today_sales'); ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Pharmacy</li>
                                        <li class="breadcrumb-item active"> <?php echo lang('today_sales'); ?>  </li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/pharmacy/today_sales.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('pharmacy'); ?> <?php echo lang('today_sales'); ?> </h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <a  href="finance/pharmacy/addPaymentView" class="btn btn-primary waves-effect waves-light w-xs"><i class="fa fa-plus-circle"></i> <?php echo lang('add_payment'); ?></a>
                                           
                                        </div>
                                    </div>
            
        
            <div class="card-body">
            <div class="adv-table editable-table">
                <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('invoice_id'); ?> </th>
                                <th> <?php echo lang('date'); ?> </th>
                                <th> <?php echo lang('sub_total'); ?> </th>
                                <th> <?php echo lang('discount'); ?> </th>
                                <th> <?php echo lang('grand_total'); ?> </th>
                              
                                <th class="option_th"> <?php echo lang('options'); ?> </th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php foreach ($payments as $payment) { ?>
                            <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                            <tr class="">
                                <td><?php echo '00' . $payment->id; ?></td>
                                <td><?php echo date('d/m/y', $payment->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->amount; ?></td>              
                                <td><?php echo $settings->currency; ?> <?php
                                    if (!empty($payment->flat_discount)) {
                                        echo $payment->flat_discount;
                                    } else {
                                        echo '0';
                                    }
                                    ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                             
                                <td> 
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                        <a class="btn btn-soft-info btn-xs editbutton width_auto" href="finance/pharmacy/editPayment?id=<?php echo $payment->id; ?>"><i class="fa fa-edit"> </i> <?php echo lang('edit'); ?></a>
                                    <?php } ?>

                                    <a class="btn btn-soft-primary btn-xs  width_auto" href="finance/pharmacy/invoice?id=<?php echo $payment->id; ?>"><i class="fa fa-file-text"></i>  <?php echo lang('invoice'); ?></a>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                        <a class="btn btn-soft-danger btn-xs delete_button width_auto" href="finance/pharmacy/delete?id=<?php echo $payment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i>  <?php echo lang('delete'); ?></a>
                                    <?php } ?>
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

<script src="common/extranal/js/pharmacy/today_sales.js"></script>
