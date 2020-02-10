<?php

namespace App\Models;

use App\Scopes\CurrentBranchScope;
use Illuminate\Database\Eloquent\Model;

class BillingCode extends Model
{
    protected $fillable = [
        'branch_id', 'type', 'prefix', 'incrementable'
    ];

    protected static function boot()
    {
        parent::boot();
        self::addGlobalScope(new CurrentBranchScope());
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = strtoupper($value);
    }

    public function setPrefixAttribute($value)
    {
        $this->attributes['prefix'] = strtoupper($value);
    }

    public function getCodeAttribute($value)
    {
        return $this->attributes['prefix'].'-'.str_pad($this->attributes['incrementable'], 8, STR_PAD_LEFT);
    }
}
