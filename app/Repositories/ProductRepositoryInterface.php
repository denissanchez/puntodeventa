<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface extends EloquentRepositoryInterface
{
    public function search($value): Collection;
}
