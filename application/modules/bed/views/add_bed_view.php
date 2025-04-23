<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php
                if (!empty($bed->id))
                    echo lang('edit_bed');
                else
                    echo lang('add_bed');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('bed'); ?></li>
                                        <li class="breadcrumb-item active"> <?php
                if (!empty($bed->id))
                    echo lang('edit_bed');
                else
                    echo lang('add_bed');
                ?></li>
                                     
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="col-md-6 row">
            <div class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php
                if (!empty($bed->id))
                    echo lang('edit_bed');
                else
                    echo lang('add_bed');
                ?></h4> 
                                        
                                    </div>
            
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="bed/addBed" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('bed_category'); ?> &#42;</label>
                                <select class="form-control m-bot15" name="category" value='' required="">
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category->category; ?>" <?php
                                        if (!empty($setval)) {
                                            if ($category->category == set_value('category')) {
                                                echo 'selected';
                                            }
                                        }
                                        if (!empty($bed->category)) {
                                            if ($category->category == $bed->category) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > <?php echo $category->category; ?> </option>
                                            <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('bed_number'); ?> &#42;</label>
                                <input type="text" class="form-control" name="number" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('number');
                                }
                                if (!empty($bed->number)) {
                                    echo $bed->number;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                                <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('description');
                                }
                                if (!empty($bed->description)) {
                                    echo $bed->description;
                                }
                                ?>' placeholder="" required="">
                            </div>

                            <input type="hidden" name="id" value='<?php
                            if (!empty($bed->id)) {
                                echo $bed->id;
                            }
                            ?>'>
                            <div class="form-group pull-right">
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->
