$(function() {
	"use strict";



// chart 1
// var options = {
//     series: [{
//         name: "Users",
//         data: [450, 650, 440, 160, 350, 414, 555, 257, 400, 555, 257]
//     }],
//     chart: {
//         foreColor: '#9a9797',
//         type: "bar",
//         //width: 130,
//         height: 270,
//         toolbar: {
//             show: !1
//         },
//         zoom: {
//             enabled: !1
//         },
//         dropShadow: {
//             enabled: 0,
//             top: 3,
//             left: 14,
//             blur: 4,
//             opacity: .12,
//             color: "#3461ff"
//         },
//         sparkline: {
//             enabled: !1
//         }
//     },
//     markers: {
//         size: 0,
//         colors: ["#3461ff", "#12bf24"],
//         strokeColors: "#fff",
//         strokeWidth: 2,
//         hover: {
//             size: 7
//         }
//     },
//     plotOptions: {
//         bar: {
//             horizontal: !1,
//             columnWidth: "40%",
//             endingShape: "rounded"
//         }
//     },
// 	legend: {
//         show: false,
//         position: 'top',
//         horizontalAlign: 'left',
//         offsetX: -20
//     },
//     dataLabels: {
//         enabled: !1
//     },
//     grid: {
//         show: false,
//         // borderColor: '#eee',
//         // strokeDashArray: 4,
//     },
//     stroke: {
//         show: !0,
//        // width: 3,
//         curve: "smooth"
//     },
//     colors: ["#12bf24"],
//     xaxis: {
//         categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
//     },
//     tooltip: {
//         theme: 'dark',
//         y: {
//             formatter: function (val) {
//                 return "" + val + ""
//             }
//         }
//     }
//   };

//   var chart = new ApexCharts(document.querySelector("#chart1"), options);
//   chart.render();


// // chart 2
// var options = {
//     series: [{
//         name: "Users",
//         data: [450, 650, 440, 160]
//     }],
//     chart: {
//         foreColor: '#9a9797',
//         type: "bar",
//         //width: 130,
//         height: 270,
//         toolbar: {
//             show: !1
//         },
//         zoom: {
//             enabled: !1
//         },
//         dropShadow: {
//             enabled: 0,
//             top: 3,
//             left: 14,
//             blur: 4,
//             opacity: .12,
//             color: "#12bf24"
//         },
//         sparkline: {
//             enabled: !1
//         }
//     },
//     markers: {
//         size: 0,
//         colors: ["#12bf24"],
//         strokeColors: "#fff",
//         strokeWidth: 2,
//         hover: {
//             size: 7
//         }
//     },
//     plotOptions: {
//         bar: {
//             horizontal: 1,
//             columnWidth: "20%",
//             columnHeight: "20%",
//             endingShape: "rounded"
//         }
//     },
// 	legend: {
//         show: false,
//         position: 'top',
//         horizontalAlign: 'left',
//         offsetX: -20
//     },
//     dataLabels: {
//         enabled: !1
//     },
//     grid: {
//         show: false,
//         // borderColor: '#eee',
//         // strokeDashArray: 4,
//     },
//     stroke: {
//         show: !0,
//        // width: 3,
//         curve: "smooth"
//     },
//     //colors: ["#12bf24"],
//     xaxis: {
//         categories: ["Visitors", "Subscribers", "Contributor", "Author"]
//     },
//     tooltip: {
//         theme: 'dark',
//         y: {
//             formatter: function (val) {
//                 return "" + val + ""
//             }
//         }
//     }
//   };

//   var chart = new ApexCharts(document.querySelector("#chart2"), options);
//   chart.render();

// // chart 3

// var options = {
//     series: [89, 45, 35, 62],
//     chart: {
//     width: 340,
//     type: 'donut',
//   },
//   labels: ["Visitors", "Subscribers", "Contributor", "Author"],
//   colors: ["#3361ff", "#e72e2e", "#12bf24", "#ff6632"],
//   legend: {
//     show: false,
//     position: 'top',
//     horizontalAlign: 'left',
//     offsetX: -20
//   },
//   responsive: [{
//     breakpoint: 480,
//     options: {
//       chart: {
//         height: 260
//       },
//       legend: {
//         position: 'bottom'
//       }
//     }
//   }]
//   };

//   var chart = new ApexCharts(document.querySelector("#chart3"), options);
//   chart.render();




	// chart 4

	// var options = {
    //     series: [68],
    //     chart: {
    //         foreColor: '#9ba7b2',
    //     height: 280,
    //     type: 'radialBar',
    //   },
    // plotOptions: {
    //     radialBar: {
    //         //startAngle: -130,
    //         //endAngle: 130,
    //         hollow: {
    //             margin: 0,
    //             size: '82%',
    //             //background: '#fff',
    //             image: undefined,
    //             imageOffsetX: 0,
    //             imageOffsetY: 0,
    //             position: 'front',
    //             dropShadow: {
    //                 enabled: false,
    //                 top: 3,
    //                 left: 0,
    //                 blur: 4,
    //                 color: 'rgba(0, 169, 255, 0.15)',
    //                 opacity: 0.65
    //             }
    //         },
    //         track: {
    //             background: '#dfecff',
    //             //strokeWidth: '67%',
    //             margin: 0, // margin is in pixels
    //             dropShadow: {
    //                 enabled: false,
    //                 top: -3,
    //                 left: 0,
    //                 blur: 4,
    //                 color: 'rgba(0, 169, 255, 0.85)',
    //                 opacity: 0.65
    //             }
    //         },
    //         dataLabels: {
    //             showOn: 'always',
    //             name: {
    //                 offsetY: -25,
    //                 show: true,
    //                 color: '#6c757d',
    //                 fontSize: '16px'
    //             },
    //             value: {
    //                 formatter: function (val) {
    //                     return val + "%";
    //                 },
    //                 color: '#000',
    //                 fontSize: '45px',
    //                 show: true,
    //                 offsetY: 10,
    //             }
    //         }
    //     }
    // },
    // fill: {
    //     type: 'gradient',
    //     gradient: {
    //         shade: 'dark',
    //         type: 'horizontal',
    //         shadeIntensity: 0.5,
    //         gradientToColors: ['#3361ff'],
    //         inverseColors: false,
    //         opacityFrom: 1,
    //         opacityTo: 1,
    //         stops: [0, 100]
    //     }
    // },
    // colors: ["#3361ff"],
    //   labels: ['mc'],
    //   };

    //   var chart = new ApexCharts(document.querySelector("#chart4"), options);
    //   chart.render();



// chart 5

// var optionsLine = {
//     chart: {
//         foreColor: '#9ba7b2',
//         height: 275,
//         type: 'line',
//         toolbar: {
//             show: !1
//         },
//         zoom: {
//             enabled: false
//         },
//         dropShadow: {
//             enabled: true,
//             top: 3,
//             left: 2,
//             blur: 4,
//             opacity: 0.1,
//         }
//     },
//     stroke: {
//         curve: 'smooth',
//         width: 3
//     },
//     colors: ["#32bfff", '#ff6632'],
//     series: [{
//         name: "Posts",
//         data: [1, 15, 56, 20, 33, 27, 15]
//     }, {
//         name: "Comments",
//         data: [30, 33, 21, 42, 30, 33, 21]
//     }],
//     markers: {
//         size: 4,
//         strokeWidth: 0,
//         hover: {
//             size: 7
//         }
//     },
//     grid: {
//         show: true,
//         padding: {
//             bottom: 0
//         }
//     },
//     //labels: ['01/15/2002', '01/16/2002', '01/17/2002', '01/18/2002', '01/19/2002', '01/20/2002'],
//     xaxis: {
//         //type: 'datetime',
//         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
//     },
//     legend: {
//         position: 'top',
//         horizontalAlign: 'right',
//         offsetY: -20
//     }
// }
// var chartLine = new ApexCharts(document.querySelector('#chart5'), optionsLine);
// chartLine.render();





});
