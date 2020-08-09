@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Registrar usuario</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <a href="{{ route('usuarios.edit', ['usuario' => $user]) }}" class="btn btn-primary">Editar</a>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" value="{{ $user->email }}" class="form-control disabled" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" value="{{ $user->name }}" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Sucursal:</label>
                                <input type="text" value="{{ $user->branch->name }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Rol:</label>
                                <input type="text" value="{{ $user->role }}" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
