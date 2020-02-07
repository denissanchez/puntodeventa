<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'item',
        'purchase_code',
        'init_quantity',
        'current_quantity',
        'unit_price'
    ];

    public function document()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeOfProduct($query, $product_id) {
        return $query->where('product_id', $product_id);
    }

    public function scopeWithAvailableStock($query)
    {
        return $query->where('current_quantity', '>', 0);
    }

    public function saleDetails()
    {
        return $this->belongsToMany(SaleDetail::class)
            ->using(SaleDetailControl::class)
            ->withPivot('quantity')->withTimestamps();
    }
}
