<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductStore extends Pivot
{
    public $incrementing = true;

    protected $fillable = [
        'product_id',
        'store_id',
        'unit_price',
        'minimun_quantity',
        'purchased_units',
        'sold_units'
    ];
}
