<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        return view('user.index')->with([
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('usuarios.create');
    }

    public function show($id)
    {
        $user = User::currentBranch()->where('id', $id)->get();
        if (!$user) {
            return view('errors.404');
        }
        return view('user.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::currentBranch()->where('id', $id)->get();
        if (!$user) {
            return view('errors.404');
        }
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('usuario.index');
    }

    public function destroy($id)
    {
        return redirect()->route('usuario.index');
    }
}
