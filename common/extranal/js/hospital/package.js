"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#editPackageForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'package/editPackageByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#editPackageForm').find('[name="id"]').val(response.package.id).end();

                $('#editPackageForm').find('[name="name"]').val(response.package.name).end();
                $('#editPackageForm').find('[name="password"]').val(response.package.password).end();
                $('#editPackageForm').find('[name="email"]').val(response.package.email).end();
                $('#editPackageForm').find('[name="address"]').val(response.package.address).end();
                $('#editPackageForm').find('[name="phone"]').val(response.package.phone).end();
                $('#editPackageForm').find('[name="language"]').val(response.settings.language).end();
            }
        });
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
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            {
                extend: 'print',
                exportOptions: {
                    columns: [1, 2, 3, 4],
                }
            },
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


