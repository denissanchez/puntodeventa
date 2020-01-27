<?php

namespace App\Observers;

use App\Jobs\VerifyProductData;
use App\Models\Product;

class ProductObserver
{
    public function created(Product $product)
    {
        VerifyProductData::dispatch($product);
        $product->update([
            'code' => substr($product->measure_unit, 0, 1).substr($product->name, 0, 4).$product->id
        ]);
    }

    public function updated(Product $product)
    {
        VerifyProductData::dispatch($product);
    }

    public function deleted(Product $product)
    {
        //
    }

    public function restored(Product $product)
    {
        //
    }

    public function forceDeleted(Product $product)
    {
        //
    }
}
