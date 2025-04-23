<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('slide'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('site'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('slide'); ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
           <link href="common/extranal/css/slide.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8">  <?php echo lang('slide'); ?> </h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_slide'); ?></button>
                                           
                                        </div>
                                    </div>
          
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('title'); ?></th>
                                <th><?php echo lang('text1'); ?></th>
                                <th><?php echo lang('text2'); ?></th>
                                <th><?php echo lang('text3'); ?></th>
                                <th><?php echo lang('position'); ?></th>
                                <th><?php echo lang('status'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($slides as $slide) { ?>
                            <tr class="">
                                <td class="img_class"><img class="img" src="<?php echo $slide->img_url; ?>"></td>
                                <td> <?php echo $slide->title; ?></td>
                                <td><?php echo $slide->text1; ?></td>
                                <td><?php echo $slide->text2; ?></td>
                                <td><?php echo $slide->text3; ?></td>
                                <td><?php echo $slide->position; ?></td>
                                <td>
                                    <?php
                                    if ($slide->status == 'Active') {
                                        echo lang('active');
                                    } else {
                                        echo lang('in_active');
                                    }
                                    ?>
                                </td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $slide->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-soft-danger btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="site/slide/delete?id=<?php echo $slide->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
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




<!-- Add Slide Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('add_slide'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
            <div class="modal-body">
                <form role="form" action="site/slide/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control" name="title"  value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text1'); ?> &#42;</label>
                        <input type="text" class="form-control" name="text1"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text2'); ?> &#42;</label>
                        <input type="text" class="form-control" name="text2"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text3'); ?> &#42;</label>
                        <input type="text" class="form-control" name="text3"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('position'); ?> &#42;</label>
                        <input type="text" class="form-control" name="position"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?> &#42;</label>
                        <select class="form-control m-bot15" name="status" value='' required="">
                            <option value="Active" <?php
                            if (!empty($setval)) {
                                if ($slide->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($slide->status)) {
                                if ($slide->status == 'Active') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('active'); ?> 
                            </option>
                            <option value="Inactive" <?php
                            if (!empty($setval)) {
                                if ($slide->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($slide->status)) {
                                if ($slide->status == 'Inactive') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('in_active'); ?> 
                            </option>
                        </select>
                    </div>
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_url">
                                    <img src="" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                <div>
                                    <span class="btn btn-soft-info btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                        <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 580x780</span><br>
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
<!-- Add Slide Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('edit_slide'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
            <div class="modal-body">
                <form role="form" id="editSlideForm" class="clearfix" action="site/slide/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control" name="title"  value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text1'); ?> &#42;</label>
                        <input type="text" class="form-control" name="text1"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text2'); ?> &#42;</label>
                        <input type="text" class="form-control" name="text2"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text3'); ?> &#42;</label>
                        <input type="text" class="form-control" name="text3"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('position'); ?> &#42;</label>
                        <input type="text" class="form-control" name="position"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?> &#42;</label>
                        <select class="form-control m-bot15" name="status" value='' required="">
                            <option value="Active" <?php
                            if (!empty($setval)) {
                                if ($slide->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($slide->status)) {
                                if ($slide->status == 'Active') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('active'); ?> 
                            </option>
                            <option value="Inactive" <?php
                            if (!empty($setval)) {
                                if ($slide->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($slide->status)) {
                                if ($slide->status == 'Inactive') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('in_active'); ?> 
                            </option>
                        </select>
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
                                    <span class="btn btn-soft-info btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                        <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 580x780</span><br>
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
<script src="common/extranal/js/site/slide.js"></script>