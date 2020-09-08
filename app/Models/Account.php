<?php

namespace App\Models;

use App\Scopes\CurrentAccountScope;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name', 'ruc', 'address', 'is_active'
    ];

    protected static function booted()
    {
        parent::booted();
    }

    public function scopeCurrentAccount($query) {
        return $query->where('id', \Auth::user()->branch->account_id)->first();
    }

    public function branches() {
        return $this->hasMany(Branch::class);
    }

    public function users() {
        return $this->hasManyThrough(User::class, Branch::class);
    }

    public function products() {
        return $this->hasManyThrough(Product::class, Branch::class);
    }
}
