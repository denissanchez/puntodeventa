<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'branch_id', 'seller_id', 'code', 'owner_document',
        'state', 'type', 'currrency', 'commentary'
    ];

    public function setOwnerDocumentAttribute($value: array)
    {
        $this->attributes['owner_document'] = serialize($value);
    }

    public function getOwnerDocumentAttribute()
    {
        return unserialize($this->attributes['owner_document']);
    }
}
