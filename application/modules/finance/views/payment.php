
<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"> <?php echo lang('payments'); ?> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item">Finance</li>
                                        <li class="breadcrumb-item active"> <?php echo lang('payments'); ?>  </li>
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
           <link href="common/extranal/css/finance/payments.css" rel="stylesheet">
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"><?php echo lang('payments') ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                        <a  href="finance/addPaymentView" class="btn btn-primary waves-effect waves-light w-xs"><i class="fa fa-plus-circle"></i> <?php echo lang('add_payment'); ?></a>
                                           
                                        </div>
                                    </div>
           

            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="row">
                        <div class="col-md-4"></div>
                <div class="col-md-4 date_field" style="margin-top: 10px; float: left; margin-left: -14px;">
                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control default-date-picker" name="date_from" id="date_from" value="" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                    <span class="input-group-text"><?php echo lang('to'); ?></span>
                                    <input type="text" class="form-control default-date-picker" name="date_to" id="date_to" value="" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                </div>

                        </div>
                        <div class="col-md-4"></div>
                </div>
                  
                    <table class="table mb-0" id="editable-sample3">
                        <thead>
                            <tr>
                                <th><?php echo lang('invoice_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('doctor'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('from'); ?></th>
                                <th><?php echo lang('sub_total'); ?></t>
                                <th><?php echo lang('vat'); ?></th>
                                <th><?php echo lang('discount'); ?></th>
                                <th><?php echo lang('grand_total'); ?></th>
                                <th><?php echo lang('paid'); ?> <?php echo lang('amount'); ?></th>
                                <th><?php echo lang('due'); ?></th>
                                <th><?php echo lang('remarks'); ?></th>
                                <th class="option_th no-print"><?php echo lang('options'); ?></th>
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



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script defer type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script>
<script src="common/extranal/js/finance/payments.js"></script>
<script>
$(document).ready(function () {
  

 $('#date_from').on('change',function(){
        var date_from=$(this).val();
        var date_to=$('#date_to').val();
        var date_from_split=date_from.split('-');
        var date_from_new=date_from_split[1] +'/'+date_from_split[0]+'/'+date_from_split[2]
        if(date_to !='' || date_to !=null){
            var date_to_split=date_to.split('-');
            var date_to_new=date_to_split[1] +'/'+date_to_split[0]+'/'+date_to_split[2];
        }
    if(date_to !='' || date_to !=null){
        if(Date.parse(date_to_new) <= Date.parse(date_from_new)){
           
            alert('Select a Valid Date. End Date should be Greater than Start Date');
            $(this).val("");
        }else{
            $('#editable-sample3').DataTable().destroy().clear();
            "use strict";
     var table = $('#editable-sample3').DataTable({
        responsive: true,
        //   dom: 'lfrBtip',

        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "finance/getPayment?start_date="+date_from+"&end_date="+date_to,
            type: 'POST',
        },
        scroller: {
            loadingIndicator: true
        },
        dom: "<'row'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
            {extend: 'excelHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
            {extend: 'csvHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
            {extend: 'print', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
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
            "url": "common/assets/DataTables/languages/"+language+".json"
        }
    });
    table.buttons().container().appendTo('.custom_buttons');
        }
    }
    })
    $('#date_to').on('change',function(){
        var date_to=$(this).val();
        var date_from=$('#date_from').val();
         
        var date_to_split=date_to.split('-');
        var date_to_new=date_to_split[1] +'/'+date_to_split[0]+'/'+date_to_split[2];
        if(date_from !='' || date_from !=null){
            var date_from_split=date_from.split('-');
            var date_from_new=date_from_split[1] +'/'+date_from_split[0]+'/'+date_from_split[2];
            
        }
    if(date_from !='' || date_from !=null){
        if(Date.parse(date_to_new) <= Date.parse(date_from_new)){
           
            alert('Select a Valid Date. End Date should be Greater than Start Date');
            $(this).val("");
        }else{
            $('#editable-sample3').DataTable().destroy().clear();
            "use strict";
     var table = $('#editable-sample3').DataTable({
        responsive: true,
        //   dom: 'lfrBtip',

        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "finance/getPayment?start_date="+date_from+"&end_date="+date_to,
            type: 'POST',
        },
        scroller: {
            loadingIndicator: true
        },
        dom: "<'row'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
            {extend: 'excelHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
            {extend: 'csvHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
            {extend: 'print', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], }},
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
            "url": "common/assets/DataTables/languages/"+language+".json"
        }
    });
    table.buttons().container().appendTo('.custom_buttons');
        }
    }
    })
})

</script>