<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('diagnostic'); ?> <?php echo lang('report'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"> <?php echo lang('patient'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('diagnostic'); ?> <?php echo lang('report'); ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
         <link href="common/extranal/css/patient/diagnostic_report.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('diagnostic'); ?> <?php echo lang('report'); ?> </h4> 
                                      
                                    </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('invoice_id'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('patient_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('diagnostic_test'); ?></th>
                                <th class="option_th no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>



                        <?php foreach ($payments as $payment) { ?>
                            <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                            <tr class="">


                                <td>
                                    <?php
                                    echo $payment->id;
                                    ?>
                                </td>

                                <td><?php echo date('d/m/y', $payment->date); ?></td>

                                <td>
                                    <?php
                                    if (!empty($patient_info)) {
                                        echo $patient_info->id;
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if (!empty($patient_info)) {
                                        echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if (!empty($payment->category_name)) {
                                        $category_name = $payment->category_name;
                                        $category_name1 = explode(',', $category_name);
                                        foreach ($category_name1 as $category_name2) {
                                            $category_name3 = explode('*', $category_name2);
                                            if ($category_name3[1] > 0) {
                                                if ($category_name3[2] == 'diagnostic') {
                                                    ?>                

                                                    <div><?php echo $category_name3[0]; ?> </div><br>

                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>

                                </td>


                                <td class="no-print"> 
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist', 'Nurse', 'Patient'))) { ?>
                                        <a class="btn btn-soft-info btn-xs editbutton" title="<?php echo lang('edit'); ?>" href="patient/report?id=<?php echo $payment->id; ?>"><i class="fa fa-eye"> <?php echo lang('details'); ?> </i></a>
                                    <?php } ?>
                                    </button>
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




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/patient/diagnostic_report.js"></script>