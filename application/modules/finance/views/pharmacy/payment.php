<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"> <?php echo lang('payments'); ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Pharmacy</li>
                                        <li class="breadcrumb-item active"> <?php echo lang('payments'); ?>  </li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/pharmacy/payment.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('pharmacy'); ?> <?php echo lang('all_sales'); ?> </h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <a  href="finance/pharmacy/addPaymentView" class="btn btn-primary waves-effect waves-light w-xs"><i class="fa fa-plus-circle"></i> <?php echo lang('add_payment'); ?></a>
                                           
                                        </div>
                                    </div>
            

          


            <div class="card-body">
                <div class="adv-table editable-table">
                <table class="table mb-0" id="editable-sample1">
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


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/pharmacy/payment.js"></script>