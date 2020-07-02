<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface StoreRepositoryInterface
{
    public function all(): Collection;
}
