<link href="common/extranal/css/sms/sgateway.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('sms_gateways'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('sms'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('sms_gateways'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <div class="row">
        <section class="col-md-7"> 
            <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('sms_gateways'); ?></h4> 
                                       
                                    </div>
          
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            $i = 0;
                            foreach ($sgateways as $sgateway) {
                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td><?php echo $i; ?></td>
                                    <td><?php
                                        if (!empty($sgateway->name)) {
                                            echo $sgateway->name;
                                        }
                                        ?></td>

                                    <td>
                                        <a class="btn btn-soft-info btn-xs btn_width" href="sms/settings?id=<?php echo $sgateway->id; ?>">  <i class="fa fa-"> </i> <?php echo lang('manage'); ?></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </section>


        <section class="col-md-5"> 
        <div class="card">
            
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">   <?php echo lang('select'); ?> <?php echo lang('sms_gateway'); ?> </h4> 
                                       
                                    </div>
          
            <div class="card-body">
                <form role="form" id="editAppointmentForm" action="settings/selectSmsGateway" class="clearfix" method="post" enctype="multipart/form-data">

                   
                        <?php foreach ($sgateways as $sgateway) { ?>
                             <div class="form-group">
                                <input type="radio" class=""  readonly="" name="sms_gateway" id="exampleInputEmail1" value='<?php echo $sgateway->name; ?>' placeholder="" <?php
                                if (!empty($sgateway->name)) {
                                    if ($settings->sms_gateway == $sgateway->name) {
                                        echo 'checked';
                                    }
                                }
                                ?>> <?php echo $sgateway->name; ?>
                             </div>
                        <?php } ?>
                  

                    <input type="hidden" name="id" value="<?php echo $settings->id; ?>">

                    <div class="col-md-12 panel pull-right">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
        </section>
    </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->






<script src="common/js/codearistos.min.js"></script>

<script src="common/extranal/js/sms/settings.js"></script>
