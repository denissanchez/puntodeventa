<?php


namespace App\Repositories\Eloquent;


use App\Repositories\EloquentRepositoryInterface;
use App\Utils\UtilsKey;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements EloquentRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): Model
    {
        $store_id = session(UtilsKey::CURRENT_STORE_ID);
        $attributes = array_merge($attributes,  ['store_id' => $store_id ]);
        return $this->model->create($attributes);
    }

    /**
     * @inheritDoc
     */
    public function find($id): Model
    {
        return $this->model->find($id);
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        ($this->model->find($id))->destroy();
    }
}
