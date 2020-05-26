<?php

namespace App\Providers;

use App\Repositories\BranchRepositoryInterface;
use App\Repositories\Eloquent\BranchRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BranchRepositoryInterface::class, BranchRepository::class);
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
