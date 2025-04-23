 <link href="common/extranal/css/systems/active_hospital.css" rel="stylesheet">
 <div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('active_hospitals'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('report'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('active_hospitals'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
        <h4 class="card-title mb-0 col-lg-8"> <i class="fa fa-hospital"></i>  <?php echo lang('active_hospitals'); ?></h4> 
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
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                         if(!empty($hospitals)){
                             foreach($hospitals as $hospitals){
                        // for($id = 0;  $id < count($hospitals); $id++) {
                            ?>
                            <tr class="">
                                <td> <?php echo $hospitals->name; ?></td>
                                <td><?php echo $hospitals->email; ?></td>
                                <td class="center"><?php echo $hospitals->address; ?></td>
                                <td><?php echo $hospitals->phone; ?></td>
                                <td>
                                    <?php
                                    if (!empty($hospitals->package)) {
                                        echo $this->db->get_where('package', array('id'  => $hospitals->package))->row()->name;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo lang('active'); ?>
                                </td>
                                
                            </tr>
                            <?php
                        }
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
<script src="common/extranal/js/systems/systems.js"></script>
