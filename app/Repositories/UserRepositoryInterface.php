<?php


namespace App\Repositories;


interface UserRepositoryInterface
{
    public function all();
    public function get($id);
    public function find($value);
    public function save(array $values);
    public function update($id, array $data);
}
