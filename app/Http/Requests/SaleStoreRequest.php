<?php

namespace App\Http\Requests;

use App\Models\Product;
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
            'client.document' => ['required', 'numeric'],
            'client.name' => ['required', 'string'],
            'client.address' => ['required', 'string'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.product_id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'numeric', 'gt:0'],
            'products.*.price_defined' => ['required', 'numeric', 'gt:0']
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'Debe agregar por lo menos un producto',
            'products.*.quantity.gt' => 'Las cantidades ingresadas no son válidas',
            'products.*.price_defined.gt' => 'Las cantidades ingresadas no son válidas',
        ];
    }

    public function isValidStock($details)
    {
        $is_valid = true;
        foreach($details as $detail) {
            $product = Product::find($detail['id']);
            if($product->current_quantity < $detail['quantity'])
            {
                $is_valid = false;
                break;
            }
        }
        return $is_valid;
    }
}
