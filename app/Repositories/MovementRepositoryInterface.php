<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface MovementRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;
}
