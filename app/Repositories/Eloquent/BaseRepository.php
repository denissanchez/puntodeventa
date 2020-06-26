<?php


namespace App\Repositories\Eloquent;


use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements EloquentRepositoryInterface
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
    public function all(): Collection
    {
        $this->model->all();
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): Model
    {
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
