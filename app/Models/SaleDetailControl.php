<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class SaleDetailControl extends Pivot
{
    public $incrementing = true;

    protected $fillable = ['purchase_detail_id', 'sale_detail_id', 'quantity'];

    public static function newRecord($record)
    {
        DB::table('sale_detail_controls')->insert($record);
    }
}
