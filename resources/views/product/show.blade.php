@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Editar producto</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" class="form-control" value="{{ $product->code }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Categoría</label>
                                <input type="text" class="form-control" value="{{ $product->category }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" class="form-control" value="{{ $product->brand }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Laboratorio</label>
                                <input type="text" class="form-control" value="{{ $product->laboratory }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Unidad de medida</label>
                                <input type="text" class="form-control" value="{{ $product->measure_unit }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <textarea rows="3" class="form-control" disabled>{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Composición</label>
                                <textarea rows="3" class="form-control" disabled>{{ $product->composition }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('productos.edit', $product) }}" class="btn btn-primary">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
