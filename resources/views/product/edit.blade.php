@extends('partials.layout')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Registrar producto</h6>
                    <form method="post" action="{{ route('productos.update', $product->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="origin_code">Cód. origen</label>
                                <input type="text" name="origin_code" id="origin_code"
                                       class="form-control @error('origin_code') is-invalid @enderror"
                                       value="{{ old('origin_code', $product->origin_code) }}"
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
                                       value="{{ old('internal_code', $product->internal_code) }}"
                                       maxlength="6"
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
                                       value="{{ old('name', $product->name) }}"
                                       required>
                                @error('name')
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
                                       class="form-control @error('minimun_quantity') is-invalid @enderror"
                                       value="{{ old('minimun_quantity', $product->minimun_quantity ) }}">
                                @error('minimun_quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-2">
                                <label for="unit_price">Precio de venta</label>
                                <input type="text" name="unit_price" id="unit_price"
                                       class="form-control @error('unit_price') is-invalid @enderror"
                                       value="{{ old('unit_price', $product->unit_price) }}">
                                @error('unit_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" id="description" rows="3"
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="composition">Composición</label>
                            <textarea name="composition" id="composition" rows="3"
                                      class="form-control @error('composition') is-invalid @enderror">{{ old('composition', $product->composition) }}</textarea>
                            @error('composition')
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
