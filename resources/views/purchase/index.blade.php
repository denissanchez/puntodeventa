@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Productos</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Fecha y hora</th>
                        <th>Código</th>
                        <th>Proveedor</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->date }}</td>
                            <td>{{ $purchase->code }}</td>
                            <td>{{ $purchase->provider->name }}</td>
                            <td>
                                <a href="{{ route('compras.show', [ 'compra' => $purchase ]) }}" class="btn btn-link">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </div>
@endsection
