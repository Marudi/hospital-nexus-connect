
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Due</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active">Due</li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <!-- page start-->
           <link href="common/extranal/css/finance/payments.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> <?php echo lang('due'); ?> <?php echo lang('payments');?></h4> 
                                        <div class="col-md-4 date_field" style="margin-top: 10px;">
                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control default-date-picker" name="date_from" id="date_from" value="" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                    <span class="input-group-text"><?php echo lang('to'); ?></span>
                                    <input type="text" class="form-control default-date-picker" name="date_to" id="date_to" value="" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                </div>
                        </div>
                                    </div>
            

            <div class="card-body">
                <div class="adv-table editable-table ">
                    <!-- <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 date_field" style="margin-top: 10px;">
               
                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control default-date-picker" name="date_from" id="date_from" value="" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                    <span class="input-group-text"><?php echo lang('to'); ?></span>
                                    <input type="text" class="form-control default-date-picker" name="date_to" id="date_to" value="" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                </div>
                        </div>
                        <div class="col-md-4"></div>
                </div> -->
                        <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample4">
                        <thead>
                            <tr>
                                <th><?php echo lang('invoice_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('doctor'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('from'); ?></th>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('add_deposit'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         
            <div class="modal-body">
                <form role="form" action="finance/deposit" id="deposit-form" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="row">
                <div class="form-group col-md-4">
                     <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('name'); ?> &ast; </label>
                     <input type="text" class="form-control" name="name" id="name" value='' placeholder="" readonly=""> 
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1"><?php echo lang('invoice_no'); ?>  &ast; </label>
                    <input type="text" class="form-control" name="invoice_no" id="invoice_no"  value='' placeholder="" readonly=""> 
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast; </label>
                    <input type="text" class="form-control" name="date" id="date" value='' placeholder="" readonly=""> 
                </div>
                <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('due'); ?> <?php echo lang('amount');?></label>
                        <input type="text" class="form-control" id="due_amount" name="due"  value='' placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('deposit_amount'); ?></label>
                        <input type="text" class="form-control" name="deposited_amount" id="deposited_amount"  value='' placeholder="" required>
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
                            <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') {
                                ?>
                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                    <input type="text"  id="cardholder" class="form-control pay_in" name="cardholder" value='' placeholder="">
                                </div>
                            <?php } ?>
                            <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                    <input type="text" class="form-control pay_in" id="card" name="card_number" value='' placeholder="">
                                </div>



                                <div class="col-md-8 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                    <input type="text" class="form-control pay_in" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                </div>
                                <div class="col-md-4 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                    <input type="text" class="form-control pay_in" id="cvv" maxlength="3" name="cvv" value='' placeholder="">
                                </div> 

                            </div>

                            <?php
                        }
                        ?>

                    </div> 


                    <input type="hidden" name="redirect" value="due">
                    <input type="hidden" name="id" id="id" value=''>
                    <input type="hidden" name="patient" id="patient_id" value=''>
                    <input type="hidden" name="payment_id" id="payment_id" value=''>
                    <div class="modal-footer">
                   
                    <div class="form-group cashsubmit payment  right-six col-md-12 pull-right">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit2" id="submit1" class="btn btn-info"> <?php echo lang('submit'); ?></button> 
                    </div>
                    <div class="form-group cardsubmit  right-six col-md-12 hidden pull-right">
                        <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info " <?php if ($settings->payment_gateway == 'Stripe') {
                            ?>onClick="stripePay(event);"<?php }
                        ?><?php if ($settings->payment_gateway == '2Checkout' && $twocheckout->status == 'live') {
                            ?>onClick="twoCheckoutPay(event);"<?php }
                        ?>> <?php echo lang('submit'); ?></button>
                    </div>
                    </div>
                        </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="common/extranal/js/finance/due_collection.js"></script>
<?php if (!empty($gateway->publish)) { 
    $gateway_stripe= $gateway->publish;
 } else { 
    $gateway_stripe='';
 } ?>




<script type="text/javascript">var publish = "<?php echo $gateway_stripe; ?>";</script>
<script src="common/js/moment.min.js"></script>

<script type="text/javascript">var payment_gateway = "<?php echo $settings->payment_gateway; ?>";</script>

<script src="common/extranal/js/finance/patient_deposit.js"></script>

<script>
$(document).ready(function () {
  

 $('#date_from').on('change',function(){
        var date_from=$(this).val();
        var date_to=$('#date_to').val();
        var date_from_split=date_from.split('-');
        var date_from_new=date_from_split[1] +'/'+date_from_split[0]+'/'+date_from_split[2]
        if(date_to !='' || date_to !=null){
            var date_to_split=date_to.split('-');
            var date_to_new=date_to_split[1] +'/'+date_to_split[0]+'/'+date_to_split[2];
        }
    if(date_to !='' || date_to !=null){
        if(Date.parse(date_to_new) <= Date.parse(date_from_new)){
           
            alert('Select a Valid Date. End Date should be Greater than Start Date');
            $(this).val("");
        }else{
            $('#editable-sample4').DataTable().destroy().clear();
            "use strict";
            var table = $("#editable-sample4").DataTable({
    responsive: true,
    //   dom: 'lfrBtip',

    processing: true,
    serverSide: true,
    searchable: true,
    ajax: {
      url: "finance/getDuePayment?start_date="+date_from+"&end_date="+date_to,
      type: "POST",
    },
    scroller: {
      loadingIndicator: true,
    },
    dom:
      "<'row'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      {
        extend: "copyHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "excelHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "csvHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "pdfHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "print",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: 100,

    order: [[0, "desc"]],

    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });
  table.buttons().container().appendTo(".custom_buttons");
        }
    }
    })
    $('#date_to').on('change',function(){
        var date_to=$(this).val();
        var date_from=$('#date_from').val();
         
        var date_to_split=date_to.split('-');
        var date_to_new=date_to_split[1] +'/'+date_to_split[0]+'/'+date_to_split[2];
        if(date_from !='' || date_from !=null){
            var date_from_split=date_from.split('-');
            var date_from_new=date_from_split[1] +'/'+date_from_split[0]+'/'+date_from_split[2];
            
        }
    if(date_from !='' || date_from !=null){
        if(Date.parse(date_to_new) <= Date.parse(date_from_new)){
           
            alert('Select a Valid Date. End Date should be Greater than Start Date');
            $(this).val("");
        }else{
            $('#editable-sample4').DataTable().destroy().clear();
            "use strict";
            var table = $("#editable-sample4").DataTable({
    responsive: true,
    //   dom: 'lfrBtip',

    processing: true,
    serverSide: true,
    searchable: true,
    ajax: {
      url: "finance/getDuePayment?start_date="+date_from+"&end_date="+date_to,
      type: "POST",
    },
    scroller: {
      loadingIndicator: true,
    },
    dom:
      "<'row'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      {
        extend: "copyHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "excelHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "csvHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "pdfHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "print",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: 100,

    order: [[0, "desc"]],

    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });
  table.buttons().container().appendTo(".custom_buttons");
        }
    }
    })
})

</script>