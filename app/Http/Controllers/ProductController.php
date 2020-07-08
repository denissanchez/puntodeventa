<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        return view('product.index', ['products' => $products]);
    }

    public function create()
    {
        $utils = $this->productRepository->utils();
        return view('product.create')->with($utils);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $this->productRepository->create($data);
        return redirect()->route('productos.index');
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        return view('product.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        return view('product.edit', ['product' => $product]);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->productRepository->update($data, $id);
        return redirect()->route('productos.show', $id );
    }

    public function destroy($id)
    {
        return view('errors.404');
    }
}
