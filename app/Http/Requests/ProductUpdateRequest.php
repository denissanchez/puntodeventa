<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'origin_code' => ['nullable', 'string'],
            'internal_code' => ['nullable', 'string', 'max:6',
                Rule::unique('products', 'internal_code')->ignore($this->internal_code)],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'composition' => ['nullable', 'string'],
            'unit_price' => ['required', 'numeric', 'gt:0'],
            'minimun_quantity' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
