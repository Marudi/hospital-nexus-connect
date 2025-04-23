<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Folder</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"> <?php echo lang('patient'); ?></li>
                                        <li class="breadcrumb-item active">Folder</li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
         <link href="common/extranal/css/patient/medical_history_by_folder.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
        <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                        <h4 class="card-title mb-0 col-lg-8">                <?php echo lang('patient'); ?> : <?php echo $this->patient_model->getPatientById($folder->patient)->name; ?> | <?php echo lang('folder'); ?> : <?php echo $folder->folder_name; ?>
</h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModalff"><i class="fa fa-plus-circle"></i> <?php echo lang('add_file'); ?></button>
                                           
                                        </div>
                                        <?php }else{ ?>
                                            <h4 class="card-title mb-0 col-lg-12">                <?php echo lang('patient'); ?> : <?php echo $this->patient_model->getPatientById($folder->patient)->name; ?> | <?php echo lang('folder'); ?> : <?php echo $folder->folder_name; ?>
</h4> 
                                            <?php } ?>
                                    </div>
            

            <section class="card-body folder-panel-body">   

                <div class="">

                    <div id="profile" class="tab-pane"> <div class="">
                            <div class="adv-table editable-table ">

                                <div class="col-md-12 patient_material_info">
                                    <div class="row">
                                    <?php foreach ($patient_materials as $patient_material) { ?>
                                        <div class="card col-md-3 patient_material_class1">
                                            <div class="col-md-12 patient_material_img">    
                                                <div class="post-info"> 
                                                    <a class="example-image-link" href="<?php echo $patient_material->url; ?>" data-lightbox="example-1">
                                                        <img class="example-image" src="<?php echo $patient_material->url; ?>" alt="image-1" height="90" width="100"/></a>
                                                </div>

                                                <div class="post-info patient_material_title">
                                                    <?php
                                                    if (!empty($patient_material->title)) {
                                                        echo $patient_material->title;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 patient_material_url">
                                                <div class="post-info">
                                                    <a class="btn btn-soft-info btn-xs btn_width" href="<?php echo $patient_material->url; ?>" download> <i class="fa fa-download"></i> </a>
                                                    <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="patient/deletePatientMaterialInFolder?id=<?php echo $patient_material->id; ?>"
                                                           onclick="return confirm('Are you sure you want to delete this item?');"> <i class="fa fa-trash"></i> </a>
                                                       <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>

        </section>



    </section>
    <!-- page end-->
                                                    </div>
</div>
</div>
<!--main content end-->
<div class="modal fade" id="myModalff" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast; </label>
                        <input type="text" class="form-control" name="title" placeholder="" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?> &ast; </label>
                        <input type="file" name="img_url" required>
                    </div>
                    <input type="hidden" name="hidden_folder_name" value="<?php echo $folder->folder_name; ?>" />
                    <input type="hidden" name="patient" value='<?php echo $folder->patient; ?>'>
                    <input type="hidden" name="folder" value='<?php echo $folder->id; ?>'>
                    <input type="hidden" name="type" value='doc'>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>






