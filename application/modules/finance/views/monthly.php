<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Monthly</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active"><?php echo lang('monthly'); ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!--state overview start-->
         <link href="common/extranal/css/finance/daily.css" rel="stylesheet">
        <div class="col-md-12">
            <div class="row state-overview state_overview_design">
                <div class="col-md-8">
                    <!--custom chart start-->
                    <div class="card">
                    <?php
                    $currently_processing_year = date('Y', $first_minute);
                    $next_year = $currently_processing_year + 1;
                    $previous_year = $currently_processing_year - 1;
                    ?>
 <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> <?php echo date('Y', $first_minute) . ' ' .lang('hospital').' '. lang('sales_report'); ?>  </h4> 
                                        <div class="col-lg-4 no-print row"> 
                                            <div class="col-md-4 pull-right">
                                        <a class="btn btn-primary " onclick="javascript:window.print();"> <i class="fa fa-print"></i>  </a></div>
                                        <div class="col-md-4 pull-right">
                                         <a class="btn btn-soft-info" href="finance/monthly?year=<?php echo $next_year; ?>">
                                             <i class="fa fa-arrow-left"></i> Prev
                                        </a>
                                        </div>
                                        <div class="col-md-4 pull-right">
                                        <a class="btn btn-soft-info" href="finance/monthly?year=<?php echo $previous_year; ?>">
                                             Next <i class="fa fa-arrow-right"></i>
                                        </a>
                                        </div>
                                        </div>
                                    </div>
         
                   
                    <div class="card-body">
                    <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample1">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('date'); ?> </th>
                                        <th> <?php echo lang('amount'); ?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        $time = mktime(12, 0, 0, $month, 1, $year);
                                        if (!empty($all_payments[date('m-Y', $time)])) {
                                            if (date('Y', $time) == $year) {
                                                $month_name = date('F', $time);
                                                $amount = $all_payments[date('m-Y', $time)];
                                            }
                                        } else {
                                            if (date('Y', $time) == $year) {
                                                $month_name = date('F', $time);
                                                $amount = 0;
                                            }
                                        }
                                        ?>
                                    
                                        <tr>
                                            <td><?php echo lang($month_name); ?></td>
                                            <td><?php echo $this->currency; ?><?php echo number_format($amount, 2, '.', ','); ?></td>
                                            <?php $total_amount[] = $amount; ?>
                                        </tr>

                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if (!empty($total_amount)) {
                                        $total_amount = array_sum($total_amount);
                                    } else {
                                        $total_amount = 0;
                                    }
                                    ?>

                                        <tr class="total_amount">
                                        <td><?php echo lang('total'); ?></td> 
                                        <td><?php echo $this->currency; ?><?php echo number_format($total_amount, 2, '.', ','); ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        <!--state overview end-->
</div>
</div>
<!--main content end-->
<!--footer start-->
<!--footer end-->

</div>

<!-- js placed at the end of the document so the pages load faster -->

<script src="common/js/codearistos.min.js"></script>




</body>
</html>
