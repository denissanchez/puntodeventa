<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\RepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() {
        $users = $this->userRepository->all();
        return view('user.index')->with([
            'users' => $users
        ]);
    }

    public function show($id) {
        $user = $this->userRepository->find($id);
        return view('user.show')->with([
            'user' => $user
        ]);
    }

    public function create() {
        return view('user.create');
    }

    public function store(UserStoreRequest $request) {
        $data = $request->validated();
        $this->userRepository->create($data);
        return redirect()->route('usuarios.index')->with('alert', 'Se registró el usuario correctamente');
    }

    public function update() {

    }

    public function destroy() {

    }
}
