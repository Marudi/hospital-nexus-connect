"use strict";
var myEditor;
var myEditor3;
$(document).ready(function () {
  ClassicEditor.create(document.querySelector("#editor1"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor = editor;
      // editor.model.document.on("change:data", (evt, data) => {
      //   //let html = $('.ck-restricted-editing_mode_standard').text();
      //   let html = $(".ck-restricted-editing_mode_standard").html();
      //   $("#profile").val(html);
      //   //    let text = editor.getData();
      //   //    $('#report').val(text);
      // });
    })
    .catch((error) => {
      console.error(error);
    });

  ClassicEditor.create(document.querySelector("#editor3"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor3 = editor;
      // editor.model.document.on("change:data", (evt, data) => {
      //   //let html = $('.ck-restricted-editing_mode_standard').text();
      //   let html = $(".ck-restricted-editing_mode_standard").html();
      //   $("#profile1").val(html);
      //   //    let text = editor.getData();
      //   //    $('#report').val(text);
      // });
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
    $("#editLaboratoristForm").trigger("reset");
    $("#myModal2").modal("show");
    $.ajax({
      url: "laboratorist/editLaboratoristByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        $("#editLaboratoristForm")
          .find('[name="id"]')
          .val(response.laboratorist.id)
          .end();
        $("#editLaboratoristForm")
          .find('[name="name"]')
          .val(response.laboratorist.name)
          .end();
        $("#editLaboratoristForm")
          .find('[name="password"]')
          .val(response.laboratorist.password)
          .end();
        $("#editLaboratoristForm")
          .find('[name="email"]')
          .val(response.laboratorist.email)
          .end();
        $("#editLaboratoristForm")
          .find('[name="address"]')
          .val(response.laboratorist.address)
          .end();
        $("#editLaboratoristForm")
          .find('[name="phone"]')
          .val(response.laboratorist.phone)
          .end();
        if (response.laboratorist.profile !== null) {
          myEditor3.setData(response.laboratorist.profile);
          // $("#profile1").val(response.laboratorist.profile);
        }
        if (
          typeof response.laboratorist.img_url !== "undefined" &&
          response.laboratorist.img_url !== ""
        ) {
          $("#img").attr("src", response.laboratorist.img_url);
        }
        if (
          typeof response.laboratorist.signature !== "undefined" &&
          response.laboratorist.signature !== ""
        ) {
          $("#signature").attr("src", response.laboratorist.signature);
        }
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
    "#remove_button_laboratorist_signature",
    function (e) {
      e.preventDefault();
      $("#signature").attr("src", "");
      var id = $("#id_value").val();
      $.ajax({
        url: "laboratorist/deleteLaboratoristImage?id=" + id,
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
