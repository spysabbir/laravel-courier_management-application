@php
    $default_setting = App\Models\DefaultSetting::first();
@endphp
<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('uploads/default_photo') }}/{{ $default_setting->favicon }}" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/style.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
	<link href="{{ asset('admin') }}/css/pace.min.css" rel="stylesheet" />

    <title>{{ env('APP_NAME') }} || @yield('title')</title>
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    <div class="card shadow rounded-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-5 bg-login d-flex align-items-center justify-content-center">
                            <img src="{{ asset('admin') }}/images/error/login-img.jpg" class="img-fluid" alt="">
                        </div>
                        @yield('content')
                    </div>
                    </div>
                </div>
            </div>
        </main>
        <!--end page main-->
    </div>
    <!--end wrapper-->

    <!--plugins-->
    <script src="{{ asset('admin') }}/js/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/js/pace.min.js"></script>

    @yield('script')

</body>
</html>
