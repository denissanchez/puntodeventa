<?php

namespace App\Http\Controllers;

use App\Builders\ResponseDataBuilder;
use App\Http\Requests\PurchaseDeleteRequest;
use App\Http\Requests\PurchaseStoreRequest;
use App\Http\Requests\PurchaseUpdateRequest;
use App\Models\Purchase;
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
        $data = $data->providers()->products()->build();
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
        if ($purchase->is_editable)
        {
            $data = new ResponseDataBuilder();
            $data = $data->providers()->products()->categories()->brands()->laboratories()->measure_units()->build();
            return view('purchase.edit', array_merge($data, ['purchase' => $purchase]));
        }
        return redirect()->route('compras.show', ['compra' => $purchase]);
    }

    public function update(PurchaseUpdateRequest $request, $id)
    {
        $purchase = Purchase::findOrfail($id);
        if ($purchase->is_editable)
        {
            foreach ($purchase->details as $detail)
            {
                $detail->removeUnits();
                $detail->delete();
            }
            $products = $request->post('products');
            $purchase->addDetails($products);
        }
        return redirect()->route('compras.show', ['compra' => $purchase]);
    }

    public function destroy($id, PurchaseDeleteRequest $request)
    {
        $purchase = Purchase::findOrFail($id);
        if ($purchase->is_deleteable)
        {
            $purchase->cancel($request->post('commentary'));
        }
        return redirect()->route('compras.index');
    }
}
