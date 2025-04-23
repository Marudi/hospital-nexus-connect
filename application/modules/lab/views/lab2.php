
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->

        <link href="common/extranal/css/lab/lab.css" rel="stylesheet">

        <section class="col-md-5 no-print" style="display: none;">
            <header class="panel-heading no-print">
                <?php
                if (!empty($lab_single->id))
                    echo lang('edit_lab_report');
                else
                    echo lang('add_lab_report');
                ?>
            </header>
            <div class="no-print">
                <div class="adv-table editable-table ">
                    <div class="clearfix">


                        <form role="form" id="editLabForm" class="clearfix" action="lab/addLab" method="post" enctype="multipart/form-data">

                            <div class="">
                                <div class="col-md-6 lab pad_bot">
                                    <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                                    <input type="text" class="form-control pay_in default-date-picker" name="date" value='<?php
                                    if (!empty($lab_single->date)) {
                                        echo date('d-m-Y', $lab_single->date);
                                    } else {
                                        echo date('d-m-Y');
                                    }
                                    ?>' placeholder="">
                                </div>

                                <div class="col-md-6 lab pad_bot">
                                    <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                    <select class="form-control m-bot15 pos_select" id="pos_select" name="patient" value=''> 
                                        <?php if (!empty($lab_single->patient)) { ?>
                                            <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> - <?php echo $patients->id; ?></option>  
                                        <?php } ?>
                                    </select>
                                </div> 

                                <div class="col-md-8 panel"> 
                                </div>

                                <div class="pos_client">
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="p_name" value='<?php
                                            if (!empty($lab_single->p_name)) {
                                                echo $lab_single->p_name;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="p_email" value='<?php
                                            if (!empty($lab_single->p_email)) {
                                                echo $lab_single->p_email;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="p_phone" value='<?php
                                            if (!empty($lab_single->p_phone)) {
                                                echo $lab_single->p_phone;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('birth_date'); ?> &ast; </label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" required="" onkeypress="return false;">      
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <div class="input-group m-bot15">

                                                <input type="number" min="0" max="150" class="form-control" name="years"  value='' placeholder="<?php echo lang('years'); ?>">
                                                <span class="input-group-addon"><?php echo lang('y'); ?></span>
                                                <input type="number" class="form-control input-group-addon" min="0" max="12" name="months"  value='' placeholder="<?php echo lang('months'); ?>">
                                                <span class="input-group-addon"><?php echo lang('m'); ?></span>
                                                <input type="number" class="form-control input-group-addon" name="days"  min="0" max="29"   value='' placeholder="<?php echo lang('days'); ?>">
                                                <span class="input-group-addon"><?php echo lang('d'); ?></span>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <select class="form-control m-bot15" name="p_gender" value=''>

                                                <option value="Male" <?php
                                                if (!empty($patient->sex)) {
                                                    if ($patient->sex == 'Male') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > Male </option>   
                                                <option value="Female" <?php
                                                if (!empty($patient->sex)) {
                                                    if ($patient->sex == 'Female') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > Female </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 lab pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('refd_by_doctor'); ?></label> 
                                    <select class="form-control m-bot15  add_doctor" id="add_doctor" name="doctor" value=''>  
                                        <?php if (!empty($lab_single->doctor)) { ?>
                                            <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - <?php echo $doctors->id; ?></option>  
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 lab pad_bot">
                                    <label for="exampleInputEmail1">
                                        <?php echo lang('template'); ?>
                                    </label>
                                    <select class="form-control m-bot15 js-example-basic-multiple template" id="template" name="template" value=''> 
                                        <option value="">Select .....</option>
                                        <?php foreach ($templates as $template) { ?>
                                            <option value="<?php echo $template->id; ?>"><?php echo $template->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="pos_doctor">
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('name'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="d_name" value='<?php
                                            if (!empty($lab_single->p_name)) {
                                                echo $lab_single->p_name;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('email'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="d_email" value='<?php
                                            if (!empty($lab_single->p_email)) {
                                                echo $lab_single->p_email;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('phone'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="d_phone" value='<?php
                                            if (!empty($lab_single->p_phone)) {
                                                echo $lab_single->p_phone;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 panel">
                                </div>



                            </div>









                            <div class="col-md-12 lab pad_bot">
                                <label for="exampleInputEmail1"> <?php echo lang('report'); ?></label>
                                <textarea class="ckeditor form-control" id="editor" name="report" value="" rows="10"><?php
                                    if (!empty($setval)) {
                                        echo set_value('report');
                                    }
                                    if (!empty($lab_single->report)) {
                                        echo $lab_single->report;
                                    }
                                    ?>
                                </textarea>
                            </div>

                            <input type="hidden" name="redirect" value="<?php
                            if (!empty($lab_single)) {
                                echo 'lab?id=' . $lab_single->id;
                            } else {
                                echo 'lab';
                            }
                            ?>">

                            <input type="hidden" name="id" value='<?php
                            if (!empty($lab_single->id)) {
                                echo $lab_single->id;
                            }
                            ?>'>


                            <div class="col-md-12 lab"> 
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>



        </section>









        <section class="col-md-12">
            <header class="panel-heading">
                <?php echo lang('lab_report'); ?>
                <div class="col-md-2 no-print pull-right"> 
                        <select class="form-control labStatus">
                            <option value="all">All</option>
                            <option value="pending"><?php echo lang('pending'); ?></option>
                            <option value="waiting"><?php echo lang('waiting'); ?></option>
                            <option value="sample_taken"><?php echo lang('sample_collected'); ?></option>
                            <option value="complete"><?php echo lang('completed'); ?></option>
                            <option value="delivered"><?php echo lang('delivered'); ?></option>
                        </select>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
<!--                    <div style="margin-top: 15px;">
                        <label> Lab Report Status </label>
                        <select class="form-control labStatus">
                            <option value="all">All</option>
                            <option value="pending"><?php echo lang('pending'); ?></option>
                            <option value="waiting"><?php echo lang('waiting'); ?></option>
                            <option value="sample_taken"><?php echo lang('sample_collected'); ?></option>
                            <option value="complete"><?php echo lang('completed'); ?></option>
                            <option value="delivered"><?php echo lang('delivered'); ?></option>
                        </select>
                    </div>-->
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
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
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script src="common/extranal/js/lab/lab.js"></script>
<script>
    $('.labStatus').on("change", function () {
        let status = $('.labStatus').val();
        if (status == 'all') {
            $('#editable-sample').DataTable().destroy().clear();
            var table = $('#editable-sample').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "lab/getDeliveredLab",
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
        } else if (status == 'pending') {
            $('#editable-sample').DataTable().destroy().clear();
            var table = $('#editable-sample').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "lab/getPendingLab",
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
        } else if (status == 'waiting') {
            $('#editable-sample').DataTable().destroy().clear();
            var table = $('#editable-sample').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "lab/getWaitingLab",
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
        } else if (status == 'sample_taken') {
            $('#editable-sample').DataTable().destroy().clear();
            var table = $('#editable-sample').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "lab/getSampleCollectedLab",
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
        } else if (status == 'complete') {
            $('#editable-sample').DataTable().destroy().clear();
            var table = $('#editable-sample').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "lab/getCompletedLab",
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
        } else if (status == 'delivered') {
            $('#editable-sample').DataTable().destroy().clear();
            var table = $('#editable-sample').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "lab/getDeliveredLab",
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
        }
    })

</script>
