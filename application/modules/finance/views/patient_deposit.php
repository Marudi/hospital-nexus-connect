<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"> <?php echo lang('payment_history'); ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active"> <?php echo lang('payment_history'); ?>  </li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/finance/patient_deposit.css" rel="stylesheet">
        <div class="row">
        <section class="no-print col-md-8">
            <div class="card">

            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-6"><?php echo lang('payment_history') ?></h4> 
                                        <div class="col-lg-6 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('deposit'); ?></button>
                                                    <button type="button" class="btn btn-success waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal5"><i class="fa fa-file"></i> <?php echo lang('invoice'); ?></button>
                                        <a  href="finance/addPaymentByPatientView?id=<?php echo $patient->id; ?>&type=gen" class="btn btn-info waves-effect waves-light w-xs"><i class="fa fa-plus-circle"></i> <?php echo lang('add_payment'); ?></a>
                                           
                                        </div>
                                    </div>
          
            <div class=" card-body">
                <div class="adv-table editable-table ">


                    <section class="col-md-12 no-print">
                    <div class="row">
                        <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <form role="form" class="f_report" action="finance/patientPaymentHistory" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                                                                                                if (!empty($date_from)) {
                                                                                                                    echo date('m/d/Y', $date_from);
                                                                                                                }
                                                                                                                ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                        <span class="input-group-text"><?php echo lang('to'); ?></span>
                                        <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                                                                                            if (!empty($date_to)) {
                                                                                                                echo date('m/d/Y', $date_to);
                                                                                                            }
                                                                                                            ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                        <input type="hidden" class="form-control dpd2" name="patient" value="<?php echo $patient->id; ?>">
                                    </div>
                                    <div class="row"></div>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6 no-print">
                                    <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    </section>
                    <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('all_bills'); ?> & <?php echo lang('deposits'); ?> </h4> 
                                      
                                    </div>
                  
                                    <table class="table mb-0" id="editable-samples">
                        <thead>
                            <tr>
                                <th class=""><?php echo lang('date'); ?></th>
                                <th class=""><?php echo lang('invoice'); ?> #</th>
                                <th class=""><?php echo lang('bill_amount'); ?></th>
                                <th class=""><?php echo lang('deposit'); ?></th>
                                <th class=""><?php echo lang('deposit_type'); ?></th>
                                <th class=""><?php echo lang('from'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php
                            $dates = array();
                            $datess = array();
                            foreach ($payments as $payment) {
                                $dates[] = $payment->date;
                            }
                            foreach ($deposits as $deposit) {
                                $datess[] = $deposit->date;
                            }
                            $dat = array_merge($dates, $datess);
                            $dattt = array_unique($dat);
                            asort($dattt);

                            $total_pur = array();

                            $total_p = array();
                            ?>

                            <?php
                            foreach ($dattt as $key => $value) {
                                foreach ($payments as $payment) {
                                    if ($payment->date == $value) {
                            ?>
                                        <tr class="">
                                            <td><?php echo date('d-m-y', $payment->date); ?></td>
                                            <td> <?php echo $payment->id; ?></td>
                                            <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                                            <td><?php
                                                if (!empty($payment->amount_received)) {
                                                    echo $settings->currency;
                                                }
                                                ?> <?php echo $payment->amount_received; ?>
                                            </td>

                                            <td> <?php echo $payment->deposit_type; ?></td>
                                            <td>
                                                <?php
                                                if ($payment->payment_from == 'appointment') {
                                                   echo '<span class="badge bg-primary">' . lang('appointment') . '</span>';
                                                } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') {
                                                    echo '<span class="badge bg-warning">' . lang('ipd_medicine') . '</span>';
                                                } elseif ($payment->payment_from == 'case') {
                                                    echo '<span class="badge bg-primary">' . lang('case') . '</span>';
                                                } elseif ($payment->payment_from == 'admitted_patient_bed_service') {
                                                    echo '<span class="badge bg-success">' . lang('ipd_service') . '</span>';
                                                } elseif ($payment->payment_from == 'admitted_patient_bed_diagnostic') {
                                                    echo '<span class="badge bg-info">' . lang('ipd_diagnostic') . '</span>';
                                                } elseif ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                                                    echo '<span class="badge bg-primary">' . lang('opd') . '</span>';
                                                } elseif ($payment->payment_from == 'pre_service') {
                                                    echo lang('pre_surgery') . ' ' . lang('service');
                                                } elseif ($payment->payment_from == 'post_service') {
                                                    echo lang('post_surgery') . ' ' . lang('service');
                                                } elseif ($payment->payment_from == 'surgery') {
                                                    echo lang('surgery');
                                                } elseif ($payment->payment_from == 'pre_surgery_medical_analysis') {
                                                    echo lang('pre_surgery') . ' ' . lang('medical_analysis');
                                                } elseif ($payment->payment_from == 'post_surgery_medical_analysis') {
                                                    echo lang('post_surgery') . ' ' . lang('medical_analysis');
                                                } elseif ($payment->payment_from == 'pre_surgery_medicine') {
                                                    echo lang('pre_surgery') . ' ' . lang('medicine');
                                                } elseif ($payment->payment_from == 'post_surgery_medicine') {
                                                    echo lang('post_surgery') . ' ' . lang('medicine');
                                                }
                                                ?>

                                            </td>


                                            <td class="no-print">
                                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                                    <?php if ($payment->payment_from == 'payment' && empty($payment->payment_from)) {
                                                        $lab_pending = array();
                                                        $lab_reports_previous = $this->lab_model->getLabByInvoice($payment->id);

                                                        if (!empty($lab_reports_previous)) {
                                                            foreach ($lab_reports_previous as $lab) {
                                                                if ($lab->test_status == 'not_done' || empty($lab->test_status)) {
                                                                    $lab_pending[] = 'no';
                                                                }
                                                            }
                                                        }
                                                        if (count($lab_reports_previous) == count($lab_pending) || empty($lab_reports_previous)) {
                                                    ?>

                                                            <a class="btn btn-xs btn-soft-info edit_pay" title="<?php echo lang('edit'); ?>" href="finance/editPayment?id=<?php echo $payment->id; ?>"><i class="fa fa-edit"> </i></a>
                                                    <?php }
                                                    } ?>
                                                <?php } ?>
                                                <a class="btn-xs btn btn-soft-primary" title="<?php echo lang('invoice'); ?>" href="finance/invoice?id=<?php echo $payment->id; ?>"><i class="fa fa-file-invoice"></i> </a>
                                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                                    <?php if ($payment->payment_from == 'payment' && empty($payment->payment_from)) {
                                                        $lab_pending = array();
                                                        $lab_reports_previous = $this->lab_model->getLabByInvoice($payment->id);

                                                        if (!empty($lab_reports_previous)) {
                                                            foreach ($lab_reports_previous as $lab) {
                                                                if ($lab->test_status == 'not_done' || empty($lab->test_status)) {
                                                                    $lab_pending[] = 'no';
                                                                }
                                                            }
                                                        }
                                                        if (count($lab_reports_previous) == count($lab_pending) || empty($lab_reports_previous)) {
                                                    ?>
                                                            <a class="btn btn-xs btn-soft-danger delete_button" title="<?php echo lang('delete'); ?>" style="width: 25%;" href="finance/delete?id=<?php echo $payment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                                    <?php }
                                                    } ?>
                                                <?php } ?>
                                                </button>
                                            </td>
                                        </tr>

                                <?php
                                    }
                                }
                                ?>


                                <?php
                                foreach ($deposits as $deposit) {
                                    if ($deposit->date == $value) {
                                        if (!empty($deposit->deposited_amount) && empty($deposit->amount_received_id)) {
                                ?>

                                            <tr class="">
                                                <td><?php echo date('d-m-y', $deposit->date); ?></td>
                                                <td><?php echo $deposit->payment_id; ?></td>
                                                <td></td>
                                                <td><?php echo $settings->currency; ?> <?php echo $deposit->deposited_amount; ?></td>
                                                <td> <?php echo $deposit->deposit_type; ?></td>
                                                <td></td>
                                                <td class="no-print">
                                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                                        <button type="button" class="btn btn-xs btn-soft-info editbutton edit_pay" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $deposit->id; ?>"><i class="fa fa-edit"></i> </button>
                                                    <?php } ?>
                                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                                        <a class="btn btn-xs btn-soft-danger delete_button edit_pay" title="<?php echo lang('delete'); ?>" href="finance/deleteDeposit?id=<?php echo $deposit->id; ?>&patient=<?php echo $patient->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            <?php } ?>



                        </tbody>

                    </table>
                </div>
            </div>
                            </div>
        </section>

        <style>
    .personal-task{
        background-color: #F1F2F7;
    }
    .personal-task tbody tr td {
            padding: 11px 15px;
            border-color: #eeeff1;
        }
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
        <section class="no-print col-md-4">
           
           <div class="">
               <section class="card">
                   <div class="card-body profile">
                       <div class="task-thumb-details">
                           <?php echo lang('patient'); ?> <?php echo lang('name'); ?>: <h4><a href="#"><?php echo $patient->name; ?></a></h4> <br>
                           <?php echo lang('address'); ?>: <p> <?php echo $patient->address; ?></p>
                       </div>
                   </div>
                   <table class="table mb-0 personal-task">
                       <tbody>
                           <tr>
                               <td>
                                   <i class=" fa fa-envelope"></i>
                               </td>
                               <td style="text-align:right;"><?php echo $patient->email; ?></td>

                           </tr>
                           <tr>
                               <td>
                                   <i class="fa fa-phone"></i>
                               </td>
                               <td style="text-align:right;"><?php echo $patient->phone; ?></td>

                           </tr>

                       </tbody>
                   </table>
               </section>

               <?php
               $total_bill = array();
               foreach ($payments as $payment) {
                   $total_bill[] = $payment->gross_total;
               }
               if (!empty($total_bill)) {
                   $total_bill = array_sum($total_bill);
               } else {
                   $total_bill = 0;
               }
               ?>






               <section class="card">
                   <div class="weather-bg">
                       <div class="card-body">
                           <div class="row">
                               <div class="col-md-6 text_bar">
                                   <i class="fa fa-money-check"></i>
                                   <?php echo lang('total_bill_amount'); ?>
                               </div>
                               <div class="col-md-6">
                                   <div class="degree">
                                       <?php echo $settings->currency; ?>
                                       <?php echo $total_payable_bill = $total_bill; ?>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </section>

               <section class="card">
                   <div class="weather-bg">
                       <div class="card-body">
                           <div class="row">
                               <div class="col-md-6 text_bar">
                                   <i class="fa fa-money-check"></i>
                                   <?php echo lang('total_deposit_amount'); ?>
                               </div>
                               <div class="col-md-6">
                                   <div class="degree">
                                       <?php echo $settings->currency; ?>
                                       <?php
                                       $total_deposit = array();
                                       foreach ($deposits as $deposit) {
                                           $total_deposit[] = $deposit->deposited_amount;
                                       }
                                       echo array_sum($total_deposit);
                                       ?>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </section>

               <section class="card red due_amount_div">
                   <div class="weather-bg">
                       <div class="card-body">
                           <div class="row">
                               <div class="col-md-6 text_bar">
                                   <i class="fa fa-money-check"></i>
                                   <?php echo lang('due_amount'); ?>
                               </div>
                               <div class="col-md-6">
                                   <div class="degree">
                                       <?php echo $settings->currency; ?>
                                       <?php
                                       echo $total_payable_bill - array_sum($total_deposit);
                                       ?>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </section>


           </div>
                               
       </section>
    </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('add_deposit'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
            <div class="modal-body">
                <form role="form" action="finance/deposit" id="deposit-form" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group payment_class"> 
                        <label for="exampleInputEmail1"><?php echo lang('invoice'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single" id="payment_id1"  name="payment_id" value='' required=""> 
                            <option value="">Select .....</option>
                            <?php foreach ($payments as $payment) { ?>
                                <option value="<?php echo $payment->id; ?>" ><?php echo $payment->id; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('due'); ?> <?php echo lang('amount');?></label>
                        <input type="text" class="form-control" id="due_amount" name="due"  value='' placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('deposit_amount'); ?></label>
                        <input type="text" class="form-control" name="deposited_amount" id="deposited_amount"  value='' placeholder="">
                    </div>



                    <div class="form-group">
                    <div class="">
                            <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>
                        </div>
                        <div class="">
                            <select class="form-control m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                    <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                    <option value="Card"> <?php echo lang('card'); ?> </option>
                                <?php } ?>

                            </select>
                        </div>
                        <?php
                        $payment_gateway = $settings->payment_gateway;
                        ?>



                        <div class = "card2">

                            <hr>
                            <div class="col-md-12 payment pad_bot">
                                <label for="exampleInputEmail1"> <?php echo lang('accepted'); ?> <?php echo lang('cards'); ?></label>
                                <div class="payment pad_bot">
                                    <img src="uploads/card.png" width="100%">
                                </div> 
                            </div>

                            <?php
                            if ($payment_gateway == 'PayPal') {
                                ?>
                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                    <select class="form-control m-bot15" name="card_type" value=''>

                                        <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>   
                                        <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                        <option value="American Express" > <?php echo lang('american_express'); ?> </option>
                                    </select>
                                </div>
                            <?php } ?>
                            <?php if ( $payment_gateway == 'PayPal') {
                                ?>
                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                    <input type="text"  id="cardholder" class="form-control pay_in" name="cardholder" value='' placeholder="">
                                </div>
                            <?php } ?>
                            <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                    <input type="text" class="form-control pay_in" id="card"  name="card_number" value='' placeholder="">
                                </div>


<div class="row">
                                <div class="col-md-8 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                    <input type="text" class="form-control pay_in" data-date="" id="expire" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                </div>
                                <div class="col-md-4 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                    <input type="text" class="form-control pay_in" id="cvv" maxlength="3" name="cvv_number" value='' placeholder="">
                                </div> 
</div>

                            </div>

                            <?php
                        }
                        ?>

                    </div> 

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>
                    <div class="modal-footer">
                    <div class="form-group cashsubmit payment  right-six col-md-12 pull-right">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    
                        <button type="submit" name="submit2" id="submit1" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                    </div>
                    <div class="form-group cardsubmit  right-six col-md-12 hidden pull-right">
                        <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> &nbsp;
                        <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info " <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                    ?>onClick="stripePay(event);" <?php }
                                                            ?><?php if ($settings->payment_gateway == '2Checkout' && $twocheckout->status == 'live') {
                            ?>onClick="twoCheckoutPay(event);" <?php }
                                                                ?>> <?php echo lang('submit'); ?></button>
                    </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>
<!-- Add Patient Modal-->




<!-- Add Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('edit_deposit'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
         
            <div class="modal-body">
                <form role="form" id="editDepositform" action="finance/deposit" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="payment_label">
                        <label for="exampleInputEmail1"><?php echo lang('invoice'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" id="payment_id2" name="payment_id" value=''>
                            <option value="">Select .....</option>
                            <?php foreach ($payments as $payment) {
                                if ($payment->payment_from == 'payment' || $payment->payment_from == 'admitted_patient_bed_medicine'  || $payment->payment_from == 'admitted_patient_bed_service' || $payment->payment_from =='admitted_patient_bed_diagnostic') {
                            ?>
                                    <option value="<?php echo $payment->id; ?>" <?php
                                                                                if (!empty($deposit->payment_id)) {
                                                                                    if ($deposit->payment_id == $payment->id) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>><?php echo $payment->id; ?> </option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('due'); ?> <?php echo lang('amount'); ?></label>
                        <input type="text" class="form-control" id="due_amount1" name="due" value='' placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('deposit_amount'); ?></label>
                        <input type="text" class="form-control" name="deposited_amount" id="deposited_amount1" value='' placeholder="">
                    </div>


                    <div class="form-group">
                        <div class="">
                            <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>
                        </div>
                        <div class="">
                            <select class="form-control m-bot15 js-example-basic-single selecttype1" id="selecttype1" name="deposit_type" value=''>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                    <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                    <option value="Card"> <?php echo lang('card'); ?> </option>
                                <?php } ?>

                            </select>
                        </div>

                        <?php
                        $payment_gateway = $settings->payment_gateway;
                        ?>



                        <div class="card1">

                            <hr>
                            <div class="col-md-12 payment pad_bot">
                                <label for="exampleInputEmail1"> <?php echo lang('accepted'); ?> <?php echo lang('cards'); ?></label>
                                <div class="payment pad_bot">
                                    <img src="uploads/card.png" width="100%">
                                </div>
                            </div>

                            <?php
                            if ($payment_gateway == 'PayPal') {
                            ?>
                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                    <select class="form-control m-bot15" name="card_type" value=''>

                                        <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                        <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                        <option value="American Express"> <?php echo lang('american_express'); ?> </option>
                                    </select>
                                </div>
                            <?php } ?>
                            <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') {
                            ?>
                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                    <input type="text" id="cardholder" class="form-control pay_in" name="cardholder" value='' placeholder="">
                                </div>
                            <?php } ?>
                            <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                    <input type="text" class="form-control pay_in" id="card1" name="card_number" value='<?php
                                                                                                                        if (!empty($payment->p_email)) {
                                                                                                                            echo $payment->p_email;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                </div>


                                <div class="row">
                                <div class="col-md-8 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                    <input type="text" class="form-control pay_in" data-date="" id="expire1" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='<?php
                                                                                                                                                                                                                                            if (!empty($payment->p_phone)) {
                                                                                                                                                                                                                                                echo $payment->p_phone;
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            ?>' placeholder="">
                                </div>
                                <div class="col-md-4 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                    <input type="text" class="form-control pay_in" id="cvv1" maxlength="3" name="cvv_number" value='<?php
                                                                                                                                    if (!empty($payment->p_age)) {
                                                                                                                                        echo $payment->p_age;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="">
                                </div>
                                </div>
                        </div>

                    <?php
                            }
                    ?>

                    </div>



                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>
                    <div class="modal-footer">
                        <div class="form-group cashsubmit1 payment  right-six col-md-12 pull-right">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> &nbsp;
                            <button type="submit" name="submit2" id="submit1" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                        </div>
                        <div class="form-group cardsubmit1  right-six col-md-12 hidden pull-right">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> &nbsp;
                            <button type="submit" name="pay_now" id="submit-btn1" class="btn btn-info" <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                        ?>onClick="stripePay1(event);" <?php }
                                                                ?>> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>
<!-- Add Patient Modal-->












<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header  no-print">
                
                <h5 class="modal-title"><?php echo lang('invoice'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body clearfix">
                <div class="pacardnel panel-primary">

                    <div class="card-body" id="invoice">
                        <div class="row invoice-list">
                            <div class="text-center corporate-id top_title">
                                <img alt="" src="<?php echo $this->settings_model->getSettings()->logo; ?>" width="200" height="100">
                                <h4>
                                    <?php echo $settings->title ?>
                                </h3>
                                <h5>
                                    <?php echo $settings->address ?>
                                </h5>
                                <h5>
                                    Tel: <?php echo $settings->phone ?>
                                </h5>
                            </div>
                            
                            <div class="col-lg-4 col-sm-4 information">
                                <h6><?php echo lang('payment_to'); ?>:</h6>
                                <p>
                                    <?php echo $settings->title; ?> <br>
                                    <?php echo $settings->address; ?><br>
                                    Tel: <?php echo $settings->phone; ?>
                                </p>
                            </div>
                            <?php if (!empty($payment->patient)) { ?>
                                <div class="col-lg-4 col-sm-4 information">
                                    <h6><?php echo lang('bill_to'); ?>:</h6>
                                    <p>
                                        <?php
                                        if (!empty($patient->name)) {
                                            echo $patient->name . ' <br>';
                                        }
                                        if (!empty($patient->address)) {
                                            echo $patient->address . ' <br>';
                                        }
                                        if (!empty($patient->phone)) {
                                            echo $patient->phone . ' <br>';
                                        }
                                        ?>
                                    </p>
                                </div>
                            <?php } ?>
                            <div class="col-lg-4 col-sm-4 information">
                                <h6><?php echo lang('invoice_info'); ?></h6>
                                <ul class="unstyled">
                                    <li>Date : <?php echo date('m/d/Y'); ?></li>
                                </ul>
                            </div>
                            <br>
                        </div>
                        <table class="table mb-0" id="editable-samples">
                            <thead>
                                <tr>
                                    <th class=""><?php echo lang('date'); ?></th>
                                    <th class=""><?php echo lang('invoice'); ?> #</th>
                                    <th class=""><?php echo lang('bill_amount'); ?></th>
                                    <th class=""><?php echo lang('deposit'); ?></th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                $dates = array();
                                $datess = array();
                                foreach ($payments as $payment) {
                                    $dates[] = $payment->date;
                                }
                                foreach ($deposits as $deposit) {
                                    $datess[] = $deposit->date;
                                }
                                $dat = array_merge($dates, $datess);
                                $dattt = array_unique($dat);
                                asort($dattt);

                                $total_pur = array();

                                $total_p = array();
                                ?>

                                <?php
                                foreach ($dattt as $key => $value) {
                                    foreach ($payments as $payment) {
                                        if ($payment->date == $value) {
                                ?>
                                            <tr class="">
                                                <td><?php echo date('d/m/y', $payment->date); ?></td>
                                                <td> <?php echo $payment->id; ?></td>
                                                <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                                                <td><?php
                                                    if (!empty($payment->amount_received)) {
                                                        echo $settings->currency;
                                                    }
                                                    ?> <?php echo $payment->amount_received; ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    foreach ($deposits as $deposit) {
                                        if ($deposit->date == $value) {
                                            if (!empty($deposit->deposited_amount) && empty($deposit->amount_received_id)) {
                                    ?>

                                                <tr class="">
                                                    <td><?php echo date('d-m-y', $deposit->date); ?></td>
                                                    <td><?php echo $deposit->payment_id; ?></td>
                                                    <td></td>
                                                    <td><?php echo $settings->currency; ?> <?php echo $deposit->deposited_amount; ?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-8 invoice-block total_section">
                                <ul class="unstyled amounts">
                                    <li><strong><?php echo lang('grand_total'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $total_payable_bill = $total_bill; ?></li>
                                    <li><strong><?php echo lang('amount_received'); ?> : </strong><?php echo $settings->currency; ?> <?php echo array_sum($total_deposit); ?></li>
                                    <li><strong><?php echo lang('amount_to_be_paid'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $total_payable_bill - array_sum($total_deposit); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

<div class="modal-footer">
<a class="btn btn-soft-info btn-sm invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
<a class="btn btn-soft-primary btn-sm detailsbutton pull-left download" id="download"><i class="fa fa-download"></i> <?php echo lang('download'); ?> </a>
                
</div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>

<?php if (!empty($gateway->publish)) {
    $gateway_stripe = $gateway->publish;
} else {
    $gateway_stripe = '';
} ?>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script type="text/javascript">
    var publish = "<?php echo $gateway_stripe; ?>";
</script>
<script src="common/js/moment.min.js"></script>

<script type="text/javascript">
    var payment_gateway = "<?php echo $settings->payment_gateway; ?>";
</script>

<script src="common/extranal/js/finance/patient_deposit.js"></script>