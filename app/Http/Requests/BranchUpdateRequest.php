<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ruc' => ['required', 'digits:11'],
            'name' => ['required', 'string'],
            'address' => ['required', ''],
            'phone' => [''],
            'email' => ['email', 'nullable'],
            'website' => ['url', 'nullable'],
        ];
    }
}
