<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('bed'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('bed'); ?></li>
                                     
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/bed/bed.css" rel="stylesheet">
        <section class="card">

        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('bed'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?></button>
                                           
                                        </div>
                                    </div>
           
            <div class="card-body">
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-4">
                        <label><?php echo lang('bed'); ?> <?php echo lang('status'); ?></label><br>
                        <select class="form-control status">
                            <option value=""><?php echo lang('all'); ?></option>
                            <option value="available"><?php echo lang('available'); ?></option>
                            <option value="alloted"><?php echo lang('alloted'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample1">
                        <thead>
                            <tr>
                                <th><?php echo lang('bed_id'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('status'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
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







<!-- Add Bed Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('add_new_bed') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
           
            <div class="modal-body">
                <form role="form" action="bed/addBed" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('bed_category'); ?> &#42;</label>
                        <select class="form-control" name="category" value='' required="">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                                                                    if (!empty($bed->category)) {
                                                                                        if ($category->category == $bed->category) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $category->category; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('bed_number'); ?> &#42;</label>
                        <input type="text" class="form-control" name="number" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                        <input type="text" class="form-control" name="description" value='' placeholder="" required="">
                    </div>

                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title"> <?php echo lang('edit_bed') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
         
            <div class="modal-body">
                <form role="form" id="editBedForm" class="clearfix row" action="bed/addBed" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('bed_category'); ?> &#42;</label>
                        <select class="form-control" name="category" value='' required="">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                                                                    if (!empty($bed->category)) {
                                                                                        if ($category->category == $bed->category) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $category->category; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('bed_number'); ?> &#42;</label>
                        <input type="text" class="form-control" name="number" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                        <input type="text" class="form-control" name="description" value='' placeholder="" required="">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('submit') ?></button>
                                                            </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/bed/bed.js"></script>






<script>
    $(function() {
        let status = $('.status').val();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "bed/getBedList?status=" + status,
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
                        columns: [0, 1, 2],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [0, "desc"]
            ],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');

        $(document).on("change", '.user_id', function() {
            let status = $('.status').val();

            $('#editable-sample1').DataTable().destroy().clear();
            var table = $('#editable-sample1').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "bed/getBedList?status=" + status,
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
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                ],
                aLengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                iDisplayLength: 100,
                "order": [
                    [0, "desc"]
                ],

                "language": {
                    "lengthMenu": "_MENU_",
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                }
            });
            table.buttons().container().appendTo('.custom_buttons');
        })

        $('.status').on("change", function() {
            let status = $('.status').val();

            $('#editable-sample1').DataTable().destroy().clear();
            var table = $('#editable-sample1').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "bed/getBedList?status=" + status,
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
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                ],
                aLengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                iDisplayLength: 100,
                "order": [
                    [0, "desc"]
                ],

                "language": {
                    "lengthMenu": "_MENU_",
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                }
            });
            table.buttons().container().appendTo('.custom_buttons');
        })
    })
</script>