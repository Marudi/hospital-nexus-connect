
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('gridsection'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('site'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('gridsection'); ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
         <link href="common/extranal/css/gridsection.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8">  <?php echo lang('gridsection'); ?> </h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal">  <i class="fa fa-plus-circle"></i> <?php echo lang('add_gridsection'); ?></button>
                                           
                                        </div>
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                               
                                <th>Time</th>
                                <th><?php echo lang('title'); ?></th>
                                
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        

                        <?php foreach ($gridsections as $gridsection) { ?>
                            <tr class="">
                                <td><?php echo $gridsection->category; ?></td>
                                <td> <?php echo $gridsection->title; ?></td>
                                
                                <td class="no-print">
                                    <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $gridsection->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-soft-danger btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="site/gridsection/delete?id=<?php echo $gridsection->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
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
                
                <h5 class="modal-title"><?php echo lang('add_gridsection'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
          
            <div class="modal-body">
                <form role="form" action="site/gridsection/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control" name="title"  value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Time &#42;</label>
                        <input type="text" class="form-control" name="category"  value='' placeholder="" required="">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('edit_gridsection'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
         

            <div class="modal-body">
                <form role="form" id="editSlideForm" class="clearfix" action="site/gridsection/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control" name="title"  value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Time</label>
                        <input type="text" class="form-control" name="category"  value='' placeholder="" required="">
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

<script src="common/extranal/js/site/gridsection.js"></script>