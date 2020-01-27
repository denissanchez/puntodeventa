<?php

namespace App\Models;

use App\Scopes\CurrentBranchScope;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'branch_id', 'seller_id', 'provider_id', 'seller_name',
        'code', 'type', 'currency', 'commentary', 'state'
    ];

    protected static function boot()
    {
        parent::boot();
        self::addGlobalScope(new CurrentBranchScope());
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    public function setSellerNameAttribute($value)
    {
        $this->attributes['seller_name'] = strtoupper($value);
    }

    public function setCommentaryAttribute($value)
    {
        $this->attributes['commentary'] = strtoupper($value);
    }

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = strtoupper($value);
    }

    public function getDateAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['date']));
    }

    public function scopeCurrentBranch($query)
    {
        return $query->where('branch_id', '=', Auth::user()->branch_id);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(OwnerDocument::class);
    }

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
