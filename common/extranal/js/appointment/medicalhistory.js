$(document).ready(function () {
  "use strict";
  $(".edit_appointment_button").on(
    "click",
    ".editAppointmentButton",
    function () {
      "use strict";

      $("#adoctors1").html("");

      var iid = $(this).attr("data-id");
      var id = $(this).attr("data-id");

      $("#editAppointmentForm").trigger("reset");
      $(".consultant_fee_div").addClass("hidden");
      $(".pay_now").addClass("hidden");
      $(".payment_status").addClass("hidden");
      $(".deposit_type1").addClass("hidden");
      $("#editAppointmentModal").modal("show");
      $.ajax({
        url: "appointment/editAppointmentByJason?id=" + iid,
        method: "GET",
        data: "",
        dataType: "json",
        success: function (response) {
          "use strict";
          var de = response.appointment.date * 1000;
          var d = new Date(de);
          var da =
            d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();

          $("#editAppointmentForm")
            .find('[name="id"]')
            .val(response.appointment.id)
            .end();
          $("#editAppointmentForm")
            .find('[name="patient"]')
            .val(response.appointment.patient)
            .end();

          $("#editAppointmentForm").find('[name="date"]').val(da).end();
          $("#editAppointmentForm")
            .find('[name="status"]')
            .val(response.appointment.status)
            .end();
          $("#editAppointmentForm")
            .find('[name="remarks"]')
            .val(response.appointment.remarks)
            .end();
          var option1 = new Option(
            response.doctor.name + "-" + response.doctor.id,
            response.doctor.id,
            true,
            true
          );
          $("#editAppointmentForm")
            .find('[name="doctor"]')
            .append(option1)
            .trigger("change");

          $(".js-example-basic-single.patient")
            .val(response.appointment.patient)
            .trigger("change");
          $("#visit_description1").html("");
          $.ajax({
            url:
              "doctor/getDoctorVisitForEdit?id=" +
              response.doctor.id +
              "&description=" +
              response.appointment.visit_description,
            method: "GET",
            data: "",
            dataType: "json",
            success: function (response1) {
              $("#visit_description1").html(response1.response).end();
              // $('#editAppointmentForm').find('[name="visit_description"]').val(response.appointment.visit_description).trigger('change').end();
            },
          });

          if (response.appointment.payment_status == "unpaid") {
            $(".consultant_fee_div").removeClass("hidden");
            $(".pay_now").removeClass("hidden");
            $(".payment_status").addClass("hidden");
            $('#visit_description1').css('pointer-events', "auto");
            // $('.deposit_type1').removeClass('hidden');
            $("#editAppointmentForm")
              .find('[name="visit_charges"]')
              .val(response.appointment.visit_charges)
              .end();
            $("#editAppointmentForm")
              .find('[name="discount"]')
              .val(response.appointment.discount)
              .end();
            $("#editAppointmentForm")
              .find('[name="grand_total"]')
              .val(response.appointment.grand_total)
              .end();
          } else {
            $(".payment_status").removeClass("hidden");
            $(".pay_now").addClass("hidden");
            $(".consultant_fee_div").addClass("hidden");
            //  $('.deposit_type1').addClass('hidden');
            // $('.status_paid_hidden_section').addClass('hidden');
            $("#visit_description1").css("pointer-events", "none");
            $("#editAppointmentForm")
              .find('[id="adoctors1"]')
              .select2([
                {
                  id: response.doctor.id,
                  text: response.doctor.name + "-" + response.doctor.id,
                  locked: true,
                },
              ]);
            $("#editAppointmentForm")
              .find('[id="pos_select1"]')
              .select2([
                {
                  id: response.patient.id,
                  text: response.patient.name + "-" + response.patient.id,
                  locked: true,
                },
              ]);
          }
          var date = $("#date1").val();
          var doctorr = $("#adoctors1").val();
          var appointment_id = $("#appointment_id").val();

          $.ajax({
            url:
              "schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=" +
              date +
              "&doctor=" +
              doctorr +
              "&appointment_id=" +
              appointment_id,
            method: "GET",
            data: "",
            dataType: "json",
            success: function (response) {
              "use strict";
              $("#aslots1").find("option").remove();
              var slots = response.aslots;
              $.each(slots, function (key, value) {
                $("#aslots1")
                  .append($("<option>").text(value).val(value))
                  .end();
              });

              $("#aslots1").val(response.current_value).trigger("change");

              if ($("#aslots1").has("option").length == 0) {
                $("#aslots1")
                  .append(
                    $("<option>")
                      .text("No Further Time Slots")
                      .val("Not Selected")
                  )
                  .end();
              }
            },
          });
        },
      });
    }
  );
});

$(document).ready(function () {
  "use strict";
  $(".doctor_div").on("change", "#adoctors", function () {
    "use strict";
    var iid = $("#date").val();
    var doctorr = $("#adoctors").val();
    $("#aslots").find("option").remove();
    if (date != '') {
      $.ajax({
        url:
          "schedule/getAvailableSlotByDoctorByDateByJason?date=" +
          iid +
          "&doctor=" +
          doctorr,
        method: "GET",
        data: "",
        dataType: "json",
        success: function (response) {
          "use strict";
          var slots = response.aslots;
          $.each(slots, function (key, value) {
            "use strict";
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
  var iid = $("#date").val();
  var doctorr = $("#adoctors").val();
  $("#aslots").find("option").remove();

  $.ajax({
    url:
      "schedule/getAvailableSlotByDoctorByDateByJason?date=" +
      iid +
      "&doctor=" +
      doctorr,
    method: "GET",
    data: "",
    dataType: "json",
    success: function (response) {
      "use strict";
      var slots = response.aslots;
      $.each(slots, function (key, value) {
        "use strict";
        $("#aslots").append($("<option>").text(value).val(value)).end();
      });

      if ($("#aslots").has("option").length == 0) {
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

    // .change(dateChanged)
    .on("changeDate", dateChanged);
});

function dateChanged() {
  "use strict";
  var iid = $("#date").val();
  var doctorr = $("#adoctors").val();
  $("#aslots").find("option").remove();
  if (doctorr != '') {
    $.ajax({
      url:
        "schedule/getAvailableSlotByDoctorByDateByJason?date=" +
        iid +
        "&doctor=" +
        doctorr,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        var slots = response.aslots;
        $.each(slots, function (key, value) {
          "use strict";
          $("#aslots").append($("<option>").text(value).val(value)).end();
        });

        if ($("#aslots").has("option").length == 0) {
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
  "use strict";
  $(".doctor_div1").on("change", "#adoctors1", function () {
    "use strict";
    var id = $("#appointment_id").val();
    var date = $("#date1").val();
    var doctorr = $("#adoctors1").val();
    $("#aslots1").find("option").remove();
    if (date != '') {
      $.ajax({
        url:
          "schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=" +
          date +
          "&doctor=" +
          doctorr +
          "&appointment_id=" +
          id,
        method: "GET",
        data: "",
        dataType: "json",
        success: function (response) {
          "use strict";
          var slots = response.aslots;
          $.each(slots, function (key, value) {
            "use strict";
            $("#aslots1").append($("<option>").text(value).val(value)).end();
          });

          if ($("#aslots1").has("option").length == 0) {
            $("#aslots1")
              .append(
                $("<option>").text("No Further Time Slots").val("Not Selected")
              )
              .end();
          }
        },
      });
    }
    $("#visit_description1").html(" ");
    $("#visit_charges1").val(" ");
    $.ajax({
      url: "doctor/getDoctorVisit?id=" + doctorr,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response1) {
        $("#visit_description1").html(response1.response).end();
      },
    });
  });
});

$(document).ready(function () {
  "use strict";
  var id = $("#appointment_id").val();
  var date = $("#date1").val();
  var doctorr = $("#adoctors1").val();
  $("#aslots1").find("option").remove();

  $.ajax({
    url:
      "schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=" +
      date +
      "&doctor=" +
      doctorr +
      "&appointment_id=" +
      id,
    method: "GET",
    data: "",
    dataType: "json",
    success: function (response) {
      "use strict";
      var slots = response.aslots;
      $.each(slots, function (key, value) {
        "use strict";
        $("#aslots1").append($("<option>").text(value).val(value)).end();
      });

      if ($("#aslots1").has("option").length == 0) {
        //if it is blank.
        $("#aslots1")
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

  $("#date1")
    .datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
    })

    // .change(dateChanged1)
    .on("changeDate", dateChanged1);
});

function dateChanged1() {
  "use strict";
  var id = $("#appointment_id").val();
  var iid = $("#date1").val();
  var doctorr = $("#adoctors1").val();
  $("#aslots1").find("option").remove();
  if (doctorr != '') {
    $.ajax({
      url:
        "schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=" +
        iid +
        "&doctor=" +
        doctorr +
        "&appointment_id=" +
        id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        var slots = response.aslots;
        $.each(slots, function (key, value) {
          "use strict";
          $("#aslots1").append($("<option>").text(value).val(value)).end();
        });

        if ($("#aslots1").has("option").length == 0) {
          $("#aslots1")
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
  $("#visit_description").change(function () {
    // Get the record's ID via attribute
    var id = $(this).val();

    $("#visit_charges").val(" ");
    // $('#default').trigger("reset");

    $.ajax({
      url: "doctor/getDoctorVisitCharges?id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#visit_charges").val(response.response.visit_charges).end();
        var discount = $("#discount").val();
        $("#grand_total")
          .val(parseFloat(response.response.visit_charges - discount))
          .end();
      },
    });
  });
  $("#discount").keyup(function () {
    // Get the record's ID via attribute
    var discount = $(this).val();
    var price = $("#visit_charges").val();
    $("#grand_total")
      .val(parseFloat(price - discount))
      .end();
  });
});
$(document).ready(function () {
  $("#visit_description1").change(function () {
    // Get the record's ID via attribute
    var id = $(this).val();

    $("#visit_charges1").val(" ");
    // $('#default').trigger("reset");

    $.ajax({
      url: "doctor/getDoctorVisitCharges?id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#visit_charges1").val(response.response.visit_charges).end();
        var discount = $("#discount1").val();
        $("#grand_total1")
          .val(parseFloat(response.response.visit_charges - discount))
          .end();
      },
    });
  });
  $("#discount1").keyup(function () {
    // Get the record's ID via attribute
    var discount = $(this).val();
    var price = $("#visit_charges1").val();
    $("#grand_total1")
      .val(parseFloat(price - discount))
      .end();
  });
});
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
  $(".card1").hide();
  $(document.body).on("change", "#selecttype1", function () {
    var v = $("select.selecttype1 option:selected").val();
    if (v == "Card") {
      $(".cardsubmit1").removeClass("hidden");
      $(".cashsubmit1").addClass("hidden");
      // $("#amount_received").prop('required', true);
      // $('#amount_received').attr("required");;
      $(".card1").show();
    } else {
      $(".card1").hide();
      $(".cashsubmit1").removeClass("hidden");
      $(".cardsubmit1").addClass("hidden");
      // $("#amount_received").prop('required', false);
      //$('#amount_received').removeAttr('required');
    }
  });
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
  $("#pay_now_appointment1").change(function () {
    if ($(this).prop("checked") == true) {
      $(".deposit_type1").removeClass("hidden");
      $("#editAppointmentForm").find('[name="deposit_type"]').trigger("reset");
      // $('#editAppointmentForm').find('[name="status"]').val("Confirmed").end()
    } else {
      $("#editAppointmentForm").find('[name="deposit_type"]').val("").end();
      $(".deposit_type1").addClass("hidden");
      //  $('#editAppointmentForm').find('[name="status"]').val("").end()

      $(".card1").hide();
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









$(document).ready(function () {
  "use strict";
  $(".aslots").on("change", "#aslots1", function () {
    "use strict";
    var iid = $("#date1").val();
    var patient = $("#pos_select1").val();
    var current_slot = $("#aslots1").val();
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
  $(".patient_div").on("change", "#pos_select1", function () {
    "use strict";
    var iid = $("#date1").val();
    var patient = $("#pos_select1").val();
    var current_slot = $("#aslots1").val();
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
  $("#date1")
    .datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
    })
    //Listen for the change even on the input

    .on("changeDate", dateChanged1);
});

function dateChanged1() {
  "use strict";
  var iid = $("#date1").val();
  var patient = $("#pos_select1").val();
  var current_slot = $("#aslots1").val();
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



