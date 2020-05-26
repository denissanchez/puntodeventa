<?php


namespace App\Repositories\Eloquent;


use App\Models\Branch;
use App\Repositories\BranchRepositoryInterface;

class BranchRepository implements BranchRepositoryInterface
{

    public function all($paginate = 10)
    {
        return Branch::all();
    }

    public function get($id)
    {
        return Branch::where("id", $id)->first();
    }

    public function find($value)
    {
        return Branch::find($value)->first();
    }

    public function save(array $values)
    {
        return Branch::create($values);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }
}
