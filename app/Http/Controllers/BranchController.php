<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchStoreRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Models\Branch;
use App\Repositories\BranchRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private $repository;

    public function __construct(BranchRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $branches = $this->repository->all();
        return view('branch.index')->with(['branches' => $branches]);
    }

    public function create()
    {
        return view('branch.create');
    }

    public function store($data)
    {
        $branch = $this->repository->save($data);
        return redirect()->route('sucursales.show', ['sucursale' => $branch]);
    }

    public function show($id)
    {
        $branch = $this->repository->get($id);
        return view('branch.show')->with(['branch' => $branch]);
    }

    public function edit($id)
    {
        $branch = $this->repository->get($id);
        return view('branch.edit')->with(['branch' => $branch]);
    }

    public function update(BranchUpdateRequest $request, $id)
    {
        $branch = $this->repository->get($id);
        $branch->update($request->validated());
        return redirect()->route('sucursales.show', ['sucursale' => $branch]);
    }

    public function destroy($id)
    {
        return view('errors.404');
    }
}
