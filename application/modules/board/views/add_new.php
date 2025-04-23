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
                                Feedback Management Platform Dashboard
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
                        <div class="card-header"><strong>Board</strong></div>
                        <div class="card-body">
                            <form action="board/addNew" method="post" accept-charset="utf-8">

                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-237"
                                        style="width: 100%; overflow: hidden;">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input class="form-control " type="text" name="title"
                                                placeholder="Board Title" value="<?php
                                if (!empty($setval)) {
                                    echo set_value('title');
                                }
                                if (!empty($board->title)) {
                                    echo $board->title;
                                }
                                ?>">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <input class="form-control " type="text" name="description"
                                                placeholder="Board Description" value="<?php
                                if (!empty($setval)) {
                                    echo set_value('description');
                                }
                                if (!empty($board->description)) {
                                    echo $board->description;
                                }
                                ?>">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="date" value='<?php
                            if (!empty($board->date)) {
                                echo $board->date;
                            }
                            ?>'>
                                    <input type="hidden" name="id" value='<?php
                            if (!empty($board->id)) {
                                echo $board->id;
                            }
                            ?>'>
                                    <div class="p-3">
                                        <button type="submit" class="mb-2 me-2 btn btn-shadow btn-primary">Save</button>
                                    </div>

                                </div>
                            </form>
                        </div>
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