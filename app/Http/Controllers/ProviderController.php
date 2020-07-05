<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderStoreRequest;
use App\Http\Requests\ProviderUpdateRequest;
use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $providers = $this->repository->providers()->all();
        return view('provider.index')->with([
            'providers' => $providers
        ]);
    }

    public function create()
    {
        return view('provider.create');
    }

    public function store(ProviderStoreRequest $request)
    {
        $data = $request->validated();
        $this->repository->providers()->create($data);
        return redirect()->route('provider.index');
    }

    public function show($id)
    {
        $provider = $this->getProviderById($id);
        return view('provider.show')->with(['provider' => $provider]);
    }

    public function edit($id)
    {
        $provider = $this->getProviderById($id);
        return view('provider.edit')->with(['provider' => $provider]);
    }

    public function update(ProviderUpdateRequest $request, $id)
    {

    }

    public function destroy($id)
    {
        //
    }

    private function getProviderById($id) {
        return $this->repository->providers()->find($id);
    }
}
