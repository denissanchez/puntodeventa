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
            'client.identity_document' => ['required', 'numeric'],
            'client.name' => ['required', 'string'],
            'client.address' => ['required', 'string'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'products.*.unit_price_defined' => ['required', 'numeric', 'min:0.01']
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'Debe agregar por lo menos un product'
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
