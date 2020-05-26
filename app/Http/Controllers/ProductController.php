<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $repository;

    public function __construct(ProductRepositoryInterface $service)
    {
        $this->repository = $service;
    }

    public function index()
    {
        $products = $this->repository->all();
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
