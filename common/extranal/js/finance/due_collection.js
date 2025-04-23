"use strict";
$(document).ready(function () {
  "use strict";
  $(".table").on("click", ".depositButton", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    var from = $(this).attr("data-from");
    $("#due_amount").val("");
    $("#payment_id").val("");
    $("#patient_id").val("");
    $("#name").val("");
    $("#invoice_no").val("");
    $("#date").val("");
    $("#editDepositform").trigger("reset");
    $("#myModal").modal("show");
    $.ajax({
      url: "finance/getDepositByInvoiceIdForDeposit?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        var d = new Date();
        var strDate =
          d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear();
        $("#due_amount").val(response.response);
        if (from == 'appointment') {
          $("#deposited_amount").val(response.response);
          $('#deposited_amount').attr('readonly', true);
        }
        $("#payment_id").val(iid);
        $("#patient_id").val(response.patient.id);
        $("#name").val(response.patient.name);
        $("#invoice_no").val(iid);
        $("#date").val(strDate);
      },
    });
  });
});
$(document).ready(function () {
  "use strict";
  var date_to = $("#date_to").val();
  var date_from = $("#date_from").val();
  var table = $("#editable-sample4").DataTable({
    responsive: true,
    //   dom: 'lfrBtip',

    processing: true,
    serverSide: true,
    searchable: true,
    ajax: {
      url:
        "finance/getDuePayment?start_date=" +
        date_from +
        "&end_date=" +
        date_to,
      type: "POST",
    },
    scroller: {
      loadingIndicator: true,
    },
    dom:
      "<'row'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      {
        extend: "copyHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "excelHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "csvHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "pdfHtml5",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
      {
        extend: "print",
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] },
      },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: 100,

    order: [[0, "desc"]],

    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });
  table.buttons().container().appendTo(".custom_buttons");
});
$(document).ready(function () {
  "use strict";
  $(".flashmessage").delay(3000).fadeOut(100);
});
