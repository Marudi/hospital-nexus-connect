$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        $("#loader").show();
        var iid = $(this).attr('data-id');
        $('#editFaqForm').trigger("reset");
        $.ajax({
            url: 'faq/editFaqByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#editFaqForm').find('[name="id"]').val(response.faq.id).end()
                $('#editFaqForm').find('[name="title"]').val(response.faq.title).end()
                $('#editFaqForm').find('[name="description"]').val(response.faq.description).end()
                $('#myModal2').modal('show');
            },
            complete: function () {
                $("#loader").hide();
            }
        });
    });
});





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

