$(function() {
	"use strict";

   
// chart 1
var options = {
    series: [{
        name: "Messages",
        data: [450, 650, 440, 160, 671, 414, 555, 257, 901, 555, 257]
    }],
    chart: {
        foreColor: '#9a9797',
        type: "area",
        //width: 130,
        height: 100,
        toolbar: {
            show: !1
        },
        zoom: {
            enabled: !1
        },
        dropShadow: {
            enabled: 0,
            top: 3,
            left: 14,
            blur: 4,
            opacity: .12,
            color: "#3461ff"
        },
        sparkline: {
            enabled: !0
        }
    },
    markers: {
        size: 0,
        colors: ["#3461ff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
            size: 7
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            columnWidth: "35%",
            endingShape: "rounded"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 1.5,
        curve: "smooth"
    },
    colors: ["#3461ff"],
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
    },
    tooltip: {
        theme: "dark",
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart1"), options);
  chart.render();



  // chart 2
  var options = {
    series: [{
        name: 'Lectus',
        data: [104, 65, 67, 65, 71, 68, 73, 70, 76, 85]
    },{
        name: 'Quies eros',
        data: [94, 55, 57, 56, 61, 58, 63, 60, 66, 75]
    }, {
        name: 'venenatis',
        data: [76, 85, 101, 98, 87, 85, 91, 50, 94, 67]
    },{
        name: 'Scelerisque',
        data: [104, 65, 67, 65, 71, 68, 73, 70, 76, 85]
    },{
        name: 'Suscipit',
        data: [104, 65, 67, 65, 71, 68, 73, 70, 76, 85]
    },{
        name: 'Semper Suscipit',
        data: [104, 65, 67, 65, 71, 68, 73, 70, 76, 85]
    },{
        name: 'Others',
        data: [104, 65, 67, 65, 71, 68, 73, 70, 76, 85]
    }],
    chart: {
        foreColor: '#9a9797',
        type: 'bar',
        height: 190,
        stacked: true,
        toolbar: {
            show: false
        },
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '50%',
            //endingShape: 'rounded'
        },
    },
    legend: {
        //show: false,
        position: 'top',
        horizontalAlign: 'left',
        offsetX: -20
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    colors: ["#3461ff", "#e72e2e", "#8932ff", "#ff6632", "#e72e7a", "#32bfff", "#12bf24"],
    xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    },
    fill: {
        opacity: 1
    },
    grid: {
        show: true,
        borderColor: '#ededed',
        //strokeDashArray: 4,
    },
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                height: 310,
            },
            plotOptions: {
                bar: {
                    columnWidth: '30%'
                }
            }
        }
    }]
};
var chart = new ApexCharts(document.querySelector("#chart2"), options);
chart.render();


   
// chart 3
var options = {
    series: [{
        name: "Members",
        data: [353, 758, 430, 240, 160, 671, 414, 555, 257, 901, 555, 957]
    }],
    chart: {
        foreColor: '#9a9797',
        type: "area",
       // width: 130,
        height: 100,
        toolbar: {
            show: !1
        },
        zoom: {
            enabled: !1
        },
        dropShadow: {
            enabled: 0,
            top: 3,
            left: 14,
            blur: 4,
            opacity: .12,
            color: "#12bf24"
        },
        sparkline: {
            enabled: !0
        }
    },
    markers: {
        size: 0,
        colors: ["#12bf24"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
            size: 7
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            columnWidth: "35%",
            endingShape: "rounded"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 1.5,
        curve: "smooth"
    },
    colors: ["#12bf24"],
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        theme: "dark",
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart3"), options);
  chart.render();



// chart 4
var options = {
    series: [{
        name: "New Tasks",
        data: [871, 514, 555, 257, 300, 555, 420, 353, 450, 684, 240, 672]
    }],
    chart: {
        foreColor: '#9a9797',
        type: "area",
       // width: 130,
        height: 100,
        toolbar: {
            show: !1
        },
        zoom: {
            enabled: !1
        },
        dropShadow: {
            enabled: 0,
            top: 3,
            left: 14,
            blur: 4,
            opacity: .12,
            color: "#8932ff"
        },
        sparkline: {
            enabled: !0
        }
    },
    markers: {
        size: 0,
        colors: ["#8932ff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
            size: 7
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            columnWidth: "35%",
            endingShape: "rounded"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 1.5,
        curve: "smooth"
    },
    colors: ["#8932ff"],
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        theme: "dark",
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart4"), options);
  chart.render();



// chart 5
  
  var options = {
    series: [55, 20],
    chart: {
    width: 240,
    type: 'donut',
  },
  labels: [ 'Returning Users', 'New Users'],
  colors: ["#8932ff", "#e72e2e"],
  legend: {
    show: false,
    position: 'top',
    horizontalAlign: 'left',
    offsetX: -20
  },
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        height: 260
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
  };

  var chart = new ApexCharts(document.querySelector("#chart5"), options);
  chart.render();



   
// chart 6
var options = {
    series: [{
        name: "Messages",
        data: [450, 650, 440, 160, 671, 414, 555, 901, 555]
    }],
    chart: {
        foreColor: '#9a9797',
        type: "bar",
        //width: 130,
        height: 280,
        toolbar: {
            show: !1
        },
        zoom: {
            enabled: !1
        },
        dropShadow: {
            enabled: 0,
            top: 3,
            left: 14,
            blur: 4,
            opacity: .12,
            color: "#3461ff"
        },
        sparkline: {
            enabled: 0
        }
    },
    markers: {
        size: 0,
        colors: ["#3461ff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
            size: 7
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            columnWidth: "55%",
            distributed: true,
            //endingShape: "rounded"
        }
    },
    dataLabels: {
        enabled: !1
    },
    legend: {
        show: false
      },
    stroke: {
        show: !0,
        width: 1.5,
        curve: "smooth"
    },
   // colors: ["#3461ff"],
    xaxis: {
        categories: ["0-10", "10-20", "20-30", "30-40", "40-50", "50-60", "60-70", "70-80", "80-95"]
    },
    tooltip: {
        theme: "dark",
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart6"), options);
  chart.render();


   
// chart 7
var options = {
    series: [{
        name: "Messages",
        data: [450, 650, 440, 160, 671, 414, 555, 901, 555]
    }],
    chart: {
        foreColor: '#9a9797',
        type: "line",
        //width: 130,
        height: 280,
        toolbar: {
            show: !1
        },
        zoom: {
            enabled: !1
        },
        dropShadow: {
            enabled: 1,
            top: 3,
            left: 14,
            blur: 4,
            opacity: .12,
            color: "#3461ff"
        },
        sparkline: {
            enabled: 0
        }
    },
    markers: {
        size: 0,
        colors: ["#3461ff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
            size: 7
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            columnWidth: "55%",
            distributed: true,
            //endingShape: "rounded"
        }
    },
    dataLabels: {
        enabled: !1
    },
    legend: {
        show: false
      },
    stroke: {
        show: !0,
        width: 3,
        curve: "straight"
    },
   // colors: ["#3461ff"],
    xaxis: {
        categories: ["0-10", "10-20", "20-30", "30-40", "40-50", "50-60", "60-70", "70-80", "80-95"]
    },
    tooltip: {
        theme: "dark",
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart7"), options);
  chart.render();



// chart 8
var options = {
    series: [{
        name: "New Tasks",
        data: [371, 514, 555, 857, 300, 450, 684, 240, 672]
    }],
    chart: {
        foreColor: '#9a9797',
        type: "area",
       // width: 130,
        height: 370,
        toolbar: {
            show: !1
        },
        zoom: {
            enabled: !1
        },
        dropShadow: {
            enabled: 0,
            top: 3,
            left: 14,
            blur: 4,
            opacity: .12,
            color: "#32bfff"
        },
        sparkline: {
            enabled: !1
        }
    },
    markers: {
        size: 0,
        colors: ["#32bfff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
            size: 7
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            columnWidth: "35%",
            endingShape: "rounded"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2.5,
        curve: "straight"
    },
    colors: ["#32bfff"],
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"]
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        theme: "dark",
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart8"), options);
  chart.render();




// chart 9
  
var options = {
    series: [160, 60, 35],
    chart: {
     height: 250,
     type: 'pie',
  },
  labels: [ 'Mobile', 'Desktop', 'Tablet'],
  colors: ["#3461ff", "#ff6632", "#0c971a"],
  legend: {
    show: false,
    position: 'top',
    horizontalAlign: 'left',
    offsetX: -20
  },
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        height: 270
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
  };

  var chart = new ApexCharts(document.querySelector("#chart9"), options);
  chart.render();







});