<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleStoreRequest;
use App\Repositories\RepositoryInterface;
use App\Repositories\SaleRepositoryInterface;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {

    }

    public function store(SaleStoreRequest $request)
    {
        $products = $request->post('products');

        if ($request->isValidStock($products)) {
            $data = $request->validated();
            $sale = $this->repository->sales()->create($data);
            return response()->json($sale)->setStatusCode(200);
        }

        return response()->json([
            'message' => 'Stock no disponible'
        ])->setStatusCode(422);
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
