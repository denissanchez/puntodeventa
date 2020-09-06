@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Registrar una nueva cuenta</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('admin.accounts.store') }}" method="post">
                        @csrf
                        <h4>Datos de la empresa</h4>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label>RUC: <sup class="text-danger">*</sup></label>
                                    <input type="text" name="ruc" class="form-control @error('ruc') is-invalid @enderror">
                                    @error('ruc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5">
                                <div class="form-group">
                                    <label>Razón social: <sup class="text-danger">*</sup></label>
                                    <input type="text" name="name"  class="form-control to-upper @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label>Dirección: <sup class="text-danger">*</sup></label>
                                    <input type="text" name="address"  class="form-control to-upper @error('address') is-invalid @enderror">
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label>Teléfono:</label>
                                    <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label>E-mail:</label>
                                    <input type="text" name="email" class="form-control to-lower @error('email') is-invalid @enderror">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h4>Datos de la cuenta de usuario</h4>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label>Nombre <sup class="text-danger">*</sup></label>
                                    <input type="text" name="user_name" class="form-control @error('user_name') is-invalid @enderror">
                                    @error('user_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label>Email <sup class="text-danger">*</sup></label>
                                    <input type="email" name="user_email" class="form-control @error('user_email') is-invalid @enderror">
                                    @error('user_email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label>Contraseña <sup class="text-danger">*</sup></label>
                                    <input type="text" name="user_password" class="form-control @error('user_password') is-invalid @enderror">
                                    @error('user_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
@endsection
