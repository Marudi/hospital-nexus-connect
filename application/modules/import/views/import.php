<link href="common/extranal/css/import.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php echo lang('bulk'); ?> <?php echo lang('import'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('settings'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('import'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <div class="row">
        <section class="col-md-6">
        <div class="card">
           <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('import'); ?>  <?php echo lang('bulk'); ?> <?php echo lang('patient'); ?> <?php echo lang('import'); ?> (xl, xlsx, csv)</h4> 
                                        
                                    </div>
           
            <div class="card-body">
                <div class="col-md-12">
                    <blockquote>
                        <a href="files/downloads/patient_xl_format.xlsx"><?php echo lang('download'); ?></a> <?php echo lang('the_format_of_xl_file'); ?>.
                        <br> <?php echo lang('please_follow_the_exact_format'); ?>. 
                    </blockquote>
                </div>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" action="<?php echo site_url('import/importPatientInfo') ?>" class="clearfix" method="post" enctype="multipart/form-data"> 
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="exampleInputEmail1"> <?php echo lang('choose_file'); ?></label>
                                    <input type="file" class="form-control" placeholder="" name="filename" required accept=".xls, .xlsx ,.csv" required>
                                    <span class="glyphicon glyphicon-file form-control-feedback"></span>
                                    <input type="hidden" name="tablename"value="patient">
                                </div>

                                <section class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <div class="col-md-12">
                <?php
                $message = $this->session->flashdata('message1');
                if (!empty($message)) {
                    ?>
                    <code class="flash_message pull-right"> <?php echo $message; ?></code>
                <?php } ?> 
            </div>
                </div>
        </section>
        <section class="col-md-6">
            <div class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('bulk'); ?> <?php echo lang('doctor'); ?> <?php echo lang('import'); ?> (xl, xlsx, csv)</h4> 
                                        
                                    </div>
           
            <div class="card-body">
                <div class="col-md-12">
                    <blockquote>
                        <a href="files/downloads/doctor_xl_format.xlsx"><?php echo lang('download'); ?></a> <?php echo lang('the_format_of_xl_file'); ?>.
                        <br> <?php echo lang('please_follow_the_exact_format'); ?>. 
                    </blockquote>
                </div>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" action="<?php echo site_url('import/importDoctorInfo') ?>" class="clearfix" method="post" enctype="multipart/form-data"> 
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="exampleInputEmail1"> <?php echo lang('choose_file'); ?></label>
                                    <input type="file" class="form-control" placeholder="" name="filename" required accept=".xls, .xlsx ,.csv">
                                    <span class="glyphicon glyphicon-file form-control-feedback"></span>
                                    <input type="hidden" name="tablename"value="doctor">
                                </div>

                                <section class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <?php
                $message2 = $this->session->flashdata('message2');
                if (!empty($message2)) {
                    ?>
                    <code class="flash_message pull-right"> <?php echo $message2; ?></code>
                <?php } ?> 
            </div>



            </div>
        </section>
        <section class="col-md-6">
        <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('bulk'); ?> <?php echo lang('medicine'); ?> <?php echo lang('import'); ?> (xl, xlsx, csv) (xl, xlsx, csv)</h4> 
                                        
                                    </div>
        
            <div class="card-body">
                <div class="col-md-12">
                    <blockquote>
                        <a href="files/downloads/medicine_xl_format.xlsx"><?php echo lang('download'); ?></a> <?php echo lang('the_format_of_xl_file'); ?>.
                        <br> <?php echo lang('please_follow_the_exact_format'); ?>. 
                    </blockquote>
                </div>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" action="<?php echo site_url('import/importMedicineInfo') ?>" class="clearfix" method="post" enctype="multipart/form-data"> 
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="exampleInputEmail1"> <?php echo lang('choose_file'); ?></label>
                                    <input type="file" class="form-control" placeholder="" name="filename" required accept=".xls, .xlsx ,.csv" required="">
                                    <span class="glyphicon glyphicon-file form-control-feedback"></span>
                                    <input type="hidden" name="tablename"value="medicine">
                                </div>

                                <section class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <?php
                $message3 = $this->session->flashdata('message3');
                if (!empty($message3)) {
                    ?>
                    <code class="flash_message pull-right"> <?php echo $message3; ?></code>
                <?php } ?> 
            </div>
        </div>
        </section>
                        </div>
    </div>
</div>
</div>









