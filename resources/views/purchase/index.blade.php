@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Compras</h4>
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
                        <th>Fecha y hora</th>
                        <th>Código</th>
                        <th>Proveedor</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td class="text-uppercase">{{ $purchase->date }}</td>
                            <td class="text-uppercase">{{ $purchase->code }}</td>
                            <td class="text-uppercase">{{ $purchase->provider['name'] }}</td>
                            <td>
                                <a href="{{ route('compras.show', [ 'compra' => $purchase ]) }}" class="btn btn-link">Ver</a>
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
