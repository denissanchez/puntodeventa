<?php

namespace App\Http\Controllers\API;

use App\Builders\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ProductStoreRequest;
use App\Http\Resources\API\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function create()
    {
        $data = new ResponseDataBuilder();
        $data = $data->categories()->brands()->laboratories()->measure_units()->build();
        return view('partials.product.create', $data);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = array_merge($request->validated(), ['branch_id' => Auth::user()->branch_id]);
        $product = Product::create($data);
        return new ProductResource($product);
    }

    public function show(Product $product)
    {
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
