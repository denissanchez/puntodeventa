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
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}"/>
</head>
<body class="sidebar-dark">
<div class="main-wrapper">
    @include('partials.sidebar')
    <div class="page-wrapper">
        @include('partials.navbar')
        <div class="page-content">
            @yield('content')
        </div>
    @include('partials.footer')

    @if(!\Illuminate\Support\Facades\Session::get('current_branch'))
        <form method="POST">
            <div class="modal fade" id="changeOfficeModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="changeOfficeModal"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changeOfficeModalLabel">Seleccionar sucursal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <select name="office" id="office" class="form-control">
                                    <option selected disabled>Seleccionar</option>
                                    <option value="1">Sucursal A</option>
                                    <option value="2">Sucursal A</option>
                                </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Seleccionar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>
</div>

@section('scripts')
    <script src="{{ asset('vendors/core/core.js') }}"></script>
    <script src="{{ asset('vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('js/admin/template.js') }}"></script>
    @if(!\Illuminate\Support\Facades\Session::get('current_branch'))
        <script src="{{ asset('js/custom/layout.js') }}"></script>
    @endif
@show
</body>
</html>
