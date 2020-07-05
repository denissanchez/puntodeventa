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
        $products = $this->repository->products()->search($search);
        return response()->json($products)->setStatusCode(200);
    }
}
