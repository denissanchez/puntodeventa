<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Branch
 * @package App\Models
 * @property string ruc
 * @property string name
 * @property string address
 * @property string email
 * @property string phone
 * @property string website
 */
class Branch extends Model
{
    protected $fillable = [
        'account_id', 'ruc', 'name', 'address', 'email', 'phone', 'website'
    ];

    public function scopeCurrentAccount($query)
    {
        return $query->where('account_id', \Auth::user()->branch->account_id);
    }

    public function scopeCurrentBranch($query)
    {
        return $query->where('id', '=', \Auth::user()->branch_id);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = strtoupper($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function setWebsiteAttribute($value)
    {
        $this->attributes['website'] = strtolower($value);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
