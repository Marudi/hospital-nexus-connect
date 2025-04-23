"use strict";
$(document).ready(function () {
    "use strict";
    if (hospital_id !== null) {
        if (hospital_package === null) {

            $('.pos_client').show();
        } else {
            $('.pos_client').hide();

        }
    } else {

        $('.pos_client').hide();
    }
    $(document.body).on('change', '#package_select', function () {
        "use strict";
        var v = $("select.pos_select option:selected").val()
        if (v == '') {
            $('.pos_client').show();
        } else {
            $('.pos_client').hide();
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
    $(".package_duration_div").on("change", "#package_duration", function () {
        "use strict";
        var package1 = $('#package_select').val();
        var duration = $(this).val();
        if (package1 !== null) {
            $.ajax({
                url: 'hospital/getPackageForHospitalRegisterationOnlyPackage?id=' + package1,
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
    $(".trial_version_div").on("click", ".trial_version", function () {
        "use strict";
        if ($(this).is(':checked')) {
            $(".payment_div").hide();  // checked
             $("#cvv").removeAttr('required');
                $("#expire").removeAttr('required');
            if (payment_gateway == 'Stripe' || payment_gateway == 'PayPal') {
                $("#cvv").removeAttr('required');
                $("#expire").removeAttr('required');
            }
            if (payment_gateway == 'Stripe') {

                $('#submit-btn').removeAttr("onclick");
            }

        } else {
            $(".payment_div").show();  // unchecked
            if (payment_gateway == 'Stripe' || payment_gateway == 'PayPal') {
                $("#cvv").prop('required', 'true');
                $("#expire").prop('required', 'true');
            }
            if (payment_gateway == 'Stripe') {
                $('#submit-btn').attr("onclick", "stripePay(event)");
            }
        }
    })
});

$(document).ready(function () {
    "use strict";
    $(".package_select_div").on("change", "#package_select", function () {
        "use strict";
        var package1 = $(this).val();
        var duration = $('#package_duration').val();
        $('#modules_list').html("");
        if (package1 !== null) {
            $.ajax({
                url: 'hospital/getPackageForHospitalRegisteration?id=' + package1,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (response) {
                    if (duration == 'monthly') {
                        $('.price-input').val(response.package.monthly_price).end();
                    } else {
                        $('.price-input').val(response.package.yearly_price).end();
                    }
                    $('#modules_list').html('<label for="exampleInputEmail1">' + permited_modules + ' </label><br>' + response.option);
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

//callback to handle the response from stripe
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
    }
}


