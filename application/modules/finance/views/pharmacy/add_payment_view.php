<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">   <?php
                if (!empty($payment->id))
                    echo  lang('edit_payment');
                else
                    echo lang('poss');
                ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Pharmacy</li>
                                        <li class="breadcrumb-item active">  <?php
                if (!empty($payment->id))
                    echo  lang('edit_payment');
                else
                    echo  lang('poss');
                ?> </li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
          <link href="common/extranal/css/pharmacy/add_payment_view.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                if (!empty($payment->id))
                    echo lang('pharmacy') . ' ' . lang('edit_payment');
                else
                    echo lang('pharmacy') . ' ' . lang('poss');
                ?> </h4> 
                                       
                                    </div>
          
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                       

                        <form role="form" class="clearfix pos form1"  id="editPaymentForm" action="finance/pharmacy/addPayment" method="post" enctype="multipart/form-data">
                        <div class="row">    
                        <div class="col-md-6">     
                                <?php if (!empty($payment->id)) { ?>
                                    <div class="col-md-8 payment pad_bot">
                                        <div class="col-md-3 payment_label"> 
                                            <label for="exampleInputEmail1">  <?php echo lang('invoice_id'); ?> :</label>
                                        </div>
                                        <div class="col-md-6">                                                   
                                            <?php echo '00' . $payment->id; ?>                                                                                                       
                                        </div>                                              
                                    </div>                                           
                                <?php } ?>
                                <div class="col-md-8 payment">
                                    <div class="form-group last">
                                        <div class="col-md-6 payment_label row"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('select_item'); ?></label>
                                        </div>
                                        <div class="col-md-9 row category_div">
                                            <?php if (empty($payment->id)) { ?>
                                                <select name="category_name[]" class="multi-select1" id="my_multi_select4" >

                                                </select>
                                            <?php } else { ?>
                                                <select name="category_name[]"  class="multi-select1"  multiple="multiple" id="my_multi_select4" >
                                                    <?php
                                                    if (!empty($payment)) {

                                                        $category_name = $payment->category_name;
                                                        $category_name1 = explode(',', $category_name);
                                                        foreach ($category_name1 as $category_name2) {
                                                            $category_name3 = explode('*', $category_name2);
                                                            $medicine = $this->medicine_model->getMedicineById($category_name3[0]);
                                                            ?>
                                                            <option value="<?php echo $medicine->id . '*' . (float) $medicine->s_price . '*' . $medicine->name . '*' . $medicine->company. '*' . $medicine->box; ?>" data-qtity="<?php echo $category_name3[2]; ?>" selected="selected">
                                                                <?php echo $medicine->name; ?>
                                                            </option>                

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            <?php } ?>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 qfloww" style="border-left: 1px groove;
    border-right: 1px groove;"><p class="title"><?php echo lang('selected_items'); ?></p></div>
                            <div class="col-md-4 right-six">
                            <div class="card-header bg-transparent border-bottom py-3 px-4">
                                            <h5 class="font-size-16 mb-0">Invoice Summary <span class="float-end">#<?php
                if (!empty($payment->id)) {
                    echo $payment->id;
                } else {
                    echo 'New';
                }
                ?></span></h5>
                                        </div>
                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('sub_total'); ?></label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                        if (!empty($payment->amount)) {

                                            echo $payment->amount;
                                        }
                                        ?>' placeholder=" " disabled>
                                    </div>

                                </div>
                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('discount'); ?><?php
                                            if ($discount_type == 'percentage') {
                                                echo ' (%)';
                                            }
                                            ?> </label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <input type="text" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                        if (!empty($payment->discount)) {
                                            $discount = explode('*', $payment->discount);
                                            echo $discount[0];
                                        }else{
                                            echo '0';
                                        }
                                        ?>' placeholder="Discount">
                                    </div>
                                </div>

                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('gross_total'); ?></label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                        if (!empty($payment->gross_total)) {

                                            echo $payment->gross_total;
                                        }
                                        ?>' placeholder=" " disabled>
                                    </div>

                                </div>


                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-12 row">
                                        <div class="col-md-6"> 
                                        </div> 
                                         
                                        <div class="col-md-6" style="padding-left: 2%;"> 
                                            <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                                        </div>
                                       
                                    </div>
                                </div>
                              

                                <input type="hidden" name="id" value='<?php
                                if (!empty($payment->id)) {
                                    echo $payment->id;
                                }
                                ?>'>
                               
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var discount_type = "<?php echo $discount_type; ?>";</script>
<script type="text/javascript">var medicine = "<?php echo lang('medicine'); ?>";</script>
<script src="common/extranal/js/pharmacy/add_payment_view.js"></script>
