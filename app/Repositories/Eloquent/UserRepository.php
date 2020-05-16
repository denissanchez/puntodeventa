<?php


namespace App\Repositories\Eloquent;


use App\Repositories\UserRepositoryInterface;
use App\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function all()
    {
        return $this->model->all();
    }
}
