<?php


namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements EloquentRepositoryInterface
{
    protected Model $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
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
        return $this->model->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        ($this->model->findOrFail($id))->destroy();
    }

    /**
     * @inheritDoc
     */
    public function update(array $attributes, $id)
    {
        $this->find($id)->update($attributes);
    }
}
