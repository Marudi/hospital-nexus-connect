"use strict";
if (superadmin_login == "no") {
  // google.charts.load("current", { packages: ["corechart"] });

  // function drawChartupdate() {
  //   "use strict";
  //   var months = [
  //     "January",
  //     "February",
  //     "March",
  //     "April",
  //     "May",
  //     "June",
  //     "July",
  //     "August",
  //     "September",
  //     "October",
  //     "November",
  //     "December"
  //   ];

  //   var d = new Date();

  //   var selectedMonthName = months[d.getMonth()] + ", " + d.getFullYear();

  //   var data = google.visualization.arrayToDataTable([
  //     ["Task", "Hours per Day"],
  //     [income_lang, payment_this],
  //     [expense_lang, expense_this]
  //   ]);

  //   var options = {
  //     title: selectedMonthName,
  //     is3D: true
  //   };

  //   var chart123 = new google.visualization.PieChart(
  //     document.getElementById("piechart_3d")
  //   );
  //   chart123.draw(data, options);
  // }
  // google.charts.setOnLoadCallback(drawChartupdate);
  // google.charts.load("current", { packages: ["corechart"] });

  // function drawChart() {
  //   "use strict";
  //   var months = [
  //     "January",
  //     "February",
  //     "March",
  //     "April",
  //     "May",
  //     "June",
  //     "July",
  //     "August",
  //     "September",
  //     "October",
  //     "November",
  //     "December"
  //   ];

  //   var d = new Date();
  //   var selectedMonthName = months[d.getMonth()] + ", " + d.getFullYear();

  //   var data = google.visualization.arrayToDataTable([
  //     ["Task", "Num of Appointment"],
  //     [treated_lang, appointment_treated],
  //     [cancelled_lang, appointment_cancelled]
  //   ]);

  //   var options = {
  //     title: selectedMonthName + appointment_lang,
  //     is3D: true
  //   };

  //   var chart122 = new google.visualization.PieChart(
  //     document.getElementById("donutchart")
  //   );
  //   chart122.draw(data, options);
  // }

  // google.charts.setOnLoadCallback(drawChart);

  // google.charts.load("current", { packages: ["corechart"] });
  // google.charts.setOnLoadCallback(drawVisualization);

  // function drawVisualization() {
  //   "use strict";
  //   var data = google.visualization.arrayToDataTable([
  //     ["Month", income_lang, expense_lang],
  //     [jan, this_year["january"], this_year_expenses["january"]],
  //     [feb, this_year["february"], this_year_expenses["february"]],
  //     [mar, this_year["march"], this_year_expenses["march"]],
  //     [apr, this_year["april"], this_year_expenses["april"]],
  //     [may, this_year["may"], this_year_expenses["may"]],
  //     [june, this_year["june"], this_year_expenses["june"]],
  //     [july, this_year["july"], this_year_expenses["july"]],
  //     [aug, this_year["august"], this_year_expenses["august"]],
  //     [sep, this_year["september"], this_year_expenses["september"]],
  //     [oct, this_year["october"], this_year_expenses["october"]],
  //     [nov, this_year["november"], this_year_expenses["november"]],
  //     [dec, this_year["december"], this_year_expenses["december"]]
  //   ]);

  //   var options33 = {
  //     title: new Date().getFullYear() + " " + per_month_income_expense,
  //     vAxis: { title: currency },
  //     hAxis: { title: months_lang },
  //     seriesType: "bars",
  //     series: { 5: { type: "line" } }
  //   };

  //   var chart124 = new google.visualization.ComboChart(
  //     document.getElementById("chart_div")
  //   );
  //   chart124.draw(data, options33);
  // }

  $(document).ready(function () {
    function getChartColorsArray(e) {
      if (null !== document.getElementById(e)) {
        var r = document.getElementById(e).getAttribute("data-colors");
        return (r = JSON.parse(r)).map(function (e) {
          var r = e.replace(" ", "");
          if (-1 == r.indexOf("--")) return r;
          var t = getComputedStyle(document.documentElement).getPropertyValue(
            r
          );
          return t || void 0;
        });
      }
    }

    var options_today_sales = {
        series: [{ data: all_payments_da }],
        chart: { type: "line", height: 61, sparkline: { enabled: !0 } },
        colors: ["#3980c0", "transparent"],
        stroke: { curve: "smooth", width: 2.5 },
        tooltip: {
          fixed: { enabled: !1 },
          x: { show: !1 },
          y: {
            title: {
              formatter: function (e) {
                return "";
              }
            }
          },
          marker: { show: !1 }
        }
      },
      chart = new ApexCharts(
        document.querySelector("#mini-1"),
        options_today_sales
      );
    chart.render();

    var options = {
      series: [{ data: access_user }],
      chart: { type: "line", height: 61, sparkline: { enabled: !0 } },
      colors: ["#33a186", "transparent"],
      stroke: { curve: "smooth", width: 2.5 },
      tooltip: {
        fixed: { enabled: !1 },
        x: { show: !1 },
        y: {
          title: {
            formatter: function (e) {
              return "";
            }
          }
        },
        marker: { show: !1 }
      }
    };
    (chart = new ApexCharts(
      document.querySelector("#mini-2"),
      options
    )).render();

    var options3 = {
      series: [{ data: all_expense_da }],
      chart: { type: "line", height: 61, sparkline: { enabled: !0 } },
      colors: ["#3980c0", "transparent"],
      stroke: { curve: "smooth", width: 2.5 },
      tooltip: {
        fixed: { enabled: !1 },
        x: { show: !1 },
        y: {
          title: {
            formatter: function (e) {
              return "";
            }
          }
        },
        marker: { show: !1 }
      }
    };
    (chart = new ApexCharts(
      document.querySelector("#mini-3"),
      options3
    )).render();

    var options4 = {
      series: [{ data: total_amount_due }],
      chart: { type: "line", height: 61, sparkline: { enabled: !0 } },
      colors: ["#33a186", "transparent"],
      stroke: { curve: "smooth", width: 2.5 },
      tooltip: {
        fixed: { enabled: !1 },
        x: { show: !1 },
        y: {
          title: {
            formatter: function (e) {
              return "";
            }
          }
        },
        marker: { show: !1 }
      }
    };
    (chart = new ApexCharts(
      document.querySelector("#mini-4"),
      options4
    )).render();

    var options5 = {
      series: [{ data: register_user }],
      chart: { type: "line", height: 61, sparkline: { enabled: !0 } },
      colors: ["#3980c0", "transparent"],
      stroke: { curve: "smooth", width: 2.5 },
      tooltip: {
        fixed: { enabled: !1 },
        x: { show: !1 },
        y: {
          title: {
            formatter: function (e) {
              return "";
            }
          }
        },
        marker: { show: !1 }
      }
    };
    (chart = new ApexCharts(
      document.querySelector("#mini-5"),
      options5
    )).render();

    options5 = {
      series: [
        {
          data: this_year_sale
        }
      ],
      chart: {
        toolbar: {
          show: !1
        },
        height: 350,
        type: "bar",
        events: {
          click: function (e, r, t) {}
        }
      },
      plotOptions: {
        bar: {
          columnWidth: "70%",
          distributed: !0
        }
      },
      dataLabels: {
        enabled: !1
      },
      legend: {
        show: !1
      },
      colors: [
        "#3980C0",
        "#78CD51",
        "#CCE7E1",
        "#eff1f3",
        "#33a186",
        "#3980c0",
        "#EBF2F9",
        "#eff1f3",
        "#FC9774",
        "#50AF98"
      ],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct"
        ],
        labels: {
          style: {
            colors: [
              "#3980C0",
              "#78CD51",
              "#CCE7E1",
              "#eff1f3",
              "#33a186",
              "#3980c0",
              "#EBF2F9",
              "#eff1f3",
              "#FC9774",
              "#50AF98"
            ],
            fontSize: "12px"
          }
        }
      }
    };
    (chart = new ApexCharts(
      document.querySelector("#sales-statistics"),
      options5
    )).render();
     Chart.pluginService.register({
        afterUpdate: function (chart) {
                var a=chart.config.data.datasets.length -1;
               
                for (let i in chart.config.data.datasets) {
                    for(var j = chart.config.data.datasets[i].data.length; j>= 0;--j) { 
                        if (Number(j) == (chart.config.data.datasets[i].data.length))
                          
                            continue;
                        var arc = chart.getDatasetMeta(i).data[j];
                        arc.round = {
                            x: (chart.chartArea.left + chart.chartArea.right) / 2,
                            y: (chart.chartArea.top + chart.chartArea.bottom) / 2,
                            radius: chart.innerRadius + chart.radiusLength / 2 + (a * chart.radiusLength),
                            thickness: chart.radiusLength / 2 - 1,
                            backgroundColor: arc._model.backgroundColor
                        }
                    }
                    a--;
                }
        },

        afterDraw: function (chart) {
                var ctx = chart.chart.ctx;
                for (let i in chart.config.data.datasets) {
                    for(var j = chart.config.data.datasets[i].data.length; j>= 0;--j) { 
                        if (Number(j) == (chart.config.data.datasets[i].data.length ))
                            continue;
                        var arc = chart.getDatasetMeta(i).data[j];
                        var startAngle = Math.PI / 2 - arc._view.startAngle;
                        var endAngle = Math.PI / 2 - arc._view.endAngle;

                        ctx.save();
                        ctx.translate(arc.round.x, arc.round.y);
                        console.log(arc.round.startAngle)
                        ctx.fillStyle = arc.round.backgroundColor;
                        ctx.beginPath();
                        //ctx.arc(arc.round.radius * Math.sin(startAngle), arc.round.radius * Math.cos(startAngle), arc.round.thickness, 0, 2 * Math.PI);
                        ctx.arc(arc.round.radius * Math.sin(endAngle), arc.round.radius * Math.cos(endAngle), arc.round.thickness, 0, 2 * Math.PI);
                        ctx.closePath();
                        ctx.fill();
                        ctx.restore();
                    }
                }
        },
    });
    var salescategorycolors = getChartColorsArray("sales-category"),
      config = {
        type: "doughnut",
        data: {
          labels: [
            "Doctor Appointment",
            "Admitted Patient",
            "Payment",
            "Pharmacy"
          ],
          datasets: [
            {
              data: service_category,
              backgroundColor: salescategorycolors,
              hoverBackgroundColor: salescategorycolors,
              borderWidth: 0,
              borderColor: salescategorycolors,
              hoverBorderWidth: 0,
              borderRadius:10
            }
          ]
        },
        options: {
          responsive: !1,
          legend: {
            display: !1
          },
          // tooltips: {
          //   enabled: !0
          // },
          cutoutPercentage: 75,
          rotation: -0.5 * Math.PI,
          circumference: 2 * Math.PI

          // title: {
          //   display: !1
          // }
        }
      },
      ctx = document.getElementById("sales-category");
    window.myDoughnut = new Chart(ctx, config);
    //const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const generateChartData = () => {
      // const months = [
      //   'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
      // ];
      const data = [];

      for (let i = 0; i < earning_key.length; i++) {
        const startDate = 0;
        const endDate = earning_item[i];

        data.push({
          x: earning_key[i],
          y: [startDate, endDate]
        });
      }

      return data;
    };

    var barchartColors = getChartColorsArray("earning-item"),
      options1121 = {
        series: [
          {
            data: [
              {
                x: earning_keybed,
                y: [0, earning_itembed],
                fillColor: barchartColors[0]
              },
              {
                x: earning_keypayment,
                y: [0, earning_itempayment],
                fillColor: barchartColors[1]
              },
              {
                x: earning_keyappointment,
                y: [0, earning_itemappointment],
                fillColor: barchartColors[0]
              },
              {
                x: earning_keypharmacy,
                y: [0, earning_itempharmacy],
                fillColor: barchartColors[1]
              }
            ]
          }
        ],
        chart: { height: 398, type: "rangeBar", toolbar: { show: !1 } },
        plotOptions: { bar: { horizontal: !0, barHeight: "30%" } },
        xaxis: { type: "numeric", min: 0, max: 100 }
      };
    // var barchartColors = getChartColorsArray("earning-item"),
    //   options1121 = {
    //     fill: {
    //       colors: function ({ value, seriesIndex, w }) {
    //         const colors = ["#33a186", "#3980c0", "#FEB019", "#FF4560"];

    //         return colors[value.seriesIndex % colors.length];
    //       }
    //     },
    //     series: [
    //       {
    //         data: generateChartData()
    //       }
    //     ],
    //     chart: { height: 398, type: "rangeBar", toolbar: { show: !1 } },
    //     plotOptions: { bar: { horizontal: !0, barHeight: "30%" } },
    //     xaxis: { type: "numeric", min: 0, max: 20000 }
    //   };
    (chart = new ApexCharts(
      document.querySelector("#earning-item"),
      options1121
    )).render();

    // var chart221 = new ApexCharts(document.querySelector("#earning-item"), options11200);

    // chart221.render();

    // var barchartColors = getChartColorsArray("earning-item");
    // var options3242 = {
    //     series: [
    //     {
    //       data: [
    //         {  name: 'Income',  data: this_year}, {  name: 'Expense',  data: this_year_expenses}
    //       ]
    //     }
    //   ],
    //     chart: {
    //     height: 398,
    //     type: 'rangeBar',
    //     toolbar: {
    //         show: false
    //     }
    //   },
    //   plotOptions: {
    //     bar: {
    //       horizontal: true,
    //       barHeight: '30%',
    //     }
    //   },
    //   xaxis: {
    //     categories: months,
    //     // labels: {
    //     //   formatter: function(val) {
    //     //     return val.substring(0, 3);
    //     //   }
    //     // }
    //   },
    //   yaxis: {
    //     labels: {
    //       show: false
    //     }
    //   },
    //   };
    //   // const series = [{  name: 'Income',  data: this_year}, {  name: 'Expense',  data: this_year_expenses}]
    //   var chart222 = new ApexCharts(document.querySelector("#earning-item"), options3242);
    //   chart222.render();
    // chart222.updateSeries(series);
  });
} else {
  google.charts.load("current", { packages: ["corechart"] });
  google.charts.setOnLoadCallback(drawVisualization);

  function drawVisualization() {
    // Some raw data (not necessarily accurate)
    var data = google.visualization.arrayToDataTable([
      ["Month", income_lang],
      [jan, this_year["january"]],
      [feb, this_year["february"]],
      [mar, this_year["march"]],
      [apr, this_year["april"]],
      [may, this_year["may"]],
      [june, this_year["june"]],
      [july, this_year["july"]],
      [aug, this_year["august"]],
      [sep, this_year["september"]],
      [oct, this_year["october"]],
      [nov, this_year["november"]],
      [dec, this_year["december"]]
    ]);

    var options33 = {
      title: new Date().getFullYear() + " " + per_month_income_expense,
      vAxis: { title: currency },
      hAxis: { title: months_lang },
      seriesType: "bars",
      series: { 2: { type: "line" } }
    };

    var chart = new google.visualization.ComboChart(
      document.getElementById("chart_div_superadmin")
    );
    chart.draw(data, options33);
  }

  google.charts.load("current", { packages: ["corechart"] });
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var months = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December"
    ];

    var d = new Date();
    var selectedMonthName = months[d.getMonth()] + ", " + d.getFullYear();
    //        if (superadmin_month_payment == 0) {
    //            superadmin_month_payment = 0;
    //        } else {
    //            superadmin_month_payment = superadmin_month_payment;
    //        }
    //        if (superadmin_year_payment == 0) {
    //            superadmin_year_payment = 0;
    //        } else {
    //            superadmin_year_payment = superadmin_year_payment;
    //        }
    var data = google.visualization.arrayToDataTable([
      ["Task", "Hours per Day"],
      [monthly_subscription_lang, superadmin_month_payment],
      [yearly_subscription_lang, superadmin_year_payment]
    ]);

    var options34 = {
      title: selectedMonthName,
      is3D: true
    };

    var chart121 = new google.visualization.PieChart(
      document.getElementById("piechart_3d_superadmin")
    );
    chart121.draw(data, options34);
  }
}
