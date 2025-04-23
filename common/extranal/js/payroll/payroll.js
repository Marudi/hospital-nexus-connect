"use strict";
$(document).ready(function () {
    "use strict";
    $('#payroll_year').on('change', function () {
        let month = $('#payroll_month').val();
        let year = $('#payroll_year').val();

        $.ajax({
            url: 'payroll/payrollTableByMonthYear?month=' + month + '&year=' + year,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                  $('#salary-sample').DataTable().clear().destroy();
                $('.payroll_table').empty();
                $('.payroll_table').append(response);

              
                
                let table2 = $('#salary-sample').DataTable({
                    responsive: true,
                    "processing": true,
                    "searchable": true,
                    scroller: {
                        loadingIndicator: true
                    },

                    dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                    iDisplayLength: 10,
                    "order": [[0, "desc"]],

                    "language": {
                        "lengthMenu": "_MENU_",
                        search: "_INPUT_",
                        "url": "common/assets/DataTables/languages/" + language + ".json"
                    }
                });
            }
        });
    });

    $('#payroll_month').on('change', function () {
        "use strict";
        let month = $('#payroll_month').val();
        let year = $('#payroll_year').val();

        $.ajax({
            url: 'payroll/payrollTableByMonthYear?month=' + month + '&year=' + year,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                $('#salary-sample').DataTable().clear().destroy();
                $('.payroll_table').empty();
                $('.payroll_table').append(response);

                
                let table2 = $('#salary-sample').DataTable({
                    responsive: true,
                    "processing": true,
                    "searchable": true,
                    scroller: {
                        loadingIndicator: true
                    },

                    dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                    iDisplayLength: 10,
                    "order": [[0, "desc"]],

                    "language": {
                        "lengthMenu": "_MENU_",
                        search: "_INPUT_",
                        "url": "common/assets/DataTables/languages/" + language + ".json"
                    }
                });
            }
        });
    });

    $('#payroll_year').on('change', function () {
        "use strict";
        $("#payroll_month").empty().trigger("change");
        let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        let date = new Date();
        let current_year = date.getFullYear();
        let current_month = date.getMonth();
        let year = $('#payroll_year').val();
        if (year < current_year) {
            for (let i = 0; i < 12; i++) {
                var data = {
                    id: months[i],
                    text: months[i]
                };

                var newOption = new Option(data.text, data.id, false, false);
                $("#payroll_month").append(newOption).trigger("change");
            }
        } else {
            for (let i = 0; i <= current_month; i++) {
                var data = {
                    id: months[i],
                    text: months[i]
                };

                var newOption = new Option(data.text, data.id, false, false);
                $("#payroll_month").append(newOption).trigger("change");
            }
        }

    })

    $('.generatePayroll').on('click', function () {
        "use strict";
        let month = $('#payroll_month').val();
        let year = $('#payroll_year').val();
        $.ajax({
            url: 'payroll/generatePayroll?month=' + month + '&year=' + year,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                $('#salary-sample').DataTable().clear().destroy();
                $('.payroll_table').empty();
                $('.payroll_table').append(response);




                
                let table2 = $('#salary-sample').DataTable({
                    responsive: true,
                    "processing": true,
                    "searchable": true,
                    scroller: {
                        loadingIndicator: true
                    },

                    dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                    iDisplayLength: 10,
                    "order": [[0, "desc"]],

                    "language": {
                        "lengthMenu": "_MENU_",
                        search: "_INPUT_",
                        "url": "common/assets/DataTables/languages/" + language + ".json"
                    }
                });
                table2.buttons().container().appendTo('.custom_buttons');





            }

        });
    });
});




$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".inffo", function () {
        "use strict";
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');

        $("#img1").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('.nameClass').html("").end();
        $('.emailClass').html("").end();
        $('.addressClass').html("").end();
        $('.phoneClass').html("").end();
        $('.departmentClass').html("").end();
        $('.profileClass').html("").end();
        $.ajax({
            url: 'doctor/editDoctorByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                // Populate the form fields with the data returned from server
                $('#editDoctorForm').find('[name="id"]').val(response.doctor.id).end();
                $('.nameClass').append(response.doctor.name).end();
                $('.emailClass').append(response.doctor.email).end();
                $('.addressClass').append(response.doctor.address).end();
                $('.phoneClass').append(response.doctor.phone).end();
                $('.departmentClass').append(response.doctor.department).end();
                $('.profileClass').append(response.doctor.profile).end();

                if (typeof response.doctor.img_url !== 'undefined' && response.doctor.img_url != '') {
                    $("#img1").attr("src", response.doctor.img_url);
                }

                $('#infoModal').modal('show');
            }
        });
    });
});







$(document).ready(function () {
    "use strict";
    var table2 = $('#salary-sample').DataTable({
        responsive: true,
        "processing": true,
        "searchable": true,
        scroller: {
            loadingIndicator: true
        },

        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        iDisplayLength: 10,
        "order": [[0, "desc"]],

        "language": {
            "lengthMenu": "_MENU_",
            search: "_INPUT_",
            "url": "common/assets/DataTables/languages/" + language + ".json"
        }
    });
    table2.buttons().container().appendTo('.custom_buttons');

    var table = $('#editable-sample').DataTable({
        responsive: true,
        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "leave/getLeaveType",
            type: 'POST',
        },
        scroller: {
            loadingIndicator: true
        },

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
                    columns: [0, 1, 2, 3, 4, 5, 6],
                }
            },
        ],
        "columnDefs": [
            {"width": "50%", "targets": 0}
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
            "url": "common/assets/DataTables/languages/" + language + ".json"
        }
    });
    table.buttons().container().appendTo('.custom_buttons');
});






$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});


