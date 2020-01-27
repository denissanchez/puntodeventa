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

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductNameAttribute()
    {
        $product = Product::where('id', $this->product->id)->first();
        return $product->code.' | '.$product->name.' - '.$product->brand;
    }
}
