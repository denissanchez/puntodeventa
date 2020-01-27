<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="fixed-left">
<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">
    <div class="card">
        <div class="card-block">
            <div class="ex-page-content text-center">
                <h1 class="">500</h1>
                <h3 class="">Error del servidor</h3><br>
                <a class="btn btn-danger mb-5 waves-effect waves-light" href="{{ route('home') }}">Regresar</a>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
