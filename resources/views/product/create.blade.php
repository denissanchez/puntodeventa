@extends('partials.layout')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Registrar producto</h6>
                    <form method="post" action="{{ route('productos.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="origin_code">Cód. origen</label>
                                <input type="text" name="origin_code" id="origin_code"
                                       class="form-control @error('origin_code') is-invalid @enderror"
                                       placeholder="OPCIONAL">
                                @error('origin_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="internal_code">Cód. interno</label>
                                <input type="text" name="internal_code" id="internal_code"
                                       class="form-control @error('internal_code') is-invalid @enderror"
                                       placeholder="AUTOGENERADO">
                                @error('internal_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="category">Categoría</label>
                                <select name="category" id="category"
                                        class="form-control @error('category') is-invalid @enderror">
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="brand">Marca</label>
                                <select name="brand" id="brand"
                                        class="form-control @error('brand') is-invalid @enderror">
                                </select>
                                @error('brand')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-8 col-lg-6">
                                <label for="laboratory">Laboratorio</label>
                                <select name="laboratory" id="laboratory"
                                        class="form-control @error('laboratory') is-invalid @enderror">
                                </select>
                                @error('laboratory')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-2">
                                <label for="minimun_quantity">Cantidad mínima</label>
                                <input type="text" name="minimun_quantity" id="minimun_quantity"
                                       class="form-control @error('minimun_quantity') is-invalid @enderror">
                                @error('minimun_quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-2">
                                <label for="unit_price">Precio de venta</label>
                                <input type="text" name="unit_price" id="unit_price"
                                       class="form-control @error('unit_price') is-invalid @enderror">
                                @error('unit_price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-4 col-lg-2">
                                <label for="measure_unit">Unidad de medida</label>
                                <select name="measure_unit" id="measure_unit"
                                        class="form-control @error('measure_unit') is-invalid @enderror">
                                </select>
                                @error('measure_unit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-4 col-lg-6">
                                <label for="preview">Imagen</label>
                                <div class="custom-file">
                                    <input type="file" name="preview" id="preview" class="custom-file-input" lang="es">
                                    <label class="custom-file-label">Subir imagen</label>
                                </div>
                                @error('preview')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" id="description" rows="3"
                                      class="form-control @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="commentary">Comentario adicional</label>
                            <textarea name="commentary" id="commentary" rows="3"
                                      class="form-control @error('commentary') is-invalid @enderror"></textarea>
                            @error('commentary')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary px-5">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection