<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movement
 * @package App\Models
 * @property int store_id
 * @property string seller_id
 * @property string owner
 * @property string type
 * @property string document
 * @property string document_type
 * @property string commentary
 * @property string state
 */
class Movement extends Model
{
    protected $fillable = [
        'store_id',
        'seller_id',
        'owner_id',
        'type',
        'document',
        'document_type',
        'commentary',
        'state'
    ];
}
