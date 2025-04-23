"use strict";
$(document).ready(function () {
    "use strict";
    $("#fieldset_p").on("click", "#monthly-1", function () {
        $('.text1').removeClass('hidden');
        $('.text2').addClass('hidden');
        $(".monthly_text").css("color", "white");
        $(".yearly_text").css("color", "#1A7989");
        $('.monthlyPackage').removeClass('hidden');
        $('.yearlyPackage').addClass('hidden');
    })
    $("#fieldset_p").on("click", "#yearly-1", function () {
        "use strict";
        $('.text2').removeClass('hidden');
        $('.text1').addClass('hidden');
        $('.monthlyPackage').addClass('hidden');
        $('.yearlyPackage').removeClass('hidden');
        $(".yearly_text").css("color", "white");
        $(".monthly_text").css("color", "#1A7989");

    })
})

$(document).ready(function () {
    "use strict";
    $(".price-actions").on("click", ".selectPackage", function () {
        "use strict";
        var package_id = $(this).attr('data-package-id');
        var package_type = $(this).attr('data-package-type');
        var hospital_id = $('#hospital_id').val();

        $.ajax({
            url: 'settings/getHospitalDetailsPayment?id=' + hospital_id,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                if (package_id === response.hospital_payment.package && package_type === response.hospital_payment.package_duration) {
                    alert('Already In this Package. Please Choose Another Plan');
                } else {
                    $('#myModal2').modal('show');
                    $.ajax({
                        url: 'settings/editPackageById?id=' + package_id,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                        success: function (response1) {
                            var next_due_date = '';
                            $('.package_name').val(response1.package.name).end();
                            if (package_type === 'monthly') {
                                $('.package_price').val(response1.package.monthly_price).end();

                                var timestamp = Math.round(new Date().getTime() / 1000);
                                next_due_date = parseInt(timestamp) + parseInt(2592000);


                            } else {
                                $('.package_price').val(response1.package.yearly_price).end();

                                var timestamp = Math.round(new Date().getTime() / 1000);
                                next_due_date = parseInt(timestamp) + parseInt(31536000);


                            }

                            var date = new Date(next_due_date * 1000);

                            $('.next_due_date').val(date.getDate() +
                                    "-" + (date.getMonth() + 1) +
                                    "-" + date.getFullYear());
                            $('.package_type').val(package_type).end();
                            $('#package_id').val(response1.package.id).val();

                        }
                    });
                }
            }
        });
    });
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

//set your publishable key
Stripe.setPublishableKey(gateway);


function stripeResponseHandler(status, response)
{
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



