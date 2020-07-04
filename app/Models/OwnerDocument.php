<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OwnerDocument
 * @package App\Models
 * @property string document
 * @property string name
 * @property string phone
 * @property string type
 */
class OwnerDocument extends Model
{
    protected $fillable = [
        'document', 'name', 'address', 'phone', 'type'
    ];
}
