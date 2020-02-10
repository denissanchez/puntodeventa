<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::paginate();
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
        try {
            $product = Product::where('id', '=', $id)->first();
            if (!$product)
                throw new ModelNotFoundException();
            return view('product.show', ['product' => $product]);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::where('id', '=', $id)->first();
            if (!$product)
                throw new ModelNotFoundException();
            return view('product.edit', ['product' => $product]);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function update(ProductStoreRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        $product->update($data);
        return redirect()->route('productos.show', ['producto' => $product]);
    }

    public function destroy($id)
    {
        return view('errors.404');
    }
}
