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

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = strtoupper($value);
    }

    public function setBrandAttribute($value)
    {
        $this->attributes['brand'] = strtoupper($value);
    }

    public function setLaboratoryAttribute($value)
    {
        $this->attributes['laboratory'] = strtoupper($value);
    }

    public function setMeasureUnitAttribute($value)
    {
        $this->attributes['measure_unit'] = strtoupper($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function setCompositionAttribute($value)
    {
        $this->attributes['composition'] = strtoupper($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtoupper($value);
    }

    public function getCurrentQuantityAttribute()
    {
        return $this->attributes['purchased_units'] - $this->attributes['sold_units'];
    }

    public function getDisplayNameAttribute()
    {
        return $this->code;
        // return $this->attributes['code'].' | '.$this->attributes['name'].' - '.$this->attributes['brand'];
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
