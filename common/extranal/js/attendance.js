"use strict";
$('.applyAttendanceFilter').on('click', function() {
    "use strict";
        let id = $('#staff_select').val();
        let month = $('#attendance_month').val();
        let year = $('#attendance_year').val();
        if(month === '' && year === '') {
            alert('Select Month & Year');
        } else {
            if(id === null) {
                id = 0;
            }
            $.ajax({
                url: 'attendance/createAttendanceTable?month=' + month + '&year=' + year + '&id=' + id,
                method: 'GET',
                data: '',
                dataType: 'json',
             success: function (response) {"use strict";
                $('.attendanceDiv').empty();
                $('.attendanceDiv').append(response);
            }
            });
        }
    });
    
    $(document).on('click', '.markAttandance', function() {
        "use strict";
        let date = $(this).data('id');
        let id = $(this).data('employee');
        $.ajax({
                url: 'attendance/getAttendanceDetails?date=' + date + '&id=' + id,
                method: 'GET',
                data: '',
                dataType: 'json',
             success: function (response) {
                 "use strict";
                $('#attendanceForm').find('[name="clock_in"]').val(response.clock_in).end();
                $('#attendanceForm').find('[name="clock_out"]').val(response.clock_out).end();
                $('#attendanceForm').find('[name="work_from"]').val(response.office).end();
                $('#attendanceDate').val(date);
                $('#staffId').val(response.id);
                console.log(response.halfday)
                console.log(response.late)
                 if(response.late === true) {
                    $('#late').prop('checked', true );
                }if(response.halfday === true) {
                    $('#halfday').prop('checked', true);
                } else {
                    $('#halfday').prop('checked', false);
                    $('#late').prop('checked', false);
                }
                $('#attendanceModal').modal('show');
            }
            });
        
    });
    
    
    $(document).ready(function () {
        "use strict";
         $('#attendance_year').on('change', function() {
             "use strict";
             $("#attendance_month").empty().trigger("change");
             let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                let date = new Date();
                let current_year = date.getFullYear();
                let current_month = date.getMonth();
                let year = $('#attendance_year').val();
                if(year < current_year) {
                    for(let i=0; i<12; i++) {
                        var data = {
                            id: months[i],
                            text: months[i]
                        };
                
                        var newOption = new Option(data.text, data.id, false, false);
                        $("#attendance_month").append(newOption).trigger("change");
                    }
                } else {
                    for(let i=0; i<=current_month; i++) {
                        var data = {
                            id: months[i],
                            text: months[i]
                        };
                
                        var newOption = new Option(data.text, data.id, false, false);
                        $("#attendance_month").append(newOption).trigger("change");
                    }
                }
                
         });
    "use strict";
        $('.single_date_picker').datepicker({
                    format: 'dd-mm-yyyy'
                });
    
         
        
        $("#staff_select").select2({
            placeholder: select_staff,
            allowClear: true,
            ajax: {
                url: 'settings/getStaffinfoWithAddNewOption',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
        
        $("#edit_leave_staff").select2({
            placeholder: select_staff,
            allowClear: true,
            ajax: {
                url: 'settings/getStaffinfoWithAddNewOption',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
        });

    $(document).ready(function () {
        "use strict";
        $(".table").on("click", ".editbutton", function () {
            "use strict";
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#editLeaveForm').trigger("reset");
            $.ajax({
                url: 'leave/getLeaveById?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
           success: function (response) {"use strict";
               
                // Populate the form fields with the data returned from server
                $('#editLeaveForm').find('[name="id"]').val(response.leave.id).end();
                $('#editLeaveForm').find('[name="name"]').val(response.name).end();
                $('#editLeaveForm').find('[name="reason"]').val(response.leave.reason).end();
                $('#edit_Leave_select2').val(response.leave.type).trigger('change');
                $('#editLeaveStatus').val(response.leave.status).trigger("change");
                if(response.leave.duration == 'multiple') {
                    $('#edit_multi_date_picker').val(response.leave.date);
                    $('.singleDate').css('display', 'none');
                    $('.multiDate').css('display', 'block');

                    $('.singleDate').prop('required', false);
                    $('.multiDate').prop('required', true);
                } else {
                    $('#editDate').val(response.leave.date);
                    $('.singleDate').css('display', 'block');
                    $('.multiDate').css('display', 'none');

                    $('.singleDate').prop('required', true);
                    $('.multiDate').prop('required', false);
                }
                $("#"+response.leave.duration).prop("checked", true);
                var data = {
                    id: response.leave.staff,
                    text: response.name
                };
                
                var newOption = new Option(data.text, data.id, false, false);
                $("#edit_leave_staff").append(newOption).trigger("change");

                $('#myModal2').modal('show');
            }
            });
        });
    });

    $(document).ready(function () {
        "use strict";
        $('.ca_select2').select2();
        $(".table").on("click", ".inffo", function () {
              "use strict";
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
                "use strict";
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
        var table = $('#editable-sample').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "leave/getLeave", 
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
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[1, "asc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                "url": "common/assets/DataTables/languages/"+language+".json"
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
    
    $('.leave_duration').on('change', function() {
        "use strict";
    let duration = $("input[name='duration']:checked").val();
    if(duration === 'single' || duration === 'halfday') {
        $('.singleDate').css('display', 'block');
        $('.multiDate').css('display', 'none');
        
        $('.singleDate').prop('required', true);
        $('.multiDate').prop('required', false);
    } else {
        $('.singleDate').css('display', 'none');
        $('.multiDate').css('display', 'block');
        
        $('.singleDate').prop('required', false);
        $('.multiDate').prop('required', true);
    }
        console.log();
    })

    $(document).ready(function () {
        "use strict";
        $(".flashmessage").delay(3000).fadeOut(100);
    });


