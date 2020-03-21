@extends('report.report')

@section('content')
    <div class="text-center">
        <h1 style="font-size: 16px; padding: 0; padding-bottom: 5px">REPORTE DE VENTAS</h1>
        <h3 style="font-size: 14px; padding: 0; padding-bottom: 5px">Desde: <strong>{{  date('d-m-Y', strtotime($start_date)) }}</strong> - Hasta:  <strong>{{  date('d-m-Y', strtotime($end_date)) }}</strong></h3>
    </div>
    <table class="blueTable">
        <thead>
        <tr>
            <th style="width: 15%">FECHA</th>
            <th style="width: 15%">CÓDIGO</th>
            <th style="width: 55%; text-transform: uppercase;">CLIENTE</th>
            <th style="width: 15%">MONTO (S/)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->date }}</td>
                <td>{{ $sale->code }}</td>
                <td>{{ $sale->client['name'] }}</td>
                <td>{{ $sale->ammount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
