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
        $this->updateUnitPrice($purchase_detail);
    }

    public function updated(PurchaseDetail $purchase_detail)
    {
        $sold_units = SaleDetail::where('product_id', $purchase_detail->product_id)->get()->sum('quantity');
        $product = Product::find($purchase_detail->product_id);
        $product->update([
            'purchased_units' => $product->purchased_units - $purchase_detail->init_quantity,
            'sold_units' => $sold_units,
        ]);
        $this->updateUnitPrice($purchase_detail);
    }

    public function updateUnitPrice(PurchaseDetail $purchase_detail) {
        $product = Product::find($purchase_detail->product_id);
        $new_unit_price = $purchase_detail->unit_price + ($purchase_detail->unit_price * 0.2);
        if ($product->unit_price < $new_unit_price) {
            $product->update([
                'unit_price' => $new_unit_price
            ]);
        }
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
