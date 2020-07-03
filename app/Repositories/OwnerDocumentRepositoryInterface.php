<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface OwnerDocumentRepositoryInterface extends EloquentRepositoryInterface
{
    public function search($value): Collection;
}
