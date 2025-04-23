<link href="common/extranal/css/payroll/employeePayroll.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('payroll'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('payroll'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('payroll'); ?></h4> 
                                       
                                    </div>
           
            <div class="card-body">
                <div class="col-md-12"> 
                    <div class="row employee_div">
                        <div class="col-md-5">
                            <label><?php echo lang('month'); ?></label>
                            <select class="form-control js-example-basic-single" id="payroll_month">
                                <?php
                                foreach ($months as $month) {
                                    if ($month == date('F')) {
                                        ?>
                                        <option value="<?php echo $month; ?>" selected><?php echo $month; ?></option>
                                        <?php
                                        break;
                                    } else {
                                        ?>
                                        <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label><?php echo lang('year'); ?></label>
                            <select class="form-control js-example-basic-single" id="payroll_year">
                                <?php foreach ($years as $year) {
                                    ?>
                                    <option value="<?php echo $year; ?>" <?php if ($year == date('Y')) { ?>selected<?php } ?>><?php echo $year; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 30px;">
                            <button class="btn btn-success generatePayroll"><i class="fas fa-paper-plane"></i> <?php echo lang('generate'); ?></button>
                        </div>
                    </div>
                </div>

               

                <div class="table-responsive adv-table">
                    <div class="payroll_table">
                    <table class="table mb-0" id="salary-sample">
                       
                            <thead>
                                <tr>
                                    <th><?php echo lang('staff'); ?></th>
                                    <th><?php echo lang('salary'); ?></th>
                                    <th><?php echo lang('paid_on'); ?></th>
                                    <th><?php echo lang('status'); ?></th>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (!empty($employees)) {
                                    for ($i = 0; $i < count($employees); $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $employees[$i][0]; ?></td>
                                            <td><?php echo $employees[$i][1]; ?></td>
                                            <td><?php echo $employees[$i][2]; ?></td>
                                            <td><?php echo $employees[$i][3]; ?></td>
                                            <td><?php echo $employees[$i][4]; ?></td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- page end-->
    </div>
</div>
<!--main content end-->
<!--footer start-->






<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('salary'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="salaryForm" action="payroll/addEditSalary" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('salary'); ?></label>
                        <input type="text" class="form-control" name="salary" id="exampleInputEmail1" value='' placeholder="Enter Salary Amount" required>
                    </div>

                    <input type="hidden" name="staff">

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->






<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/payroll/payroll.js"></script>
