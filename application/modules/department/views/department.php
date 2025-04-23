<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('department'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('department'); ?></li>
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
         <!-- <link href="common/extranal/css/department.css" rel="stylesheet"> -->
        
        <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header table_header">
                                    <h4 class="card-title mb-0 col-lg-8"><?php echo lang('list_of_departments') ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                                            <!-- <a data-toggle="modal" href="#myModal">
                                                <div class="btn-group pull-right">
                                                    <button id="" class="btn btn-primary waves-effect waves-light w-xs">
                                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                                    </button>
                                                </div>
                                            </a> -->
                                        </div>
                                    </div>
                                    <div class="card-body">  
                                        <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample"> <!-- table mb-0-->
        
                                                <thead>
                                                <tr>
                                                    <th> <?php echo lang('name') ?></th>
                                                    <th> <?php echo lang('description') ?></th>
                                                    <th class="no-print"> <?php echo lang('options') ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($departments as $department) { ?>
                                                    <tr class="">
                                                        <td><?php echo $department->name; ?></td>
                                                        <td><?php echo $department->description; ?></td>
                                                        <td class="no-print">
                                                            <button type="button" class="btn btn-soft-primary waves-effect waves-light editbutton" data-toggle="modal" title="<?php echo lang('edit'); ?>" data-id="<?php echo $department->id; ?>"><i class="fa fa-edit"></i> </button>   
                                                            <a  class="btn btn-soft-success waves-effect waves-light"  title="<?php echo lang('doctor_directory'); ?>" href="department/doctorDirectory?id=<?php echo $department->id; ?>"><i class="fa fa-users"></i> </a>   
                                                            <a class="btn btn-soft-danger waves-effect waves-light delete_button" title="<?php echo lang('delete'); ?>" href="department/delete?id=<?php echo $department->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
        
                                    </div>
                                </div>
                            </div>
        <!-- page end-->
                            </div>
                            </div>
                            </div>
<!--main content end-->
<!--footer start-->




<!-- Add Department Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title"> <?php echo lang('add_department') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body">
                <form role="form" action="department/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">  <?php echo lang('department') ?> <?php echo lang('name') ?> &ast;</label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label class=""> <?php echo lang('description') ?> &ast;</label>
                        <div class="">
                            <textarea class="ckeditor form-control" name="description" id="editor" value="" rows="10" required="">  </textarea>
                        </div>
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
<!-- Add Department Modal-->

<!-- Edit Department Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title">   <?php echo lang('edit_department') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" id="departmentEditForm" class="clearfix" action="department/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1"> <?php echo lang('department') ?> <?php echo lang('name') ?></label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label class=""> <?php echo lang('description') ?></label>
                        <div class="">
                            <textarea class="ckeditor form-control editor" id="editor1" name="description" value="" rows="10" required>  </textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                    <!-- <section class="mt-4 pull-right">
                        <button type="submit" name="submit" class="btn btn-info w-md submit_button"> <?php echo lang('submit') ?></button>
                    </section> -->
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/department.js"></script>