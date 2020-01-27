<?php

namespace App\Providers;

use App\Models\ControlStock;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Observers\ControlStockObserver;
use App\Observers\ProductObserver;
use App\Observers\PurchaseDetailObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Product::observe(ProductObserver::class);
        PurchaseDetail::observe(PurchaseDetailObserver::class);
        ControlStock::observe(ControlStockObserver::class);
    }
}
