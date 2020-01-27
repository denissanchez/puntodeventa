@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Editar producto</h4>
        </div>
    </div>
</div>

<form action="{{ route('productos.update', ['producto' => $product]) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" class="form-control" name="code" value="{{ $product->code }}" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Categoría</label>
                                <input type="text" class="form-control" name="category" value="{{ $product->category }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" class="form-control" name="brand" value="{{ $product->brand }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Laboratorio</label>
                                <input type="text" class="form-control" name="laboratory" value="{{ $product->laboratory }}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Unidad de medida</label>
                                <input type="text" class="form-control" name="measure_unit" value="{{ $product->measure_unit }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="description" rows="3" class="form-control" required>{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Composición</label>
                                <textarea name="composition" rows="3" class="form-control" required>{{ $product->composition }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
