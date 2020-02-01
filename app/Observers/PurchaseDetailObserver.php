<?php

namespace App\Observers;

use App\Jobs\UpdateStockOnPurchase;
use App\Models\PurchaseDetail;

class PurchaseDetailObserver
{
    public function created(PurchaseDetail $purchaseDetail)
    {
        UpdateStockOnPurchase::dispatchNow($purchaseDetail);
    }

    public function updated(PurchaseDetail $purchaseDetail)
    {
        UpdateStockOnPurchase::dispatchNow($purchaseDetail);
    }

    public function deleted(PurchaseDetail $purchaseDetail)
    {
        //
    }

    public function restored(PurchaseDetail $purchaseDetail)
    {
        //
    }

    public function forceDeleted(PurchaseDetail $purchaseDetail)
    {
        //
    }
}