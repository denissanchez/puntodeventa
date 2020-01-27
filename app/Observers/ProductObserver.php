<?php

namespace App\Observers;

use App\Jobs\VerifyProductData;
use App\Models\Product;

class ProductObserver
{
    public function created(Product $product)
    {
        VerifyProductData::dispatch($product);
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
