<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property double purchased_units
 * @property double sold_units
 * @property double unit_price
 */
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

    public function getCurrentQuantityAttribute()
    {
        return $this->purchased_units - $this->sold_units;
    }
}
