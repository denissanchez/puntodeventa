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
                                <input type="text" class="form-control" value="{{ $product->code }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Categoría</label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ $product->category }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ $product->brand }}" required>
                                @error('brand')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Laboratorio</label>
                                <input type="text" class="form-control @error('laboratory') is-invalid @enderror" name="laboratory" value="{{ $product->laboratory }}" required>
                                @error('laboratory')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Unidad de medida</label>
                                <input type="text" class="form-control @error('measure_unit') is-invalid @enderror" name="measure_unit" value="{{ $product->measure_unit }}" required>
                                @error('measure_unit')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" required>{{ $product->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Composición</label>
                                <textarea name="composition" rows="3" class="form-control  @error('composition') is-invalid @enderror">{{ $product->composition }}</textarea>
                                @error('composition')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" name="unit_price" class="form-control @error('unit_price') is-invalid @enderror" value="{{ $product->unit_price }}">
                                @error('unit_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
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
