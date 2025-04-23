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
                            All Feedback
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
            <div class="card mb-4">
                <div class="card-header">
                    <div class="col-md-3">
                        <select name="board" id="board" class="board form-select form-control-lg form-control">
                            <option value="all" selected>Select Boards</option>
                            <?php foreach ($boards as $key => $board) { ?>
                            <option value="<?php echo $board->title; ?>"><?php echo $board->title; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-9">
                        <a href="feedback/addNewView" class="m-2 btn btn-shadow btn-primary float-end"><i
                                class="lnr-plus-circle"></i> New Feedback Idea</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-337">
                            <table class="table table-hover table-striped table-bordered feedback-dataTable-ajax"
                                id="table">
                                <thead>
                                    <tr>
                                        <th class="pl-2">Sr No.</th>
                                        <th class="pl-2">Username</th>
                                        <th class="pl-2">Email</th>
                                        <th class="pl-2" style="width: 30%;">Ideas</th>
                                        <th class="pl-2">Status</th>
                                        <th class="pl-2">Category</th>
                                        <th class="pl-2">Comments</th>
                                        <th class="pl-2">Approval</th>
                                        <!-- <th>Status</th> -->



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

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title"> View Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" action="" class="clearfix" method="post"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> User Name</label>
                        <input type="text" class="form-control" id="username" name="username" value='' placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> User Email</label>
                        <input type="text" class="form-control" id="email" name="email" value='' placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label class=""> Feedback Description </label>
                        <div class="">
                            <textarea class="ckeditor form-control" name="description" id="description" value="" rows="10"
                            readonly>  </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Status</label>
                        <input type="text" class="form-control" id="roadmap" name="roadmap" value='' placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Category</label>
                        <input type="text" class="form-control" id="category" name="category" value='' placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Board</label>
                        <input type="text" class="form-control" id="fboard" name="board" value='' placeholder="" readonly>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="editModal" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFeedbackForm" method="post" accept-charset="utf-8">
                    <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview" role="tabpanel" style="width: 100%; overflow: hidden;">
                            <input type="hidden" name="id" id="edit_id">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username" id="edit_username" readonly>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Email</label>
                                    <input class="form-control" type="text" name="email" id="edit_email" readonly>
                                </div>
                                <div class="mb-3 col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="edit_description"></textarea>
                                </div>
                                <div class="mb-3 col-4">
                                    <label class="form-label">Category</label>
                                    <select class="form-select form-control-sm form-control" name="category" id="edit_category">
                                        <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category->title; ?>"><?php echo $category->title; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-4">
                                    <label class="form-label">Board</label>
                                    <select class="form-select form-control-sm form-control" name="board" id="edit_board">
                                        <?php foreach ($boards as $board): ?>
                                        <option value="<?php echo $board->title; ?>"><?php echo $board->title; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-4">
                                    <label class="form-label">Roadmap</label>
                                    <select class="form-select form-control-sm form-control" name="roadmap" id="edit_roadmap">
                                        <?php foreach ($roadmaps as $roadmap): ?>
                                        <option value="<?php echo $roadmap->id; ?>"><?php echo $roadmap->title; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="approval_status" id="edit_approval_status">
                                        <label class="form-check-label" for="edit_approval_status">
                                            Check this box to Approve/Undo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="hospital_id" id="edit_hospital_id">
                            <input type="hidden" name="date" id="edit_date">
                            <input type="hidden" name="ion_user_id" id="edit_ion_user_id">
                            <input type="hidden" name="status" value="Pending">
                        </div>
                        <div class="p-3">
                            <button type="submit" class="mb-2 me-2 btn btn-shadow btn-primary">Save Changes</button>
                            <button type="button" class="mb-2 me-2 btn btn-shadow btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="common/js/codearistos.min.js"></script>
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

<script>
$(document).ready(function() {
    "use strict";
    var board = $(".board").val();

    // Initialize the DataTable once
    var table = $("#table").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        searchable: true,
        ajax: {
            url: "feedback/getFeedback?board=" + board,
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

    // Handle board change
    $(".board").on("change", function() {
        var board = $(this).val();
        table.ajax.url("feedback/getFeedback?board=" + board).load();
    });

    // Handle category change
    $(document).on("change", '.category', function(e) {
        let id = $(this).data("id");
        let category = $(this).val();

        let data = new FormData();
        data.append('id', id);
        data.append('category', category);
        
        axios.post('<?php echo site_url('feedback/changeCategory'); ?>', data)
            .then(response => {
                // Show success message
                toastr.success('Category updated successfully');
                // Reload table data
                table.ajax.reload(null, false);
            })
            .catch(error => {
                toastr.error('Error updating category');
            });
    });

    // Handle roadmap/status change
    $(document).on("change", '.roadmap', function(e) {
        let id = $(this).data("id");
        let roadmap = $(this).val();

        let data = new FormData();
        data.append('id', id);
        data.append('roadmap', roadmap);
        
        axios.post('<?php echo site_url('feedback/changeRoadmap'); ?>', data)
            .then(response => {
                // Show success message
                toastr.success('Status updated successfully');
                // Reload table data
                table.ajax.reload(null, false);
            })
            .catch(error => {
                toastr.error('Error updating status');
            });
    });

    // Replace the edit button click handler in the actions column
    $(document).on('click', '.edit-feedback', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        // Fetch feedback data
        $.ajax({
            url: 'feedback/editFeedbackByJason?id=' + id,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var feedback = response.feedback;
                console.log('Feedback data:', feedback); // Debug log
                
                // Populate the edit modal
                $('#edit_id').val(feedback.id);
                $('#edit_username').val(feedback.username);
                $('#edit_email').val(feedback.email);
                $('#edit_description').val(feedback.description);
                
                // Set the category dropdown
                if (feedback.category) {
                    $('#edit_category').val(feedback.category);
                }
                
                // Set the board dropdown
                if (feedback.board) {
                    $('#edit_board').val(feedback.board);
                }
                
                // Set the roadmap dropdown
                if (feedback.roadmap) {
                    $('#edit_roadmap').val(feedback.roadmap);
                }
                
                // Set the approval status checkbox
                if (feedback.approval_status === '1') {
                    $('#edit_approval_status').prop('checked', true);
                } else {
                    $('#edit_approval_status').prop('checked', false);
                }
                
                $('#edit_hospital_id').val(feedback.hospital_id);
                $('#edit_date').val(feedback.date);
                $('#edit_ion_user_id').val(feedback.ion_user_id);
                
                // Show the modal
                $('#editModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching feedback:', error); // Debug log
                toastr.error('Error fetching feedback data');
            }
        });
    });

    // Handle form submission
    $('#editFeedbackForm').submit(function(e) {
        e.preventDefault();
        
        var formData = $(this).serializeArray();
        
        // Add approval status to form data
        formData.push({
            name: 'approval_status',
            value: $('#edit_approval_status').is(':checked') ? '1' : '0'
        });
        
        $.ajax({
            url: 'feedback/addNew',
            method: 'POST',
            data: $.param(formData),
            success: function(response) {
                $('#editModal').modal('hide');
                // Reload the DataTable
                $('.feedback-dataTable-ajax').DataTable().ajax.reload();
                toastr.success('Feedback updated successfully');
            },
            error: function() {
                toastr.error('Error updating feedback');
            }
        });
    });
});
</script>
<script>
  $(document).ready(function() {
    $(".table").on("click", ".finfo", function () {
      // alert("clicked");
      // Get data attributes from the clicked element
      var id = $(this).attr('data-id');
      var board = $(this).data('board');
      var username = $(this).data('username');
      var email = $(this).data('email');
      var description = $(this).data('description');
      var status = $(this).data('status');
      var category = $(this).data('category');
      var roadmap = $(this).data('roadmap');
      console.log(board);

      // Update form fields with the retrieved data
      $("#username").val(username); // For input fields
      $("#email").val(email); // For input fields
      $("#description").val(description); // For textarea or input fields
      $("#status").val(status); // For input or select fields
      $("#category").val(category); // For input or select fields
      $("#fboard").val(board); // For input or select fields
      $("#roadmap").val(roadmap); // For input or select fields

      // If you're updating non-input fields (e.g., <span>, <div>), use .text() or .html()
      // Example:
      // $("#username-display").text(username);
      // $("#email-display").text(email);
    });
  });
</script>