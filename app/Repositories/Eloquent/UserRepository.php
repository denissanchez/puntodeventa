<?php


namespace App\Repositories\Eloquent;


use App\User;

class UserRepository implements \App\Repositories\UserRepositoryInterface
{

    public function all()
    {
        return User::all();
    }

    public function get($id)
    {
        return User::where("id", $id)->first();
    }

    public function find($value)
    {
        return User::find($value)->first();
    }

    public function save(array $values)
    {
        return User::create($values);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }
}
