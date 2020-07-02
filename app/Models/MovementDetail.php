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
        'price',
        'price_defined'
    ];
}
