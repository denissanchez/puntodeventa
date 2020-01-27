<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Laboratory;
use App\Models\MeasureUnit;
use App\Models\OwnerDocument;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::orderBy('id', 'desc')->get();
        return view('purchase.index', [
            'purchases' => $purchases
        ]);
    }

    public function create()
    {
        $products = Product::get();
        $categories = Category::all();
        $brands = Brand::all();
        $laboratories = Laboratory::all();
        $measure_units = MeasureUnit::all();
        $providers = OwnerDocument::whereRaw('LENGTH(identity_document) = 11')->get();
        return view('purchase.create', [
            'products' => $products,
            'providers' => $providers,
            'categories' => $categories,
            'brands' => $brands,
            'laboratories' => $laboratories,
            'measure_units' => $measure_units,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $purchase_builder = new PurchaseBuilder();
            $purchase = $purchase_builder
                ->currentBranch()
                ->seller()
                ->provider([
                    'identity_document' => $request->post('provider_identity_document'),
                    'name' => $request->post('provider_name'),
                    'address' => $request->post('provider_address')
                ])
                ->code($request->post('code'))
                ->date($request->post('date'))
                ->defaultType()
                ->defaultCurrency()
                ->completedState()
                ->build();
            $this->setDetailsToPurchase($purchase, $request->post('products'));
            DB::commit();
            return redirect()->route('compras.show', ['compra' => $purchase]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return view('errors.500');
        }
    }

    private function setDetailsToPurchase(Purchase $purchase, $details)
    {
        foreach ($details as $key=>$detail) {
            $purchase_detail = PurchaseDetail::create([
                'purchase_id' => $purchase->id,
                'product_id' => $this->getProduct($detail)->id,
                'item' => $key + 1,
                'init_quantity' => $detail['quantity'],
                'current_quantity' => $detail['quantity'],
                'unit_price' => $detail['unit_price']
            ]);
        }
    }

    public function getProduct($product)
    {
        $product_id = $product['id'];
        if ($product_id) {
            return Product::where('id', $product_id)->first();
        }
        return Product::create([
            'branch_id' => Auth::user()->branch_id,
            'code' => $product['code'],
            'category' => $product['category'],
            'brand' => $product['brand'],
            'name' => $product['name'],
            'laboratory' => $product['laboratory'],
            'measure_unit' => $product['measure_unit'],
            'composition' => $product['composition'],
            'description' => $product['description']
        ]);
    }

    public function show($id)
    {
        try {
            $purchase = Purchase::where('id', '=', $id)->first();
            if (!$purchase) {
                throw new ModelNotFoundException();
            }
            return view('purchase.show', [
                'purchase' => $purchase
            ]);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function edit($id)
    {
        try {
            $purchase = Purchase::currentBranch()->where('id', $id)->first();
            if (!$purchase)
                throw new ModelNotFoundException();
            $products = Product::currentBranch()->get();
            $categories = Category::all();
            $brands = Brand::all();
            $laboratories = Laboratory::all();
            $measure_units = MeasureUnit::all();
            $products = Product::currentBranch()->get();
            $providers = OwnerDocument::whereRaw('LENGTH(identity_document) = 11')->get();
            return view('purchase.edit', [
                'products' => $products,
                'providers' => $providers,
                'categories' => $categories,
                'brands' => $brands,
                'laboratories' => $laboratories,
                'measure_units' => $measure_units,
                'purchase' => $purchase,
            ]);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
