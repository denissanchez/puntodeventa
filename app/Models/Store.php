<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Office
 * @package App\Models
 * @property string ruc
 * @property string name
 * @property string address
 * @property string phone
 */
class Store extends Model
{
    protected $fillable = [
        'ruc', 'name', 'address', 'phone'
    ];
}
