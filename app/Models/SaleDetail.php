<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SaleDetail
 * @package App\Models
 * @property int id
 * @property int sale_id
 * @property int product_id
 * @property int item
 * @property double quantity
 * @property double unit_price
 * @property double discount
 */
class SaleDetail extends Model
{
    protected $fillable = [
        'sale_id', 'product_id', 'item', 'quantity', 'unit_price', 'discount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchaseDetails() {
        return $this->belongsToMany(SaleDetail::class)
            ->using(SaleDetailControl::class)
            ->withPivot('quantity')->withTimestamps();
    }
}
