<?php


namespace App\Repositories\Eloquent;

use App\Repositories\StoreRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
{
    /**
     * OfficeRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}
