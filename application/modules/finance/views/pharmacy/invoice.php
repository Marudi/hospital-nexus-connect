<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Invoice</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Pharmacy</li>
                                        <li class="breadcrumb-item active">Invoice</li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- invoice start-->
         <link href="common/extranal/css/pharmacy/invoice.css" rel="stylesheet">
         <style>
                    @media print{
                        #main-content{
                            display:flex;
                            height: 40vh;
                            max-height:10% !important;
                            max-width:3.11in  !important;
                        }
                        .table-striped th{
                            font-size: 8px !important;
                        }
                        .table-striped td{
                            font-size: 8px !important;
                        }
                        h4{
                            font-size:10px !important;
                        }
                        .panel{
                            border:none !important;
                        }
                        #invoice{
                            background-color: white !important;
                        }
                    }
        </style>
        <section>
            <div class="row">
            <div class=" col-md-5">
            <div class="card panel-primary">
                
                <div  class="card-body panel-moree" id="invoice">
                    <div class="row invoice-list">

                        <div class="text-center corporate-id">
                            <h3>
                                <?php echo $settings->title ?>
                            </h3>
                            <h5>
                                <?php echo $settings->address ?>
                            </h5>
                            <h5>
                                Tel: <?php echo $settings->phone ?>
                            </h5>
                        </div>
<div class="row" style="padding-left: 6%;">
                        
                        <div class="col-lg-4 col-sm-4 details">
                            <h5> <?php echo lang('payment_to'); ?> :</h5>
                            <p>
                                <?php echo $settings->title; ?> <br>
                                <?php echo $settings->address; ?><br>
                                Tel:  <?php echo $settings->phone; ?>
                            </p>
                        </div>
                        
                        
                        <?php if (!empty($payment->patient)) { ?>
                            <div class="col-lg-4 col-sm-4 details">
                                <h5> <?php echo lang('bill_to'); ?> :</h5>
                                <p>
                                    <?php
                                    $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row();
                                    echo $patient_info->name . ' <br>';
                                    echo $patient_info->address . '  <br/>';
                                    P: echo $patient_info->phone
                                    ?>
                                </p>
                            </div>
                        <?php } ?>
                        <div class="col-lg-4 col-sm-4 details">
                            <h5> <?php echo lang('invoice_info'); ?> </h5>
                            <p>
                                 <?php echo lang('invoice_number'); ?> 		: <strong>00<?php echo $payment->id; ?></strong>
                                
                                </p>
                        </div>

                        <div class="col-lg-4 col-sm-4 details">
                            <h4> <?php echo lang('date'); ?> </h4>
                            <p>
                               <?php echo date('m/d/Y', $payment->date); ?>
                                </p>
                        </div>
</div>
                    </div>

                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> <?php echo lang('name'); ?> </th>
                                <th> <?php echo lang('company'); ?> </th>
                                <th> <?php echo lang('unit_price'); ?></th>
                                <th> <?php echo lang('quantity'); ?> </th>
                                <th> <?php echo lang('total_per_item'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($payment->x_ray)) { ?>
                                <tr>
                                    <td><?php echo $i = 1 ?></td>
                                    <td>X Ray</td>
                                    <td class=""><?php echo $settings->currency; ?> <?php echo $payment->x_ray; ?> </td>
                                </tr>
                            <?php } ?>
                            <?php
                            if (!empty($payment->category_name)) {
                                $category_name = $payment->category_name;
                                $category_name1 = explode(',', $category_name);
                                if (empty($payment->x_ray)) {
                                    $i = 0;
                                }
                                foreach ($category_name1 as $category_name2) {
                                    $category_name3 = explode('*', $category_name2);
                                    if ($category_name3[1] > 0) {
                                        ?>                
                                        <tr>
                                            <td><?php echo $i = $i + 1; ?></td>
                                            <td><?php
                                                $current_medicine = $this->db->get_where('medicine', array('id' => $category_name3[0]))->row();
                                                echo $current_medicine->name;
                                                ?>
                                            </td>
                                            <td class=""> <?php echo $current_medicine->company; ?> </td>
                                            <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                            <td class=""> <?php echo $category_name3[2]; ?> </td>
                                            <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1] * $category_name3[2]; ?> </td>
                                        </tr> 
                                        <?php
                                    }
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-12 invoice-block" style="padding-left: 61%;">
                            <ul class="unstyled amounts">
                                <li><strong> <?php echo lang('sub_total'); ?>   <?php echo lang('amount'); ?>  : </strong><?php echo $settings->currency; ?> <?php echo $payment->amount; ?></li>
                                <?php if (!empty($payment->discount)) { ?>
                                    <li><strong>Discount</strong> <?php
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
                                    <li><strong> <?php echo lang('vat'); ?>  :</strong>   <?php
                                        if (!empty($payment->vat)) {
                                            echo $payment->vat;
                                        } else {
                                            echo '0';
                                        }
                                        ?> % = <?php echo $settings->currency . ' ' . $payment->flat_vat; ?></li>
                                <?php } ?>
                                <li><strong> <?php echo lang('grand_total'); ?>  : </strong><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></li>
                                
                            </ul>
                        </div>
                    </div>




                </div>
                </div>
                </div>
                <style>
                    @media print{
                        .card{
                            box-shadow: 0 0px 0px !important;
                        }
                    }
                    </style>
                <div class="col-md-5 panel-moree no-print">

                    <div class="text-center invoice-btn clearfix">
                        <a class="btn btn-soft-info btn-sm editbutton pull-left" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>

                    <div class="text-center invoice-btn clearfix">
                        <a class="btn btn-soft-primary btn-sm detailsbutton pull-left download" id="download"><i class="fa fa-download"></i> <?php echo lang('download'); ?> </a>
                    </div>

                    <div class="text-center invoice-btn clearfix">
                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                            <a href="finance/pharmacy/editPayment?id=<?php echo $payment->id; ?>" class="btn btn-soft-success btn-sm pull-left"><i class="fa fa-edit"></i> <?php echo lang('edit_invoice'); ?> </a>
                        <?php } ?>
                    </div>
                  <div class="text-center invoice-btn no-print pull-left ">
                        <a href="finance/pharmacy/previousInvoice?id=<?php echo $payment->id ?>"class="btn btn-soft-info btn-sm green previousone1"><i class="fa fa-arrow-left"></i> Prev </a>
                        <a href="finance/pharmacy/nextInvoice?id=<?php echo $payment->id ?>"class="btn btn-soft-info btn-sm green nextone1 "><i class="fa fa-arrow-right"></i> Next </a>

                    </div>
                    


                </div>
           

            </div>
        </section>
        <!-- invoice end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="common/extranal/js/pharmacy/invoice.js"></script>