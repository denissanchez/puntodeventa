@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Detalle de compra</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>RUC</label>
                            <input type="number" class="form-control" value="{{ $purchase->provider['identity_document'] }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Razón social</label>
                            <input type="text" class="form-control to-upper" value="{{ $purchase->provider['name'] }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" class="form-control to-upper" value="{{ $purchase->provider['address'] }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Código</label>
                            <input type="text" class="form-control to-upper" value="{{ $purchase->code }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Fecha</label>
                            <input name="date" type="date" class="form-control"
                                   value="{{ $purchase->date }}" disabled>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="55%">Producto</th>
                        <th width="20%">UOM</th>
                        <th width="10%">Cantidad</th>
                        <th width="10%">P. Unit</th>
                        <th width="10%">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase->details as $detail)
                        <tr>
                            <td>{{ $detail->item }}</td>
                            <td>{{ $detail->product->display_name }}</td>
                            <td>{{ $detail->product->measure_unit }}</td>
                            <td>{{ $detail->init_quantity }}</td>
                            <td>{{ $detail->unit_price }}</td>
                            <td>{{ $detail->subtotal }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="form-row">
                    <div class="col-sm-12">
                        @if ($purchase->is_deleteable)
                            <form action="{{ route('compras.destroy', ['compra' => $purchase]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="d-flex">
                                    <div class="flex-grow-0">
                                        <label class="p-2">Comentario</label>
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="text" class="form-control form-control-sm" name="commentary">
                                    </div>
                                    <div>
                                        <button class="p-2 btn btn-danger btn-sm">Anular</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    @if ($purchase->is_editable)
                        <a href="{{ route('compras.edit', ['compra' => $purchase]) }}" class="p-2 m-2 btn btn-primary btn-sm">Editar</a>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <span class="text-muted">Estado: {{ $purchase->state }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
