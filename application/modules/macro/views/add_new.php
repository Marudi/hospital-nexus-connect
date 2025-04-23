<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php
                if (!empty($macro->id))
                    echo lang('edit_macro');
                else
                    echo lang('add_macro');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('lab'); ?></li>
                                        <li class="breadcrumb-item active"><?php
                if (!empty($macro->id))
                    echo lang('edit_macro');
                else
                    echo lang('add_macro');
                ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <div class="col-md-7">
        <section class="card">
        <div class="card-header table_header">
                                    <h4 class="card-title mb-0 col-lg-12">   <?php
                if (!empty($macro->id))
                    echo lang('edit_macro');
                else
                    echo lang('add_macro');
                ?></h4> 

                                           
                                       
                                    </div>
          
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                    <?php echo validation_errors(); ?>
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="macro/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">


                                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="short_name"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('short_name');
                                            }
                                            if (!empty($macro->short_name)) {
                                                echo $macro->short_name;
                                            }
                                            ?>' placeholder="" required>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="description"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('description');
                                            }
                                            if (!empty($macro->description)) {
                                                echo $macro->description;
                                            }
                                            ?>' placeholder="" required="">
                                        </div>
                                       

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($macro->id)) {
                                            echo $macro->id;
                                        }
                                        ?>'>


                                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                                    </form>

                                </div>
                            </section>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/macro.js"></script>
