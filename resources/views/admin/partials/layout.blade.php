<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración de usuarios</title>

    <link rel="stylesheet" href="{{ asset('vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>
<body class="sidebar-dark">
    <div class="main-wrapper">
        @include('admin.partials.sidebar')
        <div class="page-wrapper">
            @include('admin.partials.navbar')
            <div class="page-content">
                @yield('content')
            </div>
            @include('admin.partials.footer')
        </div>
    </div>
    <script src="{{ asset('vendors/core/core.js') }}"></script>
    <script src="{{ asset('vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('js/admin/template.js') }}"></script>
</body>
</html>
