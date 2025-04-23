<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Amount Distribution</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active">Amount Distribution</li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
         <link href="common/extranal/css/finance/amount_distribution.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> <i class="fa fa-money"></i>  <?php echo lang('amount_distribution'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <a  href="finance/addPaymentView" class="btn btn-primary waves-effect waves-light w-xs"><i class="fa fa-plus-circle"></i> <?php echo lang('add_payment'); ?></a>
                                        <button class="btn btn-info waves-effect waves-light w-xs export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>    
                                        </div>
                                    </div>
          
            <div class="card-body">
             
                    <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('refd_by_doctor'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('sub_total'); ?></t>
                                <th><?php echo lang('discount'); ?></th>
                                <th><?php echo lang('total'); ?></th>
                                <th><?php echo lang('hospital_amount'); ?></th>
                                <th><?php echo lang('doctor_amount'); ?></th>
                                <th class="option_th no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                       

                        <?php foreach ($payments as $payment) { ?>
                            <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                            <tr class="">
                                <td><?php
                                    if (!empty($patient_info)) {
                                        echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                    }
                                    ?></td>
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
                                <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->hospital_amount; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->doctor_amount; ?></td>
                                <td class="no-print"> 
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                        <a class="btn btn-soft-info btn-xs editbutton width_auto" href="finance/editPayment?id=<?php echo $payment->id; ?>"><i class="fa fa-edit"> <?php echo lang('edit'); ?></i></a>
                                    <?php } ?>

                                    <a class="btn btn-soft-primary btn-xs width_auto" href="finance/invoice?id=<?php echo $payment->id; ?>"><i class="fa fa-file-text"></i> <?php echo lang('invoice'); ?></a>
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                        <a class="btn btn-soft-danger btn-xs delete_button width_auto" href="finance/delete?id=<?php echo $payment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?></a>
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
</div></div>
<!--main content end-->
<!--footer start-->
