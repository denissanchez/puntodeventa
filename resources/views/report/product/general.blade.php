@extends('report.report')

@section('content')
<div class="text-center">
    <h1 style="font-size: 16px; padding: 0; padding-bottom: 5px">REPORTE DE STOCK</h1>
    <h3 style="font-size: 14px; padding: 0; padding-bottom: 5px">Desde: <strong>{{  date('d-m-Y', strtotime($start_date)) }}</strong> - Hasta:  <strong>{{  date('d-m-Y', strtotime($end_date)) }}</strong></h3>
</div>
<table class="blueTable">
    <thead>
    <tr>
        <th style="width: 15%">CÓDIGO</th>
        <th style="width: 40%">PRODUCTO</th>
        <th style="width: 15%">U. COMPRADAS</th>
        <th style="width: 15%">U. VENDIDAS</th>
        <th style="width: 15%">STOCK</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->purchased_units }}</td>
            <td>{{ $product->sold_units }}</td>
            <td>{{ $product->current_quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
