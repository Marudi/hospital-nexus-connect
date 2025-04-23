<?php
if (!empty($interactions)) {
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?php echo lang('drug_interactions'); ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                <li class="breadcrumb-item"><?php echo lang('prescription'); ?></li>
                                <li class="breadcrumb-item active"><?php echo lang('drug_interactions'); ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h4 class="card-title mb-0"><i class="fa fa-exclamation-triangle me-2"></i><?php echo lang('drug_interaction_warning'); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($interaction_summary)): ?>
                                <div class="alert alert-danger border-danger mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fa fa-exclamation-triangle me-2"></i>
                                        <?php echo $interaction_summary; ?>
                                    </h5>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($interactions['interactions'])): ?>
                                <div class="alert alert-danger border-danger">
                                    <h5 class="alert-heading"><i class="fa fa-exclamation-triangle me-2"></i><?php echo lang('drug_interactions_found'); ?></h5>
                                    <hr>
                                    <?php foreach ($interactions['interactions'] as $interaction): ?>
                                        <div class="interaction-item mb-4 p-3 border-start border-danger border-3 bg-light">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fa fa-pills text-danger me-2"></i>
                                                <strong class="text-danger"><?php echo $interaction['medicines'][0] . ' + ' . $interaction['medicines'][1]; ?></strong>
                                            </div>
                                            <p class="mb-2 text-dark"><?php echo $interaction['interaction']; ?></p>
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="fa fa-info-circle me-1"></i>
                                                Source: <?php echo $interaction['source']; ?>
                                            </small>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($interactions['warnings'])): ?>
                                <div class="alert alert-warning border-warning mt-4">
                                    <h5 class="alert-heading"><i class="fa fa-exclamation-circle me-2"></i><?php echo lang('individual_drug_warnings'); ?></h5>
                                    <hr>
                                    <?php foreach ($interactions['warnings'] as $warning): ?>
                                        <div class="warning-item mb-4 p-3 border-start border-warning border-3 bg-light">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fa fa-prescription-bottle text-warning me-2"></i>
                                                <strong class="text-warning"><?php echo $warning['medicine']; ?></strong>
                                            </div>
                                            
                                            <?php if (!empty($warning['warnings']['boxed_warnings'])): ?>
                                                <div class="boxed-warning mb-3 p-3 border border-danger rounded bg-danger bg-opacity-10">
                                                    <h6 class="text-danger mb-2">
                                                        <i class="fa fa-exclamation-triangle me-1"></i>
                                                        <?php echo lang('boxed_warnings'); ?>
                                                    </h6>
                                                    <p class="mb-0"><?php echo $warning['warnings']['boxed_warnings'][0]; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if (!empty($warning['warnings']['warnings'])): ?>
                                                <div class="general-warning mb-3 p-3 border border-warning rounded bg-warning bg-opacity-10">
                                                    <h6 class="text-warning mb-2">
                                                        <i class="fa fa-exclamation-circle me-1"></i>
                                                        <?php echo lang('warnings'); ?>
                                                    </h6>
                                                    <p class="mb-0"><?php echo $warning['warnings']['warnings'][0]; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if (!empty($warning['warnings']['precautions'])): ?>
                                                <div class="precautions mb-3 p-3 border border-info rounded bg-info bg-opacity-10">
                                                    <h6 class="text-info mb-2">
                                                        <i class="fa fa-info-circle me-1"></i>
                                                        <?php echo lang('precautions'); ?>
                                                    </h6>
                                                    <p class="mb-0"><?php echo $warning['warnings']['precautions'][0]; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <small class="text-muted d-flex align-items-center mt-2">
                                                <i class="fa fa-info-circle me-1"></i>
                                                Source: <?php echo $warning['source']; ?>
                                            </small>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div class="mt-4 d-flex gap-2">
                                <a href="<?php echo site_url('prescription'); ?>" class="btn btn-danger">
                                    <i class="fa fa-times-circle me-1"></i>
                                    <?php echo lang('cancel_prescription'); ?>
                                </a>
                                <a href="<?php echo site_url('prescription/addPrescriptionView'); ?>" class="btn btn-warning">
                                    <i class="fa fa-edit me-1"></i>
                                    <?php echo lang('modify_prescription'); ?>
                                </a>
                                <a href="<?php echo site_url('prescription/continue_anyway'); ?>" class="btn btn-secondary">
                                    <i class="fa fa-arrow-right me-1"></i>
                                    <?php echo lang('continue_anyway'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { 
    redirect('prescription');
} ?> 