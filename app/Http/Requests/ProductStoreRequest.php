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
            'code' => ['required', 'unique:products,code'],
            'category' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'laboratory' => ['required', 'string'],
            'name' => ['required', 'string'],
            'measure_unit' => ['required', 'string'],
            'description' => ['required', 'string'],
            'composition' => ['nullable', 'string'],
        ];
    }
}
