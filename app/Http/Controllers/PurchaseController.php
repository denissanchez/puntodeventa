<?php

namespace App\Http\Controllers;

use App\Builders\PurchaseBuilder;
use App\Builders\ResponseDataBuilder;
use App\Http\Requests\PurchaseStoreRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $purchase->addDetails($products);
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
