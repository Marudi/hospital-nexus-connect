<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('today_net_cash'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Pharmacy</li>
                                        <li class="breadcrumb-item active"><?php echo lang('today_net_cash'); ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('pharmacy'); ?> <?php echo lang('today_net_cash'); ?></h4> 
                                      
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?> </th>
                                <th> <?php echo lang('amount'); ?> </th>

                            </tr>
                        </thead>
                        <tbody>
                        


                        <tr class="">
                            <td> <?php echo lang('today_sales'); ?> </td>
                            <td>  <?php echo $settings->currency; ?>  <?php
                                if (!empty($today_sales_amount)) {
                                    echo number_format($today_sales_amount, 2, '.', ',');
                                } else {
                                    echo $today_sales_amount = 0;
                                }
                                ?> 
                            </td>

                        </tr>

                        <tr class="">
                            <td> <?php echo lang('today_expense'); ?> </td>
                            <td>  <?php echo $settings->currency; ?>  <?php
                                if (!empty($today_expenses_amount)) {
                                    echo number_format($today_expenses_amount, 2, '.', ',');
                                } else {
                                    echo $today_expenses_amount = 0;
                                }
                                ?> 
                            </td>


                        </tr>

                        <tr class="total">
                            <td> <?php echo lang('today_net_cash'); ?> </td>
                            <td> <strong> <?php echo $settings->currency; ?> <?php echo number_format($today_sales_amount - $today_expenses_amount, 2, '.', ','); ?></strong> </td>

                        </tr>



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
<script src="common/js/codearistos.min.js"></script>

<script src="common/extranal/js/finance/today_net_cash.js"></script>