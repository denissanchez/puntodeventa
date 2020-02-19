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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('compras.update', [ 'compra' => $purchase ]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-2">
                            <label>RUC</label>
                            <input type="number" class="form-control" name="provider[identity_document]" id="provider_identity_document" value="{{ $purchase->provider['identity_document'] }}">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Razón social</label>
                                <input type="text" class="form-control to-upper" name="provider[name]" id="provider_name" value="{{ $purchase->provider['name'] }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control to-upper" name="provider[address]" id="provider_address" value="{{ $purchase->provider['address'] }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" class="form-control to-upper" name="code" value="{{ $purchase->code }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input name="date" type="date" class="form-control"
                                       value="{{ date('Y-m-d', strtotime($purchase->date)) }}"
                                       min="{{ date('Y-m-d', strtotime($now."- 3 days")) }}"
                                       max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label>Producto</label>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-11">
                            <select id="select2-product" class="form-control select2">
                                <option value="">SELECCIONAR</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewProduct">Nuevo</button>
                        </div>
                    </div>
                    <table id="table-detail" class="table">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="55%">Producto</th>
                            <th width="15%">UOM</th>
                            <th width="10%">Cantidad</th>
                            <th width="10%">P. Unit</th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNewProduct" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-new_product" onsubmit="return false;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="moda-title">Registrar nuevo producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" name="code" class="form-control to-upper" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Categoría</label>
                                <select name="category" class="form-control select2" data-data="" required>
                                    <option value="-" selected>-</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Marca</label>
                                <select name="brand" class="form-control select2" data-data="" required>
                                    <option value="-" selected>-</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Laboratorio</label>
                                <select name="laboratory" id="" class="form-control select2" data-data="" required>
                                    <option value="-" selected>-</option>
                                    @foreach($laboratories as $laboratory)
                                        <option value="{{ $laboratory->id }}">{{ $laboratory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="name" class="form-control to-upper" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>U. medida</label>
                                <select name="measure_unit" class="form-control select2" data-data="" data-tags="true" required>
                                    <option value="-" selected>-</option>
                                    @foreach($measure_units as $measure_unit)
                                        <option value="{{ $measure_unit->id }}">{{ $measure_unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="description" rows="3" class="form-control to-upper" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Composición</label>
                        <textarea name="composition" rows="3" class="form-control to-upper" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    let products = [
        @foreach($products as $key => $product)
            {
                id: {{ $product->id }},
                text:  "{{ $product->code }} | {{ $product->name }} - {{ $product->brand }}",
                uom: "{{ $product->measure_unit }}"
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
                    unit_price: '{{ $product['unit_price'] }}'
                }
                @if(count(old('products')) - 1 !== $key), @endif
            @endforeach
        @else
            @foreach($purchase->details as $key=>$detail)
                {
                    id: '{{ $detail->product_id }}',
                    text: '{{ $detail->product->display_name }}',
                    uom: '{{ $detail->product->measure_unit }}',
                    quantity: '{{ $detail->init_quantity }}',
                    unit_price: '{{ $detail->unit_price }}',
                    subtotal: '{{ $detail->subtotal }}',
                }
                @if(count($purchase->details) - 1 !== $key), @endif
            @endforeach
        @endif
    ];

    $(
        function() {
            $('.select2').select2(
                {
                    tags: true,
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
        data.quantity = (0).toFixed(2);
        data.unit_price = (0).toFixed(2);
        data.subtotal = (0).toFixed(2);
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
                    '<td><input type="text" name="products[' + index + '][quantity]" id="product-'+ index +'-quantity" onchange="onChangeQuantity('+ index +')" value="'+ product.quantity +'" class="form-control form-control-sm" required></td>' +
                    '<td><input type="text" name="products[' + index + '][unit_price]" id="product-'+ index +'-unit_price" onchange="onChangeUnitPrice('+ index +')" value="'+ product.unit_price +'" class="form-control form-control-sm" required></td>' +
                    '<td><input type="text" id="product-'+ index +'-subtotal"  class="form-control form-control-sm" value="' + product.subtotal + '" readonly></td>' +
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
                    toastr.error('No se encontró ningún registro con el número de RUC', 'Proveedor no encontrado')
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
            code: $.trim(getInputFromModalByName('code').val()),
            category : $.trim(getSelect2FromModalByName('category')),
            brand : $.trim(getSelect2FromModalByName('brand')),
            laboratory : $.trim(getSelect2FromModalByName('laboratory')),
            name : $.trim(getInputFromModalByName('name').val()),
            measure_unit : $.trim(getSelect2FromModalByName('measure_unit')),
            description : $.trim(getTextAreaFromModalByName('description').val()),
            composition : $.trim(getTextAreaFromModalByName('composition').val()),
        };

        axios.post('/api/productos', product).then(
            res => {
                let data = res.data.data;
                data.quantity = (0).toFixed(2);
                data.unit_price = (0).toFixed(2);
                data.subtotal = (0).toFixed(2);
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
</script>
@endsection
