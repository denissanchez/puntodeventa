@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Registrar venta</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <form action="{{ route('compras.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>RUC</label>
                                <input type="text"
                                       class="form-control @error('client.identity_document') is-invalid @enderror"
                                       name="client[identity_document]"
                                       id="client_identity_document"
                                       value="{{ old('client.identity_document') }}">
                                @error('client.identity_document')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Razón social</label>
                                <input type="text"
                                       class="form-control to-upper @error('client.name') is-invalid @enderror"
                                       name="client[name]"
                                       id="client_name"
                                       value="{{ old('client.name') }}">
                                @error('client.name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text"
                                       class="form-control to-upper @error('client.address') is-invalid @enderror"
                                       name="client[address]"
                                       id="client_address"
                                       value="{{ old('client.address') }}">
                                @error('client.name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label>Producto</label>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-12">
                            <select id="select2-product" class="form-control select2">
                                <option value="">SELECCIONAR</option>
                            </select>
                        </div>
                    </div>
                    @error('products')
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            </div>
                        </div>
                    @enderror
                    <table id="table-detail" class="table">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="45%">Producto</th>
                            <th width="10%">P. Unit</th>
                            <th width="10%">Cantidad</th>
                            <th width="10%">Dscto</th>
                            <th width="10%">Subtotal</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    let products = [
        @foreach($products as $key => $product)
            {
                id: {{ $product->id }},
                text:  "{{ $product->code }} | {{ $product->name }} - {{ $product->brand }}",
                uom: "{{ $product->measure_unit }}",
                unit_price: {{ $product->unit_price }}
            } @if(count($products) - 1 !== $key), @endif
        @endforeach
    ];

    let clients = [
        @foreach($clients as $key => $client)
            {
                id: '{{ $client->id }}',
                name: "{{ $client->name }}",
                identity_document: "{{ $client->identity_document }}",
                address: "{{ $client->address }}"
            }
            @if(count($clients) - 1 !== $key), @endif
        @endforeach
    ];

    let selectedProducts = [
        @if(old('products') !== null)
            @foreach(old('products') as $key=>$product)
                {
                    id: '{{ $product['id'] }}',
                    text: '{{ $product['text'] }}',
                    uom: '{{ $product['uom'] }}',
                    quantity: '{{ $product['quantity'] }}',
                    unit_price: '{{ $product['unit_price'] }}'
                }
                @if(count(old('products')) - 1 !== $key), @endif
            @endforeach
        @endif
    ];

    $(
        function () {
            $('.select2').select2(
                {
                    theme: 'bootstrap',
                    data: products
                });
    })

    $('#select2-product').on('select2:select', function(e){
        let data = e.params.data;
        data.quantity = 0;
        data.unit_price = 0;
        data.discount = 0;
        selectedProducts.push(data);
        $('#select2-product').val('');
        reloadTableContent();
    });

    function reloadTableContent() {
        let table = $('#table-detail');
        table.find('tbody tr').remove();
        selectedProducts.forEach(
            function (product, index) {
                table.append(
                    '<tr id="item-' + index + '">' +
                        '<td>'+ (index + 1) +
                            '<input type="hidden" name="products[' + index + '][id]" value="' + product.id + '">' +
                            '<input type="hidden" name="products[' + index + '][text]" value="' + product.text + '">' +
                            '<input type="hidden" name="products[' + index + '][uom]" value="' + product.uom + '">' +
                            '<input type="hidden" name="products[' + index + '][unit_price]" value="' + product.unit_price + '">' +
                        '</td>' +
                        '<td>'+ product.text + '</td>' +
                        '<td>'+ product.unit_price + '</td>' +
                        '<td><input type="text" name="products[' + index + '][quantity]" id="product-'+ index +'-quantity" value="'+ product.quantity +'" class="form-control form-control-sm" required></td>' +
                        '<td><input type="text" name="products[' + index + '][discount]" id="product-'+ index +'-discount" value="'+ product.quantity +'" class="form-control form-control-sm" required></td>' +
                        '<td><input type="text" id="product-'+ index +'-subtotal"  class="form-control form-control-sm" value="0.00" readonly></td>'+
                        '<td>' +
                            '<button type="button" onclick="deleteItem(' + index + ', \''+ product.text +'\')" class="btn btn-danger btn-sm" >' +
                                '<i class="fa fa-trash"></i>' +
                            '</button>' +
                        '</td>' +
                    '</tr>'
                );
            }
        );
    }

    $('#client_identity_document').change(
        function () {
            $('#client_identity_document').removeClass('is-invalid')
            let value = $('#client_identity_document').val().trim();
            if (value.length === 8 || value.length === 11) {
                let client = clients.find(function(client) {
                    return client.identity_document === value
                });
                if (client) {
                    setClientName(client.name);
                    setClientAddress(client.address);
                    toastr.success('Cliente encontrado')
                } else {
                    toastr.error('No se encontró ningún registro con el número de documento', 'Cliente no encontrado')
                }
            } else {
                toastr.error('Por favor ingrese un número de documento válido', 'Error')
                $('#client_identity_document').addClass('is-invalid')
                setClientAddress('');
                setClientName('');
            }
        }
    );

    function setClientName(value){
        $('#client_name').val(value);
    }

    function setClientAddress(value){
        $('#client_address').val(value);
    }

    function deleteItem(index, text) {
        $('#item-' + index).remove();
        let product = selectedProducts.find(
            product => product.text === text
        );
        index = selectedProducts.indexOf(product);
        selectedProducts.splice(index, 1);
        reloadTableContent();
    }

    function onChangeQuantity(index) {
        selectedProducts[index].quantity = $('#product-'+ index +'-quantity').val();
    }

    function onChangeUnitPrice(index) {
        selectedProducts[index].unit_price = $('#product-'+ index +'-unit_price').val();
    }

    function onChangeDiscount(index) {
        selectedProducts[index].unit_price = $('#product-'+ index +'-unit_price').val();
    }
</script>
@endsection
