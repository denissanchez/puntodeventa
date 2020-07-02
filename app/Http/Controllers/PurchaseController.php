<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseDeleteRequest;
use App\Http\Requests\PurchaseStoreRequest;
use App\Http\Requests\PurchaseUpdateRequest;
use App\Repositories\UnitOfWork;
use App\Utils\MovementType;

class PurchaseController extends Controller
{
    private UnitOfWork $unitOfWork;

    public function __construct() {
        $this->unitOfWork = new UnitOfWork;
    }

    public function index()
    {
        $purchases = $this->unitOfWork->purchaseRepository->all();
        return view('purchase.index', [
            'purchases' => $purchases
        ]);
    }

    public function create()
    {
        $products = $this->unitOfWork->productRepository->all();
        return view('purchase.create', [
            'products' => $products
        ]);
    }

    public function store(PurchaseStoreRequest $request)
    {
        $data = $request->validated();
        $purchase = $this->unitOfWork->purchaseRepository->create();
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
