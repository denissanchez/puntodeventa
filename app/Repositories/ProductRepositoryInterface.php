<?php


namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all();
    public function get($id);
    public function find($value);
    public function save($values);
    public function update($id, array $data);
}
