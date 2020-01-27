<?php

namespace App\Models;

use App\Scopes\CurrentBranchScope;
use Illuminate\Database\Eloquent\Model;

class ControlStock extends Model
{
    protected $fillable = [
        'branch_id',
        'product_id',
        'user_name',
        'product_code',
        'product_name',
        'document_code',
        'type',
        'quantity'
    ];

    protected static function boot()
    {
        parent::boot();
        self::addGlobalScope(new CurrentBranchScope());
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
