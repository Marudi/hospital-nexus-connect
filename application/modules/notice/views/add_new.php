<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php
                                                                    if (!empty($notice->id))
                                                                        echo lang('edit_notice');
                                                                    else
                                                                        echo lang('add_notice');
                                                                    ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('notice'); ?></li>
                                        <li class="breadcrumb-item active"> <?php
                                                                    if (!empty($notice->id))
                                                                        echo lang('edit_notice');
                                                                    else
                                                                        echo lang('add_notice');
                                                                    ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
     
           <link href="common/extranal/css/notice/add_new.css" rel="stylesheet">
        <section class="col-md-6">
            <div class="card">
        <div class="card-header table_header">
                                    <h4 class="card-title mb-0 col-lg-12"> <?php
                if (!empty($notice->id))
                    echo lang('edit_notice');
                else
                    echo lang('add_notice');
                ?></h4> 

                                           
                                       
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <form role="form" action="notice/addNew" class="clearfix" method="post" enctype="multipart/form-data">
<div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                                <input type="text" class="form-control" name="title"  value='<?php
                                if (!empty($notice->name)) {
                                    echo $notice->name;
                                }
                                ?>' placeholder="" required="">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Notice For</label>
                                <select class="form-control m-bot15" name="type" value=''>
                                    <option value="patient" <?php
                                    if (!empty($notice->type)) {
                                        if ($notice->type == 'patient') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('patient'); ?></option>
                                    <option value="staff" <?php
                                    if (!empty($notice->type)) {
                                        if ($notice->type == 'staff') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('staff'); ?></option>

                                </select>
                            </div>

                                </div>
                            <div class="form-group col-md-12 des">
                                <label class="control-label col-md-3"><?php echo lang('description'); ?> &ast;</label>
                                <div class="col-md-12 des">
                                    <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10" required=""> </textarea>
                                </div>
                            </div>



                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                                <input type="text" class="form-control default-date-picker" name="date"  onkeypress="return false;" value='' placeholder="" required="">
                            </div>




                            <input type="hidden" name="id" value='<?php
                            if (!empty($notice->id)) {
                                echo $notice->id;
                            }
                            ?>'>

<div class="pull-right">
                            <button type="submit" name="submit" class="btn btn-soft-info waves-effect waves-light"> <?php echo lang('submit'); ?></button>
</div>
                        </form>

                    </div>
                </div>

            </div>
            </div>
        </section>
    
    </div>
    <!-- page end-->
</div>
</div>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/notice.js"></script>
