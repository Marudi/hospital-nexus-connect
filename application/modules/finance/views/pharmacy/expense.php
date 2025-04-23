<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"> <?php echo lang('expense'); ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">pharmacy</li>
                                        <li class="breadcrumb-item active"> <?php echo lang('expense'); ?>  </li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('expense') ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <a  href="finance/pharmacy/addExpenseView" class="btn btn-primary waves-effect waves-light w-xs"><i class="fa fa-plus-circle"></i> <?php echo lang('add_expense'); ?></a>
                                           
                                        </div>
                                    </div>
          
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                            
                                <th><?php echo lang('amount'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
  <?php foreach ($expenses as $expense) { ?>
                            <tr class="">
                                <td><?php echo $expense->category; ?></td>
                                <td> <?php echo date('d/m/y', $expense->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $expense->amount; ?></td>             
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <td>
                                        <a class="btn btn-soft-info btn-xs editbutton width_auto" href="finance/pharmacy/editExpense?id=<?php echo $expense->id; ?>"><i class="fa fa-edit"></i>  <?php echo lang('edit'); ?></a>
                                        <a class="btn btn-soft-danger btn-xs delete_button width_auto" href="finance/pharmacy/deleteExpense?id=<?php echo $expense->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i>  <?php echo lang('delete'); ?></a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>

                       

                      

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
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/finance/pharmacy/expense.js"></script>
