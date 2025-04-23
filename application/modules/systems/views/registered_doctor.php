<link href="common/extranal/css/systems/active_hospital.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> Registered Doctor</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('report'); ?></li>
                                        <li class="breadcrumb-item active"> Registered Doctor</li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
        <h4 class="card-title mb-0 col-lg-8"> <i class="fa fa-hospital"></i>  Registered Doctor</h4> 
        </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
       
                        <thead>
                            <tr>
                                <th><?php echo lang('doctor_id'); ?></th>                        
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('hospital'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                      

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
<script src="common/extranal/js/systems/registered_doctor.js"></script>

