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
            'category' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'laboratory' => ['required', 'string'],
            'name' => ['required', 'string'],
            'measure_unit' => ['required', 'string'],
            'description' => ['required', 'string'],
            'composition' => ['nullable', 'string'],
            'unit_price' => ['required', 'numeric', 'min:0.01'],
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
