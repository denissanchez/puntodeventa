<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

interface EloquentRepositoryInterface
{
    /**
     * @return Model
     */
    public function all() : Collection;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes) : Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id) : Model;

    /**
     * @param $id
     */
    public function delete($id);
}
