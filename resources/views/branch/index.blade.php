@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Sucursales</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Razón social</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($branches as $key => $branch)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $branch->name }}</td>
                            <td>{{ $branch->address }}</td>
                            <td>{{ $branch->phone }}</td>
                            <td>
                                <a href="{{ route('sucursales.show', [ 'sucursale' => $branch ]) }}" class="btn btn-link">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $branches->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
