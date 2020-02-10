<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\SaleDetail;
use App\Models\SaleDetailControl;

class SaleDetailControlObserver
{
    /**
     * Handle the sale detail control "created" event.
     *
     * @param SaleDetailControl $sale_detail_control
     * @return void
     */
    public function created(SaleDetailControl $sale_detail_control)
    {
        $purchase_detail = PurchaseDetail::find($sale_detail_control->purchase_detail_id);
        $purchase_detail->current_quantity -= $sale_detail_control->quantity;
        $purchase_detail->save();

        $product = Product::find($purchase_detail->product_id);
        $product->sold_units += $sale_detail_control->quantity;
        $product->save();
    }

    /**
     * Handle the sale detail control "updated" event.
     *
     * @param SaleDetailControl $sale_detail_control
     * @return void
     */
    public function updated(SaleDetailControl $sale_detail_control)
    {
        //
    }

    /**
     * Handle the sale detail control "deleted" event.
     *
     * @param SaleDetailControl $sale_detail_control
     * @return void
     */
    public function deleted(SaleDetailControl $sale_detail_control)
    {
        //
    }

    /**
     * Handle the sale detail control "restored" event.
     *
     * @param SaleDetailControl $sale_detail_control
     * @return void
     */
    public function restored(SaleDetailControl $sale_detail_control)
    {
        //
    }

    /**
     * Handle the sale detail control "force deleted" event.
     *
     * @param SaleDetailControl $sale_detail_control
     * @return void
     */
    public function forceDeleted(SaleDetailControl $sale_detail_control)
    {
        //
    }
}
