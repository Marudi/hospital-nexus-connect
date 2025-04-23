<script type="text/javascript" src="common/js/google-loader.js"></script>
<link href="common/css/bootstrap-reset.css" rel="stylesheet">
<link href="common/extranal/css/home.css" rel="stylesheet">

<div class="main-content">
<style>
    .state-overview  i {
            color: #fff;
            font-size: 50px;
            padding: 25px;
    }
        .claendar_div {
        padding-right: 0px;
    }

    .fc-state-active, .fc-state-active .fc-button-inner, .fc-state-hover, .fc-state-hover .fc-button-inner {
        background: #ff6c60 !important;
        color: #fff !important;
    }
    .claendar_div{
        margin-top: 20px;
    }
    h4{
        color: white  !important;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h3 class="mb-0">Dashboard</h3>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item">Pharmacy</li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
        



       
       
            

                <div class="state-overview col-md-12 state_overview_design">
                    <div class="clearfix row">
                     
                            <div class="col-lg-3 col-sm-6">
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <a href="finance/pharmacy/todaySales">
                                    <?php } ?>
                                    <section class="card">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-4 green">
                                            <i class="fa fa-plus"></i> 
                                        </div>
                                        <div class="col-md-8 value card-body">
                                            <h3 class="">
                                                <?php echo $settings->currency ?? ''; ?> <?php echo number_format($today_sales_amount ?? 0, 2, '.', ','); ?>
                                            </h3>
                                            <p class="card-text"><?php echo lang('today_sales'); ?></p> 
                                        </div>
                                </div>
                                    </section>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    </a>
                                <?php } ?>
                            </div>
                    

                       
                            <div class="col-lg-3 col-sm-6">
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <a href="finance/pharmacy/todayExpense">
                                    <?php } ?>
                                    <section class="card">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-4 blue">
                                            <i class="fa fa-minus" style="padding-left: 16px;"></i>
                                        </div>
                                        <div class="col-md-8 value card-body">
                                            <h3 class="">
                                                <?php echo $settings->currency ?? ''; ?> <?php echo number_format($today_expenses_amount ?? 0, 2, '.', ','); ?>
                                            </h3>
                                            <p class="card-text"><?php echo lang('today_expense'); ?></p>
                                        </div>
                                </div>
                                    </section>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    </a>
                                <?php } ?>
                            </div>
                        

                       
                            <div class="col-lg-3 col-sm-6">
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <a href="medicine">
                                    <?php } ?>
                                    <section class="card">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-4 green">
                                            <i class="fa fa-medkit"></i>
                                        </div>
                                        <div class="col-md-8 value card-body">
                                            <h3 class="">
                                            <?php echo count($medicines ?? []); ?>
                                            </h3>
                                            <p class="card-text"><?php echo lang('medicine'); ?></p>
                                        </div>
                                        </div>
                                    </section>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    </a>
                                <?php } ?>
                            </div>
                        
                     
                            <div class="col-lg-3 col-sm-6">
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <a href="staff">
                                    <?php } ?>
                                    <section class="card">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-4 blue">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="col-md-8 value card-body">
                                            <h3 class="">
                                                <?php echo count($accountants ?? []); ?>
                                            </h3>
                                            <p class="card-text"><?php echo lang('staff'); ?></p>
                                        </div>
                                        </div>
                                    </section>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    </a>
                                <?php } ?>
                            </div>
                       
                    </div>


<div class="row">
                    <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                     
                            <div class="col-md-6 col-sm-12">
                                <div id="chart_div" class="card"></div>
                                <section class="card">
                                    <div class="card-header" style="background-color: #3980C0; color:white;">
                                        <h4 class="card-title"><?php echo lang('latest_sales'); ?></h4> 
                                    </div>
                                    <div class="card-body col-md-12">
                                        <div class="table-responsive">
                                            <!-- <ul class="task-list"> -->
                                                <table class="table mb-0" id="editable-sample78">
                                                <thead>
                                                    <tr>
                                                        <th> <?php echo lang('date'); ?> </th>
                                                        <th> <?php echo lang('grand_total'); ?> </th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                                        <?php
                                                    $i = 0;
                                                    foreach ($payments as $payment) {
                                                        $i = $i + 1;
                                                        ?>
                                                        <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>
                                                        <tr class="">
                                                            <td><?php echo date('d/m/y', $payment->date); ?></td>
                                                            <td><?php echo $settings->currency ?? ''; ?> <?php echo number_format($payment->gross_total ?? 0, 2, '.', ','); ?></td>
                                                        </tr>
                                                        <?php
                                                        if ($i == 10)
                                                            break;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            <!-- </ul> -->

                                    </div>
                                </section>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                            <div class="col-md-12 col-sm-12">
                                <section class="card">
                                    <div class="card-header" style="background-color: #3980C0; color:white;">
                                        <h4 class="card-title"><?php echo lang('latest_expense'); ?></h4> 
                                    </div>
                                    <div class="card-body col-md-12">
                                        <div class="table-responsive">
                                            <!-- <ul class="task-list"> -->
                                                <table class="table mb-0" id="editable-sample78">
                                                <thead>
                                    <tr>
                                        <th> <?php echo lang('category'); ?> </th>
                                        <th> <?php echo lang('date'); ?> </th>
                                        <th> <?php echo lang('amount'); ?> </th>
                                    </tr>
                                </thead>
                                                    <tbody>
                                                    <?php
                                $i = 0;
                                foreach ($expenses as $expense) {
                                    $i = $i + 1;
                                    ?>
                                    <tr class="">
                                        <td><?php echo $expense->category ?? ''; ?></td>
                                        <td> <?php echo date('d/m/y', $expense->date); ?></td>
                                        <td><?php echo $settings->currency ?? ''; ?> <?php echo number_format($expense->amount ?? 0, 2, '.', ','); ?></td>             
                                    </tr>
                                    <?php
                                    if ($i == 10)
                                        break;
                                }
                                ?>
                                                    </tbody>
                                                </table>
                                            <!-- </ul> -->

                                    </div>
                                </section>
                            </div>
                    <?php 
                    } ?>
                            </div>
                           
<?php } ?>



               

                    <style>
                        .task-progress h6 {
                        color: #39b5aa;
                        font-size: 18px;
                        margin: 0;
                        padding: 0;
                        font-weight: 400;
                    }
                    .task-thumb-details p, .task-progress p {
                        padding-top: 5px;
                        color: #a4aaba;
                    }
                    table tr{
                        border-bottom: 1px solid #eee;
                    }
                    </style>

                <div class="col-md-6">
                    <!--work progress start-->
                    <section class="card statistics">
                        <div class="card-header progress-panel">
                            <div class="task-progress">
                                <h6><?php echo lang('statistics'); ?></h6>
                                <p><?php echo lang('this_month'); ?></p>
                            </div>
                        </div>
                        <table class="table table-hover personal-task">
                            <tbody>  
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <?php echo lang('number_of_sales'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            <?php
                                            $query_n_o_s = $this->db->get('pharmacy_payment')->result();
                                            $i = 0;
                                            foreach ($query_n_o_s as $q_n_o_s) {
                                                if (date('m/y', time()) == date('m/y', $q_n_o_s->date)) {
                                                    $i = $i + 1;
                                                }
                                            }
                                            echo $i;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress1"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>
                                        <?php echo lang('total_sales'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            <?php echo $settings->currency ?? ''; ?>
                                            <?php
                                            $query = $this->db->get('pharmacy_payment')->result();
                                            $sales_total = array();
                                            foreach ($query as $q) {
                                                if (date('m', time()) == date('m', $q->date)) {
                                                    $sales_total[] = $q->gross_total;
                                                }
                                            }
                                            if (!empty($sales_total)) {
                                                echo number_format(array_sum($sales_total), 2, '.', ',');
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress1"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>
                                        <?php echo lang('number_of_expenses'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">
                                            <?php
                                            $query_n_o_e = $this->db->get('pharmacy_expense')->result();
                                            $i = 0;
                                            foreach ($query_n_o_e as $q_n_o_e) {
                                                if (date('m', time()) == date('m', $q_n_o_e->date)) {
                                                    $i = $i + 1;
                                                }
                                            }
                                            echo $i;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress2"></canvas></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>
                                        <?php echo lang('total_expense'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">
                                            <?php echo $settings->currency ?? ''; ?>
                                            <?php
                                            $query_expense = $this->db->get('pharmacy_expense')->result();
                                            $sales_total = array();
                                            foreach ($query_expense as $q_expense) {
                                                if (date('m', time()) == date('m', $q_expense->date)) {
                                                    $expense_total[] = $q_expense->amount;
                                                }
                                            }
                                            if (!empty($expense_total)) {
                                                echo number_format(array_sum($expense_total), 2, '.', ',');
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress2"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>
                                        <?php echo lang('medicine_number'); ?> 
                                    </td>
                                    <td>
                                        <span class="badge bg-info"> 
                                            <?php
                                            $query_medicine_number = $this->db->get('medicine')->result();
                                            $i = 0;
                                            foreach ($query_medicine_number as $q_medicine_number) {
                                                $i = $i + 1;
                                            }
                                            echo $i;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress3"></canvas></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td>
                                        <?php echo lang('medicine_quantity'); ?> 
                                    </td>
                                    <td>
                                        <span class="badge bg-info"> 
                                            <?php
                                            $query_medicine = $this->db->get('medicine')->result();
                                            $i = 0;
                                            foreach ($query_medicine as $q_medicine) {
                                                if ($q_medicine->quantity > 0) {
                                                    $i = $i + $q_medicine->quantity;
                                                }
                                            }
                                            echo number_format($i, 2, '.', ',');
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress3"></canvas></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>
                                        <?php echo lang('medicine_o_s'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">
                                            <?php
                                            $query_medicine = $this->db->get('medicine')->result();
                                            $i = 0;
                                            foreach ($query_medicine as $q_medicine) {
                                                if ($q_medicine->quantity == 0) {
                                                    $i = $i + 1;
                                                }
                                            }
                                            echo $i;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress4"></canvas></div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </section>
                    <!--work progress end-->

                    <div class="card">  
                           <div class="card-header table_header" style="background-color: #3980C0; color:white;">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('latest_medicines'); ?> </h4> 
                                      
                                    </div>
                        
                        <table class="table mb=0" id="">
                            <thead>
                                <tr>
                                    <th> <?php echo lang('name'); ?></th>
                                    <th> <?php echo lang('category'); ?></th>
                                    <th> <?php echo lang('price'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                           
                            <?php
                            $i = 0;
                            foreach ($latest_medicines as $latest_medicine) {
                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td><?php echo $latest_medicine->name ?? ''; ?></td>
                                    <td> <?php echo $latest_medicine->category ?? ''; ?></td>
                                    <td><?php echo $settings->currency ?? ''; ?> <?php echo number_format($latest_medicine->s_price ?? 0, 2, '.', ','); ?></td>
                                </tr>
                                <?php
                                if ($i == 10)
                                    break;
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                 
                 

                </div>
              

                </div> 



                                    </div>
                                    </div>

                                    </div>


 <script type="text/javascript">var per_month_income_expense = "<?php echo lang('per_month_income_expense') ?>";</script>
<script type="text/javascript">var currency = "<?php echo $settings->currency ?? ''; ?>";</script>
<script type="text/javascript">var months_lang = "<?php echo lang('months') ?>";</script>
<script type="text/javascript">var this_year = <?php echo json_encode($this_year['payment_per_month'] ?? []); ?>;</script>
<script type="text/javascript">var this_year_expenses = <?php echo json_encode($this_year['expense_per_month'] ?? []); ?>;</script>
<script src="common/extranal/js/pharmacy/home.js"></script>
