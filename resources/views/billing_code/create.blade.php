@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Registrar códigos de facturación</h4>
        </div>
    </div>
</div>

<form action="{{ route('facturacion.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>Tipo:</label>
                                <select name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="FACTURA">FACTURA</option>
                                    <option value="BOLETA">BOLETA</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <div class="form-group">
                                <label>Código:</label>
                                <input type="text" name="prefix" class="form-control to-upper @error('prefix') is-invalid @enderror">
                                @error('prefix')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>Incrementable:</label>
                                <input type="text" name="incrementable"  class="form-control to-upper @error('incrementable') is-invalid @enderror">
                                @error('incrementable')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
