<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php
                if (!empty($medicine->id))
                    echo lang('edit_medicine');
                else
                    echo lang('add_medicine');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('medicine'); ?></li>
                                        <li class="breadcrumb-item active"> <?php
                if (!empty($medicine->id))
                    echo lang('edit_medicine');
                else
                    echo lang('add_medicine');
                ?></li>
                                       
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
           <link href="common/extranal/css/medicine/add_new_medicine_view.css" rel="stylesheet">
        <section class="card col-md-6">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php
                if (!empty($medicine->id))
                    echo lang('edit_medicine');
                else
                    echo lang('add_medicine');
                ?></h4> 
                                      
                                    </div>
           
           
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <section class="panel row">
                                <div class = "panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="medicine/addNewMedicine" class="clearfix" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="name"  value='<?php
                                            if (!empty($medicine->name)) {
                                                echo $medicine->name;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"> <?php echo lang('category'); ?> &ast;</label>
                                            <select class="form-control m-bot15" name="category" value='' required="">
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category->category; ?>" <?php
                                                    if (!empty($medicine->category)) {
                                                        if ($category->category == $medicine->category) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $category->category; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="price"  value='<?php
                                            if (!empty($medicine->price)) {
                                                echo $medicine->price;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="s_price"  value='<?php
                                            if (!empty($medicine->s_price)) {
                                                echo $medicine->s_price;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                                            <input type="text" class="form-control" name="box"  value='<?php
                                            if (!empty($medicine->box)) {
                                                echo $medicine->box;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="quantity"  value='<?php
                                            if (!empty($medicine->quantity)) {
                                                echo $medicine->quantity;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="generic"  value='<?php
                                            if (!empty($medicine->generic)) {
                                                echo $medicine->generic;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                                            <input type="text" class="form-control" name="company"  value='<?php
                                            if (!empty($medicine->company)) {
                                                echo $medicine->company;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                                            <input type="text" class="form-control" name="effects"  value='<?php
                                            if (!empty($medicine->effects)) {
                                                echo $medicine->effects;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?> &ast;</label>
                                            <input type="text" class="form-control default-date-picker readonly" name="e_date"  value='<?php
                                            if (!empty($medicine->e_date)) {
                                                echo $medicine->e_date;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($medicine->id)) {
                                            echo $medicine->id;
                                        }
                                        ?>'>
                                        <div class="form-group col-md-12 pull-right">
                                            <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                                        </div>
                                    </div>
                                    </form>
                                    </div>

                            </section>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
