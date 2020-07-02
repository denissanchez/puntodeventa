<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

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

    }

    public function store() {

    }

    public function update() {

    }

    public function destroy() {

    }
}
