<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'origin_code' => ['nullable', 'string'],
            'internal_code' => ['nullable', 'string', 'max:6', 'unique:products'],
            'category' => ['nullable', 'string'],
            'brand' => ['nullable', 'string'],
            'laboratory' => ['nullable', 'string'],
            'measure_unit' => ['nullable', 'string'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'composition' => ['nullable', 'string'],
            'unit_price' => ['required', 'numeric', 'gt:0'],
            'minimun_quantity' => ['required', 'numeric', 'gt:0'],
        ];
    }

    public function messages()
    {
        return [
            'unit_price.numeric' => 'Ingrese un precio unitario válido',
            'unit_price.min' => 'Ingrese un precio unitario válido'
        ];
    }
}
