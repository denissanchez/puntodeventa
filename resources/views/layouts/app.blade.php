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
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <div id="wrapper">

        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="fas fa-times"></i>
            </button>

            <div class="topbar-left">
                <div class="text-center">
                    <a href="#" class="logo"> FÉ Y SALUD</a>
                </div>
            </div>

            <div class="sidebar-inner slimscrollleft">
                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Principal</li>
                        <li>
                            <a href="#" class="waves-effect">
                                <span> Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="content-page">
            <div class="content">
                <div class="topbar">
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item dropdown notification-list">
                                <a href="#" class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                   data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="{{ asset('images/users/avatar.png') }}" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                    <div class="dropdown-item noti-title">
                                        <h5>Bienvenido</h5>
                                    </div>
                                    <a href="#" class="dropdown-item"><i class="fa fa-user text-muted"></i> Cuenta</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item"><i class="mdi mdi-logout m-r-5 text-muted"></i> Salir</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-left waves-light waves-effect">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </li>
                        </ul>
                        <div class="clear-fix"></div>
                    </nav>
                </div>

                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
