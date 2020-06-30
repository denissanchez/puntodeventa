<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UtilsRepositoryInterface;
use App\Utils\UtilsKey;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;
    private $utilsRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        UtilsRepositoryInterface $utilsRepository
    ) {
        $this->productRepository = $productRepository;
        $this->utilsRepository = $utilsRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        return view('product.index', ['products' => $products]);
    }

    public function create()
    {
        $laboratories = $this->utilsRepository->get(UtilsKey::LABORATORY);
        $brands = $this->utilsRepository->get(UtilsKey::BRAND);
        $categories = $this->utilsRepository->get(UtilsKey::CATEGORY);
        $measureUnits = $this->utilsRepository->get(UtilsKey::MEASURE_UNIT);

        ddd($laboratories);

        return view('product.create')->with([
            'laboratories' => $laboratories,
            'brands' => $brands,
            'categories' => $categories,
            'measureUnits' => $measureUnits
        ]);
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
