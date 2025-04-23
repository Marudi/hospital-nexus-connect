
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('calendar'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('appointment'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('calendar'); ?></li>
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
            <link href="common/extranal/css/appointment/appointment.css" rel="stylesheet">
        <!-- <section class="panel"> -->
        <div class="card">
                                <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                       
                                           
                                        </div>
                                    </div>
           
            <div class="card-body">
                <aside>
                    <section class="card">
                        <div class="card-body">
                            <div id="calendar" class="has-toolbar calendar_view"></div>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
        </div>
        <!-- page end-->
    </div>
</div>
<!--main content end-->
<!--footer start-->
<div class="modal fade" role="dialog" id="cmodal">
    <div class="modal-dialog modal-xl med_his" role="document">
        <div class="modal-content">
        <!-- <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('patient').' '.lang('history'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div> -->
            <div class="modal-body row">
            <div id='medical_history'>
                <div class="col-md-12">

                </div>
            </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 pull-right">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>