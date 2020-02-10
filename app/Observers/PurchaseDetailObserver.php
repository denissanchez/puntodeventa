<?php

namespace App\Observers;

use App\Jobs\UpdateStockOnPurchase;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\SaleDetail;

class PurchaseDetailObserver
{
    public function created(PurchaseDetail $purchase_detail)
    {
        $product = Product::find($purchase_detail->product_id);
        $product->purchased_units += $purchase_detail->init_quantity;
        $product->save();
    }

    public function updated(PurchaseDetail $purchase_detail)
    {
        $sold_units = SaleDetail::where('product_id', $sale_detail->product_id)->get()->sum('quantity');
        $product = Product::find($purchase_detail->product_id);
        $product->update([
            'purchased_units' => $product->purchased_units - $purchase_detail->init_quantity,
            'sold_units' => $sold_units,
        ]);
    }

    public function deleted(PurchaseDetail $purchase_detail)
    {
        //
    }

    public function restored(PurchaseDetail $purchase_detail)
    {
        //
    }

    public function forceDeleted(PurchaseDetail $purchase_detail)
    {
        //
    }
}
