<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ruc' => ['required', 'digits:11', 'unique:branches,ruc'],
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['nullable'],
            'email' => ['email', 'nullable'],
            'website' => ['url', 'nullable'],
        ];
    }
}
