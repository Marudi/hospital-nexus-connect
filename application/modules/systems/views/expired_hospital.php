<link href="common/extranal/css/systems/active_hospital.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('license_expire_hospitals'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('report'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('license_expire_hospitals'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
        <h4 class="card-title mb-0 col-lg-8"> <i class="fa fa-hospital"></i>  <?php echo lang('license_expire_hospitals'); ?></h4> 
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
                                <th> <?php echo lang('expired_on'); ?></th>
                                <th> <?php echo lang('package'); ?></th>
                                <th> <?php echo lang('status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            if (!empty($hospitalExpiredList)) {
                                foreach ($hospitalExpiredList as $expired) {
                                    if ($expired->next_due_date_stamp < time()) {
                                        
                                        $hospital_details = $this->db->get_where('hospital', array('id' => $expired->hospital_user_id))->row();
                                        if (!empty($hospital_details)) {
                                            ?>
                                            <tr class="">
                                                <td> <?php echo $hospital_details->name; ?></td>
                                                <td><?php echo $hospital_details->email; ?></td>
                                                <td class="center"><?php echo $hospital_details->address; ?></td>
                                                <td><?php echo $hospital_details->phone; ?></td>
                                                <td><?php echo $expired->next_due_date; ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($hospital_details->package)) {
                                                        echo $this->db->get_where('package', array('id' => $hospital_details->package))->row()->name;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo lang('inactive'); ?>
                                                </td>

                                            </tr>
                                            <?php
                                        }
                                    }
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