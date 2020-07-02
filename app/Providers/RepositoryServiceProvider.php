<?php

namespace App\Providers;

use App\Models\Movement;
use App\Models\Store;
use App\Models\Product;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\MovementRepository;
use App\Repositories\Eloquent\PurchaseRepository;
use App\Repositories\Eloquent\SaleRepository;
use App\Repositories\Eloquent\StoreRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\UtilsRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\MovementRepositoryInterface;
use App\Repositories\PurchaseRepositoryInterface;
use App\Repositories\SaleRepositoryInterface;
use App\Repositories\StoreRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UtilsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

use App\User;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);

        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserRepository(new User);
        });

        $this->app->bind(ProductRepositoryInterface::class, function () {
            return new ProductRepository(new Product);
        });

        $this->app->bind(StoreRepositoryInterface::class, function () {
            return new StoreRepository(new Store);
        });

        $this->app->bind(PurchaseRepositoryInterface::class, function () {
            return new PurchaseRepository(new Movement);
        });

        $this->app->bind(SaleRepositoryInterface::class, function () {
            return new SaleRepository(new Movement);
        });

        $this->app->bind(UtilsRepositoryInterface::class, UtilsRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
