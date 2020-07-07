<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleDeleteRequest;
use App\Http\Requests\SaleStoreRequest;
use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $sales = $this->repository->sales();
        return view('sale.index', [
            'sales' => $sales
        ]);
    }

    public function create()
    {
        return view('sale.create');
    }

    public function store(SaleStoreRequest $request)
    {
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
//        return redirect()->route('ventas.show', [ 'venta' => $sale]);
    }

    public function update(Request $request, $id)
    {
//        return redirect()->route('ventas.show', [ 'venta' => $sale]);
    }

    public function destroy($id, SaleDeleteRequest $request)
    {
//        $sale = Sale::findOrFail($id);
//        if ($sale->is_deleteable) {
//            $sale->cancel($request->post('commentary'));
//        }
//        return redirect()->route('ventas.show', [ 'venta' => $sale]);
    }
}
