<?php

namespace App\Http\Controllers;

use App\Builders\ResponseDataBuilder;
use App\Builders\SaleBuilder;
use App\Http\Requests\SaleStoreRequest;
use App\Models\OwnerDocument;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    // TODO: Refactorizar metodo
    public function store(SaleStoreRequest $request)
    {
        $data = $request->validated();
        $sale = Sale::addRecord($data);
        $products = $request->post('products');
        $sale->addDetails($products);

        $sale_builder = new SaleBuilder();
        $sale = $sale_builder
            ->currentBranch()
            ->currentUser()
            ->code($request->post('code'))
            ->ownerDocument([
                'identity_document' => $request->post('client_identity_document'),
                'name' => $request->post('client_name'),
                'address' => $request->post('client_address')
            ])
            ->state()
            ->defaultCurrency()
            ->withoutCommentary()
            ->build();
        $this->setDetailsToSale($sale, $request->post('products'));
    }

    private function setDetailsToSale(Sale $sale, $details)
    {
        foreach ($details as $key=>$detail) {
            $product = $this->getProduct($detail);
            $sale_detail = SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'sale_code' => $sale->code,
                'item' => $key + 1,
                'purchase_code' => 1231,
                'quantiity' => $detail['quantity'],
                'unit_price' => $product->unit_price,
                'discount' => $detail['discount']
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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
