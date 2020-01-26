@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Detalle de sucursal</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>RUC: <sup class="text-danger">*</sup></label>
                                <input type="number" class="form-control" value="{{ $branch->ruc }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <div class="form-group">
                                <label>Razón social: <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control to-upper" value="{{ $branch->name }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>Dirección: <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control to-upper" value="{{ $branch->address }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label>Teléfono:</label>
                                <input type="number" class="form-control" value="{{ $branch->phone }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>E-mail:</label>
                                <input type="text" class="form-control to-lower" value="{{ $branch->email }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>Sitio web:</label>
                                <input type="text" class="form-control to-lower" value="{{ $branch->website }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
