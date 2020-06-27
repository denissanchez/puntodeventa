<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface OfficeRepositoryInterface
{
    public function all(): Collection;
}
