<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
    $doctordetails = $this->db->get_where('doctor', array('id' => $doctor_id))->row();
}
?>


<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">  <?php
                if (!empty($prescription->id))
                    echo lang('edit_prescription');
                else
                    echo lang('add_prescription');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('prescription'); ?></li>
                                        <li class="breadcrumb-item active">  <?php
                if (!empty($prescription->id))
                    echo lang('edit_prescription');
                else
                    echo lang('add_prescription');
                ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
         <!-- <link href="common/extranal/css/prescription/add_new_prescription_view.css" rel="stylesheet"> -->
         <div class="row">
            <section class="col-md-8">
                <div class="card">
                <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php
                if (!empty($prescription->id))
                    echo lang('edit_prescription');
                else
                    echo lang('add_prescription');
                ?></h4> 
                                       
                                    </div>
        
            <div class="card-body col-md-12">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="prescription/addNewPrescription" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm border-0 mb-4">
                                            <div class="card-body">
                                                <!-- Basic Information -->
                                                <div class="row mb-5">
                                                    <div class="col-12 mb-4">
                                                        <h3 class="border-bottom border-primary pb-3 text-uppercase font-weight-900">
                                                            <i class="fas fa-info-circle mr-3 text-primary"></i><?php echo lang('basic_information'); ?>
                                                        </h3>
                                                    </div>

                                                    <div class="col-md-12 mb-4">
                                                        <div class="form-group">
                                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('date'); ?> <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-lg shadow-sm default-date-picker" autocomplete="off" name="date" value='<?php
                                                                                                                                                                                        if (!empty($setval)) {
                                                                                                                                                                                            echo set_value('date');
                                                                                                                                                                                        }
                                                                                                                                                                                        if (!empty($prescription->date)) {
                                                                                                                                                                                            echo date('d-m-Y', $prescription->date);
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo date('d-m-Y');
                                                                                                                                                                                        }
                                                                                                                                                                                        ?>' required="">
                                                        </div>
                                                    </div>

                                                    <?php if (!$this->ion_auth->in_group('Doctor')) { ?>
                                                        <div class="col-md-12 mb-4">
                                                            <div class="form-group">
                                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('doctor'); ?> <span class="text-danger">*</span></label>
                                                                <select class="form-control form-control-lg shadow-sm" id="doctorchoose" name="doctor" required>
                                                                    <?php if (!empty($prescription->doctor)) { ?>
                                                                        <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctors->id; ?>)</option>
                                                                    <?php } ?>
                                                                    <?php
                                                                    if (!empty($setval)) {
                                                                        $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                                                    ?>
                                                                        <option value="<?php echo $doctordetails1->id; ?>" selected="selected"><?php echo $doctordetails1->name; ?> -(<?php echo lang('id'); ?> : <?php echo $doctordetails1->id; ?>)</option>
                                                                    <?php }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="col-md-12 mb-4">
                                                            <div class="form-group">
                                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('doctor'); ?></label>
                                                                <?php if (!empty($prescription->doctor)) { ?>
                                                                    <select class="form-control form-control-lg shadow-sm" name="doctor">
                                                                        <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctors->id; ?>)</option>
                                                                    </select>
                                                                <?php } else { ?>
                                                                    <select class="form-control form-control-lg shadow-sm" id="doctorchoose1" name="doctor">
                                                                        <?php if (!empty($prescription->doctor)) { ?>
                                                                            <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctors->id; ?>)</option>
                                                                        <?php } ?>
                                                                        <?php if (!empty($doctordetails)) { ?>
                                                                            <option value="<?php echo $doctordetails->id; ?>" selected="selected"><?php echo $doctordetails->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctordetails->id; ?>)</option>
                                                                        <?php } ?>
                                                                        <?php
                                                                        if (!empty($setval)) {
                                                                            $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                                                        ?>
                                                                            <option value="<?php echo $doctordetails1->id; ?>" selected="selected"><?php echo $doctordetails1->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctordetails->id; ?>)</option>
                                                                        <?php }
                                                                        ?>
                                                                    </select>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="col-md-12 mb-4">
                                                        <div class="form-group">
                                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('patient'); ?> <span class="text-danger">*</span></label>
                                                            <select class="form-control form-control-lg shadow-sm" id="patientchoose" name="patient" required="">
                                                                <?php if (!empty($prescription->patient)) {
                                                                    if (empty($patients->age)) {
                                                                        $dateOfBirth = $patients->birthdate;
                                                                        if (empty($dateOfBirth)) {
                                                                            $age[0] = '0';
                                                                        } else {
                                                                            $today = date("Y-m-d");
                                                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                                            $age[0] = $diff->format('%y');
                                                                        }
                                                                    } else {
                                                                        $age = explode('-', $patients->age);
                                                                    }
                                                                ?>
                                                                    <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> ( <?php echo lang('id'); ?>: <?php echo $patients->id; ?> - <?php echo lang('phone'); ?>: <?php echo $patients->phone; ?> - <?php echo lang('age'); ?>: <?php echo $age[0]; ?> ) </option>
                                                                <?php } ?>
                                                                <?php
                                                                if (!empty($setval)) {
                                                                    $patientdetails = $this->db->get_where('patient', array('id' => set_value('patient')))->row();
                                                                    if (empty($patientdetails->age)) {
                                                                        $dateOfBirth = $patientdetails->birthdate;
                                                                        if (empty($dateOfBirth)) {
                                                                            $age[0] = '0';
                                                                        } else {
                                                                            $today = date("Y-m-d");
                                                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                                            $age[0] = $diff->format('%y');
                                                                        }
                                                                    } else {
                                                                        $age = explode('-', $patientdetails->age);
                                                                    }
                                                                ?>
                                                                    <option value="<?php echo $patientdetails->id; ?>" selected="selected"><?php echo $patientdetails->name; ?> ( <?php echo lang('id'); ?>: <?php echo $patientdetails->id; ?> - <?php echo lang('phone'); ?>: <?php echo $patientdetails->phone; ?> - <?php echo lang('age'); ?>: <?php echo $age[0]; ?> ) </option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-4">
                                                        <div class="form-group">
                                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('history'); ?></label>
                                                            <textarea class="form-control shadow-sm" id="editor1" name="symptom" rows="3"><?php
                                                                                                                                            if (!empty($setval)) {
                                                                                                                                                echo set_value('symptom');
                                                                                                                                            }
                                                                                                                                            if (!empty($prescription->symptom)) {
                                                                                                                                                echo $prescription->symptom;
                                                                                                                                            }
                                                                                                                                            ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-4">
                                                        <div class="form-group">
                                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('note'); ?></label>
                                                            <textarea class="form-control shadow-sm ckeditor" id="editor2" name="note" rows="3"><?php
                                                                                                                                                if (!empty($setval)) {
                                                                                                                                                    echo set_value('note');
                                                                                                                                                }
                                                                                                                                                if (!empty($prescription->note)) {
                                                                                                                                                    echo $prescription->note;
                                                                                                                                                }
                                                                                                                                                ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-4">
                                                        <div class="form-group">
                                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('advice'); ?></label>
                                                            <textarea class="form-control shadow-sm ckeditor" id="editor3" name="advice" rows="3"><?php
                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                        echo set_value('advice');
                                                                                                                                                    }
                                                                                                                                                    if (!empty($prescription->advice)) {
                                                                                                                                                        echo $prescription->advice;
                                                                                                                                                    }
                                                                                                                                                    ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm border-0">
                                            <div class="card-body">


                                                <!-- Medicine Information -->
                                                <div class="row mb-5">
                                                    <div class="col-12 mb-4">
                                                        <h3 class="border-bottom border-danger pb-3 text-uppercase font-weight-900">
                                                            <i class="fas fa-pills mr-3 text-danger"></i><?php echo lang('medicine_information'); ?>
                                                        </h3>

                                                    </div>

                                                    <div class="col-md-12 medicine_block">
                                                        <div class="form-group">
                                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('medicine'); ?></label>
                                                            <div class="medicine_div">
                                                                <?php if (empty($prescription->medicine)) { ?>
                                                                    <select class="form-control form-control-lg shadow-sm medicinee" id="my_select1_disabled" name="category">
                                                                    </select>
                                                                <?php } else { ?>
                                                                    <select name="category" class="form-control form-control-lg shadow-sm medicinee" multiple="multiple" id="my_select1_disabled">
                                                                        <?php
                                                                        if (!empty($prescription->medicine)) {
                                                                            $prescription_medicine = explode('###', $prescription->medicine);
                                                                            foreach ($prescription_medicine as $key => $value) {
                                                                                $prescription_medicine_extended = explode('***', $value);
                                                                                $medicine = $this->medicine_model->getMedicineById($prescription_medicine_extended[0]);
                                                                        ?>
                                                                                <option value="<?php echo $medicine->id . '*' . $medicine->name; ?>" <?php echo 'data-dosage="' . $prescription_medicine_extended[1] . '"' . 'data-frequency="' . $prescription_medicine_extended[2] . '"data-days="' . $prescription_medicine_extended[3] . '"data-instruction="' . $prescription_medicine_extended[4] . '"'; ?> selected="selected">
                                                                                    <?php echo $medicine->name; ?>
                                                                                </option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                <?php } ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 medicine_block mt-4">
                                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('selected'); ?> <?php echo lang('medicine'); ?></label>
                                                            <div class="medicine row"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="admin" value='admin'>
                                                <input type="hidden" name="id" value='<?php
                                                                                        if (!empty($prescription->id)) {
                                                                                            echo $prescription->id;
                                                                                        }
                                                                                        ?>'>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex gap-2 justify-content-end">
                                                            <button type="submit" name="submit" class="btn btn-primary btn-lg px-4">
                                                                <i class="fas fa-save mr-2"></i>
                                                                <?php echo $prescription->id ? lang('update') : lang('submit'); ?>
                                                            </button>
                                                            <a href="prescription/viewPrescription?id=<?php echo $prescription->id; ?>" type="button" class="btn btn-outline-primary btn-lg px-4" id="print">
                                                                <i class="fas fa-print mr-2"></i>
                                                                <?php echo lang('print'); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            </div>
        </section>

            <!-- Drug Interactions Warning Column -->
            <?php if (!empty($interactions)): ?>
            <section class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0"><?php echo lang('drug_interactions'); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger mb-4">
                            <h5 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> <?php echo lang('drug_interactions_found'); ?></h5>
                            <?php foreach ($interactions['interactions'] as $interaction): ?>
                                <div class="interaction-item mb-3 p-3 border-bottom">
                                    <strong class="d-block mb-2"><?php echo $interaction['medicines'][0] . ' + ' . $interaction['medicines'][1]; ?></strong>
                                    <p class="mb-2"><?php echo $interaction['interaction']; ?></p>
                                    <small class="text-muted">Source: <?php echo $interaction['source']; ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if (!empty($interactions['warnings'])): ?>
                        <div class="alert alert-warning mb-4">
                            <h5 class="alert-heading"><i class="fa fa-exclamation-circle"></i> <?php echo lang('individual_drug_warnings'); ?></h5>
                            <?php foreach ($interactions['warnings'] as $warning): ?>
                                <div class="warning-item mb-3 p-3 border-bottom">
                                    <strong class="d-block mb-2"><?php echo $warning['medicine']; ?></strong>
                                    <?php if (!empty($warning['warnings']['boxed_warnings'])): ?>
                                        <div class="boxed-warning mb-2">
                                            <h6 class="text-danger"><?php echo lang('boxed_warnings'); ?></h6>
                                            <p><?php echo $warning['warnings']['boxed_warnings'][0]; ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($warning['warnings']['warnings'])): ?>
                                        <div class="general-warning mb-2">
                                            <h6><?php echo lang('warnings'); ?></h6>
                                            <p><?php echo $warning['warnings']['warnings'][0]; ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($warning['warnings']['precautions'])): ?>
                                        <div class="precautions mb-2">
                                            <h6><?php echo lang('precautions'); ?></h6>
                                            <p><?php echo $warning['warnings']['precautions'][0]; ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <small class="text-muted">Source: <?php echo $warning['source']; ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>
            <!-- End Drug Interactions Warning Column -->

            <!-- Drug Interaction Details Container -->
            <section class="col-md-4">
                <div class="card" id="interaction_details">
                    <div class="card-header">
                        <h4 class="card-title mb-0"><?php echo lang('drug_interactions'); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info d-none" id="drug_interaction_alert">
                            <h5 class="alert-heading"><i class="fa fa-info-circle"></i> <?php echo lang('select_medicines_to_check_interactions'); ?></h5>
                            <div id="drug_interaction_results"></div>
                        </div>
                        <div id="no_interactions_message">
                            <div class="text-center py-4">
                                <i class="fa fa-pills fa-3x mb-3 text-muted"></i>
                                <p><?php echo lang('select_medicines_to_check_interactions'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Drug Interaction Details Container -->
        </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var select_medicine = "<?php echo lang('medicine'); ?>";
</script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/prescription/add_new_prescription_view.js"></script>

<!-- Add this script to handle drug interactions checks -->
<script>
$(document).ready(function() {
    // Function to check drug interactions via AJAX
    function checkDrugInteractions() {
        var selected = [];
        $('#my_select1_disabled option:selected').each(function() {
            var val = $(this).val();
            if (val) {
                // Extract medicine name from the value (format: id*name)
                var parts = val.split('*');
                if (parts.length > 1) {
                    selected.push(parts[1]); // Add the medicine name
                }
            }
        });
        
        if (selected.length >= 2) {
            // Show loading indicator
            $('#drug_interaction_results').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Checking drug interactions...</div>');
            $('#drug_interaction_alert').removeClass('d-none').removeClass('alert-danger').removeClass('alert-success').addClass('alert-info');
            $('#no_interactions_message').addClass('d-none');
            
            $.ajax({
                url: 'prescription/checkDrugInteractions',
                type: 'POST',
                data: { medicines: selected },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#drug_interaction_alert').removeClass('d-none');
                        $('#no_interactions_message').addClass('d-none');
                        
                        var html = '';
                        
                        if (response.interactions.length > 0 || response.warnings.length > 0) {
                            // Interactions or warnings found - show alert
                            $('#drug_interaction_alert').removeClass('alert-info').removeClass('alert-success').addClass('alert-danger');
                            $('#drug_interaction_alert .alert-heading').html('<i class="fa fa-exclamation-triangle"></i> ' + '<?php echo lang('drug_interactions_found'); ?>');
                            
                            if (response.interactions.length > 0) {
                                html += '<div class="mb-3"><strong>' + response.interactions.length + ' interaction(s) found:</strong></div>';
                                $.each(response.interactions, function(i, interaction) {
                                    html += '<div class="interaction-item mb-2 p-2 border-left border-warning bg-light">';
                                    html += interaction.interaction;
                                    html += '</div>';
                                });
                            }
                            
                            if (response.warnings.length > 0) {
                                html += '<div class="mb-3 mt-3"><strong>' + response.warnings.length + ' warning(s) found:</strong></div>';
                                $.each(response.warnings, function(i, warning) {
                                    html += '<div class="warning-item mb-2 p-2 border-left border-warning bg-light">';
                                    html += '<strong>' + warning.medicine + ':</strong> ';
                                    if (warning.warnings && warning.warnings.warnings) {
                                        html += warning.warnings.warnings[0];
                                    }
                                    html += '</div>';
                                });
                            }
                        } else {
                            // No interactions found - show success message
                            $('#drug_interaction_alert').removeClass('alert-info').removeClass('alert-danger').addClass('alert-success');
                            $('#drug_interaction_alert .alert-heading').html('<i class="fa fa-check-circle"></i> Safe Medication Combination');
                            
                            html += '<div class="alert alert-success border-0">';
                            html += '<p>No drug interactions detected between the selected medications.</p>';
                            html += '<p>According to our database, these medications appear to be safe to use together.</p>';
                            html += '<small class="text-muted">Note: Always follow your healthcare provider\'s recommendations.</small>';
                            html += '</div>';
                        }
                        
                        $('#drug_interaction_results').html(html);
                    } else {
                        // API returned success=false 
                        $('#drug_interaction_alert').removeClass('d-none').removeClass('alert-info').removeClass('alert-success').addClass('alert-warning');
                        $('#drug_interaction_alert .alert-heading').html('<i class="fa fa-info-circle"></i> No Data Available');
                        $('#drug_interaction_results').html('<div class="alert alert-warning border-0">Unable to check interactions for the selected medications. ' + (response.message || '') + '</div>');
                    }
                },
                error: function() {
                    // AJAX error
                    $('#drug_interaction_alert').removeClass('d-none').removeClass('alert-info').removeClass('alert-success').addClass('alert-danger');
                    $('#drug_interaction_alert .alert-heading').html('<i class="fa fa-exclamation-circle"></i> Connection Error');
                    $('#drug_interaction_results').html('<div class="alert alert-danger border-0">Error connecting to the drug interaction service. Please try again.</div>');
                }
            });
        } else if (selected.length === 1) {
            // Only one medicine selected
            $('#drug_interaction_alert').removeClass('d-none').removeClass('alert-danger').removeClass('alert-success').addClass('alert-info');
            $('#drug_interaction_alert .alert-heading').html('<i class="fa fa-info-circle"></i> Select More Medications');
            $('#drug_interaction_results').html('<div class="alert alert-info border-0">Please select at least one more medication to check for drug interactions.</div>');
            $('#no_interactions_message').addClass('d-none');
        } else {
            // No medicines selected
            $('#drug_interaction_alert').addClass('d-none');
            $('#no_interactions_message').removeClass('d-none');
        }
    }
    
    // Check for interactions when medicines change
    $('#my_select1_disabled').on('change', checkDrugInteractions);
    
    // Check for interactions on page load if medicines are already selected
    setTimeout(function() {
        if ($('#my_select1_disabled option:selected').length >= 2) {
            checkDrugInteractions();
        } else if ($('#my_select1_disabled option:selected').length === 1) {
            // One medicine already selected on load
            $('#drug_interaction_alert').removeClass('d-none').removeClass('alert-danger').removeClass('alert-success').addClass('alert-info');
            $('#drug_interaction_alert .alert-heading').html('<i class="fa fa-info-circle"></i> Select More Medications');
            $('#drug_interaction_results').html('<div class="alert alert-info border-0">Please select at least one more medication to check for drug interactions.</div>');
            $('#no_interactions_message').addClass('d-none');
        }
    }, 1000); // Slight delay to ensure Select2 is fully initialized
});
</script>
