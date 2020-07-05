@extends('partials.layout')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Registrar proveedor</h6>
                    <form method="post" action="{{ route('usuarios.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="username">Usuario</label>
                                <input type="text" name="username" id="username"
                                       class="form-control @error('username') is-invalid @enderror"
                                       value="{{ old('username', '') }}"
                                       placeholder="Nombre usuario único">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-8">
                                <label for="name">Nombres y apellidos</label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', '') }}"
                                       placeholder="Nombres y apellidos">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="password">Contraseña</label>
                                <input type="text" name="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       value="{{ old('password', '') }}"
                                       placeholder="Contraseña">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="password_confirmation ">Confirmar contraseña</label>
                                <input type="text" name="password_confirmation" id="password_confirmation "
                                       class="form-control" placeholder="Repetir contraseña">
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary px-5">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
