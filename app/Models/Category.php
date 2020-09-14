<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 * @property string name
 */
class Category extends Model
{
    protected $fillable = ['account_id', 'name'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function scopeCurrentAccount($query)
    {
        return $query->where('account_id', \Auth::user()->branch->account_id);
    }
}
