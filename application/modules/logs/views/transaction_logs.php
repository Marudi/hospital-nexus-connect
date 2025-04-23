<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('transaction_logs'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('logs'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('transaction_logs'); ?></li>
                                        
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                                <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('transaction_logs'); ?></h4> 
                                        
                                    </div>
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('date-time'); ?></th>
                                <th><?php echo lang('invoice'); ?> <?php echo lang('id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('deposit_type'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                                <th><?php echo lang('created_by'); ?></th>
                                <th><?php echo lang('action'); ?></th> 
                               
                              
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
<!--main content end-->
<!--footer start-->
<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/transaction.js"></script>
