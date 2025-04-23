<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Crutches</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active">Crutches</li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/crutches.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> Crutches </h4> 
                                        <!-- <div class="col-lg-4 no-print pull-right"> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs" data-bs-toggle="modal"
                                                    data-bs-target="#myModal"><i class="fa fa-plus-circle"></i> <?php echo lang('add_crutches'); ?></button>
                                           
                                        </div> -->
                                    </div>
            
            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('image'); ?></th>
                                <th>Department <?php echo lang('name'); ?></th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Description</th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                      

                        <?php foreach ($crutchess as $crutches) { ?>
                            <tr class="">
                                <td class="img_class"><img class="img" width="100" src="<?php echo $crutches->img; ?>"></td>
                                <td> <?php echo $crutches->name; ?></td>
                                <td><?php echo $crutches->designation; ?></td>
                                <td><?php echo $crutches->crutches; ?></td>
                                <td>
                                <?php echo $crutches->status; ?>
                                </td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $crutches->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <!-- <a class="btn btn-soft-danger btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="frontend/crutches/delete?id=<?php echo $crutches->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a> -->
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




<!-- Add Slide Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title">Add Crutches</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
           
            <div class="modal-body">
                <form role="form" action="frontend/crutches/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Department <?php echo lang('name'); ?> &#42;</label>
                        <input type="text" class="form-control" name="name"  value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Title &#42;</label>
                        <input type="text" class="form-control" name="designation"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub Title &#42;</label>
                        <textarea class="form-control" name="crutches"  value='' placeholder="" cols="20" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description &#42;</label>
                        <textarea class="form-control" name="status"  value='' placeholder="" cols="20" required=""></textarea>
                    </div>
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_url">
                                    <img src="" alt="" />
                                </div>
                                <div class="fileupload-pcrutches fileupload-exists thumbnail img_thumb"></div>
                                <div>
                                    <span class="btn btn-soft-info btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                        <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 505x400</span><br>
                        <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
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
<!-- Add Slide Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                
                <h5 class="modal-title">Edit Crutches</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         
            <div class="modal-body">
                <form role="form" id="editSlideForm" class="clearfix" action="frontend/crutches/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Department <?php echo lang('name'); ?> &#42;</label>
                        <input type="text" class="form-control" name="name"  value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Title &#42;</label>
                        <input type="text" class="form-control" name="designation"  value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub Title &#42;</label>
                        <textarea type="text" cols="20" class="form-control" name="crutches"  value='' placeholder="" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description &#42;</label>
                        <textarea class="form-control" name="status"  value='' placeholder="" cols="20" required=""></textarea>
                    </div>
                    <!-- <style>
                        img{
                            height: 150;
                            width: 150;
                        }
                    </style> -->
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_url">
                                    <img src="" id="img" alt="" />
                                </div>
                                <div class="fileupload-pcrutches fileupload-exists thumbnail img_thumb"></div>
                                <div>
                                    <span class="btn btn-soft-info btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                        <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 505x400</span><br>
                        <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
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
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script>
    "use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editSlideForm').trigger("reset");
        $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $.ajax({
            url: 'frontend/crutches/editCrutchesByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
            $('#editSlideForm').find('[name="id"]').val(response.crutches.id).end();
            $('#editSlideForm').find('[name="name"]').val(response.crutches.name).end();
            $('#editSlideForm').find('[name="designation"]').val(response.crutches.designation).end();
            $('#editSlideForm').find('[name="crutches"]').val(response.crutches.crutches).end();
            $('#editSlideForm').find('[name="status"]').val(response.crutches.status).end();

            if (typeof response.crutches.img !== 'undefined' && response.crutches.img != '') {
                $("#img").attr("src", response.crutches.img);
            }

            $('#myModal2').modal('show');
            }
        })
    });
});
$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [1, 2, 3, 4], }},
            {extend: 'excelHtml5', exportOptions: {columns: [1, 2, 3, 4], }},
            {extend: 'csvHtml5', exportOptions: {columns: [1, 2, 3, 4], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [1, 2, 3, 4], }},
            {extend: 'print', exportOptions: {columns: [1, 2, 3, 4], }},
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
