"use strict";
$(".default-date-picker").datepicker({
  format: "dd-mm-yyyy",
  autoclose: true,
});
$("#date").on("changeDate", function () {
  "use strict";
  $("#date").datepicker("hide");
});
$("#date1").on("changeDate", function () {
  "use strict";
  $("#date1").datepicker("hide");
});
$(document).ready(function () {
  "use strict";
  $(".timepicker-default").timepicker({
    defaultTime: 'current',
    showMeridian: false,
  });
});
$(document).ready(function () {
  "use strict";
  $(".pos_client").hide();
  $(".pos_client_id").hide();
  $(document.body).on("change", "#pos_select", function () {
    "use strict";
    var v = $("select.pos_select option:selected").val();
    if (v === "add_new") {
      $(".pos_client").show();
      $(".pos_client_id").hide();
    } else if (v === "patient_id") {
      $(".pos_client_id").show();
      $(".pos_client").hide();
    } else {
      $(".pos_client_id").hide();
      $(".pos_client").hide();
    }
  });
});
$(document).ready(function () {
  "use strict";
  $(".appointment").hide();
  $(document.body).on("click", "#appointment", function () {
    "use strict";
    if ($(".appointment").is(":hidden")) {
      $(".appointment").show();
    } else {
      $(".appointment").hide();
    }
  });
});

$(document).ready(function () {
  "use strict";
  $(".doctor_div").on("change", "#adoctors", function () {
    "use strict";

    var id = $("#appointment_id").val();
    var date = $("#date").val();
    var doctorr = $("#adoctors").val();
    $("#aslots").find("option").remove();

    $.ajax({
      url:
        "frontend/getAvailableSlotByDoctorByDateByJason?date=" +
        date +
        "&doctor=" +
        doctorr,
      method: "GET",
      data: "",
      dataType: "json",
    }).done(function (response) {
      "use strict";
      var slots = response.aslots;
      $.each(slots, function (key, value) {
        $("#aslots").append($("<option>").text(value).val(value)).end();
      });

      if ($("#aslots").has("option").length === 0) {
        $("#aslots")
          .append(
            $("<option>").text("No Available Time Slots").val("Not Selected")
          )
          .end();
      }
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
      "frontend/getAvailableSlotByDoctorByDateByJason?date=" +
      date +
      "&doctor=" +
      doctorr,
    method: "GET",
    data: "",
    dataType: "json",
  }).done(function (response) {
    "use strict";
    var slots = response.aslots;
    $.each(response.aslots, function (key, value) {
      "use strict";
      $("#aslots").append($("<option>").text(value).val(value)).end();
    });
    $("#aslots")
      .val(response.current_value)
      .find("option[value=" + response.current_value + "]")
      .attr("selected", true);

    if ($("#aslots").has("option").length === 0) {
      //if it is blank.
      $("#aslots")
        .append(
          $("<option>").text("No Available Time Slots").val("Not Selected")
        )
        .end();
    }
  });
});
$(document).ready(function () {
  "use strict";
  $("#date")
    .datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
    })

    .change(dateChanged)
    .on("changeDate", dateChanged);
});
function dateChanged() {
  "use strict";
  var id = $("#appointment_id").val();
  var date = $("#date").val();
  var doctorr = $("#adoctors").val();
  $("#aslots").find("option").remove();

  $.ajax({
    url:
      "frontend/getAvailableSlotByDoctorByDateByJason?date=" +
      date +
      "&doctor=" +
      doctorr,
    method: "GET",
    data: "",
    dataType: "json",
  }).done(function (response) {
    "use strict";
    var slots = response.aslots;
    $.each(response.aslots, function (key, value) {
      "use strict";
      $("#aslots").append($("<option>").text(value).val(value)).end();
    });

    if ($("#aslots").has("option").length === 0) {
      $("#aslots")
        .append(
          $("<option>").text("No Available Time Slots").val("Not Selected")
        )
        .end();
    }
  });
}

$(document).ready(function () {
  "use strict";
  $(".caption img").removeAttr("style");
  var windowH = $(window).width();
  $(".caption img").css("width", windowH + "px");
  $(".caption img").css("height", "500px");
});

$(function () {
  "use strict";
  $(".navoption").on("click", "a[href*=\\#]:not([href=\\#])", function () {
    "use strict";

    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        $("html,body").animate(
          {
            scrollTop: target.offset().top,
          },
          1000
        );
        return false;
      }
    }
  });
});
$(document).ready(function () {
  "use strict";
  $(".headerSlider").owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: false,
    dots: true,
    nav: false,
    navText: [
      "<div class='hd-nav-btn nav-btn-left'><i class='fa fa-chevron-left fa-2x'></i></div>",
      "<div class='hd-nav-btn nav-btn-right'><i class='fa fa-chevron-right fa-2x'></i></div>",
    ],
    navigation: true,
    pagination: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        loop: true,
      },
      600: {
        items: 1,
        loop: true,
      },
      1000: {
        items: 1,
        loop: true,
      },
    },
  });
});
