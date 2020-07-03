<?php


namespace App\Http\Controllers\API;


use App\Repositories\RepositoryInterface;

class OwnersController
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function search($value, $digits)
    {
        if ($digits === 11) {
            $this->repository->
        } else {

        }
    }
}
