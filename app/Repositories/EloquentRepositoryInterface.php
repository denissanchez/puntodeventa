<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all() : Collection;

    /**
     * @param array $attributes
     * @return Model
     */
    public function pcreate(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id) : Model;

    /**
     * @param $id
     */
    public function delete($id);

    /**
     * @param array $attributes
     * @param $id
     */
    public function update(array $attributes, $id);
}
