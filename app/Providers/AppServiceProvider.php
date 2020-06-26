<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $this->translateResourceVerbs();

//        Product::observe(ProductObserver::class);
//        PurchaseDetail::observe(PurchaseDetailObserver::class);
//        Sale::observe(SaleObserver::class);
//        SaleDetail::observe(SaleDetailObserver::class);
//        SaleDetailControl::observe(SaleDetailControlObserver::class);
    }

    public function translateResourceVerbs() {

        Route::resourceVerbs([
            'create' => 'crear',
            'store' => 'guardar',
            'show' => 'detalle',
            'edit' => 'editar',
            'update' => 'actualizar',
            'delete' => 'eliminar',
        ]);

    }
}
