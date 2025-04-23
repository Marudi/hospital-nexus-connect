<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roadmap</title>
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
    transform: translate3d(60px, -15px, -75px) !important;
    width: 0px;
}

.dataTables_length {
    padding-left: 0px;
}

.dataTables_filter {
    padding-right: 0px;
}
</style>
<body>
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
                                Feedback Categories
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
                    <div class="card-header"><a href="category/addNewView" class="m-2 btn btn-shadow btn-primary"><i
                                class="lnr-plus-circle"></i> Create Category </a></div>
                    <div class="card-body">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-337">
                                <table class="table table-hover table-striped table-bordered category-dataTable-ajax"
                                    id="table">
                                    <thead>
                                        <tr>
                                            <th class="pl-2">Sr No.</th>
                                            <th class="pl-2">Title</th>
                                            <th class="pl-2">Description</th>
                                            <th class="pl-2">Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>


                                        <?php foreach ($categorys as $category) { ?>
                                        <tr class="">
                                            <td class="img_td"><?php echo $category->id; ?></td>
                                            <td> <?php echo $category->title; ?></td>
                                            <td><?php echo $category->description; ?></td>
                                            <td class="no-print">
                                            <div class="dropdown">
                                                    <button type="button" aria-haspopup="true" data-toggle="dropdown"
                                                        aria-expanded="false" class="btn btn-link">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div tabindex="-1" aria-hidden="true"
                                                        class="dropdown-menu dropdown-menu-right">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link btn btn-link text-primary drop edit-roadmap"
                                                                    href="category/editCategory?id=<?php echo $category->id; ?>">
                                                                    <i class="nav-link-icon fa fa-edit"></i>Edit
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link btn btn-link text-primary drop edit-roadmap"
                                                                    href="category/delete?id=<?php echo $category->id; ?>">
                                                                    <i class="nav-link-icon fa fa-trash"></i>Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        <?php } ?>




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

    var table = $('#table').DataTable({
        responsive: true,


        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        iDisplayLength: 10,
        "order": [
            [0, "desc"]
        ],

        "language": {
            "lengthMenu": "_MENU_",
            search: "_INPUT_",
            "url": ""
        }
    });
    table.buttons().container().appendTo('.custom_buttons');
});
</script>