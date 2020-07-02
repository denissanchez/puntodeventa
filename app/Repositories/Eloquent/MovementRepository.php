<?php


namespace App\Repositories\Eloquent;


use App\Repositories\MovementRepositoryInterface;
use App\Utils\UtilsKey;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MovementRepository extends BaseRepository implements MovementRepositoryInterface
{
    /**
     * OfficeRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        $store_id = session(UtilsKey::CURRENT_STORE_ID);
        return $this->model->where('store_id', $store_id)->get();
    }
}
