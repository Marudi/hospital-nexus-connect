
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
        <!-- page start-->
          <link href="common/extranal/css/appointment/appointment.css" rel="stylesheet">
          <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('my_appointments'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('my_appointments'); ?></li>
                                        
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                                <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('my_appointments'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right custom_buttons"> 
                                       
                                           
                                        </div>
                                    </div>
          
            <div class="card-body">
                            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample1">
                        <thead>
                            <tr>
                                <th> <?php echo lang('id'); ?></th>
                                <th> <?php echo lang('doctor'); ?></th>
                                <th> <?php echo lang('date-time'); ?></th>
                                <th> <?php echo lang('remarks'); ?></th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php
                        foreach ($appointments as $appointment) {
                            if ($user_id == $appointment->patient) {
                                ?>

                                <tr class="">
                                    <td><?php echo $appointment->id; ?></td>
                                    <td> <?php echo $this->db->get_where('doctor', array('id' => $appointment->doctor))->row()->name; ?></td>
                                    <td> <?php echo date('d-m-Y', $appointment->date); ?> => <?php echo $appointment->time_slot; ?></td>
                                    <td><?php echo $appointment->remarks; ?></td>

                                </tr>
                                <?php
                            }
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <!-- page end-->
    </div>
</div>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script type="text/javascript">var language = <?php echo $this->language; ?>;</script>

<script src="common/extranal/js/appointment/appointment.js"></script>