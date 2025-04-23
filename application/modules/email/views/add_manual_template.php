<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('manual'); ?> <?php echo lang('template'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('email'); ?></li>
                                        <li class="breadcrumb-item active"> <?php if (empty($id)) { ?>
                        <?php echo lang('add_new'); ?> <?php echo lang('manual'); ?> <?php echo lang('template');
                } else { ?>
                         <?php echo lang('edit'); ?> <?php echo lang('manual'); ?> <?php echo lang('template');
                } ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <div class="col-md-8">
            <section class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php if (empty($id)) { ?>
                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?> <?php echo lang('manual'); ?> <?php echo lang('template');
                } else { ?>
                        <i class="fa fa-edit"></i> <?php echo lang('edit'); ?> <?php echo lang('manual'); ?> <?php echo lang('template');
                } ?></h4> 
                                       
                                    </div>
             
                <div class="card-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <div class="panel-body">
<?php echo validation_errors(); ?>
                                        <form role="form" name="myform" action="email/addNewManualTemplate" method="post" enctype="multipart/form-data">                                                                                    

                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php echo lang('templatename'); ?> &ast; </label>
                                                <input type="text" class="form-control" name="name"  value='<?php
                                                if (!empty($templatename->name)) {
                                                    echo $templatename->name;
                                                }
                                                if (!empty($setval)) {
                                                    echo set_value('name');
                                                }
                                                ?>' placeholder="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php echo lang('message'); ?> <?php echo lang('template'); ?> &ast; </label>
                                                <?php
                                                $count = 0;
                                                foreach ($shortcode as $shortcodes) {
                                                    ?>
                                                    <input type="button" name="myBtn" value="<?php echo $shortcodes->name; ?>" onClick="addtext(this);">
                                                    <?php
                                                    $count+=1;
                                                    if ($count === 7) {
                                                        ?>
                                                        <br>
                                                        <?php
                                                    }
                                                }
                                                ?> <br><br>
                                                <textarea class="ckeditor" id="editor1" name="message" value='<?php
                                                if (!empty($templatename->message)) {
                                                    echo $templatename->message;
                                                }
                                                if (!empty($setval)) {
                                                    echo set_value('message');
                                                }
                                                ?>' cols="70" rows="10"placeholder="" required> <?php
                                                              if (!empty($templatename->message)) {
                                                                  echo $templatename->message;
                                                              }
                                                              if (!empty($setval)) {
                                                                  echo set_value('message');
                                                              }
                                                              ?></textarea>
                                            </div>
                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($templatename->id)) {
                                                echo $templatename->id;
                                            }
                                            ?>'>
                                            <input type="hidden" name="type" value='email'>
                                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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
<script src="common/extranal/js/email/add_manual_template.js"></script>