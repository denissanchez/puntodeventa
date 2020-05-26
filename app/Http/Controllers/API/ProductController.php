<?php

namespace App\Http\Controllers\API;

use App\Builders\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ProductStoreRequest;
use App\Http\Resources\API\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    private $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $products = $this->repository->all();
        return ProductResource::collection($products);
    }

    public function create()
    {
        $data = new ResponseDataBuilder();
        $data = $data->categories()->brands()->laboratories()->measure_units()->build();
        return view('partials.product.create', $data);
    }

    /**
     * @return ProductResource
     */
    public function store($data)
    {
        $product = $this->repository->save($data);
        return new ProductResource($product);
    }

    public function show($id)
    {
        $product = $this->repository->get($id);
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
