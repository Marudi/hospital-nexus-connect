
$(document).ready(function () {
    "use strict";
    $(".selectPackage_div").on("click", ".selectPackage", function () {
        "use strict";


        var hospital_id = $(this).attr('data-payment-id');
        $('#myModal2').modal('show');
        $.ajax({
            url: 'settings/getHospitalPayments?id=' + hospital_id,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                var next_due_date = '';
                $('.package_name').val(response.package.name).end();
                var timestamp = '';
                if (response.hospital.package_duration === 'monthly') {
                    $('.package_price').val(response.package.monthly_price).end();
                    if (Math.round(new Date().getTime() / 1000) <= response.hospital.next_due_date_stamp) {
                        timestamp = response.hospital.next_due_date_stamp;
                    } else {
                        timestamp = Math.round(new Date().getTime() / 1000);
                    }

                    next_due_date = parseInt(timestamp) + parseInt(2592000);


                } else {
                    $('.package_price').val(response.package.yearly_price).end();
                    if (Math.round(new Date().getTime() / 1000) <= response.hospital.next_due_date_stamp) {
                        timestamp = response.hospital.next_due_date_stamp;



                    } else {
                        timestamp = Math.round(new Date().getTime() / 1000);
                    }

                    next_due_date = parseInt(timestamp) + parseInt(31536000);


                }


                var date = new Date(next_due_date * 1000);

                $('.next_due_date').val(date.getDate() +
                        "-" + (date.getMonth() + 1) +
                        "-" + date.getFullYear());
                $('.package_type').val(response.hospital.package_duration).end();
                $('#package_id').val(response.package.id).val();
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
                    columns: [0, 1, 2, 3, 4, 5],
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

            $('#editDepositForm').submit();
        } else {
            alert('Please Check Your Card details');
            $("#submit-btn").attr("disabled", false);
        }



    }
}

function stripePay(e) {
    "use strict";
    e.preventDefault();
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


        return false;
    }
}


