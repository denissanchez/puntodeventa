<?php


namespace App\Http\Controllers\API;


use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

class OwnersController
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function search(Request $request)
    {
        $digits = $request->get('digits');
        $search = $request->get('search');

        if ($digits === 11) {
            $owners = $this->repository->providers()->search($search);
        } else {
            $owners = $this->repository->clients()->search($search);
        }

        return response()->json($owners)->setStatusCode(200);
    }
}
