<!-- <link href="common/extranal/css/pgateway.css" rel="stylesheet"> -->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('payment_gateways'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('settings'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('payment_gateways'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <div class="row">
        <section class="col-md-7 row"> 
        <div class="card">
           <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('payment_gateways'); ?></h4> 
                                        
                                    </div>
            
            <div class="card-body">
            <div class="table-responsive adv-table">
                        <table class="table mb-0" id="editable-sample1">
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
                            foreach ($pgateways as $pgateway) {
                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td><?php echo $i; ?></td>
                                    <td><?php
                                        if (!empty($pgateway->name)) {
                                            echo $pgateway->name;
                                        }
                                        ?></td>

                                    <td>
                                        <a class="btn btn-soft-info waves-effect waves-light btn-xs" href="pgateway/settings?id=<?php echo $pgateway->id; ?>">   <?php echo lang('manage'); ?></a>
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
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('select'); ?> <?php echo lang('payment_gateway'); ?> </h4> 
                                        
                                    </div>
          
            <div class="card-body">
                <form role="form" id="editAppointmentForm" action="settings/selectPaymentGateway" class="clearfix" method="post" enctype="multipart/form-data">

                   
                        <?php foreach ($pgateways as $pgateway) { ?>

                            <div class="form-group mb-3">
                                        <input class="form-check-input" type="radio" name="payment_gateway" id="exampleInputEmail1" value='<?php echo $pgateway->name; ?>' placeholder="" <?php
                                if (!empty($pgateway->name)) {
                                    if ($settings->payment_gateway == $pgateway->name) {
                                        echo 'checked';
                                    }
                                }
                                ?>>
                                        <label class="form-check-label" for="formRadios1">
                                        <?php echo $pgateway->name; ?>
                                                        </label>
                                                    </div>
                             
                        <?php } ?>
                  

                    <input type="hidden" name="id" value="<?php echo $settings->id; ?>">

                    <div class="modal-footer">
                        <div class="col-md-12 pull-right">
                            <button type="submit" name="submit2" id="submit1" class="btn btn-info submit_button"> <?php echo lang('submit'); ?></button>
                        </div>
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

<script src="common/extranal/js/pgateway.js"></script>
