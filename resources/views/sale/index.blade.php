@extends('partials.layout')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Ventas</h6>
                <div class="table-responsive">
                    <table id="table" class="table">
                        <thead>
                        <tr>
                            <th>Client</th>
                            <th>Código</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td class="text-uppercase">{{ $sale->owner->name }}</td>
                                <td class="text-uppercase">{{ $purchase->document }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
