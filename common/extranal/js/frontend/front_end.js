"use strict";
function testFuntion(event) {
    "use strict";
    event.preventDefault();
    setTimeout(function () {
        $('#submitTest').submit();
    }, 2000)
}
$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});
$(document).ready(function () {
    "use strict";
    $("#fieldset_p").on("click", "#monthly-1", function () {
        $(".monthly_text").css("color", "white");
        $(".yearly_text").css("color", "#1A7989");

        $('.text1').removeClass('hidden');
        $('.text2').addClass('hidden');
    });
    $("#fieldset_p").on("click", "#yearly-1", function () {
        "use strict";
        $(".yearly_text").css("color", "white");
        $(".monthly_text").css("color", "#1A7989");
        $('.text2').removeClass('hidden');
        $('.text1').addClass('hidden');

    });
});
$(document).ready(function () {
    "use strict";
    $(".trial_version_div_div").on("click", ".trial_version", function () {
        "use strict";
        if ($(this).is(':checked')) {
            $(".payment_div").hide();  // checked
            if (payment_gateway == 'Stripe' || payment_gateway == 'PayPal') {
                $("#cvv").removeAttr('required');
                $("#expire").removeAttr('required');
            }
            if (payment_gateway == 'Stripe') {

                $('#submit-btn').removeAttr("onclick");
            }

        } else {
            "use strict";
            $(".payment_div").show();  // unchecked
            if (payment_gateway == 'Stripe' || payment_gateway == 'PayPal') {
                $("#cvv").prop('required', 'true');
                $("#expire").prop('required', 'true');
            }
            if (payment_gateway == 'Stripe') {
                $('#submit-btn').attr("onclick", "stripePay(event)");
            }
        }
    });
});
$(document).ready(function () {
    "use strict";
    $(".package_duration_div").on("change", "#package_duration", function () {

        var package1 = $('#package_select').val();
        var duration = $(this).val();
        if (package1 !== null) {
            $.ajax({
                url: 'frontend/getPackageForHospitalRegisteration?id=' + package1,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (response) {
                    if (duration === 'monthly') {
                        $('.price-input').val(response.package.monthly_price).end();
                    } else {
                        $('.price-input').val(response.package.yearly_price).end();
                    }
                }
            });

        }
    });
});
$(document).ready(function () {
    "use strict";
    $(".package_select_div").on("change", "#package_select", function () {

        var package1 = $(this).val();
        var duration = $('#package_duration').val();
        if (package1 !== null) {
            $.ajax({
                url: 'frontend/getPackageForHospitalRegisteration?id=' + package1,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (response) {
                    if (duration == 'monthly') {
                        $('.price-input').val(response.package.monthly_price).end();
                    } else {
                        $('.price-input').val(response.package.yearly_price).end();
                    }
                }
            });

        }
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

Stripe.setPublishableKey(publish);


function stripeResponseHandler(status, response) {
    "use strict";
    if (response.error) {
console.log(response.error);
        $("#submit-btn").show();
        $("#loader").css("display", "none");

        $("#error-message").html(response.error.message).show();
        $("#submit-btn").attr("disabled", false);
        $("#error-message").html(response.error.message).show();
        alert(response.error.message);
    } else {
        var token = response['id'];
        if (token != null) {
            $("#token").append("<input type='hidden' name='token' value='" + token + "' />");

            $('#addNewHospital').submit();
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

        //submit from callback
        return false;
    }else{
         alert('Please Check Your Card details');
    }
}