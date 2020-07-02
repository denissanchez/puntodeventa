<?php

namespace App\Models;

use App\Utils\StateInfo;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseDetail
 * @package App\Models
 * @property int purchase_id
 * @property int product_id
 * @property int item
 * @property string purchase_code
 * @property double init_quantity
 * @property double current_quantity
 * @property double unit_price
 */
class PurchaseDetail extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'item',
        'purchase_code',
        'init_quantity',
        'current_quantity',
        'unit_price',
        'state'
    ];

    public function saleDetails()
    {
        return $this->belongsToMany(SaleDetail::class)
            ->using(SaleDetailControl::class)
            ->withPivot('quantity')->withTimestamps();
    }
}
