<?php

namespace App\Http\Requests;

use App\Models\Purchase;
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
            'provider.identity_document' => ['required', 'digits:11'],
            'provider.name' => ['required', 'string'],
            'provider.address' => ['required', 'string'],
            'code' => ['required'],
            'date' => ['required', 'date'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'products.*.unit_price' => ['required', 'numeric', 'min:0.01'],
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'Seleecione por lo menos un producto',
        ];
    }
}
