<?php

namespace App;

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

    public function scopeCurrentBranch($query)
    {
        return $query->where('branch_id', \Auth::user()->branch_id);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
