<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('salary'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('salary'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                                    <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('salary'); ?></h4> 
                                        
                                    </div>
           
                                    <div class="card-body">
                                        <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="salary-sample">
                                                    <!-- <table class="table table-striped table-hover table-bordered w-100" id="salary-sample"> -->
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo lang('staff'); ?></th>
                                                                <th><?php echo lang('salary'); ?></th>
                                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php for ($i = 0; $i < $total; $i++) { ?>
                                                                <tr>
                                                                    <td><?php echo $employee[$i]['staff']; ?></td>
                                                                    <td><?php echo $employee[$i]['salary']; ?></td>
                                                                    <td><?php echo $employee[$i]['options']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                        </div>
                                    </div>
                        </div>
        </div>
        <!-- page end-->
    </div>
</div>


<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title"> <?php echo lang('salary'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <form role="form" id="salaryForm" action="payroll/addEditSalary" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('salary'); ?> &ast;</label>
                        <input type="text" class="form-control" name="salary" id="exampleInputEmail1" value='' placeholder="Enter Salary Amount" required>
                    </div>

                    <input type="hidden" name="staff">

                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->






<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/payroll/salary.js"></script>