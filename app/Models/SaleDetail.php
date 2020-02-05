<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
        'sale_id', 'product_id', 'sale_code', 'item',
        'purchase_code', 'quantity', 'unit_price', 'discount'
    ];
}
