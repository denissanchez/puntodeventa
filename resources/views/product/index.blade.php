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
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>En stock</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key=>$product)
                        <tr>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->current_quantity }}</td>
                            <td>
                                <a href="{{ route('productos.show', $product ) }}" class="btn btn-link btn-sm">Ver</a>
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
        var html = $('#dataTable').html();
        $('#dataTable').html('');
        setTimeout(() => {
            $('#dataTable').html(html);
            $('#dataTable').DataTable();
        }, 1500)
    });
</script>

@endsection
