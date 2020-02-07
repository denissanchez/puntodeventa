<?php


namespace App\Services;

use App\Models\Product;

class StockProduct
{
    public static function updatePurchasedUnits($product_id, $purchased_units)
    {
        $product = Product::find($product_id);
        $product->purchased_units += $purchased_units;
        $product->save();
    }

    public static function updateSoldUnits($product_id, $sold_units)
    {
        $product = Product::find($product_id);
        $product->sold_units += $sold_units;
        $product->save();
    }
}
