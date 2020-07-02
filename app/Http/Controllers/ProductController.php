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
        $laboratories = $this->repository->laboratories()->get();
        $brands = $this->repository->brands()->get();
        $categories = $this->repository->categories()->get();
        $measureUnits = $this->repository->measureUnits()->get();

        return view('product.create')->with([
            'laboratories' => $laboratories,
            'brands' => $brands,
            'categories' => $categories,
            'measureUnits' => $measureUnits
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $this->repository->products()->create($data);
        return redirect()->route('productos.index');
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        if ($product) {
            return view('product.show', ['product' => $product]);
        }
    }

    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        if (product) {
            return view('product.edit', ['product' => $product]);
        }
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
