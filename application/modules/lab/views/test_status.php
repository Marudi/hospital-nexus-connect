<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">  <?php echo lang('all') . " " . lang('lab_tests'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('lab'); ?></li>
                                        <li class="breadcrumb-item active">  <?php echo lang('all') . " " . lang('lab_tests'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->

        <link href="common/extranal/css/lab/lab.css" rel="stylesheet">
        <link href="common/extranal/css/description.css" rel="stylesheet">


        <ul>
            <li class="description">If you change the status from "Not Done" to "Done", lab test will appear on the Lab Test -> Lab Reports Section. <br>
                There you can add report for a test by clicking on the "Report" button. <br>
                On the report page after writing the report if you click "Save and ready to deliver", report will be generated and will be be available on the Lab Tests -> Report Delivery section.
                <span class="close">&times;</span>
            </li>
        </ul>


        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('all') . " " . lang('lab_tests'); ?></h4> 
                                       
                                    </div>
           
            <div class="card-body">


                <div class="adv-table editable-table ">
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-2">
                            <label>Status</label>
                            <select class="form-control status">
                                <option value="all"><?php echo lang('all'); ?></option>
                                <option value="done"><?php echo lang('done'); ?></option>
                                <option value="not_done"><?php echo lang('not_done'); ?></option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Category</label>
                            <select class="form-control category">
                                <option value="all"><?php echo lang('all'); ?></option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>From</label>
                            <input type="text" class="form-control pay_in default-date-picker readonly" name="" id="from_date" readonly="">
                        </div>
                        <div class="col-md-3">
                            <label>To</label>
                            <input type="text" class="form-control pay_in default-date-picker readonly" name="" id="to_date" readonly="">
                        </div>
                        <div class="col-md-2">
                            <label>Date Filter</label><br>
                            <button class="btn btn-success dateFilter" style="width: 100%">Filter</button>
                        </div>
                    </div>
                    <div class="space15"></div>
                    <!--                    <table class="table table-striped table-hover table-bordered" id="editable-sample4">
                        <thead>
                            <tr>
                                <th><?php echo lang('report_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('status'); ?></th>
                                <th class=""><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>



                        </tbody>
                    </table>-->

                    <table class="table mb-0" id="editable-sample1">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('invoice_no'); ?></th>
                                <th><?php echo lang('invoice_date_time'); ?></th>
                                <th><?php echo lang('from'); ?></th>
                                <th><?php echo lang('test_name'); ?></th>
                                <th><?php echo lang('status'); ?></th>
                                <th><?php echo lang('date_time_done'); ?></th>
                                <th><?php echo lang('bill_status'); ?></th>
                                <th><?php echo "Done By"; ?></th>
                                <th class=""><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>



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

<div class="modal fade" id="done_by_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title">  Done By Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
            <div class="modal-body">
                <div class="form-group">
                    <label>Done By</label>
                    <input type="text" class="form-control" id="done_by">
                </div>
                <input type="hidden" class="form-control" id="done_by_id">
                <input type="hidden" class="form-control" id="done_by_status">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary done_by_btn">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script src="common/extranal/js/lab/lab.js"></script>
<script src="common/extranal/js/description.js"></script>
<script>
    $(document).ready(function() {
        let status = $('.status').val();
        let category = $('.category').val();
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        "use strict";
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [1, "desc"]
            ],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    });

    $('.status').on("change", function() {
        let status = $('.status').val();
        let category = $('.category').val();
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        "use strict";
        $('#editable-sample1').DataTable().destroy().clear();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [2, "desc"]
            ],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    })

    $('.category').on("change", function() {
        let status = $('.status').val();
        let category = $('.category').val();
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        "use strict";
        $('#editable-sample1').DataTable().destroy().clear();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [2, "desc"]
            ],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    })

    $(document).on("change", '.test_status', function() {
        let id = $(this).data("id");
        let status = $(this).val();
        if (status == 'not_done') {
            let data = new FormData();
            data.append('id', id);
            data.append('status', status);
            data.append('done_by', "");
            axios.post('<?php echo site_url('lab/changeTestStatus'); ?>', data)
                .then(response => {
                    let status = $('.status').val();
                    let category = $('.category').val();
                    let fromDate = $('#from_date').val();
                    let toDate = $('#to_date').val();
                    "use strict";
                    $('#editable-sample1').DataTable().destroy().clear();
                    var table = $('#editable-sample1').DataTable({
                        responsive: true,

                        "processing": true,
                        "serverSide": true,
                        "searchable": true,
                        "ajax": {
                            url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                            type: 'POST',
                        },
                        scroller: {
                            loadingIndicator: true
                        },

                        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                        buttons: [{
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                        ],
                        aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        iDisplayLength: 100,
                        "order": [
                            [2, "desc"]
                        ],

                        "language": {
                            "lengthMenu": "_MENU_",
                            search: "_INPUT_",
                            searchPlaceholder: "Search..."
                        }
                    });
                    table.buttons().container().appendTo('.custom_buttons');
                })

            $('#done_by_modal').modal("hide");
        } else {
            $('#done_by_id').val(id)
            $('#done_by_status').val(status)
            $('#done_by').val("")
            $('#done_by_modal').modal("show");
        }
    })

    $(document).on("click", '.done_by_btn', function() {
        let id = $('#done_by_id').val();
        let status = $('#done_by_status').val();
        let done_by = $('#done_by').val();
        let data = new FormData();
        data.append('id', id);
        data.append('status', status);
        data.append('done_by', done_by);
        axios.post('<?php echo site_url('lab/changeTestStatus'); ?>', data)
            .then(response => {
                let status = $('.status').val();
                let category = $('.category').val();
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                "use strict";
                $('#editable-sample1').DataTable().destroy().clear();
                var table = $('#editable-sample1').DataTable({
                    responsive: true,

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                        type: 'POST',
                    },
                    scroller: {
                        loadingIndicator: true
                    },

                    dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                    buttons: [{
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                    ],
                    aLengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    iDisplayLength: 100,
                    "order": [
                        [2, "desc"]
                    ],

                    "language": {
                        "lengthMenu": "_MENU_",
                        search: "_INPUT_",
                        searchPlaceholder: "Search..."
                    }
                });
                table.buttons().container().appendTo('.custom_buttons');
            })
        $('#done_by_modal').modal("hide");

    })

    $('.dateFilter').on("click", function() {
        let status = $('.status').val();
        let category = $('.category').val();
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        "use strict";
        $('#editable-sample1').DataTable().destroy().clear();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [2, "desc"]
            ],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');

    })
</script>