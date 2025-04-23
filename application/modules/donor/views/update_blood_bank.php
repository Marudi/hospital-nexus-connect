<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('blood_bank'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('donor'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('blood_bank'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <div class="col-md-6">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('edit_blood_quantity'); ?></h4> 
                                        
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <form role="form" action="donor/updateBloodBank" method="post" enctype="multipart/form-data">
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"><?php echo lang('group'); ?></label>
                                            <input type="text" class="form-control" name="group"  value='<?php
                                            if (!empty($donor->group)) {
                                                echo $donor->group;
                                            }
                                            ?>' placeholder="" disabled>    
                                        </div>
                                        <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                                        <div class="input-group m-bot15">
                                            <input type="number" class="form-control" name="status"   value='<?php
                                            if (!empty($donor->status)) {
                                                echo $donor->status;
                                            }
                                            ?>' placeholder="" required>
                                            <span class="input-group-text">Bags</span>
                                            </div>
                                        <!-- <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                                            <input type="text" class="form-control" name="status"  value='<?php
                                            if (!empty($donor->status)) {
                                                echo $donor->status;
                                            }
                                            ?>' placeholder="" required="">
                                        </div> -->
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($donor->id)) {
                                            echo $donor->id;
                                        }
                                        ?>'>
                                        <div class="pull-right" style="padding-top: 1%;">
                                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                        </div>
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
