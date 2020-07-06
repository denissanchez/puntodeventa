<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $validStock = $request->get('validStock');
        if (!$validStock) {
            $products = $this->repository->products()->search($search);
        } else {
            $products = $this->repository->stores()->productsWithStock($search);
        }

        return response()->json($products)->setStatusCode(200);
    }
}
