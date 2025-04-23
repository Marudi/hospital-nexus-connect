<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"> <?php echo lang('financial_report'); ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Pharmacy</li>
                                        <li class="breadcrumb-item active"> <?php echo lang('financial_report'); ?>  </li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <!-- <link href="common/extranal/css/finance/pharmacy/financial_report.css" rel="stylesheet"> -->
        <style>
            h5{
                font-size: 1rem !important;
            }
            .h3, h3 {
                font-size: 1.2rem !important;
            }
            .mb-0 td{
                
                border: 1px !important;
            }
            .mb-0 tr{
                border:1px  groove !important;
            }
            .col-md-4, .degree{
                color: #fff !important;
                font-weight: bold;
            }
            .billl {
                    background: #3980C0 !important;
                }
        </style>
          <?php
        if (!empty($payments)) {
            $paid_number = 0;
            foreach ($payments as $payment) {
                $paid_number = $paid_number + 1;
            }
        }
        ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> <?php echo lang('financial_report'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                            <a class="btn btn-soft-info no-print pull-right" onclick="javascript:window.print();"> <i class="fa fa-print"></i> </a>
                                           
                                        </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3"></div>           
                <div class="col-md-6 ">
                        <section>
                            <form role="form" class="f_report" action="finance/pharmacy/financialReport" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                
                                    <div class="col-md-6">
                                        <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                            <input type="text" class="form-control dpd1  default-date-picker" name="date_from" value="<?php
                                            if (!empty($from)) {
                                                echo $from;
                                            }
                                            ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                            <span class="input-group-text"><?php echo lang('to'); ?></span>
                                            <input type="text" class="form-control dpd2  default-date-picker" name="date_to" value="<?php
                                            if (!empty($to)) {
                                                echo $to;
                                            }
                                            ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                        </div>
                                        <div class="row"></div>
                                        <span class="help-block"></span> 
                                    </div>
                                    <div class="col-md-6 no-print">
                                        <button type="submit" name="submit" class="btn btn-info btn-xs range_submit"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                    <div class="col-md-3"></div> 
            </div>
            <?php
                if (!empty($payments)) {
                    $paid_number = 0;
                    foreach ($payments as $payment) {
                        $paid_number = $paid_number + 1;
                    }
                }
                ?>
<div class="col-lg-12">
                <section class="card">
                <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <i class="fa fa-money"></i>  <?php echo lang('sales'); ?> <?php echo lang('report'); ?></h4> 
                                      
                                    </div>
                    
                    <table class="table  mb-0">
                        <thead>
                            <tr>
                            <th><?php echo lang('item_name'); ?> </th>
                                <th><?php echo lang('quantity'); ?> </th>
                                <th><?php echo lang('total'); ?> <?php echo lang('purchase'); ?> <?php echo lang('cost'); ?> </th>
                                <th class="hidden-phone"><?php echo lang('total'); ?> <?php echo lang('sale'); ?> <?php echo lang('cost'); ?> </th>

                            </tr>
                        </thead>
                        <tbody>

<?php
$category_id_for_report = [];
$category_id_for_reports = [];
$amount_per_category = [];
$cost_per_category = [];
$quantity = [];
$total_cost_by_category = [];
$total_payment_by_category = [];
$discount = [];
$vat = [];

if (!empty($payments)) {
    foreach ($medicines as $medicine_name) {
        foreach ($payments as $payment) {
            $categories_in_payment = explode(',', $payment->category_name ?? '');
            foreach ($categories_in_payment as $category_in_payment) {
                $category_id = explode('*', $category_in_payment);
                if ($category_id[0] == $medicine_name->id) {
                    $category_id_for_report[] = $category_id[0];
                }
            }
        }
    }

    $category_id_for_reports = array_unique($category_id_for_report);
}
?>

<?php
if (!empty($payments)) {
    foreach ($medicines as $category) {
        if (in_array($category->id, $category_id_for_reports)) {
            ?>
            <tr class="">
                <td><?php echo $category->name ?></td>
                <?php
                foreach ($payments as $payment) {
                    $category_names_and_amounts = $payment->category_name ?? '';
                    $category_names_and_amounts = explode(',', $category_names_and_amounts);
                    foreach ($category_names_and_amounts as $category_name_and_amount) {
                        $category_name = explode('*', $category_name_and_amount);
                        if (($category->id == $category_name[0])) {
                            $amount_per_category[] = $category_name[1] * $category_name[2];
                            $cost_per_category[] = $category_name[2] * $category_name[3];
                            $quantity[] = $category_name[2];
                        }
                    }
                }
            ?>
            <td>
                <?php
                if (!empty($quantity)) {
                    echo array_sum($quantity);
                    $quantity[] = array_sum($quantity);
                } else {
                    echo '0';
                }

                $quantity = [];
                ?>
            </td>
            <td>
                <?php echo $settings->currency; ?> 
                <?php
                if (!empty($cost_per_category)) {
                    echo array_sum($cost_per_category);
                    $total_cost_by_category[] = array_sum($cost_per_category);
                } else {
                    echo '0';
                }

                $cost_per_category = [];
                ?>
            </td>
            <td>
                <?php echo $settings->currency; ?> 
                <?php
                if (!empty($amount_per_category)) {
                    echo array_sum($amount_per_category);
                    $total_payment_by_category[] = array_sum($amount_per_category);
                } else {
                    echo '0';
                }

                $amount_per_category = [];
                ?>
            </td>
            </tr>
            <?php
        }
    }
}
?>

</tbody>
<tbody>
<tr>
    <td><h3> <?php echo lang('sub_total'); ?>  </h3></td>
    <td></td>
    <td>
        <?php echo $settings->currency; ?>
        <?php
        if (!empty($total_cost_by_category)) {
            echo array_sum($total_cost_by_category);
        } else {
            echo '0';
        }
        ?> 
    </td>
    <td>
        <?php echo $settings->currency; ?>
        <?php
        if (!empty($total_payment_by_category)) {
            echo array_sum($total_payment_by_category);
        } else {
            echo '0';
        }
        ?> 
    </td>
</tr>

<tr>
    <td><h5> <?php echo lang('total'); ?>   <?php echo lang('discount'); ?> </h5></td>
    <td></td>
    <td></td>
    <td>
        <?php echo $settings->currency; ?>
        <?php
        if (!empty($payments)) {
            foreach ($payments as $payment) {
                $discount[] = $payment->flat_discount ?? 0;
            }
            if ($paid_number > 0) {
                echo array_sum($discount);
            } else {
                echo '0';
            }
        } else {
            echo '0';
        }
        ?>
    </td>
</tr>

<tr>
    <td><h5><?php echo lang('gross'); ?> <?php echo lang('sales'); ?> </h5></td>
    <td></td>
    <td></td>
    <td>
        <?php echo $settings->currency; ?>
        <?php
        if (!empty($payments)) {
            if ($paid_number > 0) {
                $gross = array_sum($total_payment_by_category) - array_sum($discount) + array_sum($vat);
                echo $gross;
            } else {
                echo '0';
            }
        } else {
            echo '0';
        }
        ?>
    </td>
</tr>

</tbody>
                </section>




                <section></section>


                <section class="card">
                <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <i class="fa fa-money"></i>   <?php echo lang('expense'); ?>   <?php echo lang('report'); ?> </h4> 
                                      
                                    </div>
                
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?></th>
                                <th class="hidden-phone"> <?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expense_categories as $category) { ?>
                                <tr class=""> 
                                    <td><?php echo $category->category ?></td>
                                    <td>
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        foreach ($expenses as $expense) {
                                            $category_name = $expense->category;


                                            if (($category->category == $category_name)) {
                                                $amount_per_category[] = $expense->amount;
                                            }
                                        }
                                        if (!empty($amount_per_category)) {
                                            $total_expense_by_category[] = array_sum($amount_per_category);
                                            echo array_sum($amount_per_category);
                                        } else {
                                            echo '0';
                                        }

                                        $amount_per_category = NULL;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </section>
            </div>
        </div>

        </div>
    </div>
    <div class="col-lg-4">
                <section class="card">
                    <div class="weather-bg">
                        <div class="card-body billl">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class="fa fa-money-bill-alt"></i>
                                    <?php echo lang('gross'); ?> <?php echo lang('p_price'); ?> 
                                </div>
                                <div class="col-md-8 pull-right">
                                    <div class="degree">
                                    <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($payments)) {
                                            if (($paid_number > 0)) {
                                                if (!empty($total_cost_by_category)) {
                                                    $total_cost = array_sum($total_cost_by_category);
                                                    echo number_format($total_cost, 2, '.', ',');
                                                } else {
                                                    $total_cost = 0;
                                                    echo number_format($total_cost, 2, '.', ',');
                                                }
                                            }
                                        } else {
                                            echo '0.00';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section class="card" style="background-color: #88B2D9; background-color: #88B2D9;">
                    <div class="weather-bg">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fa fa-money-bill-alt"></i>
                                    <?php echo lang('gross'); ?> <?php echo lang('s_price'); ?> 
                                </div>
                                <div class="col-md-6 pull-right">
                                    <div class="degree">
                                    <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($payments)) {
                                            if (($paid_number > 0)) {
                                                if (!empty($gross)) {

                                                    echo number_format($gross, 2, '.', ',');
                                                } else {
                                                    $gross = 0;
                                                    echo number_format($gross, 2, '.', ',');
                                                }
                                            }
                                        } else {
                                            echo '0.00';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>


                <section class="card" style="background-color: #88B2D9; color:#fff;">
                    <div class="weather-bg">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fa fa-money-bill-alt"></i>
                                    <?php echo lang('gross_expense'); ?> 
                                </div>
                                <div class="col-md-6 pull-right">
                                    <div class="degree">
                                    <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($total_expense_by_category)) {
                                            $total_expense = array_sum($total_expense_by_category);
                                            echo number_format($total_expense, 2, '.', ',');
                                        } else {
                                            $total_expense = 0;
                                            echo number_format($total_expense, 2, '.', ',');
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




                <section class="card">
                    <div class="weather-bg">
                        <div class="card-body billl">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class="fa fa-money-bill-alt"></i>
                                    <?php echo lang('profit'); ?> 
                                </div>
                                <div class="col-md-8 pull-right">
                                    <div class="degree">

                                        <?php echo $settings->currency; ?>
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        //  if ($paid_number > 0) {

                                        if (!empty($total_payment_by_category)) {
                                            $gross = array_sum($total_payment_by_category) - array_sum($discount) + array_sum($vat);

                                            $profit = $gross - $total_cost - $total_expense;
                                            echo number_format($profit, 2, '.', ',');
                                        } else {
                                            echo '0.00';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>


</div>


        <!-- page end-->
    </div>
</div></div>
<!--main content end-->
<!--footer start-->
