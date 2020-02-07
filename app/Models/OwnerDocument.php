<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerDocument extends Model
{
    protected $fillable = [
        'identity_document', 'name', 'address', 'phone'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = strtoupper($value);
    }

    public function scopeOnlyCompanies($query) {
        return $query->whereRaw('LENGTH(identity_document) = 11');
    }
}
