<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchStoreRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

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
        $branch = Branch::create([
            'ruc' => $request->post('ruc'),
            'name' => $request->post('name'),
            'address' => $request->post('address'),
            'phone' => $request->post('phone'),
            'email' => $request->post('email'),
            'website' => $request->post('website'),
        ]);

        return redirect()->route('sucursales.show', ['id' => $branch->id]);
    }

    public function show($id)
    {
        try {
            $branch = Branch::where('id', $id)->first();
            if (!$branch)
                throw new ModelNotFoundException();
            return view('branch.show')->with(['branch' => $branch]);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function edit($id)
    {
        try {
            $branch = Branch::where('id', $id)->first();
            if (!$branch)
                throw new ModelNotFoundException();
            return view('branch.edit')->with(['branch' => $branch]);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function update(BranchUpdateRequest $request, $id)
    {
        try {
            $branch = Branch::where('id', $id)->first();
            if (!$branch)
                throw new ModelNotFoundException();
            $branch->update([
                'ruc' => $request->post('ruc'),
                'name' => $request->post('name'),
                'address' => $request->post('address'),
                'phone' => $request->post('phone'),
                'email' => $request->post('email'),
                'website' => $request->post('website'),
            ]);
            return redirect()->route('sucursales.show', ['sucursale' => $branch]);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function destroy($id)
    {
        return view('errors.404');
    }
}
