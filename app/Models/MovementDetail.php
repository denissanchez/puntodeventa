<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class MovementDetail
 * @package App\Models
 * @package int movement_id
 * @package int product_id
 * @package int item
 * @package double quantity
 * @package double price
 * @package double price_defined
 */
class MovementDetail extends Model
{
    protected $fillable = [
        'movement_id',
        'product_id',
        'item',
        'quantity',
        'current_quantity',
        'price',
        'price_defined'
    ];

    public function saleDocuments() {
        return $this
            ->belongsToMany(MovementDetail::class, 'movement_detail_infos', 'origin_movement_detail_id', 'target_movement_detail_id')
            ->using(MovementInfo::class)
            ->withPivot([
                'quantity'
            ]);
    }

    public function purchaseDocuments() {
        return $this
            ->belongsToMany(MovementDetail::class, 'movement_detail_infos', 'target_movement_detail_id', 'origin_movement_detail_id')
            ->using(MovementInfo::class)
            ->withPivot([
                'quantity'
            ]);
    }
}
