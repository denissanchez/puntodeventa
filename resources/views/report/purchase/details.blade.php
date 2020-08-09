@extends('report.report')

@section('content')
    <div class="text-center">
        <h1 style="font-size: 16px; padding: 0; padding-bottom: 5px">REPORTE DE COMPRAS - DETALLADO POR COMPRA</h1>
        <h3 style="font-size: 14px; padding: 0; padding-bottom: 5px">Desde: <strong>{{  date('d-m-Y', strtotime($start_date)) }}</strong> - Hasta:  <strong>{{  date('d-m-Y', strtotime($end_date)) }}</strong></h3>
    </div>
    <table class="blueTable">
        <thead>
        <tr>
            <th style="width: 10%">FECHA</th>
            <th style="width: 10%">COMPRA</th>
            <th style="width: 35%">PRODUCTO</th>
            <th style="width: 5%">U.M.</th>
            <th style="width: 10%">U. COMPRADAS</th>
            <th style="width: 10%">U. VENDIDAS</th>
            <th style="width: 10%">EN STOCK</th>
            <th style="width: 10%">SUBTOTAL</th>
        </tr>
        </thead>
        <tbody>
        @foreach($purchases as $purchase)
            @foreach($purchase->details as $detail)
                <tr>
                    <td>{{ $purchase->date }}</td>
                    <td>{{ $purchase->code }}</td>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->product->measure_unit }}</td>
                    <td>{{ $detail->init_quantity }}</td>
                    <td>{{ number_format($detail->init_quantity - $detail->current_quantity, 2)}}</td>
                    <td>{{ $detail->in_stock }}</td>
                    <td>{{ number_format($detail->subtotal, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>TOTAL:</td>
                <td>{{ $purchase->ammount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
