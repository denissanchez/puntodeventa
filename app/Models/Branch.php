<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'ruc', 'name', 'address', 'email', 'phone', 'website'
    ];

    public function scopeCurrentBranch($query)
    {
        return $query->where('id', '=', Auth::user()->branch_id);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
