@extends('partials.layout')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Productos</h6>
                <x-alert />
                <div class="table-responsive">
                    <table id="table" class="table">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Categoría</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->internal_code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{ $product->category }}</td>
                                <td>
                                    <a href="{{ route('productos.show', $product->id) }}" class="btn btn-info btn-sm">Detalle</a>
                                    <a href="{{ route('productos.edit', $product->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                </td>
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

@section('scripts')
    @parent
    <script src="{{ asset('js/custom/product.index.js') }}"></script>
@endsection
