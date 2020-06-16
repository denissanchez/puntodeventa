<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchStoreRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Models\Branch;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $branches = Branch::orderBy('id', 'DESC')->paginate(20);
        return view('branch.index')->with(['branches' => $branches]);
    }

    public function create()
    {
        return view('branch.create');
    }

    public function store(BranchStoreRequest $request)
    {
        $branch = Branch::create($request->validated());
        return redirect()->route('sucursales.show', ['id' => $branch->id]);
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branch.show')->with(['branch' => $branch]);
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branch.edit')->with(['branch' => $branch]);
    }

    public function update(BranchUpdateRequest $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->update($request->validated());
        return redirect()->route('sucursales.show', ['sucursale' => $branch]);
    }

    public function destroy($id)
    {
        return view('errors.404');
    }
}
