<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MeasureUnit
 * @package App\Models
 * @property string name
 */
class MeasureUnit extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}
