<!--main content start-->
<?php if ($redirect == 'download') { ?>
    <!DOCTYPE html>
    <html lang="en" <?php if ($this->db->get('settings')->row()->language == 'arabic') { ?> dir="rtl" <?php } ?>>
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">

        <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Ubuntu&display=swap');
        </style>
        <link href="common/assets/DataTables/datatables.css" rel="stylesheet" />
        <link href="common/extranal/css/finance/downloadInvoice.css" rel="stylesheet" />

    <?php } ?>
    <link href="common/extranal/css/finance/invoice-all.css" rel="stylesheet" />
    <?php if ($redirect != 'download') { ?>
        <link href="common/extranal/css/finance/invoice_logical.css" rel="stylesheet" />
        <section id="main-content">
            <section class="wrapper site-min-height">
            <?php } ?>
            <!-- invoice start-->
            <?php if ($redirect != 'download') { ?>
                <section class="col-md-8">
                <?php } else { ?>
                    <section class="col-md-12">
                    <?php } ?>
                    <div class="panel panel-primary" id="invoice">

                        <div class="panel-body invoice-all">
                            <div class="row invoice-list">

                            <div class="col-md-12 invoice_head clearfix logotitle">
                               <div class="col-md-6">
                                <div class="col-md-3 invoice_head_right">
                                        <img class="img_class_logo" alt="" src="<?php echo $this->settings_model->getSettings()->logo; ?>" width="100">
                                        <strong><?php echo lang('invoice');?></strong>
                                        <?php echo $payment->id;?>
                                </div>
                                    <div class="col-md-9 text-left invoice_head_left" style="margin-top: 11px;">
                                        <h4 style="font-weight: 900 !important;">
                                            <?php echo $settings->title ?>
                                        </h4>
                                        <h6>
                                            <?php echo $settings->address ?>
                                        </h6>
                                        <h5>
                                            Phone: <?php echo $settings->phone ?>
                                        </h5>
                                    </div>
                               </div> 
                               


                                </div>
                                <?php if ($redirect != 'download') { ?>
                                    <div class="col-md-12 hr_border">
                                        <hr>
                                    </div>
                                    <div class="col-md-12 title" >
                                        <h4 class="text-center invoice_lang">
                                            <?php echo lang('payment') ?> <?php echo lang('invoice') ?>
                                        </h4>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-12 title" >
                                        <h4 class="text-center invoice_lang">
                                            <?php echo lang('payment') ?> <?php echo lang('invoice') ?>
                                        </h4>
                                    </div>
                                <?php } ?>

                                <?php if ($redirect != 'download') { ?>                  

                                    <div class="col-md-12 hr_border">
                                        <hr>
                                    </div>
                                <?php } ?>
                                <?php if ($redirect == 'download') { ?>  
                                    <div class="col-md-12 invoice-box">
                                        <table cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td colspan="2">
                                                    <table>
                                                        <tr>
                                                            <td> 
                                                                <div class="paragraphprint">
                                                                    <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>
                                                                    <label class="control-label"><?php echo lang('patient'); ?> <?php echo lang('name'); ?> </label>
                                                                    <span class="info_text"> : 
                                                                        <?php
                                                                        if (!empty($patient_info)) {
                                                                            echo $patient_info->name . ' <br>';
                                                                        }
                                                                        ?>
                                                                    </span>  
                                                                </div>
                                                                <div class="paragraphprint">
                                                                    <label class="control-label"><?php echo lang('patient_id'); ?>  </label>
                                                                    <span class="info_text"> : 
                                                                        <?php
                                                                        if (!empty($patient_info)) {
                                                                            echo $patient_info->id . ' <br>';
                                                                        }
                                                                        ?>
                                                                    </span></div>
                                                                <div class="paragraphprint"><label class="control-label"> <?php echo lang('address'); ?> </label>
                                                                    <span class="info_text"> : 
                                                                        <?php
                                                                        if (!empty($patient_info)) {
                                                                            echo $patient_info->address . ' <br>';
                                                                        }
                                                                        ?>
                                                                    </span></div>
                                                                <div class="paragraphprint">
                                                                    <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                                                    <span class="info_text"> : 
                                                                        <?php
                                                                        if (!empty($patient_info)) {
                                                                            echo $patient_info->phone . ' <br>';
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                                
                                                                <div class="paragraphprint">
                                                                    <label class="control-label"><?php echo lang('age'); ?>  </label>
                                                                    <span class="info_text"> : 
                                                                        <?php
                                                                        if (!empty($patient_info)) {
                                                                            $age = explode('-', $patient_info->age);
                                                                            echo $age[0] . ' ' . lang('years').' <br>';
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                                
                                                                
                                                            </td>

                                                            <td>
                                                                <div class="paragraphprint">

                                                                    <label class="control-label"><?php echo lang('invoice'); ?>  </label>
                                                                    <span class="info_text"> : 
                                                                        <?php
                                                                        if (!empty($payment->id)) {
                                                                            echo $payment->id;
                                                                        }
                                                                        ?>
                                                                    </span>

                                                                </div>
                                                                <div class="paragraphprint">

                                                                    <label class="control-label"><?php echo lang('date'); ?>  </label>
                                                                    <span class="info_text"> : 
                                                                        <?php
                                                                        if (!empty($payment->date)) {
                                                                            echo date('d-m-Y H:i', $payment->date) . ' <br>';
                                                                        }
                                                                        ?>
                                                                    </span>

                                                                </div>
                                                                <div class="paragraphprint">

                                                                    <label class="control-label"><?php echo lang('doctor'); ?>  </label>
                                                                    <span class="info_text"> : 
                                                                        <?php
                                                                        if (!empty($payment->doctor)) {
                                                                            $doc_details = $this->doctor_model->getDoctorById($payment->doctor);
                                                                            if (!empty($doc_details)) {
                                                                                echo $doc_details->name . ' <br>';
                                                                            } else {
                                                                                echo $payment->doctor_name . ' <br>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                                <!-- <div class="paragraphprint">

                                                                    <label class="control-label"><?php echo lang('report_delivery_time'); ?>  </label>
                                                                    <span class="info_text"> : 
                                                                        <?php
                                                                       
                                                                        if (!empty($payment)) {
                                                                            $date = new DateTime($payment->date_delivery.' '. $payment->time_delivery);

                                                                            //Print out the 12 hour time using the format method.
                                                                            $time = $date->format('h:ia') ;
                                                                            echo $payment->date_delivery.'-'.$time;
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                    </div> -->
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="col-md-6 pull-left row info_position">
                                            <div class="col-md-12 row details">
                                                <p>
                                                    <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row();?>
                                                    <label class="control-label"><?php echo lang('patient'); ?> <?php echo lang('name'); ?> </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($patient_info)) {
                                                            echo $patient_info->name . ' <br>';
                                                        }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-md-12 row details" >
                                                <p>
                                                    <label class="control-label"><?php echo lang('patient_id'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($patient_info)) {
                                                            echo $patient_info->id . ' <br>';
                                                        }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-md-12 row details">
                                                <p>
                                                    <label class="control-label"> <?php echo lang('address'); ?> </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($patient_info)) {
                                                            echo $patient_info->address . ' <br>';
                                                        }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-md-12 row details">
                                                <p>
                                                    <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($patient_info)) {
                                                            echo $patient_info->phone . ' <br>';
                                                        }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>
                                            
                                            <div class="col-md-12 row details">
                                                <p>
                                                    <label class="control-label"><?php echo lang('age'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($patient_info)) {
                                                            $age = explode('-', $patient_info->age);
                                                            echo $age[0] . ' ' . lang('years').' <br>';
                                                        }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>


                                        </div>

                                        <div class="col-md-6 pull-right info_position">

                                            <div class="col-md-12 row details">
                                                <p>
                                                    <label class="control-label"><?php echo lang('invoice'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($payment->id)) {
                                                            echo $payment->id;
                                                        }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>


                                            <div class="col-md-12 row details">
                                                <p>
                                                    <label class="control-label"><?php echo lang('date'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($payment->date)) {
                                                            echo date('d-m-Y H:i', $payment->date) . ' <br>';
                                                        }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>

                                            <div class="col-md-12 row details">
                                                <p>
                                                    <label class="control-label"><?php echo lang('doctor'); ?>  </label>
                                                    <span class="info_text"> : 
                                                        <?php
                                                        if (!empty($payment->doctor)) {
                                                            $doc_details = $this->doctor_model->getDoctorById($payment->doctor);
                                                            if (!empty($doc_details)) {
                                                                echo $doc_details->name . ' <br>';
                                                            } else {
                                                                echo $payment->doctor_name . ' <br>';
                                                            }
                                                        }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <!-- <div class="col-md-12 row details">
                                                <p>
                                                    <label class="control-label"><?php echo lang('report_delivery'); ?>  </label>
                                                    <span class="info_text"> : 
                                                    <?php
                                                                       
                                                                       if (!empty($payment)) {
                                                                           $date = new DateTime($payment->date_delivery.' '. $payment->time_delivery);

                                                                           //Print out the 12 hour time using the format method.
                                                                           $time = $date->format('h:ia') ;
                                                                           echo $payment->date_delivery.'-'.$time;
                                                                       }
                                                                       ?>
                                                    </span>
                                                </p>
                                            </div> -->
                                           


                                        </div>

                                    </div>






                                </div> 
                            <?php }  ?>

                               
                            <?php if ($redirect != 'download') { ?>
                                <table class="table table-striped table-hover detailssale" style="border: 1px solid #4f4d4d1c !important;">
                                <?php } else { ?>
                                    <table class="table table-striped table-hover detailssale" id="customers" style="border: 1px solid #4f4d4d1c !important;"> 
                                    <?php } ?>          
                                    <thead class="theadd">
                                    <tr>
                                    <?php if ($payment->payment_from == 'admitted_patient_bed_service') { ?>
                                            <th>#</th>
                                            <th><?php echo lang('service'); ?> <?php echo lang('name'); ?></th>
                                            <th><?php echo lang('unit'); ?> <?php echo lang('price') ?></th>
                                            <th><?php echo lang('quantity'); ?></th>
                                            <th><?php echo lang('amount'); ?></th>
                                       <?php } elseif ($payment->payment_from == 'admitted_patient_bed_medicine' ) { ?>
                                            <th>#</th>
                                            <th><?php echo lang('medicine'); ?> <?php echo lang('name'); ?></th>
                                            <th><?php echo lang('unit'); ?> <?php echo lang('price') ?></th>
                                            <th><?php echo lang('quantity'); ?></th>
                                            <th><?php echo lang('amount'); ?></th>
                                        <?php }   elseif ($payment->payment_from == 'payment' ) { ?>
                                            <th>#</th>
                                            
                                            <th><?php echo lang('description'); ?></th>
                                            <th><?php echo lang('service_point'); ?></th>
                                            <th><?php echo lang('unit_price'); ?></th>
                                            <th><?php echo lang('qty'); ?></th>
                                            <th><?php echo lang('amount'); ?></th>
                                        <?php }  else { ?>
                                            <th>#</th>
                                            <th><?php echo lang('code'); ?></th>
                                            <th><?php echo lang('description'); ?></th>
                                            
                                            <th><?php echo lang('unit_price'); ?></th>
                                            <th><?php echo lang('qty'); ?></th>
                                            <th><?php echo lang('amount'); ?></th>
                                        <?php } ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                         if ($payment->payment_from == 'admitted_patient_bed_medicine') {
                                            if (!empty($payment->category_name)) {
                                                // $case_setails = $this->db->get_where('medical_history', array('id' => $payment->case_id))->row();
                                                $category = explode('#', $payment->category_name);
                                                //  print_r($category);
                                                //die();
                                                $i = 0;
                                                foreach ($category as $cat) {
                                                    $i = $i + 1;
                                                    $cat_new = array();
                                                    $cat_new = explode('*', $cat);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?> </td>
                                                        <td><?php echo $cat_new[1]; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $cat_new[2]; ?> </td>
                                                        <td class=""> <?php echo $cat_new[3]; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $cat_new[4]; ?> </td>
                                                    </tr> 
                                                    <?php
                                                }
                                            }
                                        } elseif ($payment->payment_from == 'admitted_patient_bed_service') {
                                            if (!empty($payment->category_name)) {
                                                // $case_setails = $this->db->get_where('medical_history', array('id' => $payment->case_id))->row();
                                                $category = explode('#', $payment->category_name);
                                                //  print_r($category);
                                                //die();
                                                $i = 0;
                                                foreach ($category as $cat) {
                                                    $i = $i + 1;
                                                    $cat_new = array();
                                                    $cat_new = explode('*', $cat);
                                                    $service = $this->db->get_where('pservice', array('id' => $cat_new[0]))->row();
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?> </td>
                                                        <td>  <?php echo $service->name; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $cat_new[1]; ?> </td>
                                                        <td class=""> <?php echo '1'; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $cat_new[1]; ?> </td>
                                                    </tr> 
                                                    <?php
                                                }
                                            }
                                        } else{
                                        if (!empty($payment->category_name)) {
                                            $category_name = $payment->category_name;
                                            $category_name1 = explode(',', $category_name);
                                            $i = 0;
                                            // $length = count($category_name1);

                                            foreach ($category_name1 as $category_name2) {
                                                $i = $i + 1;
                                                $category_name3 = explode('*', $category_name2);
                                                //$count=count+1;
                                                if ($category_name3[3] > 0) {
                                                    ?>  

                                                    <tr>
                                                        <td><?php echo $i; ?> </td>
                                                       
                                                        <td><?php echo $this->finance_model->getPaymentcategoryById($category_name3[0])->category; ?> </td>
                                                        <td><?php echo $this->finance_model->getPaymentcategoryById($category_name3[0])->description; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                                        <td class=""> <?php echo $category_name3[3]; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1] * $category_name3[3]; ?> </td>
                                                    </tr> 
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                        ?>

                                    </tbody>




                                </table>
                                <?php if ($redirect == 'download') { ?>
<!--                                    <div class="">
                                        <div class="col-lg-4 pull-left">
                                            <?php if($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id) == 0) { ?>
                                            <h4 style="font-weight: bold;"><?php echo lang("paid"); ?></h4>
                                            <?php } else { ?>
                                                <h4 style="font-weight: bold;">Due Have</h4>
                                            <?php } ?>
                                            
                                        </div>
                                    </div>-->
                                   <!-- <table style="width:30%; padding-top:200px !important;">
                                       <tr>
                                           <td style=" border: 3px solid black; padding: 10px; text-align: center; border-radius: 5px;">
                                           <div class="" >
                                        <div class=" pull-left">

                                            <?php if($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id) == 0) { ?>
                                            <h4 style="font-weight: bold;"><?php echo lang("paid"); ?></h4>
                                            <?php } else { ?>
                                                <h4 style="font-weight: bold;">Due Have</h4>
                                            <?php } ?>
                                            

                                            
                                        </div>
                                    </div>
                                           </td>
                                           <td></td>
                                           <td></td>
                                       </tr>
                                   </table> -->
                                    <table style="width:90%;">
                                        <tr class="lasttr">
                                            <td class="test1" style=" border: 3px solid black; padding: 10px; text-align: center; border-radius: 5px;" >
                                            <div class="" >
                                        <div class=" pull-left">

                                            <?php if($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id) == 0) { ?>
                                            <h4 style="font-weight: bold;"><?php echo lang("paid"); ?></h4>
                                            <?php } else { ?>
                                                <h4 style="font-weight: bold;"><?php echo lang("due_have"); ?></h4>
                                            <?php } ?>
                                            
                                           
                                            
                                        </div>
                                        
                                    </div>
                                        </td>
                                          
                                            <td class="test2"><div class="pull-left">
                                        </td>
                                            <td class="test3"></td>
                                            <td class="test4"><li><strong><?php echo lang('sub_total'); ?> : </li></td>
                                        <td class="test5"></strong><?php echo $settings->currency; ?> <?php echo $payment->amount; ?></td> 
                                        </tr>
                                        <?php if (!empty($payment->discount)) { ?>
                                            <?php
                                            $type = "";
                                            $dis = "";
                                            if ($discount_type == 'percentage') {
                                                $type = '(%) : ';
                                            } else {
                                                $type = ': ';
                                            }
                                            ?> <?php
                                            $discount = explode('*', $payment->discount);
                                            if (!empty($discount[1])) {
                                                $dis = $discount[0] . ' %  =  ' . $settings->currency . ' ' . $discount[1];
                                            } else {
                                                $dis = $discount[0];
                                            }
                                            ?></li>
                                            <tr class="lasttr">
                                            <td class="test1" ></td>
                                                <td  class="test2"></td>
                                                <td  class="test3"></td>
                                                <td class="test4"><li><strong><?php echo lang('discount'); ?>  (<?php echo $payment->percent_discount;?>%) <?php echo $type; ?></strong></li></td>
                                            <td class="test5"></strong><?php echo $settings->currency . " " . $dis; ?></td> 
                                            </tr>
                                        <?php } ?>
                                        <?php if (!empty($payment->vat)) { ?>
                                            <?php
                                            if (!empty($payment->vat)) {
                                                $vat = $payment->vat;
                                            } else {
                                                $vat = '0';
                                            }
                                            ?> 
                                            <tr class="lasttr">
                                            <td class="test1" ><div class="pull-left"><u><?php echo lang('report_delivery_time'); ?></u>
                                        <?php
                                                                       
                                                                       if (!empty($payment)) {
                                                                           $date = new DateTime($payment->date_delivery.' '. $payment->time_delivery);

                                                                           //Print out the 12 hour time using the format method.
                                                                           $time = $date->format('h:ia') ;
                                                                           echo $payment->date_delivery.'-'.$time;
                                                                       }
                                                                       ?>
                                            </div></td>
                                                <td  class="test2"></td>
                                                <td  class="test3"></td>
                                                <td class="test4"><li><strong>VAT(<?php echo  $payment->vat_amount_percent; ?>%) :</strong></strong></li></td>
                                            <td class="test5"></strong><?php echo $settings->currency ?> <?php echo $vat; ?>  </td> 
                                        <?php } ?>
                                        <tr class="lasttr">
                                        <td class="test1" ></td>
                                            <td  class="test2"></td>
                                            <td  class="test3"></td>
                                            <td class="test4"><li><strong><?php echo lang('grand_total'); ?> : </strong></li></td>
                                        <td class="test5"></strong><?php echo $settings->currency; ?> <?php echo $g = $payment->gross_total; ?></td> 
                                        </tr>
                                        <tr class="lasttr">
                                        <td class="test1" ></td>
                                            <td  class="test2"></td>
                                            <td  class="test2"></td>
                                            <td class="test6"><li><strong><?php echo lang('amount_received'); ?> : </strong></li></td>
                                        <td class="test7"></strong><?php echo $settings->currency; ?> <?php echo $r = $this->finance_model->getDepositAmountByPaymentId($payment->id); ?></td> 
                                        </tr>
                                        <tr class="lasttr">
                                        <td class="test1" ></td>
                                            <td  class="test2"></td>
                                            <td  class="test2"></td>
                                            <td class="test6"><li><strong><?php echo lang('amount_to_be_paid'); ?> : </strong></li></td>
                                        <td class="test7"></strong><?php echo $settings->currency; ?> <?php echo $g - $r; ?></td> 
                                        </tr>
                                    </table>
                                    <?php  $deposited_amount_payment=$this->finance_model->getDepositByInvoiceId($payment->id); 
                                    if(count($deposited_amount_payment)>1){
                                    ?>
                                    <div class="col-md-12 ">
                                    <?php if ($redirect != 'download') { ?>
                                <table class="table table-striped table-hover detailssale" style="border: 1px solid #4f4d4d1c !important;">
                                <?php } else { ?>
                                    <table class="table table-striped table-hover detailssale" id="customers" style="border: 1px solid #4f4d4d1c !important;"> 
                                    <?php } ?>   
                                        <tr>
                                          <td colspan="3"><?php echo lang('payment_history');?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo lang('date');?></th>
                                            
                                            <th><?php echo lang('amount');?></th>
                                            <th><?php echo lang('payment_method');?></th>
                                        </tr>
                                        <?php foreach($deposited_amount_payment as $deposited){ ?>
                                        <tr>
                                            <td>
                                               <?php  echo date('d-m-y',$deposited->date); ?> 
                                            </td>
                                           
                                            <td>
                                               <?php  echo $settings->currency .' '. $deposited->deposited_amount; ?> 
                                            </td>
                                            <td>
                                               <?php if($deposited->deposit_type=='Cash'){
                                                   echo 'Cash';
                                               }else{
                                                   echo $deposited->gateway;
                                               } ?> 
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                    </div>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($redirect != 'download') { ?>
                                    <div class="col-md-12 hr_border">
                                        <hr>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class=" pull-left" style="border: 3px solid;
    border-radius: 5px;
    text-align: center;">
                                            <?php if($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id) == 0) { ?>
                                            <h4 style="font-weight: bold;"><?php echo lang("paid"); ?></h4>
                                            <?php } else { ?>
                                                <h4 style="font-weight: bold;"><?php echo lang("due_have"); ?></h4>
                                            <?php } ?>
                                            
                                        </div>
                                        <div class="pull-left" style="    margin-top: 12px;
    font-weight: 700;">
                                            <u><?php echo lang('report_delivery_time'); ?></u><br>
                                        <?php
                                                                       
                                                                       if (!empty($payment)) {
                                                                           $date = new DateTime($payment->date_delivery.' '. $payment->time_delivery);

                                                                           //Print out the 12 hour time using the format method.
                                                                           $time = $date->format('h:ia') ;
                                                                           echo $payment->date_delivery.'-'.$time;
                                                                       }
                                                                       ?>
                                            </div>
                                    </div>
                                   
                                    <div class="">
                                      
                                        <div class="col-lg-4 invoice-block pull-right">
                                            <ul class="unstyled amounts">
                                                <li><strong><?php echo lang('sub_total'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $payment->amount; ?></li>
                                                <?php if (!empty($payment->discount)) { ?>
                                                    <li><strong><?php echo lang('discount'); ?>(<?php echo  $payment->percent_discount; ?>%)</strong> <?php
                                                        if ($discount_type == 'percentage') {
                                                            echo '(%) : ';
                                                        } else {
                                                            echo ': ' . $settings->currency;
                                                        }
                                                        ?> <?php
                                                        $discount = explode('*', $payment->discount);
                                                        if (!empty($discount[1])) {
                                                            echo $discount[0] . ' %  =  ' . $settings->currency . ' ' . $discount[1];
                                                        } else {
                                                            echo $discount[0];
                                                        }
                                                        ?></li>
                                                    <?php } ?>
                                                    <?php if (!empty($payment->vat)) { ?>
                                                    <li><strong>VAT(<?php echo  $payment->vat_amount_percent; ?>%): </strong> <?php echo $settings->currency ?>  <?php
                                                        if (!empty($payment->vat)) {
                                                            echo $payment->vat;
                                                        } else {
                                                            echo '0';
                                                        }
                                                        ?> </li>
                                                <?php } ?>
                                                <li><strong><?php echo lang('grand_total'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $g = $payment->gross_total; ?></li>
                                                <li><strong><?php echo lang('amount_received'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $r = $this->finance_model->getDepositAmountByPaymentId($payment->id); ?></li>
                                                <li><strong><?php echo lang('amount_to_be_paid'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $g - $r; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php  $deposited_amount_payment=$this->finance_model->getDepositByInvoiceId($payment->id); 
                                    if(count($deposited_amount_payment)>1){
                                    ?>
                                    <div class="col-md-12 ">
                                    <?php if ($redirect != 'download') { ?>
                                <table class="table table-striped table-hover detailssale" style="border: 1px solid #4f4d4d1c !important;">
                                <?php } else { ?>
                                    <table class="table table-striped table-hover detailssale" id="customers" style="border: 1px solid #4f4d4d1c !important;"> 
                                    <?php } ?>   
                                        <tr>
                                          <td colspan="3"><?php echo lang('payment_history');?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo lang('date');?></th>
                                         
                                            <th><?php echo lang('amount');?></th>
                                            <th><?php echo lang('payment_method');?></th>
                                        </tr>
                                        <?php foreach($deposited_amount_payment as $deposited){ ?>
                                        <tr>
                                            <td>
                                               <?php  echo date('d-m-y',$deposited->date); ?> 
                                            </td>
                                          
                                            <td>
                                               <?php  echo $settings->currency .' '. $deposited->deposited_amount; ?> 
                                            </td>
                                            <td>
                                               <?php if($deposited->deposit_type=='Cash'){
                                                   echo 'Cash';
                                               }else{
                                                   echo $deposited->gateway;
                                               } ?> 
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                    </div>
                                    <?php } ?>
<!--                                    <div class="col-md-12 hr_border">
                                        <hr>
                                    </div>-->

                                    <div class="col-md-12 invoice_footer">
                                        <div class="col-md-4 row pull-left">
                                            <?php echo lang('user'); ?> : <?php echo $this->ion_auth->user($payment->user)->row()->username; ?>
                                            <div class="col-md-4 row pull-right">
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                        </div>
                </section>

                <?php if ($redirect != 'download') { ?>
                    <section class="col-md-4">
                        <div class="col-md-5 no-print option_button">
                        <?php if ($payment->payment_from == 'payment' || empty($payment->payment_from)) { ?>
                            <a href="finance/payment" class="btn btn-info btn-sm info pull-left"><i class="fa fa-arrow-circle-left"></i>  <?php echo lang('back_to_payment_modules'); ?> </a>
                         <?php } ?>
                            <div class="text-center col-md-12 row">
                                <a class="btn btn-info btn-sm invoice_button pull-left" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
                                    
                                    ?>
                                    <?php if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                                        $lab_pending=array();
                                         $lab_reports_previous=$this->lab_model->getLabByInvoice($payment->id);

                                         if(!empty($lab_reports_previous)){
                                             foreach($lab_reports_previous as $lab){
                                                 if($lab->test_status == 'not_done' || empty($lab->test_status)){
                                                     $lab_pending[]='no';
                                                 }
                                             }
                                         }
                                         if(count($lab_reports_previous)==count($lab_pending) || empty($lab_reports_previous)){
                                        ?>
                                    <a href="finance/editPayment?id=<?php echo $payment->id; ?>" class="btn btn-info btn-sm editbutton pull-left"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> <?php echo lang('invoice'); ?> </a>
                                  <?php } } ?>
                                    <a href="finance/download?id=<?php echo $payment->id; ?>" class="btn btn-info btn-sm detailsbutton pull-left download"><i class="fa fa-download"></i> <?php echo lang('download'); ?>  </a>
                                <?php } ?>


                            </div>
                           
                            <div class="no-print">
                            <?php 
                             
                            if ($payment->payment_from == 'payment' || empty($payment->payment_from)) { 
                               
                                
                                ?>
                                <a href="finance/addPaymentView" class="pull-left">
                                    <div class="btn-group">
                                        <button id="" class="btn btn-info green btn-sm">
                                            <i class="fa fa-plus-circle"></i> <?php echo lang('add_another_payment'); ?>
                                        </button>
                                    </div>
                                </a>
                                <?php } ?>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <a href="finance/sendInvoice?id=<?php echo $payment->id; ?>" class="btn  btn-sm pull-left send"> <i class="fa fa-paper-plane"></i> <?php echo lang('send_invoice'); ?>  </a>
                                <?php } ?>
                            </div>

                            <div class="panel_button">

                                <div class="text-center invoice-btn no-print pull-left ">
                                    <a href="finance/previousInvoice?id=<?php echo $payment->id ?>"class="btn btn-info btn-sm green previousone1"><i class="glyphicon glyphicon-chevron-left"></i> </a>
                                    <a href="finance/nextInvoice?id=<?php echo $payment->id ?>"class="btn btn-info btn-sm green nextone1 "><i class="glyphicon glyphicon-chevron-right"></i> </a>

                                </div>

                            </div>

                        </div>

                    </section>
                <?php } ?>


                <link rel="stylesheet" href="common/extranal/css/finance/invoiceAll.css"/>



                <script src="common/js/codearistos.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
            </section>
            <?php if ($redirect == 'download') { ?>
                </html>
            <?php } ?>
            <!-- invoice end-->
            <?php if ($redirect != 'download') { ?>
            </section>
        </section>
 <link href="common/extranal/css/finance/print.css" rel="stylesheet" />
        <script src="common/js/codearistos.min.js"></script>
        <script src="common/js/bootstrap.min.js"></script>
        <script  type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script>
    <?php } ?>
    <script src="common/extranal/js/finance/invoice.js"></script>


    <?php if ($redirectlink == 'print') { ?>
        <script src="common/extranal/js/finance/printInvoice.js"></script>
    <?php } ?>