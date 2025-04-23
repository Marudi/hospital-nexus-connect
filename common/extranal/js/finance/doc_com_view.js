"use strict";
$(document).ready(function () {
  "use strict";
  $(".flashmessage").delay(3000).fadeOut(100);
});

$(document).ready(function () {
  "use strict";
  if ($(".dpd1").val() != " " && $(".dpd2").val() != " ") {
    var message =
      doctor_name +
      "'s Commission from " +
      $(".dpd1").val() +
      " TO " +
      $(".dpd2").val();
  } else {
    var message = doctor_name + "'s Commission";
  }
  var table = $("#editable-sample").DataTable({
    responsive: true,

    dom:
      "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      {
        extend: "copyHtml5",
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        footer: true,
        messageTop: message,
      },
      {
        extend: "excelHtml5",
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        footer: true,
        messageTop: message,
      },
      {
        extend: "csvHtml5",
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        footer: true,
        messageTop: message,
      },
      {
        extend: "pdfHtml5",
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        footer: true,
        messageTop: message,
      },
      {
        extend: "print",
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        footer: true,
        messageTop: message,
      },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: -1,
    order: [[0, "desc"]],

    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });
  table.buttons().container().appendTo(".custom_buttons");
});
