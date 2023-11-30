<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('admin') }}/images/favicon-32x32.png" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/style.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>{{ env('APP_NAME') }} - @yield('title')</title>
</head>

<body>
    <!--start wrapper-->
    @yield('content')
    <!--end wrapper-->

    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('admin') }}/js/bootstrap.bundle.min.js"></script>
</body>

</html>
