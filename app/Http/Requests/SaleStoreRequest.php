<?php

namespace App\Http\Requests;

use App\Rules\AvailableStock;
use Illuminate\Foundation\Http\FormRequest;

class SaleStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client.identity_document' => ['required', 'numeric'],
            'client.name' => ['required', 'string'],
            'client.address' => ['required', 'string'],
            'products' => ['array', 'min:1'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'numeric', 'min:1'],
            'products.*.discount' => ['required', 'numeric', 'min:0'],
            'products.*.unit_price' => ['required', 'numeric', 'min:0']
        ];
    }
}
