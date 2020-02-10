<?php

namespace App\Observers;

use App\Jobs\UpdateStockOnPurchase;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\SaleDetail;
use App\Services\StockProduct;

class PurchaseDetailObserver
{
    public function created(PurchaseDetail $purchase_detail)
    {
        $product = Product::find($purchase_detail->product_id);
        StockProduct::updatePurchasedUnits($product->id, $purchase_detail->init_quantity);
    }

    public function updated(PurchaseDetail $purchase_detail)
    {
        $sold_units = SaleDetail::where('product_id', $sale_detail->product_id)
            ->confirmedState()->get()->sum('quantity');

        $product = Product::find($purchase_detail->product_id);
        $product->update([
            'purchased_units' => $product->purchased_units - $purchase_detail->init_quantity,
            'sold_units' => $sold_units,
        ]);
    }

    public function deleted(PurchaseDetail $purchase_detail)
    {

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
