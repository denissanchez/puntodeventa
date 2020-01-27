<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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

    public function update(Request $request, $id)
    {
        try {
            $product = Product::where('id', '=', $id)->first();
            if (!$product)
                throw new ModelNotFoundException();
            $product->update([
                'code' => $request->post('code'),
                'category' => $request->post('category'),
                'brand' => $request->post('brand'),
                'laboratory' => $request->post('laboratory'),
                'measure_unit' => $request->post('measure_unit'),
                'name' => $request->post('name'),
                'composition' => $request->post('composition'),
                'description' => $request->post('description'),
            ]);
            return redirect()->route('productos.show', ['producto' => $product]);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function destroy($id)
    {
        return view('errors.404');
    }
}
