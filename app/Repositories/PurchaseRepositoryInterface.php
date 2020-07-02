<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface PurchaseRepositoryInterface
{
    public function all(): Collection;
}
