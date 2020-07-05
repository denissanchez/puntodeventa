<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Repositories\RepositoryInterface;

class ProductController extends Controller
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $products = $this->repository->products()->all();
        return view('product.index', ['products' => $products]);
    }

    public function create()
    {
        $utils = $this->repository->utils();
        return view('product.create')->with($utils);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $this->repository->products()->create($data);
        return redirect()->route('productos.index');
    }

    public function show($id)
    {
        $product = $this->repository->products()->find($id);
        return view('product.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = $this->repository->products()->find($id);
        $utils = $this->repository->utils();
        return view('product.edit', [...$utils, 'product' => $product]);
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
