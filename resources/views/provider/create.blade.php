@extends('partials.layout')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Registrar proveedor</h6>
                    <form method="post" action="{{ route('proveedores.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="document">RUC</label>
                                <input type="text" name="document" id="document"
                                       class="form-control @error('document') is-invalid @enderror"
                                       value="{{ old('document', '') }}"
                                       maxlength="11"
                                       placeholder="11 digitos">
                                @error('document')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-8">
                                <label for="internal_code">Razón social</label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', '') }}"
                                       placeholder="Razón social">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="internal_code">Dirección</label>
                                <input type="text" name="address" id="address"
                                       class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address', '') }}"
                                       placeholder="Razón social">
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="internal_code">Teléfono</label>
                                <input type="text" name="phone" id="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', '') }}"
                                       placeholder="Razón social">
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
