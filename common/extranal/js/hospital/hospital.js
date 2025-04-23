"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editHospitalForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'hospital/editHospitalByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#editHospitalForm').find('[name="id"]').val(response.hospital.id).end()

                $('#editHospitalForm').find('[name="name"]').val(response.hospital.name).end()
                $('#editHospitalForm').find('[name="password"]').val(response.hospital.password).end()
                $('#editHospitalForm').find('[name="email"]').val(response.hospital.email).end()
                $('#editHospitalForm').find('[name="address"]').val(response.hospital.address).end()
                $('#editHospitalForm').find('[name="phone"]').val(response.hospital.phone).end()
                $('#editHospitalForm').find('[name="language"]').val(response.settings.language).end()
            }
        });
    });
});

$(document).ready(function () {
    "use strict";
    $(".packageChange").on("click", ".selectPackage", function () {
        "use strict";
        var hospital_id = $(this).attr('data-payment-id');
        $.ajax({
            url: 'hospital/getHospitalCurrentpackage?id=' + hospital_id,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#editChangeForm').find('[name="package"]').val(response.hospital.package).trigger('change');
                $('#editChangeForm').find('[name="package_type"]').val(response.hospital.package_duration).trigger('change');
                $('#editChangeForm').find('[name="package_price"]').val(response.hospital.price).end();
                $('#editChangeForm').find('[name="hospital_id"]').val(response.hospital.hospital_user_id).end();
                $('#editChangeForm').find('[name="id"]').val(response.hospital.package).end();
                $('#editChangeForm').find('[name="next_due_date"]').val(response.hospital.next_due_date).end();
                $('#myModal4').modal('show');
            }
        });
    })
})

$(document).ready(function () {
    "use strict";

    $(".package_duration_div").on("change", "#package_duration", function () {
        var duration = $(this).val();
        var package1 = $('#package_select').val();

        if (package1 !== null) {
            $.ajax({
                url: 'hospital/getPackageForHospitalRegisterationOnlyPackage?id=' + package1,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (response) {
                    var next_due_date = '';
                    if (response.package.name == 'trial' || response.package.name === 'Trial') {
                        $('.price-input').val(response.package.monthly_price).end();
                        var timestamp = Math.round(new Date().getTime() / 1000);
                        next_due_date = parseInt(timestamp) + parseInt(1296000);
                    } else {
                        if (duration === 'monthly') {
                            $('.price-input').val(response.package.monthly_price).end();
                            var timestamp = Math.round(new Date().getTime() / 1000);
                            next_due_date = parseInt(timestamp) + parseInt(2592000);
                        } else {
                            $('.price-input').val(response.package.yearly_price).end();
                            var timestamp = Math.round(new Date().getTime() / 1000);
                            next_due_date = parseInt(timestamp) + parseInt(31536000);
                        }



                    }

                    var date = new Date(next_due_date * 1000);

                    $('.next_due_date').val(date.getDate() +
                            "-" + (date.getMonth() + 1) +
                            "-" + date.getFullYear());
                }

            });

        }
    });
});

$(document).ready(function () {
    "use strict";
    $('.card1').hide();
    $("#cvv").removeAttr('required');
    $("#expire").removeAttr('required');
    $(document.body).on('change', '#selecttype', function () {

        var v = $("select.selecttype option:selected").val()
       
        if (v == 'Card') {
            $("#cvv").prop('required', 'true');
            $("#expire").prop('required', 'true');
            $('.cardsubmit').removeClass('hidden');
            $('.cashsubmit').addClass('hidden');
            $('.card1').show();
            
        } else {
            $("#cvv").removeAttr('required');
            $("#expire").removeAttr('required');
            $('.card1').hide();
            $('.cashsubmit').removeClass('hidden');
            $('.cardsubmit').addClass('hidden');
        }
    });

});


$(document).ready(function () {
    "use strict";
    $(".package_select_div").on("change", "#package_select", function () {
        "use strict";
        var package1 = $(this).val();

        var duration = $('#package_duration').val();
        if (package1 !== null) {
            $.ajax({
                url: 'hospital/getPackageForHospitalRegisterationOnlyPackage?id=' + package1,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (response) {
                    var next_due_date = '';
                    if (response.package.name === 'trial' || response.package.name === 'Trial') {
                        $('.price-input').val(response.package.monthly_price).end();
                        var timestamp = Math.round(new Date().getTime() / 1000);
                        next_due_date = parseInt(timestamp) + parseInt(1296000);
                    } else {
                        if (duration === 'monthly') {
                            $('.price-input').val(response.package.monthly_price).end();
                            var timestamp = Math.round(new Date().getTime() / 1000);
                            next_due_date = parseInt(timestamp) + parseInt(2592000);
                        } else {
                            $('.price-input').val(response.package.yearly_price).end();
                            var timestamp = Math.round(new Date().getTime() / 1000);
                            next_due_date = parseInt(timestamp) + parseInt(31536000);
                        }

                    }

                    var date = new Date(next_due_date * 1000);
                    console.log(date);
                    $('.next_due_date').val(date.getDate() +
                            "-" + (date.getMonth() + 1) +
                            "-" + date.getFullYear());
                    $('#package_id').val(response.package.id).end();
                }
            })

        }
    })
})


function cardValidation() {
    "use strict";
    var valid = true;
    var cardNumber = $('#card').val();
    var expire = $('#expire').val();
    var cvc = $('#cvv').val();

    $("#error-message").html("").hide();

    if (cardNumber.trim() == "") {
        valid = false;
    }

    if (expire.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }

    if (valid == false) {
        $("#error-message").html("All Fields are required").show();
    }

    return valid;
}

Stripe.setPublishableKey(gateway);


function stripeResponseHandler(status, response) {
    "use strict";
    if (response.error) {

        $("#submit-btn").show();
        $("#loader").css("display", "none");

        $("#error-message").html(response.error.message).show();
        $("#submit-btn").attr("disabled", false);
        $("#error-message").html(response.error.message).show();
    } else {

        var token = response['id'];
        if (token != null) {
            $("#token").append("<input type='hidden' name='token' value='" + token + "' />");

            $('#editChangeForm').submit();
        } else {
            alert('Please Check Your Card details');
            $("#submit-btn").attr("disabled", false);
        }


    }
}

function stripePay(e) {

    e.preventDefault();
    "use strict";
    var valid = cardValidation();

    if (valid == true) {
        $("#submit-btn").attr("disabled", true);
        $("#loader").css("display", "inline-block");
        var expire = $('#expire').val()
        var arr = expire.split('/');
        Stripe.createToken({
            number: $('#card').val(),
            cvc: $('#cvv').val(),
            exp_month: arr[0],
            exp_year: arr[1]
        }, stripeResponseHandler);

        //submit from callback
        return false;
    }
}


$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
        responsive: true,

        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
            {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
            {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
            {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
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

    table.buttons().container().appendTo('.custom_buttons');
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});
