"use strict";
var myEditor;
var myEditor3;
$(document).ready(function () {
  ClassicEditor.create(document.querySelector("#editor1"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor = editor;
    })
    .catch((error) => {
      console.error(error);
    });

  ClassicEditor.create(document.querySelector("#editor3"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor3 = editor;
    })
    .catch((error) => {
      console.error(error);
    });
});
$(document).ready(function () {
  "use strict";
  $(".table").on("click", ".editbutton", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    $("#editNurseForm").trigger("reset");
    $.ajax({
      url: "nurse/editNurseByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        $("#editNurseForm").find('[name="id"]').val(response.nurse.id).end();
        $("#editNurseForm")
          .find('[name="name"]')
          .val(response.nurse.name)
          .end();
        $("#editNurseForm")
          .find('[name="password"]')
          .val(response.nurse.password)
          .end();
        $("#editNurseForm")
          .find('[name="email"]')
          .val(response.nurse.email)
          .end();
        $("#editNurseForm")
          .find('[name="address"]')
          .val(response.nurse.address)
          .end();
        $("#editNurseForm")
          .find('[name="phone"]')
          .val(response.nurse.phone)
          .end();
        if (response.nurse.profile !== null) {
          myEditor3.setData(response.nurse.profile);
          //$("#profile1").val(response.nurse.profile);
        }
        if (
          typeof response.nurse.img_url !== "undefined" &&
          response.nurse.img_url !== ""
        ) {
          $("#img").attr("src", response.nurse.img_url);
        }
        if (
          typeof response.nurse.signature !== "undefined" &&
          response.nurse.signature !== ""
        ) {
          $("#signature").attr("src", response.nurse.signature);
        }
        $("#myModal2").modal("show");
      },
    });
  });
});

$(document).ready(function () {
  "use strict";
  var table = $("#editable-sample").DataTable({
    responsive: true,

    dom:
      "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      { extend: "copyHtml5", exportOptions: { columns: [1, 2, 3, 4] } },
      { extend: "excelHtml5", exportOptions: { columns: [1, 2, 3, 4] } },
      { extend: "csvHtml5", exportOptions: { columns: [1, 2, 3, 4] } },
      { extend: "pdfHtml5", exportOptions: { columns: [1, 2, 3, 4] } },
      { extend: "print", exportOptions: { columns: [1, 2, 3, 4] } },
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

$(document).ready(function () {
  "use strict";
  $(".flashmessage").delay(3000).fadeOut(100);
  $(".signature_class").on(
    "click",
    "#remove_button_nurse_signature",
    function (e) {
      e.preventDefault();
      $("#signature").attr("src", "");
      var id = $("#id_value").val();
      $.ajax({
        url: "nurse/deleteNurseImage?id=" + id,
        method: "GET",
        data: "",
        dataType: "json",
        success: function (response) {
          $("#signature").attr("src", "");
          console.log("deleted");
          // $("#signature").removeAttribute("src", "");
          // $("#signature").style.display = "none";
        },
      });
    }
  );
});
