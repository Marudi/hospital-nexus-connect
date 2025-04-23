<link href="common/extranal/css/superadmin/superadmin.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php echo lang('superadmin'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('superadmin'); ?></li>
                                       
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> <?php echo lang('superadmin'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                            <a data-toggle="modal" href="superadmin/addNewView">
                                                <div class="btn-group pull-right">
                                                    <button id="" class="btn btn-primary waves-effect waves-light w-xs">
                                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_superadmin'); ?>
                                                    </button>
                                                </div>
                                            </a>
                                                            
                                           
                                        </div>
                                    </div>
          
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('address'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($superadmins as $superadmin) { ?>
                                <tr class="">
                                    <td class="td_img"><img class="img_src" src="<?php echo $superadmin->img_url; ?>"></td>
                                    <td> <?php echo $superadmin->name; ?></td>
                                    <td><?php echo $superadmin->email; ?></td>
                                    <td class="center"><?php echo $superadmin->address; ?></td>
                                    <td><?php echo $superadmin->phone; ?></td>
                                    <td class="no-print">
                                        <?php if ($superadmin->id != 12) { ?>
                                            <a type="button" class="btn btn-soft-info waves-effect waves-light btn-xs" data-toggle="" href="superadmin/editSuperadmin?id=<?php echo $superadmin->id; ?>" data-id="<?php echo $superadmin->id; ?>"><i class="fa fa-edit"></i></a>   

                                            <a class="btn btn-soft-danger waves-effect waves-light btn-xs delete_button" title="<?php echo lang('delete'); ?>" href="superadmin/delete?id=<?php echo $superadmin->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                        <?php } ?>
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






<!-- Add Superadmin Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_superadmin'); ?> </h4>
            </div>
            <div class="modal-body">
                <form role="form" action="superadmin/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name"  value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password"  placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Superadmin Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_superadmin'); ?> </h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editSuperadminForm" class="clearfix" action="superadmin/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password"  placeholder="********">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/superadmin.js"></script>