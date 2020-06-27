@extends('partials.layout')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Registrar sucursal</h6>
                    <form method="post" action="{{ route('oficinas.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12 col-md-3">
                                <label for="ruc">RUC</label>
                                <input type="text" name="ruc" id="ruc"
                                       class="form-control @error('ruc') is-invalid @enderror">
                                @error('ruc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-9">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="address">Marca</label>
                                <input type="text" name="address" id="address"
                                       class="form-control @error('address') is-invalid @enderror">
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="phone">Categoría</label>
                                <input type="text" name="phone" id="phone"
                                       class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
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
