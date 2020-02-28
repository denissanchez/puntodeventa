<?php

namespace App\Providers;

use App\Models\ControlStock;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleDetailControl;
use App\Observers\ControlStockObserver;
use App\Observers\ProductObserver;
use App\Observers\PurchaseDetailObserver;
use App\Observers\PurchaseObserver;
use App\Observers\SaleDetailControlObserver;
use App\Observers\SaleDetailObserver;
use App\Observers\SaleObserver;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    public function boot()
    {
        Passport::routes();
        Product::observe(ProductObserver::class);
        Purchase::observe(PurchaseObserver::class);
        PurchaseDetail::observe(PurchaseDetailObserver::class);
        Sale::observe(SaleObserver::class);
        SaleDetail::observe(SaleDetailObserver::class);
        SaleDetailControl::observe(SaleDetailControlObserver::class);
    }
}
