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
                            <th>Tipo</th>
                            <th>Código</th>
                            <th>Incrementable</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($billing_codes as $key => $billing_code)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $billing_code->type }}</td>
                                <td>{{ $billing_code->prefix }}</td>
                                <td>{{ $billing_code->incrementable }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $billing_codes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
