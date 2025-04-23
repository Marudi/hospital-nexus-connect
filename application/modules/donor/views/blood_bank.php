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
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('blood_bank'); ?></h4> 
                                        
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th>Blood Group</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                        <?php foreach ($groups as $group) { ?>
                            <tr class="">
                                <td><?php echo $group->group; ?></td>
                                <td> <?php echo $group->status; ?> Bags</td>
                                <td>
                                    <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $group->id; ?>"><i class="fa fa-edit"></i> </button>   
                                </td>
                            </tr>
                        <?php } ?>
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








<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('update_blood_bank') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
          
            <div class="modal-body">
                <form role="form" id="editBloodBank" action="donor/updateBloodBank" method="post" enctype="multipart/form-data">
                    <div class="form-group"> 
                        <label for="exampleInputEmail1"><?php echo lang('group'); ?></label>
                        <input type="text" class="form-control" name="group"  value='' placeholder="" disabled>    
                    </div>
                    <div class="input-group m-bot15">
                    <input type="number" class="form-control" min="0" name="status"  value='' placeholder="">
                    <span class="input-group-text">Bags</span>
                    </div>
                   
                    <input type="hidden" name="id" value=''>
                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/donor/blood_bank.js"></script>