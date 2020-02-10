<?php

namespace App\Http\Requests;

use App\Models\Purchase;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseDeleteRequest extends FormRequest
{

    public function authorize()
    {
        $purchase = Purchase::find('id', $this->id);
        return $purchase->init_quantity === $purchase->current_quantity;
    }

    public function rules()
    {
        return [
            'commentary' => ['required', 'string']
        ];
    }
}
