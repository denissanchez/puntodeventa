<?php


namespace App\Repositories\Eloquent;


use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function create(array $attributes): Model
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return parent::create($attributes);
    }
}
