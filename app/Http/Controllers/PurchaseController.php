<?php

namespace App\Http\Controllers;

use App\Builders\ResponseDataBuilder;
use App\Http\Requests\PurchaseStoreRequest;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Utils\StateInfo;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
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
        $purchase = Purchase::addRecord($data);
        $products = $request->post('products');
        $purchase->addDetails($products);
        return redirect()->route('compras.show', ['compra' => $purchase]);
    }

    public function show($id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('purchase.show', [
            'purchase' => $purchase
        ]);
    }

    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        $data = new ResponseDataBuilder();
        $data = $data->providers()->products()->categories()->brands()->laboratories()->measure_units()->build();
        return view('purchase.edit', array_merge($data, ['purchase' => $purchase]));
    }

    public function update(Request $request, $id)
    {
        PurchaseDetail::where('purchase_id', $id)->delete();
        $purchase = Purchase::findOrfail($id);
        $products = $request->post('products');
        $purchase->addDetails($products);
        return redirect()->route('compras.show', ['compra' => $purchase]);
    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->update(['state' => StateInfo::CANCELED_STATE]);
    }
}
