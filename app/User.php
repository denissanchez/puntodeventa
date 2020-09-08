<?php

namespace App;

use App\Models\Account;
use App\Models\Branch;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    protected $fillable = [
        'branch_id', 'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtoupper($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function scopeCurrentAccount($query)
    {
        return $query->join('branches', 'users.branch_id', '=', 'branches.id')->join('accounts', 'branches.account_id', 'accounts.id')->where('branches.account_id', 'accounts.id');
    }

    public function scopeCurrentBranch($query)
    {
        return $query->where('branch_id', \Auth::user()->branch_id);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function account() {
        return $this->hasOneThrough(Account::class, Branch::class);
    }
}
