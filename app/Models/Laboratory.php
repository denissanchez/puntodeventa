<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Laboratory
 * @package App\Models
 * @property string name
 */
class Laboratory extends Model
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
