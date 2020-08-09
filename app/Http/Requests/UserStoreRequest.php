<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
            'branch_id' => ['required', 'exists:branches,id'],
            'email' => ['required', 'email', 'unique:users,email'],
            'name' => ['required'],
            'role' => ['required', Rule::in(['ADMIN', 'SELLER'])]
        ];
    }

    public function messages()
    {
        return [
            'branch_id.required' => 'Seleccione una sucursal',
            'branch_id.exists' => 'Seleccione una sucursal válida',
        ];
    }
}
