<?php

namespace App\Observers;

use App\Models\ControlStock;
use App\Models\Product;
use App\Utils\MovementInfo;

class ControlStockObserver
{
    public function created(ControlStock $controlStock)
    {
        $product = $controlStock->product;
        if ($controlStock->type === MovementInfo::PURCHASE_MOVEMENT){
            $this->updateQuantityOnPurchase($product, $controlStock->quantity);
        } else if ($controlStock->type === MovementInfo::SALE_MOVEMENT) {
            $this->updateQuantityOnSale($product, $controlStock->quantity);
        }
    }

    private function updateQuantityOnPurchase(Product $product, $quantity)
    {
        $current_quantity = $product->purchased_units;
        $product->update([
            'purchased_units' => $current_quantity + $quantity
        ]);
    }

    private function updateQuantityOnSale(Product $product, $quantity)
    {
        $current_quantity = $product->sold_units;
        $product->update([
            'sold_units' => $current_quantity + $quantity
        ]);
    }
}
