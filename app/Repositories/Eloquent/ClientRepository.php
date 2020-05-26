<?php


namespace App\Repositories\Eloquent;


use App\Models\OwnerDocument;

class ClientRepository
{
    public function all($paginate = 10)
    {
        return OwnerDocument::all();
    }

    public function get($id)
    {
        return OwnerDocument::where("id", $id)->first();
    }

    public function find($value)
    {
        return OwnerDocument::find($value)->first();
    }

    public function save(array $values)
    {
        return OwnerDocument::create($values);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }
}
