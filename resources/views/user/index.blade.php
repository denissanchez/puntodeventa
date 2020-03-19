@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Usuarios</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30">
            @if(Auth::user()->role === 'ADMINISTRADOR')
                <div class="card-header">
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Registrar</a>
                </div>
            @endif
            <div class="card-body">
                <table id="dataTable" class="table table-striped table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Nombre</th>
                        <th>Sucursal</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-lowercase">{{ $user->email }}</td>
                            <td class="text-uppercase">{{ $user->name }}</td>
                            <td class="text-uppercase">{{ $user->branch->name }}</td>
                            <td class="text-uppercase">{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('usuarios.show', [ 'usuario' => $user ]) }}" class="btn btn-link">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection
