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
        <div class="card m-b-30">
            <div class="card-body">
                <table id="dataTable" class="table table-striped table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $key=>$sale)
                        <tr>
                            <td class="text-uppercase">{{ $sale->code }}</td>
                            <td class="text-uppercase">{{ $sale->client['name'] }}</td>
                            <td>
                                <a href="{{ route('ventas.show', ['venta' => $sale]) }}" class="btn btn-link">Ver</a>
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
