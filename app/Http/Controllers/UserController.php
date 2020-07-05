<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\RepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index() {
        $users = $this->repository->users()->all();
        return view('user.index')->with([
            'users' => $users
        ]);
    }

    public function show($id) {
        $user = $this->repository->users()->find($id);
        return view('user.show')->with([
            'user' => $user
        ]);
    }

    public function create() {
        return view('user.create');
    }

    public function store(UserStoreRequest $request) {
        $data = $request->validated();
        $this->repository->users()->create($data);
        return redirect()->route('usuarios.index')->with('alert', 'Se registró el usuario correctamente');
    }

    public function update() {

    }

    public function destroy() {

    }
}
