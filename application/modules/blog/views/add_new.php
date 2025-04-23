<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php
                if (!empty($blog->id))
                    echo 'Edit Blog';
                else
                    echo  'Add Blog';
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Blog</li>
                                        <li class="breadcrumb-item active"><?php
                 if (!empty($blog->id))
                 echo 'Edit Blog';
             else
                 echo  'Add Blog';
                ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
        <h4 class="card-title mb-0 col-lg-8">   <?php
                if (!empty($blog->id))
                    echo '<i class="fa fa-edit"></i> Edit Blog ';
                else
                    echo '<i class="fa fa-plus-circle"></i> Add Blog' ;
                ?></h4> 
        </div>
          
         
            <div class="card-body">
            <div class="table-responsive adv-table">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="">
                                <div class="">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="blog/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">    
                                            <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                                            <input type="text" class="form-control" name="title"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('title');
                                            }
                                            if (!empty($blog->title)) {
                                                echo $blog->title;
                                            }
                                            ?>' placeholder="">   
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Posted By</label>
                                            <input type="text" class="form-control" name="posted_by"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('posted_by');
                                            }
                                            if (!empty($blog->posted_by)) {
                                                echo $blog->posted_by;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                                            <input type="text" class="form-control" name="description"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('description');
                                            }
                                            if (!empty($blog->description)) {
                                                echo $blog->description;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image</label>
                                            <input type="file" name="img_url">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($blog->id)) {
                                            echo $blog->id;
                                        }
                                        ?>'>
                                        <input type="hidden" name="date" value='<?php
                                        if (!empty($blog->id)) {
                                            echo $blog->date;
                                        }
                                        ?>'>
                                        <div class="pull-right">
                                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
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
    </div>
</div></div>
<!--main content end-->
<!--footer start-->
