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
                                @if($account->is_active)
                                    <td><span class="badge badge-pill badge-success">ACTIVO</span></td>
                                @else
                                    <td><span class="badge badge-pill badge-warning">INACTIVO</span></td>
                                @endif
                                <td>
                                    @if($account->is_active)
                                        <form action="{{ route('admin.accounts.destroy', ['account' => $account]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Desactivar</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.accounts.enable', ['account' => $account]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Activar</button>
                                        </form>
                                    @endif
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

