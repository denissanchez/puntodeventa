<?php

namespace App\Observers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\SaleDetail;
use App\Models\SaleDetailControl;

class SaleDetailObserver
{
    private $sale_detail;

    public function created(SaleDetail $sale_detail)
    {
        $this->sale_detail = $sale_detail;
        $required_quantity = $sale_detail->quantity;
        $purchase_details = PurchaseDetail::ofProduct($sale_detail->product_id)->confirmedState()->withAvailableStock()
                                ->orderBy('id', 'asc')->get();

        foreach($purchase_details as $key=>$purchase_detail) {
            $current_quantity = $purchase_detail->current_quantity;
            if ($current_quantity < $required_quantity) {
                $required_quantity -= $current_quantity;
                $this->createControl($purchase_detail, $current_quantity);
            } else {
                $this->createControl($purchase_detail, $sale_detail->quantity);
                break;
            }
        }
    }

    private function createControl(PurchaseDetail $purchase_detail, $quantity) {
        SaleDetailControl::newRecord([
            'purchase_detail_id' => $purchase_detail->id,
            'sale_detail_id' => $this->sale_detail->id,
            'quantity' => $quantity
        ]);
    }

    public function updated(SaleDetail $sale_detail)
    {
        //
    }

    public function deleted(SaleDetail $sale_detail)
    {
        //
    }

    public function restored(SaleDetail $sale_detail)
    {
        //
    }

    public function forceDeleted(SaleDetail $sale_detail)
    {
        //
    }
}
