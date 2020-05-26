<?php

namespace App\Models;

use App\Scopes\CurrentBranchScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property int branch_id
 * @property string code
 * @property string category
 * @property string brand
 * @property string laboratory
 * @property string measure_unit
 * @property string name
 * @property string composition
 * @property string description
 * @property string unit_price
 * @property string purchased_units
 * @property string sold_units
 */
class Product extends Model
{
    protected $fillable = [
        'branch_id',
        'code',
        'origin_code',
        'category',
        'brand',
        'laboratory',
        'measure_unit',
        'name',
        'composition',
        'description',
        'unit_price',
        'purchased_units',
        'sold_units',
    ];

    protected static function boot()
    {
        parent::boot();
        self::addGlobalScope(new CurrentBranchScope());
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
