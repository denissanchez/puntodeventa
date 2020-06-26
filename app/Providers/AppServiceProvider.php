<?php

namespace App\Providers;

use App\Models\ControlStock;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleDetailControl;
use App\Observers\ControlStockObserver;
use App\Observers\ProductObserver;
use App\Observers\PurchaseDetailObserver;
use App\Observers\SaleDetailControlObserver;
use App\Observers\SaleDetailObserver;
use App\Observers\SaleObserver;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Product::observe(ProductObserver::class);
        PurchaseDetail::observe(PurchaseDetailObserver::class);
        Sale::observe(SaleObserver::class);
        SaleDetail::observe(SaleDetailObserver::class);
        SaleDetailControl::observe(SaleDetailControlObserver::class);
    }
}
