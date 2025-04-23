<link href="common/extranal/css/laboratorist.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">

    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('laboratorist'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('human_resources'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('laboratorist'); ?></li>
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <div class="card">
                            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('laboratorist'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-info waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                                           
                                        </div>
                                    </div>
         
            <div class="card-body">  
                                        <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample"> <!-- table mb-0-->
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

                      

                        <?php foreach ($laboratorists as $laboratorist) { ?>
                            <tr class="">
                                <td  class="img_td"><img class="img_url1" src="<?php echo $laboratorist->img_url; ?>"></td>
                                <td> <?php echo $laboratorist->name; ?></td>
                                <td><?php echo $laboratorist->email; ?></td>
                                <td class="center"><?php echo $laboratorist->address; ?></td>
                                <td><?php echo $laboratorist->phone; ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-soft-primary waves-effect waves-light btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $laboratorist->id; ?>"><i class="fa fa-edit"></i> </button>   
                                    <a class="btn btn-soft-primary waves-effect waves-light btn-xs btn_width delete_button" href="laboratorist/delete?id=<?php echo $laboratorist->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
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
<!--main content end-->
<!--footer start-->







<!-- Add Laboratorist Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               
                <h5 class="modal-title"> <?php echo lang('add_new_laboratorist'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" action="laboratorist/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control" name="name"  value='' required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast;</label>
                        <input type="email" class="form-control" name="email"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?> &ast;</label>
                        <input type="password" class="form-control" name="password"  placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast;</label>
                        <input type="text" class="form-control" name="address"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast;</label>
                        <input type="number" class="form-control" name="phone"  value='' placeholder="" required="">
                    </div>
                    <div class="row"> 
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('signature'); ?> &ast; </label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img src="" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                                <div>
                                    <span class="btn btn-soft-info btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Signature</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="signature"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                       
                    </div>
                    <div class="form-group last col-md-6">
                        <label class="control-label"><?php echo lang('image'); ?> </label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img src="" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                                <div>
                                    <span class="btn btn-soft-info btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('profile'); ?> &ast; </label>
                        <textarea class="form-control ckeditor" id="editor1" name="profile" value="" rows="50" cols="20"></textarea>
                        <!-- <input type="hidden" name="profile" id="profile" value=""> -->
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
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title">  <?php echo lang('edit_laboratorist'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" id="editLaboratoristForm" class="clearfix" action="laboratorist/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast;</label>
                        <input type="email" class="form-control" name="email"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password"  placeholder="********">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast;</label>
                        <input type="text" class="form-control" name="address"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone &ast;</label>
                        <input type="number" class="form-control" name="phone"  value='' placeholder="" required="">
                    </div>
                    <div class="row"> 
                    <div class="form-group  col-md-6">
                        <label class="control-label"><?php echo lang('signature');?></label>
                        <div class="signature_class">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img src="" id="signature" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                                <div>
                                    <span class="btn btn-soft-info btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Signature</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="signature"/>
                                    </span>
                                    <button class="btn btn-danger" id="remove_button_laboratorist_signature"> <?php echo lang('remove');?></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group last col-md-6">
                        <label class="control-label"><?php echo lang('image'); ?></label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img src="" id="img" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                                <div>
                                    <span class="btn btn-soft-info btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>
                   
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('profile'); ?></label>
                        <textarea class="form-control ckeditor" id="editor3" name="profile" value="" rows="50" cols="20"></textarea>
                        <!-- <input type="hidden" name="profile" id="profile1" value=""> -->
                    </div>

                    <input type="hidden" name="id" id="id_value" value=''>
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
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/laboratorist.js"></script>