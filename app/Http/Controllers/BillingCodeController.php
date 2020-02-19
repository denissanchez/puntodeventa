<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingCodeController extends Controller
{
    public function index()
    {
        return view('billing_code.index');
    }

    public function create()
    {
        return view('billing_code.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('facturacion.index');
    }

    public function edit($id)
    {
        return redirect()->route('facturacion.index');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('facturacion.index');
    }

    public function destroy()
    {
        return redirect()->route('facturacion.index');
    }
}
