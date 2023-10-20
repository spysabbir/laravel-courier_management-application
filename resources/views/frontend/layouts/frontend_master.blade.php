@php
    $default_setting = App\Models\DefaultSetting::first();
@endphp
<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>{{ $default_setting->app_name }} - @yield('title')</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/default_photo') }}/{{ $default_setting->favicon }}"/>
        <!-- Place favicon.ico in the root directory -->

        <!-- ========================= CSS here ========================= -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap-5.0.0-alpha-2.min.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/LineIcons.2.0.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/animate.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/main.css" />
        <link href="{{ asset('admin') }}/plugins/toastr/toastr.css" rel="stylesheet">
    </head>
<body>

    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- preloader end -->

    <!-- ========================= header start ========================= -->
    <header class="header">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ route('index') }}">
                                <img src="{{ asset('uploads/default_photo') }}/{{ $default_setting->logo_photo }}" alt="Logo" />
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                @if (Route::currentRouteName() == "index")
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#services">Services</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#about">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#how">How It Works</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#testimonial">Testimonials</a>
                                    </li>
                                </ul>
                                @else
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('index') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('all.service') }}">Services</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('about.us') }}">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('contact.us') }}">Contact Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('check.status') }}">Check Status</a>
                                    </li>
                                </ul>
                                @endif
                            </div>
                            <!-- navbar collapse -->
                        </nav>
                        <!-- navbar -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- navbar area -->
    </header>
    <!-- ========================= header end ========================= -->

    @yield('content')

    <!-- ========================= partners-section start ========================= -->
    <section id="partner" class="partner-section pt-60 pb-60">
        <div class="container">
            <div class="row">
                @php
                    $time = .2;
                @endphp
                @forelse (App\Models\Company::where('status', 'Active')->get() as $company)
                @php
                    $time += .2;
                @endphp
                <div class="col-lg-3 col-sm-6">
                    <div class="single-partner wow fadeInUp" data-wow-delay="{{ $time }}s">
                        <img src="{{ asset('uploads/company_photo') }}/{{ $company->company_photo }}" alt="{{ $company->company_name }}">
                    </div>
                </div>
                @empty
                <div class="alert alert-warning" role="alert">
                    <strong>Data Not Found!</strong>
                </div>
                @endforelse
            </div>
        </div>
    </section>
	<!-- ========================= partners-section end ========================= -->

    <!-- ========================= footer start ========================= -->
    <footer id="footer" class="footer pt-100 pb-70">
        <div class="footer-shape">
            <img src="{{ asset('frontend') }}/img/footer/footer-left.svg" alt="" class="shape shape-1">
            <img src="{{ asset('frontend') }}/img/footer/footer-right.svg" alt="" class="shape shape-2">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget wow fadeInUp" data-wow-delay=".2s">
                        <div class="logo">
                            <a href="{{ route('index') }}"><img src="{{ asset('uploads/default_photo') }}/{{ $default_setting->logo_photo }}" alt="logo"></a>
                        </div>
                        <ul class="links text-white">
                            <li>
                                Phone: <a href="javascript:void(0)">{{ $default_setting->support_phone }}</a>
                            </li>
                            <li>
                                Email: <a href="javascript:void(0)">{{ $default_setting->support_email }}</a>
                            </li>
                            <li>
                                Address: {{ $default_setting->address }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget wow fadeInUp" data-wow-delay=".4s">
                        <h3>Importent Link</h3>
                        <ul class="links">
                            <li>
                                <a href="{{ route('all.branch') }}">All Branch</a>
                            </li>
                            <li>
                                <a href="{{ route('all.service') }}">All Service</a>
                            </li>
                            <li>
                                <a href="{{ route('about.us') }}">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget wow fadeInUp" data-wow-delay=".6s">
                        <h3>Support</h3>
                        <ul class="links">
                            <li>
                                <a href="{{ route('contact.us') }}">Contact Us</a>
                            </li>
                            <li>
                                <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="{{ route('terms.of.service') }}">Terms of Service</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="text-center">Designed and Developed by <a href="{{ $default_setting->app_url }}" style="color: #fff;" rel="nofollow">{{ $default_setting->app_name }}</a></p>
            </div>
        </div>
    </footer>
    <!-- ========================= footer end ========================= -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('admin') }}/js/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.5.0.0.alpha-2-min.js"></script>
    <script src="{{ asset('frontend') }}/js/count-up.min.js"></script>
    <script src="{{ asset('frontend') }}/js/wow.min.js"></script>
    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <script src="{{ asset('admin') }}/plugins/toastr/toastr.min.js"></script>

    @yield('script')
  </body>
</html>
