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
    protected $fillable = ['name'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}
