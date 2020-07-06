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
        <div id="app" class="page-content">
            @yield('content')
            <Toast />
        </div>
    @include('partials.footer')

    @if(!\Illuminate\Support\Facades\Session::get(\App\Utils\UtilsKey::CURRENT_STORE_ID))
        <form action="{{ route('store.session') }}" method="POST">
            @csrf
            <div class="modal fade" id="changeOfficeModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="changeOfficeModal"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changeOfficeModalLabel">Seleccionar sucursal</h5>
                        </div>
                        <div class="modal-body">
                            @php
                                $stores = \App\Models\Store::all();
                            @endphp
                                <select name="store" id="store" class="form-control @error('store') is-invalid @enderror">
                                    <option selected disabled>Seleccionar</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                @error('store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
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
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    @if(!\Illuminate\Support\Facades\Session::get('current_branch'))
        <script src="{{ asset('js/custom/layout.js') }}"></script>
    @endif

    <script src="{{ asset('js/app.js') }}"></script>
@show
</body>
</html>
