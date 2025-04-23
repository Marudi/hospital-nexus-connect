<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('alert_stock_list'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('medicine'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('alert_stock_list'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
          <link href="common/extranal/css/medicine/medicine.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8">  <?php echo lang('medicine'); ?>  <?php echo lang('alert_stock_list'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_medicine'); ?></button>
                                           
                                        </div>
                                    </div>
        

         
            <div class="card-body"> 
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('id'); ?></th>
                                <th> <?php echo lang('name'); ?></th>
                                <th> <?php echo lang('category'); ?></th>
                                <th> <?php echo lang('store_box'); ?></th>
                                <th> <?php echo lang('p_price'); ?></th>
                                <th> <?php echo lang('s_price'); ?></th>
                                <th> <?php echo lang('quantity'); ?></th>
                                <th> <?php echo lang('generic_name'); ?></th>
                                <th> <?php echo lang('company'); ?></th>
                                <th> <?php echo lang('effects'); ?></th>
                                <th> <?php echo lang('expiry_date'); ?></th>
                                <th> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                    
                        <?php
                        if (!empty($p_n)) {
                            $i = $p_n * 50;
                        } else {
                            $i = 0;
                        }
                        foreach ($medicines as $medicine) {
                            $i = $i + 1;
                            ?>
                            <tr class="">
                                <td class="medici_name"><?php echo $i; ?></td>
                                <td class="medici_name"><?php echo $medicine->name; ?></td>
                                <td> <?php echo $medicine->category; ?></td>
                                <td> <?php echo $medicine->box; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $medicine->price; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $medicine->s_price; ?></td>
                                <td> <?php
                                    if ($medicine->quantity <= 0) {
                                        echo '<p class="os">Stock Out</p>';
                                    } else {
                                        echo $medicine->quantity;
                                    }
                                    ?>
                                    <button type="button" class="btn btn-info btn-xs btn_width load" data-toggle="modal" data-id="<?php echo $medicine->id; ?>"> <?php echo lang('load'); ?></button> 
                                </td>
                                <td class="center"><?php echo $medicine->generic; ?></td>
                                <td><?php echo $medicine->company; ?></td>
                                <td><?php echo $medicine->effects; ?></td>
                                <td> <?php echo $medicine->e_date; ?></td>
                                <td>
                                    <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $medicine->id; ?>"><i class="fa fa-edit"></i>  <?php echo lang('edit'); ?></button>   
                                    <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="medicine/delete?id=<?php echo $medicine->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>


                   

                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->







<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('add_medicine'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
          
            <div class="modal-body row">
                <form role="form" action="medicine/addNewMedicine" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-5">
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

                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?> </label>
                        <input type="text" class="form-control" name="price"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?> &ast;</label>
                        <input type="text" class="form-control" name="s_price"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?> &ast;</label>
                        <input type="text" class="form-control" name="quantity"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?> &ast;</label>
                        <input type="text" class="form-control" name="generic"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                        <input type="text" class="form-control" name="company"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                        <input type="text" class="form-control" name="effects"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4"> 
                        <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                        <input type="text" class="form-control" name="box"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?> &ast;</label>
                        <input type="text" class="form-control default-date-picker readonly" name="e_date"  value='' placeholder="" required="">
                    </div>
                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>








<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('edit_medicine'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           
            <div class="modal-body row">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                        <select class="form-control m-bot15" name="category" value=''>
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

                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                        <input type="text" class="form-control" name="price"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?></label>
                        <input type="text" class="form-control" name="s_price"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?></label>
                        <input type="text" class="form-control" name="generic"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                        <input type="text" class="form-control" name="company"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                        <input type="text" class="form-control" name="effects"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4"> 
                        <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                        <input type="text" class="form-control" name="box"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="e_date"  value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>

                                                            </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModal3" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('load_medicine'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           
            <div class="modal-body">
                <form role="form" id="editMedicineForm1" class="clearfix" action="medicine/load" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('add_quantity'); ?></label>
                        <input type="text" class="form-control" name="qty"  value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/medicine/medicine_stock_alert.js"></script>