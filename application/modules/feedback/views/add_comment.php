<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/main.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/scripts/responsive.dataTables.min.css'); ?>">
<div class="main-content">
    <div class="page-content">
    <style>
    .dropdown-menu {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    min-width: 10rem !important;
}
</style>
        <div class="container-fluid">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <a href="#">
                                <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                            </a>
                        </div>
                        <div>
                            Add New Comment
                            <div class="page-title-subheading">
                                <nav class="" aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Comment</strong></div>
                    <div class="card-body">
                        <form action="feedback/addComment" method="post" accept-charset="utf-8">
                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-237"
                                    style="width: 100%; overflow: hidden;">

                                    <div class="row">
                                        <?php if(!empty($comment->id)){ ?>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Username</label>
                                            <input class="form-control " type="text" name="username" placeholder=""
                                                value="<?php if(!empty($comment->id)){echo $comment->username;} ?>"
                                                readonly>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Email</label>
                                            <input class="form-control " type="text" name="email" placeholder=""
                                                value="<?php if(!empty($comment->id)){echo $comment->email;} ?>"
                                                readonly>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                        <?php } ?>
                                        <?php if(empty($comment->id)){ 
                                            $feedback_id = $this->input->get('feedback_id');
                                            if($feedback_id == ''){ 
                                            ?>
                                        <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                                        <div class="mb-3 col-12">
                                            <label class="form-label">Feedback</label>
                                            <select class="form-select form-control-sm form-control " name="feedback">
                                                <option value="">Select Feedback</option>
                                                <?php foreach ($feedbacks as $feedback): ?>
                                                <option value="<?php echo $feedback->id; ?>" <?php if (!empty($comment->feedback)) {
                                            if ($feedback->id == $comment->feedback) {
                                                echo 'selected';
                                            }
                                        } ?>><?php echo $feedback->description; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <?php } else{ ?>
                                        <div class="mb-3 col-12">
                                            <label class="form-label">Feedback</label>
                                            <select class="form-select form-control-sm form-control" name="feedback">
                                                <option value="">Select Feedback</option>
                                                <?php foreach ($feedbacks as $feedback): ?>
                                                <?php if ($feedback->hospital_id == $this->session->userdata('hospital_id')): ?>
                                                <option value="<?php echo $feedback->id; ?>" <?php if (!empty($comment->feedback) && $feedback->id == $comment->feedback) {
                        echo 'selected';
                    } ?>>
                                                    <?php echo $feedback->description; ?>
                                                </option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php }else{ ?>
                                            <input type="hidden" name="feedback" value='<?php  echo $feedback_id;
                            ?>'>
                                            <?php } ?>
                                        <?php } else{ ?>
                                        <input type="hidden" name="feedback" value='<?php
                            if (!empty($comment->feedback)) {
                                echo $comment->feedback;
                            }
                            ?>'>
                                        <?php } ?>
                                        <div class="mb-3 col-12">
                                            <label class="form-label">Comment</label>
                                            <textarea class="form-control" name="comment"
                                                placeholder="Comment Description"><?php if(!empty($comment->id)){echo $comment->comment;} ?></textarea>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <?php if(!empty($comment->id)){ ?>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Status</label>
                                            <select class=" form-select form-control-sm form-control " name="status">
                                                <option value="Pending Moderation" <?php if (!empty($comment->status)) {
                                            if ($comment->status == 'Pending Moderation') {
                                                echo 'selected';
                                            }
                                        } ?>>Pending
                                                </option>
                                                <option value="Approved" <?php if (!empty($comment->status)) {
                                            if ($comment->status == 'Approved') {
                                                echo 'selected';
                                            }
                                        } ?>>Approved
                                                </option>
                                                <option value="Dis-Approved" <?php if (!empty($comment->status)) {
                                            if ($comment->status == 'Dis-Approved') {
                                                echo 'selected';
                                            }
                                        } ?>>Dis-Approved
                                                </option>

                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Date</label>
                                            <span class="form-control"> <?php echo date('d-m-Y') ?> </span>
                                        </div>
                                        <?php }else{ ?>
                                        <input type="hidden" name="status" value='Pending Moderation'>
                                        <?php } ?>
                                    </div>


                                </div>
                            </div>
                            <input type="hidden" name="id" value='<?php
                            if (!empty($comment->id)) {
                                echo $comment->id;
                            }
                            ?>'>
                            <input type="hidden" name="hospital_id" value='<?php
                            if (!empty($comment->hospital_id)) {
                                echo $comment->hospital_id;
                            }
                            ?>'>
                            <input type="hidden" name="date" value='<?php
                            if (!empty($comment->date)) {
                                echo $comment->date;
                            }
                            ?>'>
                            <input type="hidden" name="ion_user_id" value='<?php
                            if (!empty($comment->ion_user_id)) {
                                echo $comment->ion_user_id;
                            }
                            ?>'>
                            <div class="p-3">
                                <button type="submit" class="mb-2 me-2 btn btn-shadow btn-primary"
                                    name="submit">Save</button>
                            </div>

                    </div>
                    </form>
                </div>
                <?php if(!empty($comment->id)){ 
                    $feedback_details = $this->feedback_model->getFeedbackById($comment->feedback);
                    $roadmap_details = $this->roadmap_model->getRoadmapById($feedback_details->roadmap);
                    ?>
                <div class="card mb-4">
                    <div class="card-header"><strong>Feedback</strong></div>
                    <div class="card-body">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-237"
                                style="width: 100%; overflow: hidden;">
                                <div class="mb-3">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Feedback Description</th>
                                                <th>User Name</th>
                                                <th>User Email</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>Approval Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $feedback_details->description; ?></td>
                                                <td><?php echo $feedback_details->username; ?></td>
                                                <td><?php echo $feedback_details->email; ?></td>
                                                <td><?php echo $roadmap_details->title; ?></td>
                                                <td><?php echo $feedback_details->category; ?></td>
                                                <td>
                                                    <label
                                                        class="label"><?php if($feedback_details->approval_status == 1){ echo 'Approved';}else{ echo 'Pending';} ?></label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

    </div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/scripts/toastr.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('/assets/main.js'); ?>"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/dataTables.bootstrap4.min.js'); ?>">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/dataTables.responsive.min.js'); ?>">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/custom.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/variable-pie.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/export-data.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/accessibility.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/exporting.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/highcharts-3d.js'); ?>"></script>