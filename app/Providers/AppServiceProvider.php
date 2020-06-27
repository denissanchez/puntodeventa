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
    }

    public function translateResourceVerbs() {

        Route::resourceVerbs([
            'create' => 'registrar',
            'store' => 'guardar',
            'show' => 'detalle',
            'edit' => 'editar',
            'update' => 'actualizar',
            'delete' => 'eliminar',
        ]);

    }
}
