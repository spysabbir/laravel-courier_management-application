@extends('admin.layouts.admin_master')

@section('title', 'Dashboard')

@section('content')

@if (session('info'))
<div class="alert alert-warning">
    <strong>{{ session('info') }}</strong>
</div>
@endif

<div class="row">
    <div class="col-12 col-lg-12 col-xl-6 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-3 row-cols-xxl-3 g-3">
                    <div class="col">
                        <div class="card radius-10 bg-tiffany mb-0">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                                    <i class="bi bi-file-earmark-break-fill"></i>
                                </div>
                                <h3 class="text-white">{{ $branches }}</h3>
                                <p class="mb-0 text-white">Total Branch</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-danger mb-0">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                                    <i class="bi bi-hdd-fill"></i>
                                </div>
                                <h3 class="text-white">{{ $companies }}</h3>
                                <p class="mb-0 text-white">Total Company</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-orange mb-0">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                                    <i class="bi bi-file-earmark-check-fill"></i>
                                </div>
                                <h3 class="text-white">{{ $all_manager }}</h3>
                                <p class="mb-0 text-white">Total Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-success mb-0">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                @if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Admin')
                                <h3 class="text-white">{{ $all_staff }}</h3>
                                <p class="mb-0 text-white">Total Staff</p>
                                @else
                                <h3 class="text-white">{{ App\Models\User::where('role', 'Staff')->where('branch_id', Auth::user()->branch_id)->count() }}</h3>
                                <p class="mb-0 text-white">Total Staff</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-purple mb-0">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                                    <i class="bi bi-tags-fill"></i>
                                </div>
                                @if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Admin')
                                <h3 class="text-white">{{ $all_courier }}</h3>
                                <p class="mb-0 text-white">Total Courier</p>
                                @else
                                <h3 class="text-white">
                                    {{ App\Models\CourierSummary::where('sender_branch_id', Auth::user()->branch_id)->count() }}
                                </h3>
                                <p class="mb-0 text-white">Sender Courier</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-dark mb-0">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                                    <i class="bi bi-chat-left-quote-fill"></i>
                                </div>
                                @if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Admin')
                                <h3 class="text-white">{{ $all_message }}</h3>
                                <p class="mb-0 text-white">All Message</p>
                                @else
                                <h3 class="text-white">
                                    {{ App\Models\CourierSummary::where('receiver_branch_id', Auth::user()->branch_id)->count() }}
                                </h3>
                                <p class="mb-0 text-white">Receiver Courier</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-6 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <h5 class="mb-0">Courier All</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-lg-flex align-items-center justify-content-center gap-4">
                    @if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Admin')
                    <div id="chart3"></div>
                    @endif
                    <ul class="list-group list-group-flush">
                        @if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Admin')
                        <li class="list-group-item"><i class="bi bi-circle-fill text-orange me-1"></i>
                            Processing: <span class="me-1">{{ App\Models\CourierSummary::where('courier_status', 'Processing')->count() }}</span>
                        </li>
                        <li class="list-group-item"><i class="bi bi-circle-fill text-primary me-1"></i>
                            On the way: <span class="me-1">{{ App\Models\CourierSummary::where('courier_status', 'On the way')->count() }}</span>
                        </li>
                        <li class="list-group-item"><i class="bi bi-circle-fill text-danger me-1"></i>
                            Shipped: <span class="me-1">{{ App\Models\CourierSummary::where('courier_status', 'Shipped')->count() }}</span>
                        </li>
                        <li class="list-group-item"><i class="bi bi-circle-fill text-success me-1"></i>
                            Delivered: <span class="me-1">{{ App\Models\CourierSummary::where('courier_status', 'Delivered')->count() }}</span>
                        </li>
                        @else
                        <li class="list-group-item"><i class="bi bi-circle-fill text-success me-1"></i>
                            Send Processing Courier: <span class="me-1">{{ App\Models\CourierSummary::where('sender_branch_id', Auth::user()->branch_id)->where('courier_status', 'Processing')->count() }}</span>
                        </li>
                        <li class="list-group-item"><i class="bi bi-circle-fill text-success me-1"></i>
                            Send On the way Courier: <span class="me-1">{{ App\Models\CourierSummary::where('sender_branch_id', Auth::user()->branch_id)->where('courier_status', 'On the way')->count() }}</span>
                        </li>
                        <li class="list-group-item"><i class="bi bi-circle-fill text-success me-1"></i>
                            Delivery On the way Courier: <span class="me-1">{{ App\Models\CourierSummary::where('receiver_branch_id', Auth::user()->branch_id)->where('courier_status', 'On the way')->count() }}</span>
                        </li>
                        <li class="list-group-item"><i class="bi bi-circle-fill text-success me-1"></i>
                            Delivery Processing Courier: <span class="me-1">{{ App\Models\CourierSummary::where('receiver_branch_id', Auth::user()->branch_id)->where('courier_status', 'Shipped')->count() }}</span>
                        </li>
                        <li class="list-group-item"><i class="bi bi-circle-fill text-success me-1"></i>
                            Delivered Courier: <span class="me-1">{{ App\Models\CourierSummary::where('sender_branch_id', Auth::user()->branch_id)->orWhere('receiver_branch_id', Auth::user()->branch_id)->where('courier_status', 'Delivered')->count() }}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--end row-->

@if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Admin')
<div class="row">
    <div class="col-12 col-lg-12 col-xl-6 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <h5 class="mb-0">Courier Status - {{ date('Y') }}</h5>
                    </div>
                    <div class="col">
                        <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart1"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-12 col-xxl-6 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <h5 class="mb-0">Courier Status - {{ date('F,Y') }}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-lg-6 col-xl-6">
                        <div id="chart4"></div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-6">
                        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 g-3">
                            <div class="col">
                                <div class="card radius-10 mb-0 shadow-none bg-light-purple">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="mb-0 text-purple">{{ App\Models\CourierSummary::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('courier_status', 'Processing')->count() }}</h5>
                                        <p class="mb-0 text-purple">Processing</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card radius-10 mb-0 shadow-none bg-light-orange">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                    <h5 class="mb-0 text-orange">{{ App\Models\CourierSummary::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('courier_status', 'On the way')->count() }}</h5>
                                    <p class="mb-0 text-orange">On the way</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card radius-10 mb-0 shadow-none bg-light-success">
                                    <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="mb-0 text-success">{{ App\Models\CourierSummary::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('courier_status', 'Shipped')->count() }}</h5>
                                        <p class="mb-0 text-success">Shipped</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card radius-10 mb-0 shadow-none bg-light-primary">
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="mb-0 text-primary">{{ App\Models\CourierSummary::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('courier_status', 'Delivered')->count() }}</h5>
                                            <p class="mb-0 text-primary">Delivered</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end row-->

<div class="row">
    <div class="col-12 col-lg-12 col-xl-6 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent p-3">
                <div class="row row-cols-1 row-cols-lg-2 g-3 align-items-center">
                <div class="col">
                    <h5 class="mb-0">Courier Status - {{ date('Y')-1 }} vs {{ date('Y') }}</h5>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center justify-content-sm-end gap-3 cursor-pointer">
                    <div class="font-13"><i class="bi bi-circle-fill text-info"></i><span class="ms-2">{{ date('Y')-1 }}</span></div>
                    <div class="font-13"><i class="bi bi-circle-fill text-orange"></i><span class="ms-2">{{ date('Y') }}</span></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart5"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-6 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <h5 class="mb-0">Courier Type ({{ date('Y') }})</h5>
                    </div>
                </div>
            </div>
            <div class="card-body py-5">
                <div id="chart2"></div>
            </div>
        </div>
    </div>
</div><!--end row-->
@endif

@endsection

@section('script')
<script>
$(function() {
	"use strict";

    // chart 1
    var options = {
        series: [{
            name: "Courier",
            data: [
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 1)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 2)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 3)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 4)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 5)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 6)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 7)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 8)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 9)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 10)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 11)->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->whereMonth('created_at', 12)->count() }},
            ]
        }],
        chart: {
            foreColor: '#9a9797',
            type: "bar",
            height: 270,
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
                enabled: !1
            }
        },
        markers: {
            size: 0,
            colors: ["#3461ff", "#12bf24"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7
            }
        },
        plotOptions: {
            bar: {
                horizontal: !1,
                columnWidth: "40%",
                endingShape: "rounded"
            }
        },
        legend: {
            show: false,
            position: 'top',
            horizontalAlign: 'left',
            offsetX: -20
        },
        dataLabels: {
            enabled: !1
        },
        grid: {
            show: false,
            borderColor: '#eee',
            strokeDashArray: 4,
        },
        stroke: {
            show: !0,
            width: 3,
            curve: "smooth"
        },
        colors: ["#12bf24"],
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        },
        tooltip: {
            theme: 'dark',
            y: {
                formatter: function (val) {
                    return "" + val + ""
                }
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
    // chart 1

    // chart 2
    var options = {
        series: [{
            name: "Courier Status",
            data: [
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->where('sender_type', 'Company')->count() }},
                {{ App\Models\CourierSummary::whereYear('created_at', date('Y'))->where('sender_type', 'Individual')->count() }},
            ]
        }],
        chart: {
            foreColor: '#9a9797',
            type: "bar",
            height: 170,
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
                enabled: !1
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
                horizontal: 1,
                columnWidth: "20%",
                columnHeight: "20%",
                endingShape: "rounded"
            }
        },
        legend: {
            show: false,
            position: 'top',
            horizontalAlign: 'left',
            offsetX: -20
        },
        dataLabels: {
            enabled: !1
        },
        grid: {
            show: false,
            borderColor: '#eee',
            strokeDashArray: 4,
        },
        stroke: {
            show: !0,
        width: 3,
            curve: "smooth"
        },
        colors: ["#12bf24"],
        xaxis: {
            categories: ["Company", "Individual"]
        },
        tooltip: {
            theme: 'dark',
            y: {
                formatter: function (val) {
                    return "" + val + ""
                }
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();

    // chart 3
    var options = {
        series: [
                {{ App\Models\CourierSummary::where('courier_status', 'Processing')->count() }},
                {{ App\Models\CourierSummary::where('courier_status', 'On the way')->count() }},
                {{ App\Models\CourierSummary::where('courier_status', 'Shipped')->count() }},
                {{ App\Models\CourierSummary::where('courier_status', 'Delivered')->count() }}
                ],
        chart: {
        width: 340,
        type: 'donut',
        },
        labels: ["Processing", "On the way", "Shipped", "Delivered"],
        colors: ["#3361ff", "#e72e2e", "#12bf24", "#ff6632"],
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
    var chart = new ApexCharts(document.querySelector("#chart3"), options);
    chart.render();
    // chart 3

    // chart 4
    var options = {
        series: [{{ App\Models\CourierSummary::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count() }}],
        chart: {
            foreColor: '#9ba7b2',
            height: 280,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                startAngle: -130,
                endAngle: 130,
                hollow: {
                    margin: 0,
                    size: '82%',
                    background: '#fff',
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: 'front',
                    dropShadow: {
                        enabled: false,
                        top: 3,
                        left: 0,
                        blur: 4,
                        color: 'rgba(0, 169, 255, 0.15)',
                        opacity: 0.65
                    }
                },
                track: {
                    background: '#dfecff',
                    strokeWidth: '67%',
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: false,
                        top: -3,
                        left: 0,
                        blur: 4,
                        color: 'rgba(0, 169, 255, 0.85)',
                        opacity: 0.65
                    }
                },
                dataLabels: {
                    showOn: 'always',
                    name: {
                        offsetY: -25,
                        show: true,
                        color: '#6c757d',
                        fontSize: '16px'
                    },
                    value: {
                        formatter: function (val) {
                            return val;
                        },
                        color: '#000',
                        fontSize: '45px',
                        show: true,
                        offsetY: 10,
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: ['#3361ff'],
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        colors: ["#3361ff"],
        labels: ['All Courier'],
    };
    var chart = new ApexCharts(document.querySelector("#chart4"), options);
    chart.render();
    // chart 4

    // chart 5
    var optionsLine = {
        chart: {
            foreColor: '#9ba7b2',
            height: 275,
            type: 'line',
            toolbar: {
                show: !1
            },
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                top: 3,
                left: 2,
                blur: 4,
                opacity: 0.1,
            }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        colors: ["#32bfff", '#ff6632'],
        series: [{
            name: {{ date('Y')-1 }},
            data: [
                {{ App\Models\CourierSummary::whereMonth('created_at', 1)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 2)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 3)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 4)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 5)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 6)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 7)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 8)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 9)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 10)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 11)->whereYear('created_at', date('Y')-1)->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 12)->whereYear('created_at', date('Y')-1)->count() }},
            ]
        }, {
            name: {{ date('Y') }},
            data: [
                {{ App\Models\CourierSummary::whereMonth('created_at', 1)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 2)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 3)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 4)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 5)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 6)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 7)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 8)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 9)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 10)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 11)->whereYear('created_at', date('Y'))->count() }},
                {{ App\Models\CourierSummary::whereMonth('created_at', 12)->whereYear('created_at', date('Y'))->count() }},
            ]
        }],
        markers: {
            size: 4,
            strokeWidth: 0,
            hover: {
                size: 7
            }
        },
        grid: {
            show: true,
            padding: {
                bottom: 0
            }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetY: -20
        }
    }
    var chartLine = new ApexCharts(document.querySelector('#chart5'), optionsLine);
    chartLine.render();
    // chart 5
});
</script>
@endsection
