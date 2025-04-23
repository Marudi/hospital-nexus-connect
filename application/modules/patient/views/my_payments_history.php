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
           <link href="common/extranal/css/patient/my_payments_history.css" rel="stylesheet">
           <div class="row">
        <section class="no-print col-md-8">
            <div class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-6"><?php echo lang('payment_history') ?></h4> 
                                        <div class="col-lg-6 no-print pull-right"> 
                                        <button type="button" class="btn btn-soft-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('deposit'); ?></button>
                                                    <button type="button" class="btn btn-soft-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal5"><i class="fa fa-file"></i> <?php echo lang('invoice'); ?></button>
                                           
                                        </div>
                                    </div>
       
            <div class="card-body">
                <div class="adv-table editable-table ">


                    <section class="col-md-12 no-print row">
                        <form role="form" class="f_report" action="patient/myPaymentHistory" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                               
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

                        </form>
                    </section>
                    <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('all_bills'); ?> & <?php echo lang('deposits'); ?> </h4> 
                                      
                                    </div>
           
                   
                    
                    <table class="table mb-0" id="editable-samples">
                        <thead>
                            <tr>
                                <th class=""><?php echo lang('date'); ?></th>
                                <th class=""><?php echo lang('invoice'); ?> #</th>
                                <th class=""><?php echo lang('bill_amount'); ?></th>
                                <th class=""><?php echo lang('deposit'); ?></th>
                                <th class=""><?php echo lang('deposit_type'); ?></th>
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



                                        <td  class="no-print"> 
                                            <a class="btn btn-soft-primary btn-xs" title="<?php echo lang('invoice'); ?>" href="patient/myInvoice?id=<?php echo $payment->id; ?>"><i class="fas fa-file-invoice"></i> </a>
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
                                            <td  class="no-print"> 
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
                <form role="form" action="patient/deposit" id="deposit-form" class="clearfix" method="post" enctype="multipart/form-data">
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

                                <option value="Card"> <?php echo lang('card'); ?> </option>  
                            </select>
                        </div>

                        <?php
                        $payment_gateway = $settings->payment_gateway;
                        ?>



                        <div class = "card">

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

                    <div class="form-group cardsubmit  right-six col-md-12"> 
                        
                        <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row pull-right" <?php if ($settings->payment_gateway == 'Stripe') {
                            ?>onClick="stripePay(event);"<?php }
                        ?>> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>
<!-- Add Patient Modal-->









<div class="modal fade" id="myModal5" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-print">
                <button type="button" class="close no-print" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('invoice'); ?></h4>
            </div>
            <div class="modal-body clearfix">
                <div class="panel panel-primary">
                   
                    <div class="panel-body col-md-12 logo_div">
                        <div class="row invoice-list">

                            <div class="text-center corporate-id top_title">

                                <img alt="" src="<?php echo $this->settings_model->getSettings()->logo; ?>" width="200" height="100">
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

                            <div class="col-lg-4 col-sm-4 settings_info">
                                <h4><?php echo lang('payment_to'); ?>:</h4>
                                <p>
                                    <?php echo $settings->title; ?> <br>
                                    <?php echo $settings->address; ?><br>
                                    Tel:  <?php echo $settings->phone; ?>
                                </p>
                            </div>

                            <?php if (!empty($payment->patient)) { ?>


                                <div class="col-lg-4 col-sm-4 settings_info">
                                    <h4><?php echo lang('bill_to'); ?>:</h4>
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

                            <div class="col-lg-4 col-sm-4 settings_info">
                                <h4><?php echo lang('invoice_info'); ?></h4>
                                <ul class="unstyled">
                                    <li>Date		: <?php echo date('m/d/Y'); ?></li>
                                </ul>

                            </div>
                            <br>

                        </div>






                        <table class="table table-striped table-hover table-bordered" id="editable-samples">
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
                            <div class="col-lg-8 invoice-block pull-right total_section">
                                <ul class="unstyled amounts"> 
                                    <li><strong><?php echo lang('grand_total'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $total_payable_bill = $total_bill; ?></li>
                                    <li><strong><?php echo lang('amount_received'); ?> : </strong><?php echo $settings->currency; ?> <?php echo array_sum($total_deposit); ?></li>
                                    <li><strong><?php echo lang('amount_to_be_paid'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $total_payable_bill - array_sum($total_deposit); ?></li>
                                </ul>
                            </div>
                        </div>


                        <div class="text-center invoice-btn">

                            <a class="btn btn-info btn-lg invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
                        </div>


                    </div>



                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>

<?php if (!empty($gateway->publish)) { 
    $gateway_stripe= $gateway->publish;
 } else { 
    $gateway_stripe='';
 } ?>


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">var publish = "<?php echo $gateway_stripe; ?>";</script>
<script src="common/js/moment.min.js"></script>

<script type="text/javascript">var payment_gateway = "<?php echo $settings->payment_gateway; ?>";</script>

<script src="common/extranal/js/patient/my_payments_history.js"></script>