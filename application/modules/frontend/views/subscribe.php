<!--sidebar end-->
<!--main content start-->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><i class="fas fa-envelope mr-2"></i> Subscribers</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a
                                        href="javascript: void(0);"><?php echo lang('home') ?>></a></li>
                                <li class="breadcrumb-item active">Subscribers</li>


                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- page start-->
            <section class="card">
                <div class="card-header table_header">

                    <h4 class="card-title mb-0 col-lg-8">Subscribers</h4>
                    




                </div>

                <div class="card-body">
                    <div class="table-responsive adv-table">
                        <table class="table mb-0" id="editable-sample">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Email</th>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                            </thead>
                            <tbody>


                                <?php foreach ($subscribes as $subscribe) { ?>
                                <tr class="">

                                    <td> <?php echo $subscribe->id; ?></td>
                                    <td><?php echo $subscribe->email; ?></td>
                                    <td class="no-print d-flex gap-1">
                                        
                                        <a class="btn btn-danger btn-sm btn_width delete_button"
                                            title="<?php echo lang('delete'); ?>"
                                            href="frontend/deleteSubscribe?id=<?php echo $subscribe->id; ?>"
                                            onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                class="fa fa-trash"> </i></a>
                                    </td>
                                </tr>
                                <?php } ?>

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


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
var language = "<?php echo $this->language; ?>";
</script>
<script>
    $(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
        responsive: true,

        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            { extend: 'copyHtml5', exportOptions: { columns: [1, 2, 3, 4], } },
            { extend: 'excelHtml5', exportOptions: { columns: [1, 2, 3, 4], } },
            { extend: 'csvHtml5', exportOptions: { columns: [1, 2, 3, 4], } },
            { extend: 'pdfHtml5', exportOptions: { columns: [1, 2, 3, 4], } },
            { extend: 'print', exportOptions: { columns: [1, 2, 3, 4], } },
        ],

        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        iDisplayLength: -1,
        "order": [[0, "desc"]],

        "language": {
            "lengthMenu": "_MENU_",
            search: "_INPUT_",
            "url": "common/assets/DataTables/languages/" + language + ".json"
        },

    });

    table.buttons().container()
        .appendTo('.custom_buttons');
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

</script>