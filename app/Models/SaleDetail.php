<?php

namespace App\Models;

use App\Utils\StateInfo;
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
 * @property double unit_price_defined
 */
class SaleDetail extends Model
{
    protected $fillable = [
        'sale_id', 'product_id', 'item', 'quantity', 'unit_price', 'unit_price_defined'
    ];

    public function getSubtotalAttribute()
    {
        return $this->unit_price_defined * $this->quantity;
    }

    public function scopeConfirmedState($query)
    {
        return $query->where('state', StateInfo::CONFIRMED_STATE);
    }

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
