<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Payment Type</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active">Payment Type</li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">   <?php echo $patient->name; ?></h4> 
                                      
                                    </div>
         
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="card">
                                <div class="card-body">
                                     <link href="common/extranal/css/finance/choose_payment_type.css" rel="stylesheet">
                                    <?php echo $this->session->flashdata('feedback'); ?>
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <a href="finance/addPaymentByPatientView?id=<?php echo $patient->id;?>&type=gen">
                                            <div class="col-lg-3">
                                                <div class="flat-carousal">
                                                    <div id="owl-demo" class="owl-carousel owl-theme">
                                                       <?php echo lang('add_general_payment'); ?> <i id="add_ot" class="fa fa-arrow-circle-o-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="finance/addPaymentByPatientView?id=<?php echo $patient->id;?>&type=ot">
                                            <div class="col-lg-3">
                                                <div class="flat-carousal">
                                                    <div id="owl-demo" class="owl-carousel owl-theme">
                                                        <?php echo lang('add_ot_payment'); ?> <i id="add_ot" class="fa fa-arrow-circle-o-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="col-lg-3"></div>
                                    </div>





                                </div>
                        </div>
                        </section>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- page end-->
        </div>
</div></div>
<!--main content end-->
<!--footer start-->
