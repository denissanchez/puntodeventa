<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OwnerDocument
 * @package App\Models
 * @property string identity_document
 * @property string name
 * @property string phone
 */
class OwnerDocument extends Model
{
    protected $fillable = [
        'identity_document', 'name', 'address', 'phone'
    ];
}
