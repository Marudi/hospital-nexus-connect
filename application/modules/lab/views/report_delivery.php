
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('report_delivery'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('lab'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('report_delivery'); ?></li>
                                       
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
    <link href="common/extranal/css/description.css" rel="stylesheet">
        <!-- page start-->
        <ul>
            <li class="description">For a delivery, click on the "Deliver" button,  enter the reciever name and submit.
                <span class="close">&times;</span>
            </li>
        </ul>
        <link href="common/extranal/css/lab/lab.css" rel="stylesheet">

        <section class="col-md-12">
            <div class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('report_delivery'); ?></h4> 
                                       
                                    </div>
         
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-2">
                            <label><?php echo lang('delivery') ." ". lang('status');?></label>
                            <select class="form-control status">
                                <option value="all"><?php echo lang('all'); ?></option>
                                <option value="pending"><?php echo lang('pending'); ?></option>
                                <option value="delivered"><?php echo lang('delivered'); ?></option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label><?php echo lang('category');?></label>
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
<!--                        <div class="col-md-4">
                            <label><?php echo lang('report') ." ". lang('status');?></label>
                            <select class="form-control report_status">
                                <option value="all"><?php echo lang('all'); ?></option>
                                <option value="pending"><?php echo lang('pending'); ?></option>
                                <option value="drafted"><?php echo lang('drafted'); ?></option>
                                <option value="completed"><?php echo lang('completed'); ?></option>
                            </select>
                        </div>-->
                    </div>
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
                    <table class="table mb-0" id="editable-sample1">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('invoice_no'); ?></th>
                                <th><?php echo lang('invoice_date_time'); ?></th>
                                <th><?php echo lang('test_name'); ?></th>
                                <th><?php echo lang('test') . " " . lang('status'); ?></th>
                                <th><?php echo lang('report') . " " . lang('status'); ?></th>
                                <th><?php echo lang('delivery') . " " . lang('status'); ?></th>
                                <th><?php echo lang('delivery_date_time'); ?></th>
                                <th><?php echo lang('report_receiver'); ?></th>
                                <th><?php echo lang('bill_status'); ?></th>
                                <th class=""><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>



                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<div class="modal fade" role="dialog" id="deliveryStatusModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
                
                <h5 class="modal-title"> <?php echo lang("report")." ".lang('delivery'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
      <div class="modal-body">
          <form action="lab/changeDeliveryStatus" method="post" style="padding: 15px 0px !important;">
              <div class="form-group">
                  <label><?php echo lang('receiver_name'); ?></label>
                  <input type="text" name="receiver_name" id="receiver_name" class="form-control">
              </div>
              <input type="hidden" name="id" id="deliveryID">
              <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info submit_button"><?php echo lang('deliver'); ?> <?php echo lang('report'); ?></button>
                                                            </div>
              
          </form>
      </div>
    </div>
  </div>
</div>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script src="common/extranal/js/lab/lab.js"></script>
<script src="common/extranal/js/description.js"></script>
<script>
    $(document).ready(function () {
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
                url: "lab/getDeliveryReport?status="+status+"&category="+category+"&from="+fromDate+'&to='+toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[2, "desc"]],

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
                url: "lab/getDeliveryReport?status="+status+"&category="+category+"&from="+fromDate+'&to='+toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[2, "desc"]],

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
                url: "lab/getDeliveryReport?status="+status+"&category="+category+"&from="+fromDate+'&to='+toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[2, "desc"]],

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
        let data = new FormData();
        data.append('id', id);
        data.append('status', status);
        axios.post('<?php echo site_url('lab/changeTestStatus'); ?>', data)
    })
    
    $(document).on("click", ".changeDeliveryStatus", function(e) {
        let id = $(this).data("id");
        axios.get('<?php echo site_url('lab/getReportReceiver') ?>?id='+id)
                .then(response => {
                    $('#receiver_name').val(response.data.receiver_name);
                    $('#deliveryID').val(id);
                    $('#deliveryStatusModal').modal("show");
                })
    })
    
    $(document).on("change", '.delivery_status', function(e) {
        let id = $(this).data("id");
        let status = $(this).val();
                let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        let data = new FormData();
        data.append('id', id);
        data.append('status', status);
        data.append('check', '1');
        axios.post('<?php echo site_url('lab/changeDeliveryStatus'); ?>', data)
                .then(response => {
                    let status = $('.status').val();
        let category = $('.category').val();
         "use strict";
         $('#editable-sample1').DataTable().destroy().clear();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getDeliveryReport?status="+status+"&category="+category+"&from="+fromDate+'&to='+toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[2, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
                })
        
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
                url: "lab/getDeliveryReport?status="+status+"&category="+category+"&from="+fromDate+'&to='+toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[2, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    })

</script>
