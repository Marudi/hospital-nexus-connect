<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('autoemailtemplate'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('email'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('autoemailtemplate'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
 
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('autoemailtemplate'); ?></h4> 
                                       
                                    </div>
            

            <div class="card-body">
            <div class="table-responsive adv-table">
            <table class="table mb-0" id="editable-sample1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('message'); ?></th> 
                                <th><?php echo lang('status'); ?></th>
                                <th><?php echo lang('options'); ?></th>
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
<!--main content end-->



<!-- Edit sms temp Modal-->
<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"><?php echo lang('edit'); ?> <?php echo lang('auto'); ?> <?php echo lang('template'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
         
            <div class="modal-body">
                <?php echo validation_errors(); ?>
                <form role="form" id="emailtemp" name="myform" action="email/addNewAutoEmailTemplate" method="post" enctype="multipart/form-data">                                                                                    

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                        <input type="text" class="form-control" name="category"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('message'); ?> <?php echo lang('template'); ?></label><br>
                        <div id="divbuttontag"></div>

                        <textarea class="ckeditor" name="message" id="editor1" value="" cols="70" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('status'); ?> </label>
                        <select class="form-control m-bot15" id="status1" name="status"> 
                            <option value="Active">Active </option>
                            <option value="Inactive"> Inactive </option>
                        </select> 
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="type" value='email'>
                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/email/auto_email_template.js"></script>
