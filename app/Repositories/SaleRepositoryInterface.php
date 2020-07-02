<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface SaleRepositoryInterface
{
    public function all(): Collection;
}
