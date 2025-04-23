<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/patient/documents.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('patient'); ?>  <?php echo lang('documents'); ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('patient'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('documents'); ?></li>
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                                    <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('patient'); ?>  <?php echo lang('documents'); ?> </h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal1"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                                           
                                        </div>
                                    </div>
            
                                    <div class="card-body">  
                                        <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                            <thead>
                                <tr>
                                    <th><?php echo lang('date'); ?></th>
                                    <th><?php echo lang('patient'); ?></th>
                                    <th><?php echo lang('description'); ?></th>
                                    <th class="document_table"><?php echo lang('document'); ?></th>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

       
        <!-- page end-->
</div>
</div>
</div>

<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast; </label>
                        <select class="form-control m-bot15" id="patientchoose" name="patient" value='' required="">
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                        <input type="text" class="form-control" name="title"  placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?> &ast;</label>
                        <input type="file" name="img_url" required="">
                        <span class="help-block"><?php echo lang('recommended_size'); ?> : 3000 x 2024</span>
                    </div>
                    <input type="hidden" name="redirect" value='patient/documents'>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/patient/documents.js"></script>

