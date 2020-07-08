@extends('partials.layout')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Detalle producto</h6>
                <div class="form-row">
                    <div class="form-group col-12 col-md-6 col-lg-3">
                        <label for="origin_code">Cód. origen</label>
                        <input type="text" class="form-control"
                               value="{{ $product->origin_code }}"
                               disabled>
                    </div>
                    <div class="form-group col-12 col-md-6 col-lg-3">
                        <label for="internal_code">Cód. interno</label>
                        <input type="text" class="form-control"
                               value="{{ $product->internal_code }}"
                               disabled>
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control"
                               value="{{ $product->name }}"
                               disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" rows="3"
                              class="form-control" disabled>{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="composition">Composición</label>
                    <textarea name="composition" id="composition" rows="3"
                              class="form-control" disabled>{{ $product->composition }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
