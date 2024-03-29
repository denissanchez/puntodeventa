<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $service;

    public function __construct(ProductRepositoryInterface $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function index()
    {
        $products = $this->service->all();
        return view('product.index', ['products' => $products]);
    }

    public function create()
    {
        return view('errors.404');
    }

    public function store(Request $request)
    {
        return redirect()->route('productos.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', ['product' => $product]);
    }

    public function update(ProductStoreRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        $product->update($data);
        return redirect()->route('productos.show', $product);
    }

    public function destroy($id)
    {
        return view('errors.404');
    }
}
