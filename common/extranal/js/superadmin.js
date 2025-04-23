"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editSuperadminForm').trigger("reset");
        $.ajax({
            url: 'superadmin/editSuperadminByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#editSuperadminForm').find('[name="id"]').val(response.superadmin.id).end()
                $('#editSuperadminForm').find('[name="name"]').val(response.superadmin.name).end()
                $('#editSuperadminForm').find('[name="password"]').val(response.superadmin.password).end()
                $('#editSuperadminForm').find('[name="email"]').val(response.superadmin.email).end()
                $('#editSuperadminForm').find('[name="address"]').val(response.superadmin.address).end()
                $('#editSuperadminForm').find('[name="phone"]').val(response.superadmin.phone).end()
                $('#myModal2').modal('show');
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
        }
    });
    table.buttons().container().appendTo('.custom_buttons');
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});


