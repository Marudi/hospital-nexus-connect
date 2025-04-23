<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
 <link href="common/extranal/css/settings/subscription.css" rel="stylesheet">
 <div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php echo lang('subscription'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('settings'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('subscription'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- <section class="">
            <div class=""> -->

              

                <!-- <section class="content"> -->
                    <div class="col-md-12">
                        <div class="card panel-primary" style="-webkit-box-shadow:none;
     box-shadow: 0;">
                        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('subscription'); ?>  <?php echo lang('details'); ?></h4> 
                                        
                                    </div>
                          

                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <!-- <div class="white-box"> -->
                                        <div class="card card-inverse" style="-webkit-box-shadow:none;
     box-shadow: 0;">
                                        <div class="card-header table_header">
                                            <h4 class="card-title mb-0 col-lg-11"> <?php echo lang('my_current_plan'); ?>(<?php echo $package->name; ?>)</h4> 
                                            <div class="col-lg-1 no-print pull-right"> 
                                            <a href="settings/packages" class="btn btn-block btn-success waves-effect text-center">Change Plan</a>
                                            
                                            
                                            </div>
                                        
                                        
                                        </div>
                                    <!-- <div class="panel-wrapper collapse in"> -->
                                                <div class="card-body">
                                                    <div class="row f-15 m-b-10">
                                                        <div class="col-sm-9">
                                                            <?php echo lang('yearly_price'); ?> </div>
                                                        <div class="col-sm-3">
                                                            <?php echo $settings->currency; ?><?php echo $package->yearly_price; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row f-15 m-b-10">
                                                        <div class="col-sm-9">
                                                            <?php echo lang('monthly_price'); ?> </div>
                                                        <div class="col-sm-3">
                                                            <?php echo $settings->currency; ?><?php echo $package->monthly_price; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row f-15 m-b-10">
                                                        <div class="col-sm-9">
                                                            <?php echo lang('patient'); ?>  <?php echo lang('limit'); ?>   </div>
                                                        <div class="col-sm-3">
                                                            <?php echo $subscription->p_limit; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row f-15 m-b-10">
                                                        <div class="col-sm-9">
                                                            <?php echo lang('doctor'); ?>  <?php echo lang('limit'); ?>  </div>
                                                        <div class="col-sm-3">
                                                            <?php echo $subscription->d_limit; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row f-15 m-b-10">
                                                        <div class="col-sm-9">
                                                            <?php echo lang('my_plan'); ?>  </div>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            if ($hospital_payments->package_duration == 'yearly') {
                                                                echo lang('yearly');
                                                            } else {
                                                                echo lang('monthly');
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                     <?php
                                                    $diff_date = $hospital_payments->next_due_date_stamp - $hospital_payments->add_date_stamp;
                                                    $remain_day = $diff_date / (24 * 3600);
                                                    if ($remain_day == '15') {
                                                        ?>
                                                        <div class="row f-15 m-b-10">
                                                            <div class="col-sm-9">
                                                                <?php echo lang('version'); ?>  </div>
                                                            <div class="col-sm-3">
                                                                <?php echo lang('trial'); ?> 
                                                            </div>
                                                    </div> <?php } ?>  
                                                    <div class="row f-15 m-b-10">
                                                        <div class="col-sm-9">
                                                            <?php echo lang('next_due_date'); ?>  </div>
                                                        <div class="col-sm-3">
                                                            <?php echo $hospital_payments->next_due_date; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row f-15 m-b-10">
                                                        <div class="col-sm-9">
                                                        </div>
                                                        <div class="col-sm-3 selectPackage_div">
                                                            <button  type="button" data-payment-id="<?php echo $hospital_payments->id; ?>"  data-is-free="0" class="btn btn-success waves-effect waves-light selectPackage" title="add deposit"><i class="icon-anchor display-small"></i><span class="display-big"><?php echo lang('renew'); ?></span>
                                                            </button>
                                                                           
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <section class="card">
                            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('invoice'); ?></h4> 
                                        
                                    </div>
                               
                                <div class="card-body">
                                <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                                            <thead>
                                                <tr>
                                                    <th> #</th>
                                                    <th> <?php echo lang('package'); ?></th>
                                                    <th> <?php echo lang('amount'); ?></th>
                                                    <th> <?php echo lang('date'); ?></th>
                                                    <th> <?php echo lang('next_payment_date'); ?></th>
                                                    <th> <?php echo lang('payment_gateway'); ?></th>
                                                    <th> <?php echo lang('options'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                foreach ($deposits as $deposit) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i + 1; ?></td>

                                                        <td><?php
                                                            $package = $this->db->get_where('hospital_payment', array('id' => $deposit->payment_id))->row()->package;
                                                            $package_details = $this->db->get_where('package', array('id' => $package))->row();
                                                            echo $package_details->name;
                                                            ?></td>
                                                        <td><?php echo $deposit->deposited_amount; ?></td>
                                                        <td><?php echo $deposit->add_date; ?></td>
                                                        <td><?php echo $deposit->next_due_date; ?></td>
                                                        <td><?php echo $deposit->gateway; ?></td>
                                                        <td><a type="button" class="btn btn-soft-primary waves-effect waves-light btn-xs" data-toggle="" href="settings/downloadInvoice?id=<?php echo $deposit->id; ?>" data-id="<?php echo $deposit->id; ?>"><i class="fa fa-download"></i></a>   </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>

                           
                        </div>
                    </div>
                <!-- </section> -->



            <!-- </div> -->
        <!-- </section> -->

        <!-- page end-->
    </section>

</section>
<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title">  <?php echo lang('add_deposit'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
           
            <div class="modal-body row">
                <form role="form" id="editDepositForm" action="settings/changePlanPayment" class="clearfix" method="post" enctype="multipart/form-data">
                <div class="row">   
                <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('package'); ?> <?php echo lang('name'); ?></label> 
                        <input type="text" class="form-control package_name" name="package" value='' placeholder="" readonly="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('package'); ?> <?php echo lang('price'); ?></label> 
                        <input type="text" class="form-control pay_in package_price" name="package_price" value='' placeholder="" readonly="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('package'); ?> <?php echo lang('type'); ?></label> 
                        <input type="text" class="form-control pay_in package_type" name="package_type" value='' placeholder="" readonly="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('next_due_date'); ?> </label> 
                        <input type="text" class="form-control pay_in next_due_date" name="next_due_date" value='' placeholder="" readonly="">
                    </div>
                    <input type="hidden" name="deposit_type" value="Card">
                    <?php
                    $payment_gateway = $settings1->payment_gateway;
                    if ($payment_gateway == 'PayPal') {
                        ?>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?></label>
                            <select class="form-control  js-example-basic-single"  name="card_type" value=''>  

                                <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>   
                                <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                <option value="American Express" > <?php echo lang('american_express'); ?> </option>

                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                            <input type="text" class="form-control" name="cardholder"  value='' placeholder="">
                        </div>

                    <?php } ?>
                    <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack') { ?>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                            <input type="text" class="form-control" id="card" name="card_number" value='' placeholder="">
                        </div>


                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                            <input type="text" class="form-control" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="" required="">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?></label>
                            <input type="text" class="form-control" id="cvv" name="cvv_number" value="" placeholder="" maxlength="3" required="">
                        </div>

                        <?php
                    }
                    ?>
                    <div id="token"></div>
                    <input type="hidden" name="hospital_id" id="hospital_id" value='<?php echo $hospital->id; ?>'>
                    <input type="hidden" name="id" id="package_id" value=''>
                    <input type="hidden" name="renew"  value='renew'>
                    <div class="col-md-12 pull-right">
                        <button type="submit" value="submit" class="btn btn-info btn-groupsubmit_button" id="submit-btn"  <?php
                                if ($settings1->payment_gateway == 'Stripe') {
                                    ?>onClick="stripePay(event);"<?php }
                                ?>> <?php echo lang('submit'); ?></button>
                    </div>
                                </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script type="text/javascript">var gateway = "<?php echo $gateway->publish; ?>";</script>
<script src="common/extranal/js/settings/subscription.js"></script>
