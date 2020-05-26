<?php


namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::all()->toArray();
    }

    public function get($id)
    {
        return Product::where("id", $id)->first();
    }

    public function find($value)
    {
        return Product::find($value);
    }

    public function save($values)
    {
        return Product::create($values);
    }

    public function update($id, array $data)
    {

    }
}
