<?php

namespace App\Http\Controllers;

use App\Builders\PurchaseBuilder;
use App\Builders\ResponseDataBuilder;
use App\Http\Requests\PurchaseStoreRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Laboratory;
use App\Models\MeasureUnit;
use App\Models\OwnerDocument;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
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
        $data = new ResponseDataBuilder();
        $data = $data->providers()->products()->categories()->brands()->laboratories()->measure_units()->build();
        return view('purchase.create', $data);
    }

    public function store(PurchaseStoreRequest $request)
    {
        $data = $request->validated();
        $purchase = Purchase::create(
            array_merge($data,
                [
                    'branch_id' => Auth::user()->branch_id,
                    'seller_id' => Auth::user()->id
                ]
            ));
        $products = $request->post('products');
        foreach ($products as $key=>$product) {
            $purchase_detail = new PurchaseDetail([
                'product_id' => $product['product_id'],
                'item' => $key + 1,
                'purchase_code' => $purchase->code,
                'init_quantity' => $product['quantity'],
                'current_quantity' => $product['quantity'],
                'unit_price' => $product['unit_price']
            ]);
            $purchase->details()->create($purchase_detail);
        }
        return redirect()->route('purchase.show', ['purchase' => $purchase]);
    }

    public function show(Purchase $purchase)
    {
        return view('purchase.show', [
            'purchase' => $purchase
        ]);
    }

    public function edit(Purchase $purchase)
    {
        $data = new ResponseDataBuilder();
        $data = $data->providers()->products()->categories()->brands()->laboratories()->measure_units()->build();
        return view('purchase.edit', array_merge($data, ['purchase' => $purchase]));
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
