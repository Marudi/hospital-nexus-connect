<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">   <?php
                if (!empty($template->id))
                    echo lang('edit') . ' ' . lang('template');
                else
                    echo lang('add') . ' ' . lang('template');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('lab'); ?></li>
                                        <li class="breadcrumb-item active">   <?php
                if (!empty($template->id))
                    echo lang('edit') . ' ' . lang('template');
                else
                    echo lang('add') . ' ' . lang('template');
                ?></li>
                                       
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
          <link href="common/extranal/css/lab/add_template.css" rel="stylesheet">
          <div class="col-md-7">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">    <?php
                if (!empty($template->id))
                    echo lang('edit_lab_report') . ' ' . lang('template');
                else
                    echo lang('add_lab_report') . ' ' . lang('template');
                ?></h4> 
                                    
                                    </div>
          
            <div class="no-print card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        

                        <form role="form" id="editLabForm" class="clearfix" action="lab/addTemplate" method="post" enctype="multipart/form-data">
                            <div class="col-md-12 lab pad_bot row">
                                <div class="col-md-3 lab_label"> 
                                    <label for="exampleInputEmail1"> <?php echo lang('template'); ?> <?php echo lang('name'); ?> &ast; </label>
                                </div>
                                <div class="col-md-9"> 
                                    <input type="text" class="form-control pay_in" name="name" value='<?php
                                    if (!empty($template->name)) {
                                        echo $template->name;
                                    }
                                    ?>' placeholder="" required="">
                                </div>
                            </div>
                            
                            <div class="col-md-12 lab pad_bot row">
                                <div class="col-md-3 lab_label"> 
                                    <label for="exampleInputEmail1"> <?php echo lang('category'); ?> &ast; </label>
                                </div>
                                <div class="col-md-9"> 
                                    <select class="form-control category" name="category_id" required>
                                            <option value=""><?php echo "Select"; ?></option>
                                            <?php foreach ($categories as $category) { ?>
                                            <option value="<?php echo $category->id; ?>" <?php
                                    if (!empty($template->name) && ($template->category_id == $category->id)) {
                                        ?>
                                                    selected
                                            <?php
                                    }
                                    ?>><?php echo $category->category; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12 lab pad_bot row">
                                <div class="col-md-3"> 
                                    <label for="exampleInputEmail1"> <?php echo lang('template'); ?>  &ast; </label>
                                </div>
                                <div class="col-md-9"> 
                                    <textarea class="ckeditor form-control" id="editor" name="template" value="" rows="10" required=""><?php
                                        if (!empty($setval)) {
                                            echo set_value('template');
                                        }
                                        if (!empty($template->template)) {
                                            echo $template->template;
                                        }
                                        ?>
                                    </textarea>
                                </div>
                            </div>

                            <input type="hidden" name="id" value='<?php
                            if (!empty($template->id)) {
                                echo $template->id;
                            }
                            ?>'>


                            <div class="col-md-12 pull-right"> 
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>


           
        </section>
        </div>
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/lab/add_template_view.js"></script>