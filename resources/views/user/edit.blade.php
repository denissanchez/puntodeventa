@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Registrar usuario</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Email: <sup class="text-danger">*</sup></label>
                                    <input type="email" name="email" placeholder="usuario@email.com" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Nombre: <sup class="text-danger">*</sup></label>
                                    <input type="text" name="name" placeholder="Nombre del usuario" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Sucursal: <sup class="text-danger">*</sup></label>
                                    <select name="branch_id" class="form-control @error('branch_id') is-invalid @enderror" value="{{ $user->branch_id }}">
                                        <option value="" selected>Seleccionar</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('branch_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Rol: <sup class="text-danger">*</sup></label>
                                    <select name="role" class="form-control @error('password') is-invalid @enderror" value="{{ $user->role }}">
                                        <option value="SELLER" selected>Vendedor</option>
                                        <option value="ADMIN">Administrador</option>
                                    </select>
                                    @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
