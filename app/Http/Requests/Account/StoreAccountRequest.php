<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
        return [];
        return [
            'name' => ['required', 'string'],
            'ruc' => ['required', 'digits:11'],
            'address' => ['required', 'string'],
            'user_name' => ['required', 'string'],
            'user_email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ];
    }
}
