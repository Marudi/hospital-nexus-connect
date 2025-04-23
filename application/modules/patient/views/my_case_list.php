<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">  <?php echo lang('my'); ?> <?php echo lang('cases'); ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"> <?php echo lang('patient'); ?></li>
                                        <li class="breadcrumb-item active">  <?php echo lang('my'); ?> <?php echo lang('cases'); ?> </li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
         <link href="common/extranal/css/patient/my_case_list.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('my'); ?> <?php echo lang('cases'); ?> </h4> 
                                      
                                    </div>
           
          
            <div class="card-body"> 
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th class="id_table"><?php echo lang('id'); ?></th>
                                <th class="id_table1"><?php echo lang('case'); ?> <?php echo lang('title'); ?></th>
                                <th  class="id_table2"><?php echo lang('case'); ?></th> 
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($medical_histories as $medical_history) { ?>
                                <?php $patient_info = $this->db->get_where('patient', array('id' => $medical_history->patient_id))->row(); ?>

                                <tr class="">

                                    <td>
                                        <?php
                                        echo $medical_history->id;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $medical_history->title;
                                        ?>
                                    </td>

                                    <td><?php
                                        if (!empty($medical_history->description)) {
                                            echo $medical_history->description;
                                        }
                                        ?></td>

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





<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/patient/my_case_list.js"></script>