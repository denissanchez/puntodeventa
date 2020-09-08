@extends('layouts.app')

@php
    $now = date('Y-m-d');
@endphp

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Registrar compra</h4>
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
                                       class="form-control @error('provider.identity_document') is-invalid @enderror"
                                       name="provider[identity_document]"
                                       id="provider_identity_document"
                                       value="{{ old('provider.identity_document') }}">
                                @error('provider.identity_document')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Razón social</label>
                                <input type="text"
                                       class="form-control to-upper @error('provider.name') is-invalid @enderror"
                                       name="provider[name]"
                                       id="provider_name"
                                       value="{{ old('provider.name') }}">
                                @error('provider.name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text"
                                       class="form-control to-upper @error('provider.address') is-invalid @enderror"
                                       name="provider[address]"
                                       id="provider_address"
                                       value="{{ old('provider.address') }}">
                                @error('provider.address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text"
                                       class="form-control to-upper @error('code') is-invalid @enderror"
                                       value="{{ old('code') }}"
                                       name="code">
                                @error('code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input name="date" type="date" class="form-control"
                                       @if(old('date') !== null)
                                        value="{{ old('date') }}"
                                       @else
                                        value="{{ date('Y-m-d') }}"
                                       @endif
                                       min="{{ date('Y-m-d', strtotime($now."- 5 days")) }}"
                                       max="{{ date('Y-m-d') }}">
                                @error('date')
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
                        <div class="col-md">
                            <select id="select2-product" class="form-control select2">
                                <option value="">SELECCIONAR</option>
                            </select>
                        </div>
                        <div class="col-md-auto">
                            <button type="button"
                                    class="btn btn-primary btn-sm"
                                    onclick="openModalRegisterProduct()">
                                Nuevo
                            </button>
                        </div>
                    </div>
                    @error('products')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <table id="table-detail" class="table">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="45%">Producto</th>
                            <th width="15%">UOM</th>
                            <th width="10%">Cantidad</th>
                            <th width="10%">P. Unit</th>
                            <th width="10%">Total</th>
                            <th width="5%"></th>
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

<div class="modal fade" id="modalNewProduct" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-new_product" onsubmit="return false;">
            <div class="modal-content" id="modal-content_create">
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    let products = [
        @foreach($products as $key => $product)
            {
                id: {{ $product->id }},
                text:  "{{ $product->getDisplayNameAttribute() }}",
                uom: "{{ $product->measure_unit }}",
                error_quantity: '',
                error_unit_price: ''
            } @if(count($products) - 1 !== $key), @endif
        @endforeach
    ];

    let providers = [
        @foreach($providers as $key => $provider)
            {
                id: '{{ $provider->id }}',
                name: "{{ $provider->name }}",
                identity_document: "{{ $provider->identity_document }}",
                address: "{{ $provider->address }}"
            }
            @if(count($providers) - 1 !== $key), @endif
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
                    unit_price: '{{ $product['unit_price'] }}',
                    @error('products.'.$key.'.quantity') error_quantity: 'is-invalid', @enderror
                    @error('products.'.$key.'.unit_price') error_unit_price: 'is-invalid' @enderror
                }
                @if(count(old('products')) - 1 !== $key), @endif
            @endforeach
        @endif
    ];

    $(
        function() {
            $('.select2').select2(
                {
                    theme: 'bootstrap',
                    data: products
                });

            $('#form-new_product').validate({
                rules: {
                    code: 'required',
                    name: 'required',
                    measure_unit: 'required',
                    description: 'required',
                    composition: {
                        required: false
                    }
                },
                errorClass: 'is-invalid',
                submitHandler: function () {
                    saveProduct();
                }
            });
            reloadTableContent();
        });

    $('#select2-product').on('select2:select', function(e){
        let data = e.params.data;
        data.quantity = 0;
        data.unit_price = 0;
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
                    '<td>' + (index + 1) +
                        '<input type="hidden" name="products[' + index + '][id]" value="' + product.id + '">' +
                        '<input type="hidden" name="products[' + index + '][text]" value="' + product.text + '">' +
                        '<input type="hidden" name="products[' + index + '][uom]" value="' + product.uom + '">' +
                    '</td>' +
                    '<td>'+ product.text +'</td>' +
                    '<td>'+ product.uom +'</td>' +
                    '<td><input type="text" name="products[' + index + '][quantity]" id="product-'+ index +'-quantity" onchange="onChangeQuantity('+ index +')" value="'+ product.quantity +'" class="form-control form-control-sm '+ product.error_quantity +'" required></td>' +
                    '<td><input type="text" name="products[' + index + '][unit_price]" id="product-'+ index +'-unit_price" onchange="onChangeUnitPrice('+ index +')" value="'+ product.unit_price +'" class="form-control form-control-sm '+ product.error_unit_price +'" required></td>' +
                    '<td><input type="text" id="product-'+ index +'-subtotal"  class="form-control form-control-sm" value="0.00" readonly></td>' +
                    '<td>' +
                    '<button type="button" onclick="deleteItem(' + index + ', \''+ product.text +'\')" class="btn btn-danger btn-sm" >' +
                    '           <i class="fa fa-trash"></i>' +
                    '</button>' +
                    '</td>' +
                    '</tr>'
                );
            }
        );
    }

    $('#provider_identity_document').change(
        function () {
            $('#provider_identity_document').removeClass('is-invalid')
            let value = $('#provider_identity_document').val().trim();
            if (value.length === 11) {
                let provider = providers.find(function(provider) {
                    return provider.identity_document === value
                });
                if (provider) {
                    setProviderName(provider.name);
                    setProviderAddress(provider.address);
                    toastr.success('Proveedor encontrado')
                } else {
                    toastr.warning('No se encontró ningún registro con el número de RUC', 'Proveedor no encontrado')
                }
            } else {
                toastr.error('Por favor ingrese un RUC válido', 'Error');
                $('#provider_identity_document').addClass('is-invalid');
                setProviderAddress('');
                setProviderName('');
            }
        }
    );

    function setProviderName(value){
        $('#provider_name').val(value);
    }

    function setProviderAddress(value){
        $('#provider_address').val(value);
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

    $('#btn_modal-reset').click(closeModal())

    function closeModal() {
        $('#modalNewProduct .close').click();
        $('#form-new_product').trigger('reset');
    }

    function saveProduct() {
        let product = {
            origin_code: $.trim(getInputFromModalByName('origin_code').val()),
            code: $.trim(getInputFromModalByName('code').val()),
            category : $.trim(getSelect2FromModalByName('category')),
            brand : $.trim(getSelect2FromModalByName('brand')),
            laboratory : $.trim(getSelect2FromModalByName('laboratory')),
            name : $.trim(getInputFromModalByName('name').val()),
            measure_unit : $.trim(getSelect2FromModalByName('measure_unit')),
            description : $.trim(getTextAreaFromModalByName('description').val()),
            composition : $.trim(getTextAreaFromModalByName('composition').val()),
        };

        console.log(product);

        axios.post('/v1/productos', product).then(
            res => {
                let data = res.data.data;
                data.quantity = 0;
                data.unit_price = 0;
                selectedProducts.push(data);
                reloadTableContent();
                closeModal();
            },
            err => {

            }
        );
    }

    function getTextAttribute(product) {
        return product.code + ' | ' + product.name + ' - ' + product.brand;
    }

    function getInputFromModalByName(name) {
        return $('#form-new_product input[name="'+ name +'"]');
    }

    function getTextAreaFromModalByName(name) {
        return $('#form-new_product textarea[name="'+ name +'"]');
    }

    function getSelectFromModalByName(name) {
        return $('#form-new_product select[name="'+ name +'"]');
    }

    function getSelect2FromModalByName(name) {
        return $('#form-new_product select[name="'+ name +'"]').select2('data')['0']['text'];
    }

    function onChangeQuantity(index) {
        selectedProducts[index].quantity = $('#product-'+ index +'-quantity').val();
        calculateSubtotal(index);
    }

    function onChangeUnitPrice(index) {
        selectedProducts[index].unit_price = $('#product-'+ index +'-unit_price').val();
        calculateSubtotal(index);
    }

    function calculateSubtotal(index) {
        let subtotal = +selectedProducts[index].quantity * +selectedProducts[index].unit_price;
        $('#product-'+ index +'-subtotal').val(subtotal.toFixed(2));
    }

    function openModalRegisterProduct() {
        $('#modal-content_create').html('');
        $('#modalNewProduct').modal('show');
        axios.get("{{ route('partial.create.product')  }}").then(
            res => {
                $('#modal-content_create').html(res.data);
                $('.select2Product').select2(
                {
                    theme: 'bootstrap',
                    data: products,
                    tags: true
                });
            }
        );
    }
</script>
@endsection
