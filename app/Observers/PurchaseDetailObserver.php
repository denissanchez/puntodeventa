<?php

namespace App\Observers;

use App\Jobs\UpdateStockOnPurchase;
use App\Models\Product;
use App\Models\PurchaseDetail;
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
