
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('template'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('lab'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('template'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> <?php echo lang('lab_report'); ?> <?php echo lang('template'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <a href="lab/addTemplateView" class="btn btn-primary waves-effect waves-light w-xs" ><i class="fa fa-plus-circle"></i> <?php echo lang('add_template'); ?></a>
                                           
                                        </div>
                                    </div>
           
            <div class="card-body">
                <div class="row" style="margin-top: 10px;">
                       <div class="col-md-4">
                           <label>Category</label><br>
                            <select class="form-control category">
                                <option value=""><?php echo lang('all'); ?></option>
                                <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>User</label><br>
                            <select class="form-control user_id js-example-basic-single">
                                <option value=""><?php echo lang('all'); ?></option>
                                <?php foreach ($users as $user) {
                                  ?>
                                <option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
                                      <?php  
                                } ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample1">
                        <thead>
                            <tr>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('category')?></th>
                                <th>Created By</th>
                                <th class="option_th no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($templates as $template) { ?>
<!--                                <tr class="">
                                    <td> <?php echo $template->name; ?></td>
                                    <td class="no-print">
                                        <a href="lab/editTemplate?id=<?php echo $template->id; ?>" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $template->id; ?>"><i class="fa fa-edit"> </i></a>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="lab/deleteTemplate?id=<?php echo $template->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                    </td>
                                </tr>-->
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
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/lab/template.js"></script>
<script>
    $(function() {
        let user_id = $('.user_id').val();
        let category = $('.category').val();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTemplate?user_id="+user_id+"&category="+category,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'print', exportOptions: {columns: [0, 1, 2], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
        
        $(document).on("change", '.user_id', function() {
        let user_id = $('.user_id').val();
        let category = $('.category').val();
        
        $('#editable-sample1').DataTable().destroy().clear();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTemplate?user_id="+user_id+"&category="+category,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'print', exportOptions: {columns: [0, 1, 2], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    })
    
    $('.category').on("change", function() {
        let user_id = $('.user_id').val();
        let category = $('.category').val();
        
        $('#editable-sample1').DataTable().destroy().clear();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTemplate?user_id="+user_id+"&category="+category,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2], }},
                {extend: 'print', exportOptions: {columns: [0, 1, 2], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],

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
