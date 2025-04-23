<link href="common/extranal/css/blog.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Blog</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('website'); ?></li>
                                        <li class="breadcrumb-item active">Blog</li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8">Blog</h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                                           
                                        </div>
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('title'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th>Posted By</th>

                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php foreach ($blogs as $blog) { ?>
                                <tr class="">
                                    <td class="img_class"><img style="width:100px;" class="img" src="<?php echo $blog->img_url; ?>"></td>
                                    <td><?php echo $blog->title; ?></td>
                                    <td><?php echo $blog->description; ?></td>
                                    <td><?php echo $blog->posted_by; ?></td>

                                    <td class="no-print">
                                        <button type="button" class="btn btn-soft-info waves-effect waves-light btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $blog->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-soft-danger btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="blog/delete?id=<?php echo $blog->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
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

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> Add Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           

            <div class="modal-body">
                <form role="form" id="addBlogForm" class="clearfix" action="blog/addNew" method="post" enctype="multipart/form-data">
                  

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &ast;</label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Posted By</label>
                        <input type="text" class="form-control" name="posted_by" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &ast;</label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Button Link &ast;</label>
                        <input type="text" class="form-control" name="button_link"  value='' placeholder="" required="">
                    </div>
                 
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_url">                                   
                                        <img src="" id="img1" alt="" />                                  
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                        <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 358x242</span><br>
                        <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
                    </div>

                    

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






<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> Edit Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           
          

            <div class="modal-body">
                <form role="form" id="editBlogForm" class="clearfix" action="blog/addNew" method="post" enctype="multipart/form-data">
                  

                <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &ast;</label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Posted By</label>
                        <input type="text" class="form-control" name="posted_by" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &ast;</label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Button Link &ast;</label>
                        <input type="text" class="form-control" name="button_link"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_url">                                   
                                        <img src="" id="img" alt="" />                                  
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                        <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 358x242</span><br>
                        <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="date" value=''>

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
<script src="common/extranal/js/blog.js"></script>