  <link href="common/extranal/css/finance/payment_category.css" rel="stylesheet">
  <div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo lang('payment_procedures'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active"><?php echo lang('payment_procedures'); ?></li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8">  <?php echo lang('payment_procedures'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <a href="finance/addPaymentCategoryView" class="btn btn-primary waves-effect waves-light w-xs" ><i class="fa fa-plus-circle"></i> <?php echo lang('create_payment_procedure'); ?></a>
                                           
                                        </div>
                                    </div>
          
            <div class="card-body">
                <div class="adv-table editable-table "> 
                <div class="row" style="margin-top: 10px;">
                     
                        <div class="col-md-4">
                            <select class="form-control category js-example-basic-single">
                                <option value="all"><?php echo lang('all'); ?></option>
                                <?php foreach ($paycategories as $paycategory) { ?>
                                <option value="<?php echo $paycategory->id; ?>"><?php echo $paycategory->category; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                 
                    <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('code'); ?></th>
                               
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('service_point'); ?></th>
                                <th><?php echo lang('category'); ?>
                                <th><?php echo lang('category'); ?> <?php echo lang('price'); ?> ( <?php echo $settings->currency; ?> )</th>
                                <th><?php echo lang('doctors_commission'); ?></th>
                                <th><?php echo lang('type'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                <?php } ?>
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
<!-- Add Patient Modal-->
<style>
    .ck-editor__editable:not(.ck-editor__nested-editable) { 
    min-height: 400px !important;
}
</style>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title"><?php echo lang('add_template'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         
            <div class="modal-body row">
                <form role="form" id="addTemplate" action="finance/addPaymentProccedureTemplate" class="clearfix" method="post" enctype="multipart/form-data">
              
                <div class="form-group">
                    <label class="control-label"><?php echo lang('template'); ?></label>
                    <textarea class="form-control ckeditor" id="editor1" name="report" value="" rows="50" cols="20"></textarea>
                </div>
                  
                <input type="hidden" name="id">

                <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script defer type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script>
<script src="common/extranal/js/finance/payment_category.js"></script>
