<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MovementInfo extends Pivot
{
    protected $fillable = [
        'origin_movement_detail_id',
        'target_movement_detail_id',
        'quantity',
    ];
}
