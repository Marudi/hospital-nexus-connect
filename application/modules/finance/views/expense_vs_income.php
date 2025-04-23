<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Net Income</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active">Net Income </li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!--state overview start-->
        <link href="common/extranal/css/finance/daily.css" rel="stylesheet">
        <style>
            .col-md-6{
                margin-top: 1%;
                margin-bottom: 1%;
            }
            table th{
                background-color: #3980C0 !important;
                color: #fff;
            }
        </style>
        <div class="col-md-12">
            <div class="row state-overview ">
                <div class="card">
                <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> <?php echo lang('hospital') . ' ' . lang('expense_vs_income'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <a class="no-print pull-right" onclick="javascript:window.print();"> <i class="fa fa-print"></i> </a>
                                           
                                        </div>
                                    </div>
                    <!-- <div class="panel-heading">
                        <?php echo lang('hospital') . ' ' . lang('expense_vs_income'); ?>
                        <div class="col-md-1 pull-right no-print">
                            <a class="no-print pull-right" onclick="javascript:window.print();"> <i class="fa fa-print"></i> </a>
                        </div>
                    </div> -->
                <!-- </div> -->
                    <div id="chart_div"></div>
                    <div class="">
                        <div class="adv-table editable-table ">
                           <div class="row">
                            <section class="col-md-6">
                            <table class="table mb-0" id="editable-sample1">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><?php echo lang('last_30_days'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <?php echo lang('income'); ?> </td>
                                            <td> <?php echo $this->currency; ?><?php echo number_format($this_last_30_total_income, 2, '.', ','); ?> </td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo lang('expense'); ?> </td>
                                            <td><?php echo $this->currency; ?><?php echo number_format($this_last_30_total_expense, 2, '.', ','); ?></td>
                                        </tr>
                                        <tr class="total_amount">
                                            <td><?php echo lang('net_profit'); ?></td>
                                            <td><?php echo $this->currency; ?><?php echo number_format(($this_last_30_total_income - $this_last_30_total_expense), 2, '.', ','); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                            <section class="col-md-6">
                            <table class="table mb-0" id="editable-sample1">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><?php echo lang('total'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <?php echo lang('income'); ?> </td>
                                            <td> <?php echo $this->currency; ?><?php echo number_format($total_income, 2, '.', ','); ?> </td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo lang('expense'); ?> </td>
                                            <td><?php echo $this->currency; ?><?php echo number_format($total_expense, 2, '.', ','); ?></td>
                                        </tr>
                                        <tr class="total_amount">
                                            <td><?php echo lang('net_profit'); ?></td>
                                            <td><?php echo $this->currency; ?><?php echo number_format(($total_income - $total_expense), 2, '.', ','); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                            <section class="col-md-6">
                            <table class="table mb-0" id="editable-sample1">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><?php echo lang('this_month'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <?php echo lang('income'); ?> </td>
                                            <td> <?php echo $this->currency; ?><?php echo number_format($this_month_total_income, 2, '.', ','); ?> </td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo lang('expense'); ?> </td>
                                            <td><?php echo $this->currency; ?><?php echo number_format($this_month_total_expense, 2, '.', ','); ?></td>
                                        </tr>
                                        <tr class="total_amount">
                                            <td><?php echo lang('net_profit'); ?></td>
                                            <td><?php echo $this->currency; ?><?php echo number_format(($this_month_total_income - $this_month_total_expense), 2, '.', ','); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                            <section class="col-md-6">
                            <table class="table mb-0" id="editable-sample1">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><?php echo lang('this_week'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <?php echo lang('income'); ?> </td>
                                            <td> <?php echo $this->currency; ?><?php echo number_format($this_week_total_income, 2, '.', ','); ?> </td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo lang('expense'); ?> </td>
                                            <td><?php echo $this->currency; ?><?php echo number_format($this_week_total_expense, 2, '.', ','); ?></td>
                                        </tr>
                                        <tr class="total_amount">
                                            <td><?php echo lang('net_profit'); ?></td>
                                            <td><?php echo $this->currency; ?><?php echo number_format(($this_week_total_income - $this_week_total_expense), 2, '.', ','); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--state overview end-->
    </div>
</div>
</div>
<!--main content end-->

<style>
    .panel-heading {
        margin-bottom: 20px;
    }
</style>

<!-- js placed at the end of the document so the pages load faster -->

<script src="common/js/codearistos.min.js"></script>