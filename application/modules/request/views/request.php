 <link href="common/extranal/css/request/request.css" rel="stylesheet">
 <div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('hospital_registration_from_website'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('hospital_registration_from_website'); ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">     
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('hospital_registration_from_website'); ?> </h4> 
                                       
                                    </div>       
          
           

            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('title'); ?></th>
                                <th> <?php echo lang('email'); ?></th>
                                <th> <?php echo lang('address'); ?></th>
                                <th> <?php echo lang('phone'); ?></th>
                                <th> <?php echo lang('package'); ?></th>
                                <th> <?php echo lang('status'); ?></th>
                                <th class="no-print"> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                      

                        <?php
                        foreach ($requests as $request) {
                            ?>
                            <tr class="">
                                <td> <?php echo $request->name; ?></td>
                                <td><?php echo $request->email; ?></td>
                                <td class="center"><?php echo $request->address; ?></td>
                                <td><?php echo $request->phone; ?></td>
                                <td>
                                    <?php
                                    if (!empty($request->package)) {
                                        echo $this->package_model->getPackageById($request->package)->name;
                                    }
                                    ?>
                                </td>
                                <td> <?php echo $request->status; ?></td>
                                <td class="no-print">
                                    <?php
                                    $status = $this->db->get_where('request', array('id' => $request->id))->row()->status;
                                    if ($status == 'Pending') {
                                        ?>
                                        <a href="request/approve?id=<?php echo $request->id; ?>" type="button" class="btn btn-soft-info btn-xs status" data-toggle="modal" data-id="<?php echo $request->id; ?>"><?php echo lang('approve'); ?></a>  

                                    <?php }
                                    ?>
                                    <?php if ($status != 'Approved') { ?>
                                        <a class="btn btn-soft-danger btn-xs btn_width delete_button" href="request/delete?id=<?php echo $request->id; ?>" onclick="return confirm('Are you sure you want to decline this request?');"><i class="fa fa-trash"></i> <?php echo lang('decline'); ?></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
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
<script src="common/extranal/js/request/request.js"></script>