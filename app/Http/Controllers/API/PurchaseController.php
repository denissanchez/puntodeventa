<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseStoreRequest;
use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {

    }

    public function store(PurchaseStoreRequest $request)
    {
        $data = $request->validated();
        $purchase = $this->repository->purchases()->create($data);
        return response()->json($purchase)->setStatusCode(200);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
