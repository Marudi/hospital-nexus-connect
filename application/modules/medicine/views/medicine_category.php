<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('medicine_categories'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('medicine'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('medicine_categories'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('medicine_categories'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('create_medicine_category'); ?></button>
                                           
                                        </div>
                                    </div>
          
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?></th>
                                <th> <?php echo lang('description'); ?></th>
                                <th> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                     

                        <?php foreach ($categories as $category) { ?>
                            <tr class="">
                                <td><?php echo $category->category; ?></td>
                                <td> <?php echo $category->description; ?></td>
                                <td>
                                    <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $category->id; ?>"><i class="fa fa-edit"> <?php echo lang('edit'); ?></i></button>   
                                    <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="medicine/deleteMedicineCategory?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> <?php echo lang('delete'); ?></i></a>
                                </td>
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







<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('create_medicine_category'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           
        
            <div class="modal-body row">
                <form role="form" action="medicine/addNewCategory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12"> 
                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?> <?php echo lang('name'); ?>  &ast;</label>
                        <input type="text" class="form-control" name="category"  value='' placeholder="" required="">    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast;</label>
                        <input type="text" class="form-control" name="description"  value='' placeholder="" required="">
                    </div>
                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                </form>
            </div>
        </div>
    </div>
</div>








<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('edit_medicine_category'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
            
            <div class="modal-body row">
                <form role="form" id="editCategoryForm" action="medicine/addNewCategory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12"> 
                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?> <?php echo lang('name'); ?>  &ast;</label>
                        <input type="text" class="form-control" name="category"  value='' placeholder="" required="">    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="description"  value='' placeholder="" required="">
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
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/medicine/medicine_category.js"></script>

