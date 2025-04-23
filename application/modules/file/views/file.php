<link href="common/extranal/css/file/file.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('file_manager'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                      
                                        <li class="breadcrumb-item active"><?php echo lang('file_manager'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('file_manager'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                            <a class="btn btn-primary waves-effect waves-light w-xs" href="file/addNewView">
                                            <i class="fa fa-plus-circle"></i> <?php echo lang('add_file'); ?>
                                            </a>
                                       
                                           
                                        </div>
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('title'); ?></th>
                                <th> <?php echo lang('file'); ?></th>

                                <th> <?php echo lang('options'); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                      

                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <?php
                            foreach ($files as $file) {
                                
                                    ?>
                                    <tr class="">
                                        <td> <?php echo $file->title; ?></td>
                                        <td><img src="<?php echo $file->img_url; ?>" width="100px"></td>
                                        <td>
                                            <a class="btn btn-soft-info btn-xs btn_width" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                
                            }
                            ?>
                        <?php } ?>   
                        <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                            <?php
                            foreach ($files as $file) {
                                $modules = explode(',', $file->module);
                                if (in_array('doctor', $modules)) {
                                    ?>
                                    <tr class="">
                                        <td> <?php echo $file->title; ?></td>
                                        <td><img class="img_src_class" src="<?php echo $file->img_url; ?>" ></td>
                                        <td>
                                            <a class="btn btn-soft-info btn-xs btn_width" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        <?php } ?>  
                        <?php if ($this->ion_auth->in_group(array('Nurse'))) { ?>
                            <?php
                            foreach ($files as $file) {
                                $modules = explode(',', $file->module);
                                if (in_array('nurse', $modules)) {
                                    ?>
                                    <tr class="">
                                        <td> <?php echo $file->title; ?></td>
                                        <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                        <td>
                                            <a class="btn btn-soft-info btn-xs btn_width" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        <?php } ?>  
                        <?php if ($this->ion_auth->in_group(array('Accountant'))) { ?>
                            <?php
                            foreach ($files as $file) {
                                $modules = explode(',', $file->module);
                                if (in_array('accountant', $modules)) {
                                    ?>
                                    <tr class="">
                                        <td> <?php echo $file->title; ?></td>
                                        <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                        <td>
                                            <a class="btn btn-soft-info btn-xs btn_width" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        <?php } ?>  
                        <?php if ($this->ion_auth->in_group(array('Pharmacist'))) { ?>
                            <?php
                            foreach ($files as $file) {
                                $modules = explode(',', $file->module);
                                if (in_array('pharmacist', $modules)) {
                                    ?>
                                    <tr class="">
                                        <td> <?php echo $file->title; ?></td>
                                        <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                        <td>
                                            <a class="btn btn-soft-info btn-xs btn_width" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        <?php } ?>  
                        <?php if ($this->ion_auth->in_group(array('Laboratorist'))) { ?>
                            <?php
                            foreach ($files as $file) {
                                $modules = explode(',', $file->module);
                                if (in_array('laboratorist', $modules)) {
                                    ?>
                                    <tr class="">
                                        <td> <?php echo $file->title; ?></td>
                                        <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                        <td>
                                            <a class="btn btn-soft-info btn-xs btn_width" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        <?php } ?>  
                        <?php if ($this->ion_auth->in_group(array('Receptionist'))) { ?>
                            <?php
                            foreach ($files as $file) {
                                $modules = explode(',', $file->module);
                                if (in_array('receptionist', $modules)) {
                                    ?>
                                    <tr class="">
                                        <td> <?php echo $file->title; ?></td>
                                        <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                        <td>
                                            <a class="btn btn-soft-info btn-xs btn_width" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
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


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/file.js"></script>
