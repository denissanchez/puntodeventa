<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property string code
 * @property string category
 * @property string brand
 * @property string laboratory
 * @property string measure_unit
 * @property string name
 * @property string composition
 * @property string description
 */
class Product extends Model
{

    protected $fillable = [
        'origin_code',
        'internal_code',
        'category',
        'brand',
        'laboratory',
        'measure_unit',
        'name',
        'composition',
        'description'
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class)
            ->using(ProductStore::class)->withPivot([
                'unit_price',
                'minimun_quantity',
                'purchased_units',
                'sold_units'
            ]);
    }
}
