<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleStoreRequest;
use App\Repositories\SaleRepositoryInterface;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private SaleRepositoryInterface $repository;

    public function __construct(SaleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {

    }

    public function store(SaleStoreRequest $request)
    {

    }

    public function show($id)
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
