<?php


namespace App\Repositories;

use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;
}
