<?php


namespace App\Repositories;

interface StoreRepositoryInterface extends EloquentRepositoryInterface
{
    public function products();
}
