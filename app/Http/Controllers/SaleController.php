<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleDeleteRequest;
use App\Http\Requests\SaleStoreRequest;
use App\Repositories\RepositoryInterface;
use App\Repositories\SaleRepositoryInterface;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private SaleRepositoryInterface $saleRepository;

    public function __construct(SaleRepositoryInterface $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function index()
    {
        $sales = $this->saleRepository->all();
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

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id, SaleDeleteRequest $request)
    {

    }
}
