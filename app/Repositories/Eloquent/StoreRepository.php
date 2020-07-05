<?php


namespace App\Repositories\Eloquent;

use App\Repositories\StoreRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
{
    public function products(): Collection
    {
        return $this->model->products;
    }
}
