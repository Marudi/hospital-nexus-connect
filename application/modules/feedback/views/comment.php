<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/main.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/scripts/responsive.dataTables.min.css'); ?>">
</head>
<style>
.dropdown-menu {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    min-width: 10rem !important;
}

.dropdown-menu .nav-item {
    margin: 0;
}

.dropdown-menu .nav-link i {
    margin-right: 0.5rem;
}

.dropdown-menu-right {
    transform: translate3d(-170px, 40px, -75px) !important;
    width: 0px;
}

/* Add these styles for consistent table padding */
.table th,
.table td {
    padding: 0.75rem;
}

.dataTables_length {
    padding-left: 0px;
}

.dataTables_filter {
    padding-right: 0px;
}

/* Add hover effect to table rows */
.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}

/* Add background color to main content */
.main-content {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
}

/* Add margin to cards */
.card {
    margin-bottom: 20px;
}
</style>
<div class="main-content">


    <div class="page-content">

        <div class="container-fluid">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <a href="home">
                                <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                            </a>
                        </div>
                        <div>
                            All Comments
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
            <?php $feedback_id = $this->input->get('feedback_id'); ?>
            <div class="row">
                <?php if($feedback_id != ''){ ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header table_header">
                            <h4 class="card-title mb-0 col-lg-8"> Feedback <?php echo lang('info'); ?></h4>
                        </div>
                        <section class="card-body">
                            <aside class="profile-nav">
                                <section class="">
                                    <?php $feedback_details = $this->feedback_model->getFeedbackById($feedback_id);
                                    $roadmap_details = $this->roadmap_model->getRoadmapById($feedback_details->roadmap);
                                    ?>
                                    <ul class="list-group list-group-flush">
                                        
                                        <li class="list-group-item"> Feedback Idea<span class="label pull-right r-activity float-end"><small><?php echo $feedback_details->description; ?></small></span></li>
                                        <li class="list-group-item"> Username <span class="label pull-right r-activity float-end"><?php echo $feedback_details->username; ?></span></li>
                                        <li class="list-group-item"> Email<span class="label pull-right r-activity float-end"><?php echo $feedback_details->email; ?></span></li>
                                        <li class="list-group-item"> Category<span class="label pull-right r-activity float-end"><?php echo $feedback_details->category; ?></span></li>
                                        <li class="list-group-item"> Status<span class="label pull-right r-activity float-end"><?php echo $roadmap_details->title; ?></span></li>
                                        
                                    </ul>
                                </section>
                            </aside>
                        </section>
                    </div>
                </div>
                <?php } ?>
                <div class="<?php if($feedback_id == ''){ echo 'col-md-12'; }else{ echo 'col-md-8'; }?>">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="col-md-12">
                                <?php if($feedback_id == ''){ ?>
                                <a href="feedback/addCommentView" class="m-2 btn btn-shadow btn-primary float-end"><i class="lnr-plus-circle"></i> New Comment </a>
                                <?php } else{ ?>
                                <a data-bs-toggle="modal"
                                data-bs-target="#myModal" class="m-2 btn btn-shadow btn-primary float-end"><i class="lnr-plus-circle"></i> New Comment </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-337">
                                    <table class="table table-hover table-striped table-bordered feedback-dataTable-ajax" id="table">
                                        <thead>
                                            <tr>
                                                <th class="pl-2">Commented Id</th>
                                                <th class="pl-2" style="width: 30%;">Comment</th>
                                                <th class="pl-2">Username</th>
                                                <th class="pl-2">Email</th>
                                                <th class="pl-2">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane pt-1" role="tabpanel" id="code-337">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title">  Add New Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
            <form action="feedback/addComment" method="post" accept-charset="utf-8">
                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-237"
                                    style="width: 100%; overflow: hidden;">

                                    <div class="row">
                                       
                                        <?php $feedback_id = $this->input->get('feedback_id'); ?>
                                       
                                            <input type="hidden" name="feedback" value='<?php  echo $feedback_id; ?>'>
                                      
                                        <div class="mb-3 col-12">
                                            <label class="form-label">Comment</label>
                                            <textarea class="form-control" name="comment"
                                                placeholder="Comment Description"></textarea>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                       
                                        <input type="hidden" name="status" value='Pending Moderation'>
                                        
                                    </div>


                                </div>
                            </div>
                           
                           
                            <div class="p-3">
                                <button type="submit" class="mb-2 me-2 btn btn-shadow btn-primary"
                                    name="submit">Save</button>
                            </div>

                    </div>
                    </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/toastr.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('assets/main.js'); ?>"></script> -->
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

<script>
$(document).ready(function() {
    "use strict";
    const urlParams = new URLSearchParams(window.location.search);
    const feedback_id = urlParams.get('feedback_id');

    var table = $("#table").DataTable({
        responsive: true,
        processing: true, // Enable processing indicator initially
        serverSide: true,
        searchable: true,
        ajax: {
            url: "feedback/getComment?feedback_id=" + feedback_id,
            type: "POST",
        },
        scroller: {
            loadingIndicator: true,
        },
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"],
        ],
        iDisplayLength: 100,
        order: [
            [0, "desc"]
        ],
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            url: "",
        },



    });



    // Handle category change
    $(document).on("change", '.status', function(e) {
        let id = $(this).data("id");
        let status = $(this).val();

        let data = new FormData();
        data.append('id', id);
        data.append('status', status);

        axios.post('<?php echo site_url('feedback/changeCommentStatus'); ?>', data)
            .then(response => {
                // Show success message
                toastr.success('Status updated successfully');
                // Reload table data
                table.ajax.reload(null, false);
            })
            .catch(error => {
                toastr.error('Error updating Status');
            });
    });


});
</script>