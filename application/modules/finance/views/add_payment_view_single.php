<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"> <?php
                if (!empty($payment->id)) {
                    echo lang('edit_payment');
                } else {
                    echo lang('add_new_payment');
                }
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active"> <?php
                if (!empty($payment->id)) {
                    echo lang('edit_payment');
                } else {
                    echo lang('add_new_payment');
                }
                ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/finance/add_payment_view.css" rel="stylesheet">
        <link href="common/extranal/css/finance/add_payment_view_single.css" rel="stylesheet">

        <style>
            .percent_amount{
               
                padding: 6px 9px !important;
            }
            .percent_input{
                padding:6px 4px !important;
            }
            h4{
                font-size: 1rem !important;
            }
        </style>
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                if (!empty($payment->id)) {
                    echo lang('edit_payment');
                } else {
                    echo lang('add_new_payment');
                }
                ?></h4> 
                                       
                                    </div>
          
           
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="">

                            <section class="">

                                <div class="editform">


                                    <form role="form" id="editPaymentForm" class="clearfix" action="finance/addPayment" method="post" enctype="multipart/form-data">
<div class="row">
                                        <div class="col-md-5">


                                        <div class="col-md-12 payment pad_bot row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                                    <h4>  <?php echo $patient->name; ?></h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('id'); ?></label>
                                                    <h4>  <?php echo $patient->id; ?></h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                                    <h4>  <?php echo $patient->email; ?></h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                                    <h4>  <?php echo $patient->phone; ?></h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1"> <?php echo lang('birth_date'); ?></label>
                                                    <h4>  <?php echo $patient->birthdate; ?></h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1"> <?php echo lang('age'); ?></label>
                                                    <h4>  <?php  if(!empty($patient->age)){ $age=explode('-',$patient->age);
                                                                    echo $age[0]. ' Y '.$age[1]. ' M '.$age[2]. ' D '; }?></h4>
                                                                 </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1"> <?php echo lang('gender'); ?></label>
                                                    <h4>  <?php if($patient->sex=='Male'){
                                                        echo lang('male');
                                                    }else{
                                                        echo lang('female');
                                                    } ?></h4>  
                                                </div>             
                                                <input type="hidden" name="patient" value="<?php echo $patient->id; ?>">
                                            </div> 



                                            <div class="col-md-12 payment pad_bot">
                                                <label for="exampleInputEmail1"> <?php echo lang('refd_by_doctor'); ?></label>
                                                <select class="form-control m-bot15  add_doctor" id="add_doctor" name="doctor" value='' required>  
                                                    <?php if (!empty($payment)) { ?>
                                                        <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - <?php echo $doctors->id; ?></option>  
                                                    <?php }elseif(!empty($draft->doctor)){ 
                                                          if($draft->doctor=='add_new'){ 
                                                              ?>
                                                                   <option value="<?php echo 'add_new'; ?>" selected="selected"><?php echo lang('add_new'); ?></option>   
                                                      <?php    }else{
                                                          $doctor_name=$this->doctor_model->getDoctorById($draft->doctor)->name;
                                                          ?>
                                                        <option value="<?php echo $draft->doctor; ?>" selected="selected"><?php echo $doctor_name.'('.lang('id').': '.$draft->id.')'; ?></option>   

                                                   <?php    }
                                                       } ?>
                                                </select>
                                            </div>

                                            <div class="pos_doctor row">
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('name'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="d_name" id="d_name" value='<?php
                                                     if(!empty($draft->doctor)){
                                                   if($draft->doctor=='add_new'){
                                                    if (!empty($draft->doctor_name)) {
                                                        echo $draft->doctor_name;
                                                    }
                                                }
                                            }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('email'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="d_email" id="d_email" value='<?php
                                                    if(!empty($draft->doctor)){
                                                   if($draft->doctor=='add_new'){
                                                        if (!empty($draft->doctor_email)) {
                                                            echo $draft->doctor_email;
                                                        }
                                                    }
                                                }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('phone'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="d_phone" id="d_phone" value='<?php
                                                     if(!empty($draft->doctor)){
                                                   if($draft->doctor=='add_new'){
                                                        if (!empty($draft->doctor_phone)) {
                                                            echo $draft->doctor_phone;
                                                        }
                                                    }
                                                }
                                                    ?>' placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('report_delivery_time'); ?> &ast;</label>
                                                            
                                                    <div class="input-group m-bot15">
                                       
                                                    <input type="text" class="form-control default-date-picker" id="date" name="date_delivery" readonly value='<?php if(empty($payment->date_delivery)){
                                                        echo date('d-m-Y');
                                                    }elseif(!empty($draft->date_delivery)){
                                                        echo $draft->date_delivery;
                                                    }else{
                                                        echo $payment->date_delivery;
                                                    }  ?>' placeholder="">
                                                    <span class="input-group-text"><strong>:</strong></span>
                                                    <input type="time" class="form-control input-group-addon" id="myTime"  name="time_delivery"  value='<?php if(empty($payment->date_delivery)){
                                                        echo '19:00';
                                                    }elseif(!empty($draft->time_delivery)){
                                                        echo $draft->time_delivery;
                                                    }else{
                                                        echo $payment->time_delivery;
                                                    }  ?>' placeholder="">
                                                   
                                                </div>
                                                </div>
                                                       </div>


                                            <div class="col-md-12 payment">
                                                <div class="form-group last"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('select'); ?> &ast;</label>
                                                    <select name="category_name[]"  class="multi-select option_select" multiple="" id="my_multi_select3" required>
                                                        <?php foreach ($categories as $category) { ?>
                                                            <option class="ooppttiioonn" data-id="<?php echo $category->c_price; ?>" data-idd="<?php echo $category->id; ?>" data-cat_name="<?php echo $category->category; ?>" value="<?php echo $category->id; ?>" 

                                                                    <?php
                                                                    if (!empty($payment->category_name)) {
                                                                        $category_name = $payment->category_name;
                                                                        $category_name1 = explode(',', $category_name);
                                                                        foreach ($category_name1 as $category_name2) {
                                                                            $category_name3 = explode('*', $category_name2);
                                                                            if ($category_name3[0] == $category->id) {
                                                                                echo 'data-qtity=' . $category_name3[3];
                                                                            }
                                                                        }
                                                                    }elseif(!empty($draft->category_name)){
                                                                        $category_name = $draft->category_name;
                                                                        $category_name1 = explode(',', $category_name);
                                                                        foreach ($category_name1 as $category_name2) {
                                                                            $category_name3 = explode('*', $category_name2);
                                                                            if ($category_name3[0] == $category->id) {
                                                                                echo 'data-qtity=' . $category_name3[3];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>


                                                                    <?php
                                                                    if (!empty($payment->category_name)) {
                                                                        $category_name = $payment->category_name;
                                                                        $category_name1 = explode(',', $category_name);
                                                                        foreach ($category_name1 as $category_name2) {
                                                                            $category_name3 = explode('*', $category_name2);
                                                                            if ($category_name3[0] == $category->id) {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                    }elseif (!empty($draft->category_name)) {
                                                                        $category_name = $draft->category_name;
                                                                        $category_name1 = explode(',', $category_name);
                                                                        foreach ($category_name1 as $category_name2) {
                                                                            $category_name3 = explode('*', $category_name2);
                                                                            if ($category_name3[0] == $category->id) {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>><?php echo $category->category.'-'.$settings->currency.' '. $category->c_price; ?></option>
                                                                <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                            


                                        </div>


                                        <div class="col-md-4" style="border-left: 1px groove;
                                                border-right: 1px groove;">


                                            <div class="col-md-12 qfloww">

                                                <label class=" col-md-10 pull-left remove1"><?php echo lang('items') ?></label><label class="pull-right col-md-2 remove"><?php echo lang('qty') ?></label>


                                            </div>

                                        </div>



                                        <div class="col-md-3" >
                                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                                            <h5 class="font-size-16 mb-0">Invoice Summary <span class="float-end">#<?php
                if (!empty($payment->id)) {
                    echo $payment->id;
                } if (!empty($draft->id)) {
                    echo 'Draft-'.$draft->id;
                } else {
                    echo 'New';
                }
                ?></span></h5>
                                        </div>
                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('sub_total'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                                    if (!empty($payment->amount)) {
                                                        echo $payment->amount;
                                                    }elseif (!empty($draft->amount)) {
                                                        echo $draft->amount;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>


                                            <div class="col-md-12 payment right-six">
                                           
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('discount'); ?>  <?php
                                                        if ($discount_type == 'percentage') {
                                                            echo ' (%)';
                                                        }
                                                        ?> </label>
                                                </div>
                                                <div class="col-md-12 input-group m-bot15"> 
                                                    <input type="number" class="form-control pay_in percent_input" min="0" max="100" step="0.01" name="percent_discount" id="dis_id_percent" value='<?php
                                                    if (!empty($payment->percent_discount)) {
                                                        $percent_discount = explode('*', $payment->percent_discount);
                                                        echo $percent_discount[0];
                                                    }elseif (!empty($draft->percent_discount)) {
                                                        $percent_discount = explode('*', $draft->percent_discount);
                                                        echo $percent_discount[0];
                                                    }else{
                                                       echo $settings->discount_percent;
                                                    }
                                                    ?>' placeholder="">
                                                     <span class="input-group-text percent_amount" id="mailExtension">%
                                            </span>
                                            
                                            </span>
                                                    <input type="number" class="form-control pay_in percent_input" name="discount" id="dis_id" value='<?php
                                                    if (!empty($payment->discount)) {
                                                        $discount = explode('*', $payment->discount);
                                                        echo $discount[0];
                                                    }elseif (!empty($draft->discount)) {
                                                        $discount = explode('*', $draft->discount);
                                                        echo $discount[0];
                                                    }else{
                                                        echo'0';
                                                    }
                                                    ?>' placeholder="">
                                                    <span class="input-group-text percent_amount" id="mailExtension"><?php echo $settings->currency;?>
                                                </div>
                                                

                                            </div>
                                            
                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('vat'); ?> </label>
                                                </div>

                                                <div class="col-md-12 input-group"> 
                                                    <input type="number" class="form-control pay_in percent_input" min="0" max="100" step="0.01" name="vat" id="vat" value='<?php
                                                    if (!empty($payment->vat_amount_percent)) {
                                                        echo $payment->vat_amount_percent;
                                                    }elseif (!empty($draft->vat_amount_percent)) {
                                                        echo $draft->vat_amount_percent;
                                                    }else{
                                                       echo $settings->vat;
                                                    }
                                                    ?>' placeholder="">
                                                     <span class="input-group-text percent_amount" id="mailExtension">%
                                            </span>
                                            
                                            </span>
                                                    <input type="number" class="form-control pay_in percent_input" name="vat_amount" id="vat_amount" value='<?php
                                                    if (!empty($payment->vat)) {
                                                       echo $payment->vat;
                                                    }elseif (!empty($draft->vat)) {
                                                        echo $draft->vat;
                                                    }else{
                                                        echo '0';
                                                    }
                                                    ?>' placeholder="">
                                                    <span class="input-group-text percent_amount"><?php echo $settings->currency;?>
                                                   
                                                </div>
                                                <span style="font-style: italic;
                                                            font-weight: 400;
                                                            color: #F05;">
                                                        <?php echo $settings->vat;?> % Value Added Tax
                                                    </span>

                                            </div>
                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('gross_total'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                                    if (!empty($payment->gross_total)) {
                                                        echo $payment->gross_total;
                                                    }elseif (!empty($draft->gross_total)) {
                                                        echo $draft->gross_total;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>

                                           
                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('note'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                <textarea class="form-control" name="remarks" rows="20" cols="50" style="height: 12em !important;">  
                                                    <?php
                                                    if (!empty($payment->remarks)) {
                                                        echo $payment->remarks;
                                                    }elseif (!empty($draft->remarks)) {
                                                        echo $draft->remarks;
                                                    }
                                                    ?> </textarea>
                                                </div>

                                            </div>  

                                            <div class="col-md-12 payment right-six">

                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php
                                                        if (empty($payment)) {
                                                            echo lang('deposited_amount');
                                                        } else {
                                                            echo lang('deposit') . ' 1 <br>';
                                                            echo date('d/m/Y', $payment->date);
                                                        };
                                                        ?> </label>
                                                </div>

                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="amount_received" id="amount_received" value='<?php
                                                    if (!empty($payment->amount_received)) {
                                                        echo $payment->amount_received;
                                                    }
                                                    ?>' placeholder=" " <?php
                                                           if (!empty($payment->deposit_type)) {
                                                               if ($payment->deposit_type == 'Card') {
                                                                   echo 'readonly';
                                                               }
                                                           }
                                                           ?>>
                                                </div>

                                            </div>


                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('due'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                <input type="text" class="form-control pay_in" name="due" id="due" value='<?php
                                                    
                                                    if (!empty($payment)) {
                                                        $deposit=$this->finance_model->getDepositByInvoiceId($payment->id);
                                                        if(!empty($deposit)){
                                                            foreach($deposit as $depos){
                                                                $deposits[]=$depos->deposited_amount;
                                                            }
                                                            $depos_amount=array_sum($deposits);
                                                        }else{
                                                            $depos_amount=0;
                                                        }
                                                        echo $depos_amount;
                                                    }elseif (!empty($draft->gross_total)) {
                                                        if(!empty($draft->amount_received)){
                                                            echo ($draft->gross_total - $draft->amount_received);
                                                        }else{
                                                            echo $draft->gross_total;
                                                        }
                                                       
                                                    }else{
                                                        echo '0';
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div> 


                                            <?php if (empty($payment->id)) { ?>
                                                <div class="col-md-12 payment right-six">
                                                    <div class="payment_label"> 
                                                        <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>
                                                    </div>
                                                    <div class=""> 
                                                        <select class="form-control m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''> 
                                                            <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                                                <option value="Cash" > <?php echo lang('cash'); ?> </option>
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
                                                        <?php
                                                        } ?>
                                                        <?php if ($payment_gateway == 'PayPal') {
                                                            ?>
                                                            <div class="col-md-12 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                                                <input type="text"  id="cardholder" class="form-control pay_in" name="cardholder" value='' placeholder="">
                                                            </div>
                                                        <?php
                                                        } ?>
                                                        <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                                            <div class="col-md-12 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                                                <input type="text"  id="card" class="form-control pay_in" name="card_number" value='' placeholder="">
                                                            </div>

<div class="row">

                                                            <div class="col-md-8 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                                                <input type="text" class="form-control pay_in" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                                            </div>
                                                            <div class="col-md-4 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                                                <input type="text" class="form-control pay_in" id="cvv" maxlength="3" name="cvv" value='' placeholder="">
                                                            </div> 
</div>
                                                        </div>

                                                        <?php
                                                    }
                                                    ?>

                                                </div> 
                                            <?php } ?>

                                            <?php
                                            if (!empty($payment)) {
                                                $deposits = $this->finance_model->getDepositByPaymentId($payment->id);
                                                $i = 1;
                                                foreach ($deposits as $deposit) {
                                                    if (empty($deposit->amount_received_id)) {
                                                        $i = $i + 1; ?>
                                                        <div class="col-md-12 payment right-six">
                                                            <div class="payment_label"> 
                                                                <label for="exampleInputEmail1"><?php echo lang('deposit'); ?> <?php
                                                                    echo $i . '<br>';
                                                        echo date('d/m/Y', $deposit->date); ?> 
                                                                </label>
                                                            </div>
                                                            <div class=""> 
                                                                <input type="text" class="form-control pay_in" name="deposit_edit_amount[]" id="amount_received" value='<?php echo $deposit->deposited_amount; ?>' <?php
                                                                if ($deposit->deposit_type == 'Card') {
                                                                    echo 'readonly';
                                                                } ?>>
                                                                <input type="hidden" class="form-control pay_in" name="deposit_edit_id[]" id="amount_received" value='<?php echo $deposit->id; ?>' placeholder=" ">
                                                            </div>

                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <!-- <input type="hidden" name="id" id="id_pay" value='<?php
                                            if (!empty($payment->id)) {
                                                echo $payment->id;
                                            }
                                            ?>'>
                                            <input type="hidden" name="draft_id" id="draft_id" value='<?php
                                            if (!empty($draft->id)) {
                                                echo $draft->id;
                                            }
                                            ?>'> -->
                                            <div class="col-md-12 right-six pull-right">
                                            <div class="form-group cashsubmit payment  right-six col-md-12">
                                                <button type="submit" name="submit2" id="submit1" class="btn btn-info row pull-right"> <?php echo lang('submit'); ?></button>
                                            </div>
                                            <div class="form-group cardsubmit  right-six col-md-12 hidden">
                                                
                                                <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row pull-right" <?php if ($settings->payment_gateway == 'Stripe') {
                                                ?>onClick="stripePay(event);"<?php
                                            }
                                                ?>> <?php echo lang('submit'); ?></button>
                                            </div>
                                        </div>

                                        </div>
                                      
                                        </div>

                                        <!-- <div class="row">
                                        </div>
                                        <div class="form-group">
                                        </div> -->
                                    </form>
                                </div>

                           
                        </div>
                        </section>
                    </div>
                </div>
            </div>
            </div>
        </section>

    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->
<?php if (!empty($gateway->publish)) {
                                            $gateway_stripe= $gateway->publish;
                                        } else {
                                            $gateway_stripe='';
                                        } ?>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script type="text/javascript">var discount_type = "<?php echo $discount_type; ?>";</script>
<script type="text/javascript">var currency = "<?php echo $settings->currency; ?>";</script>
<script type="text/javascript">var publish = "<?php echo $gateway_stripe; ?>";</script>
<script src="common/js/moment.min.js"></script>
<script type="text/javascript">var payment_gateway = "<?php echo $settings->payment_gateway; ?>";</script>
<script type="text/javascript">var add_doctor = "<?php echo 'no'; ?>";</script>
<script src="common/extranal/js/finance/add_payment_view.js"></script>
