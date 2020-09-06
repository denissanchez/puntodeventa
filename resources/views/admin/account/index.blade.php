@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Cuentas registradas</h4>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-12">
            <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">Agregar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accounts as $account)
                            <tr>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->is_active }}</td>
                                <td>
                                    <a href="#" class="btn btn-info">Info</a>
                                    <a href="#" class="btn btn-danger">Desactivar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

