<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

/**
 * Class SaleDetailControl
 * @package App\Models
 * @property int purchase_detail_id
 * @property int sale_detail_id
 * @property double quantity
 */

class SaleDetailControl extends Model
{
    public $incrementing = true;

    protected $fillable = ['purchase_detail_id', 'sale_detail_id', 'quantity'];

    public static function newRecord($record)
    {
        self::create($record);
    }
}
