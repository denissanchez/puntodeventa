<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseDeleteRequest;
use App\Http\Requests\PurchaseStoreRequest;
use App\Http\Requests\PurchaseUpdateRequest;
use App\Repositories\RepositoryInterface;

class PurchaseController extends Controller
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $purchases = $this->repository->purchases()->all();
        return view('purchase.index', [
            'purchases' => $purchases
        ]);
    }

    public function create()
    {
        return view('purchase.create');
    }

    public function store(PurchaseStoreRequest $request)
    {
        $data = $request->validated();
//        $purchase = $this->purchaseRepository->create();
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
