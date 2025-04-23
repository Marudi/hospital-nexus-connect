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
                    Add New Feedback
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
            <div class="card-header"><strong>New Feedback Item</strong></div>
            <div class="card-body">
                <form action="feedback/addNew" method="post" accept-charset="utf-8">
                    <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-237"
                            style="width: 100%; overflow: hidden;">
                            <input type="hidden" name="status" value="Pending">
                            <div class="row">
                                <?php if(!empty($feedback->id)){ ?>
                            <div class="mb-3 col-6">
                                    <label class="form-label">Username</label>
                                    <input class="form-control " type="text" name="username"
                                        placeholder="Feedback Description"
                                        value="<?php if(!empty($feedback->id)){echo $feedback->username;} ?>" readonly>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Email</label>
                                    <input class="form-control " type="text" name="email"
                                        placeholder="Feedback Description"
                                        value="<?php if(!empty($feedback->id)){echo $feedback->email;} ?>" readonly>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                      
    <?php } ?>
                                <div class="mb-3 col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Feedback Description"><?php if(!empty($feedback->id)){echo $feedback->description;} ?></textarea>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="mb-3 col-4">
                                    <label class="form-label">Category</label>
                                    <select class=" form-select form-control-sm form-control " name="category">
                                        <option value="" disabled selected>Select Category</option>
                                        <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category->title; ?>" <?php if (!empty($feedback->category)) {
                                            if ($category->title == $feedback->category) {
                                                echo 'selected';
                                            }
                                        } ?>><?php echo $category->title; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="mb-3 col-4">
                                    <label class="form-label">Board</label>
                                    <select class="form-select form-control-sm form-control " name="board">
                                        <option value="">Select board</option>
                                        <?php foreach ($boards as $board): ?>
                                        <option value="<?php echo $board->title; ?>"<?php if (!empty($feedback->board)) {
                                            if ($board->title == $feedback->board) {
                                                echo 'selected';
                                            }
                                        } ?>><?php echo $board->title; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="mb-3 col-4">
                                    <label class="form-label">Roadmap</label>
                                    <select class="form-select form-control-sm form-control" name="roadmap">
                                        <option value="">Select Roadmap</option>
                                        <?php foreach ($roadmaps as $roadmap): ?>
                                        <option value="<?php echo $roadmap->id; ?>"<?php if (!empty($feedback->roadmap)) {
                                            if ($roadmap->id == $feedback->roadmap) {
                                                echo 'selected';
                                            }
                                        } ?>><?php echo $roadmap->title; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value='<?php
                            if (!empty($feedback->id)) {
                                echo $feedback->id;
                            }
                            ?>'>
                             <input type="hidden" name="hospital_id" value='<?php
                            if (!empty($feedback->hospital_id)) {
                                echo $feedback->hospital_id;
                            }
                            ?>'>
                             <input type="hidden" name="date" value='<?php
                            if (!empty($feedback->date)) {
                                echo $feedback->date;
                            }
                            ?>'>
                             <input type="hidden" name="ion_user_id" value='<?php
                            if (!empty($feedback->ion_user_id)) {
                                echo $feedback->ion_user_id;
                            }
                            ?>'>
                        <div class="p-3">
                            <button type="submit" class="mb-2 me-2 btn btn-shadow btn-primary"
                                name="submit">Save</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

                        </div></div></div>

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