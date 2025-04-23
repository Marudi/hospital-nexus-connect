"use strict";
$(document).ready(function () {
  $(".card2").hide();
  $(document.body).on("change", "#selecttype", function () {
    var v = $("select.selecttype option:selected").val();
    if (v == "Card") {
      $(".cardsubmit").removeClass("hidden");
      $(".cashsubmit").addClass("hidden");
      // $("#amount_received").prop('required', true);
      // $('#amount_received').attr("required");;
      $(".card2").show();
    } else {
      $(".card2").hide();
      $(".cashsubmit").removeClass("hidden");
      $(".cardsubmit").addClass("hidden");
      // $("#amount_received").prop('required', false);
      //$('#amount_received').removeAttr('required');
    }
  });
});

$(document).ready(function () {
  $(".doctor_div").on("change", "#adoctors", function () {
    "use strict";
    // $("#visit_description").html(" ");
    var id = $("#appointment_id").val();
    var date = $("#date").val();
    var doctorr = $("#adoctors").val();
    $("#aslots").find("option").remove();
    if (date != '') {
      $.ajax({
        url:
          "schedule/getAvailableSlotByDoctorByDateByJason?date=" +
          date +
          "&doctor=" +
          doctorr,
        method: "GET",
        data: "",
        dataType: "json",
        success: function (response) {
          "use strict";
          var slots = response.aslots;
          $.each(slots, function (key, value) {
            $("#aslots").append($("<option>").text(value).val(value)).end();
          });

          if ($("#aslots").has("option").length == 0) {
            //if it is blank.
            $("#aslots")
              .append(
                $("<option>").text("No Further Time Slots").val("Not Selected")
              )
              .end();
          }
        },
      });
    }
    $("#visit_description").html(" ");
    $("#visit_charges").val(" ");
    $.ajax({
      url: "doctor/getDoctorVisit?id=" + doctorr,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response1) {
        $("#visit_description").html(response1.response).end();
      },
    });
  });
});

$(document).ready(function () {
  "use strict";
  var id = $("#appointment_id").val();
  var date = $("#date").val();
  var doctorr = $("#adoctors").val();
  $("#aslots").find("option").remove();

  $.ajax({
    url:
      "schedule/getAvailableSlotByDoctorByDateByJason?date=" +
      date +
      "&doctor=" +
      doctorr,
    method: "GET",
    data: "",
    dataType: "json",
    success: function (response) {
      "use strict";
      var slots = response.aslots;
      $.each(slots, function (key, value) {
        $("#aslots").append($("<option>").text(value).val(value)).end();
      });

      $("#aslots")
        .val(response.current_value)
        .find("option[value=" + response.current_value + "]")
        .attr("selected", true);

      if ($("#aslots").has("option").length == 0) {
        //if it is blank.
        $("#aslots")
          .append(
            $("<option>").text("No Further Time Slots").val("Not Selected")
          )
          .end();
      }
    },
  });
});

$(document).ready(function () {
  "use strict";
  $("#date")
    .datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
    })
    //Listen for the change even on the input

    .on("changeDate", dateChanged);
});

function dateChanged() {
  "use strict";

  var id = $("#appointment_id").val();
  var date = $("#date").val();
  var doctorr = $("#adoctors").val();
  $("#aslots").find("option").remove();
  if (doctorr != '') {
    $.ajax({
      url:
        "schedule/getAvailableSlotByDoctorByDateByJason?date=" +
        date +
        "&doctor=" +
        doctorr,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        var slots = response.aslots;
        $.each(slots, function (key, value) {
          $("#aslots").append($("<option>").text(value).val(value)).end();
        });

        if ($("#aslots").has("option").length == 0) {
          //if it is blank.
          $("#aslots")
            .append(
              $("<option>").text("No Further Time Slots").val("Not Selected")
            )
            .end();
        }
      },
    });
  }
}
$(document).ready(function () {
  $("#pay_now_appointment").change(function () {
    if ($(this).prop("checked") == true) {
      $(".deposit_type").removeClass("hidden");
      $("#addAppointmentForm").find('[name="deposit_type"]').trigger("reset");
      // $('#editAppointmentForm').find('[name="status"]').val("Confirmed").end()
    } else {
      $("#addAppointmentForm").find('[name="deposit_type"]').val("").end();
      $(".deposit_type").addClass("hidden");
      //  $('#editAppointmentForm').find('[name="status"]').val("").end()

      $(".card2").hide();
    }
  });
});






$(document).ready(function () {
  "use strict";
  $(".aslots").on("change", "#aslots", function () {
    "use strict";
    var iid = $("#date").val();
    var patient = $("#pos_select").val();
    var current_slot = $("#aslots").val();
    $.ajax({
      url:
        "schedule/getIfPatientIsAvailableOrNot?date=" +
        iid +
        "&patient=" +
        patient + "&current_slot=" + current_slot,
      method: "GET",
      dataType: "json",
      success: function (response) {
        if (response.response == "no") {
          alert('Patient already has an appointment on this schedule');
        }
      },
    });
  });
});



$(document).ready(function () {
  "use strict";
  $(".patient_div").on("change", "#pos_select", function () {
    "use strict";
    var iid = $("#date").val();
    var patient = $("#pos_select").val();
    var current_slot = $("#aslots").val();
    $.ajax({
      url:
        "schedule/getIfPatientIsAvailableOrNot?date=" +
        iid +
        "&patient=" +
        patient + "&current_slot=" + current_slot,
      method: "GET",
      dataType: "json",
      success: function (response) {
        if (response.response == "no") {
          alert('Patient already has an appointment on this schedule');
        }
      },
    });
  });
});




$(document).ready(function () {
  "use strict";
  $("#date")
    .datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
    })
    //Listen for the change even on the input

    .on("changeDate", dateChanged1);
});

function dateChanged1() {
  "use strict";
  var iid = $("#date").val();
  var patient = $("#pos_select").val();
  var current_slot = $("#aslots").val();
  $.ajax({
    url:
      "schedule/getIfPatientIsAvailableOrNot?date=" +
      iid +
      "&patient=" +
      patient + "&current_slot=" + current_slot,
    method: "GET",
    dataType: "json",
    success: function (response) {
      if (response.response == "no") {
        alert('Patient already has an appointment on this schedule');
      }
    },
  });
}

