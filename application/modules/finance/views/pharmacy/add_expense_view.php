<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"> <?php
                if (!empty($expense->id))
                    echo lang('edit_expense');
                else
                    echo lang('add_expense');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Pharmacy</li>
                                        <li class="breadcrumb-item active"><?php
                if (!empty($expense->id))
                    echo lang('edit_expense');
                else
                    echo lang('add_expense');
                ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="col-md-6">
        <div class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php
                if (!empty($expense->id))
                    echo lang('pharmacy') . ' ' . lang('edit_expense');
                else
                    echo lang('pharmacy') . ' ' . lang('add_expense');
                ?></h4> 
                                      
                                    </div>
          
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix"> 
                        <?php echo validation_errors(); ?>
                        <form role="form" action="finance/pharmacy/addExpense" class="clearfix row" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('category'); ?> &ast;</label>
                                <select class="form-control m-bot15 js-example-basic-single" name="category" value='' required="">
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category->category; ?>" <?php
                                        if (!empty($setval)) {
                                            if ($category->category == set_value('category')) {
                                                echo 'selected';
                                            }
                                        }
                                        if (!empty($expense->category)) {
                                            if ($category->category == $expense->category) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > <?php echo $category->category; ?> </option>
                                            <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('amount'); ?> &ast;</label>
                                <input type="text" class="form-control" name="amount"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('amount');
                                }
                                if (!empty($expense->amount)) {
                                    echo $expense->amount;
                                }
                                ?>' placeholder="<?php echo $settings->currency; ?>" required="">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('note'); ?></label>
                                <input type="text" class="form-control" name="note"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('note');
                                }
                                if (!empty($expense->note)) {
                                    echo $expense->note;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <input type="hidden" name="id" value='<?php
                            if (!empty($expense->id)) {
                                echo $expense->id;
                            }
                            ?>'>
                            <div class="form-group col-md-12 pull-right">
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        </div>
        <!-- page end-->
    </div>
</div></div>
<!--main content end-->
<!--footer start-->
