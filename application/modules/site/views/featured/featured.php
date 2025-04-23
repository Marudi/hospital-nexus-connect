
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('featured_doctors'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('site'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('featured_doctors'); ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
         <link href="common/extranal/css/featured.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8">  <?php echo lang('featured_doctors'); ?> </h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_doctor'); ?></button>
                                           
                                        </div>
                                    </div>
         
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('profile'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                      

                        <?php foreach ($featureds as $featured) { ?>
                            <tr class="">
                                <td class="featured_td"><img class="featured_img" src="<?php echo $featured->img_url; ?>"></td>
                                <td> <?php echo $featured->name; ?></td>
                                <td><?php echo $featured->profile; ?></td>
                                <td class="center"><?php echo $featured->description; ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $featured->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-soft-danger btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="site/featured/delete?id=<?php echo $featured->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
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




<!-- Add Featured Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('add_doctor'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
            <div class="modal-body">
                <form role="form" action="site/featured/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast; </label>
                        <input type="text" class="form-control" name="name"  value='' required="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('profile'); ?> &ast; </label>
                        <input type="text" class="form-control" name="profile"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &ast; </label>
                        <textarea type="text" class="form-control ckeditor" name="description" id="editor" value='' placeholder="" required=""> </textarea>
                    </div>
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_thumb">
                                    <img src=""  alt="" />

                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_class"></div>
                                <div>
                                    <span class="btn btn-soft-primary btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                        <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 255x329</span><br>
                        <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
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
<!-- Add Featured Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('edit_doctor'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
            <div class="modal-body">
                <form role="form" id="editFeaturedForm" class="clearfix" action="site/featured/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast; </label>
                        <input type="text" class="form-control" name="name"  value='' required="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('profile'); ?> &ast; </label>
                        <input type="text" class="form-control" name="profile"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &ast; </label>
                        <textarea type="text" class="form-control ckeditor editor" id="editor1" name="description"  value='' placeholder="" required=""> </textarea>
                    </div>
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_thumb">
                                    <img src="" id="img" alt="" />

                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_class"></div>
                                <div>
                                    <span class="btn btn-soft-primary btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                        <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 255x329</span><br>
                        <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
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




<script src="common/extranal/js/site/featured.js"></script> 
