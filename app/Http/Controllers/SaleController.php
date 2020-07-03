<?php

namespace App\Http\Controllers;

use App\Builders\ResponseDataBuilder;
use App\Builders\SaleBuilder;
use App\Http\Requests\SaleDeleteRequest;
use App\Http\Requests\SaleStoreRequest;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $sales = Sale::all();
        return view('sale.index', [
            'sales' => $sales
        ]);
    }

    public function create()
    {
        $data = new ResponseDataBuilder();
        $data = $data->onlyProductWithStock()->clients()->build();
        return view('sale.create', $data);
    }

    public function store(SaleStoreRequest $request)
    {
        if ($request->isValidStock($request->post('products')))
        {
            $data = $request->validated();
            $sale = Sale::addRecord($data);
            $products = $request->post('products');
            $sale->addDetails($products);
            return redirect()->route('ventas.show', ['venta' => $sale]);
        }
        return redirect(route('ventas.create'))->withInput()->withErrors([
            'products' => 'Ingrese una cantidad válida.'
        ]);
    }

    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return view('sale.show', [
            'sale' => $sale
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('ventas.show', [ 'venta' => $sale]);
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('ventas.show', [ 'venta' => $sale]);
    }

    public function destroy($id, SaleDeleteRequest $request)
    {
        $sale = Sale::findOrFail($id);
        if ($sale->is_deleteable) {
            $sale->cancel($request->post('commentary'));
        }
        return redirect()->route('ventas.show', [ 'venta' => $sale]);
    }
}
