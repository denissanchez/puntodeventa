<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'owner_id' => ['required', 'exists:owner_documents,id'],
            'document' => ['required'],
            'date' => ['required', 'date'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.product_id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'numeric', 'gt:0'],
            'products.*.price' => ['required', 'numeric', 'gt:0'],
        ];
    }

    public function attributes()
    {
        return [
            'owner_id' => 'proveedor',
            'document' => 'código del documento',
            'products' => 'productos',
            'date' => 'fecha'
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'Seleccione por lo menos un producto',
            'products.*.id' => 'Los productos registrados no son válidos',
            'products.*.quantity' => 'Las cantidades ingresadas no son válidas',
            'products.*.unit_price' => 'Las precios unitarios ingresadas no son válidas',
        ];
    }
}
