<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Account;
use App\Models\Branch;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = Account::currentAccount()->users;
        return view('user.index', [ 'users' => $users ]);
    }

    public function create()
    {
        $branches = Branch::currentAccount()->get();
        return view('user.create', ['branches' => $branches]);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $data = array_merge($data, ['password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        $user = User::create($data);

        $user->assignRole($request->post('role'));

        return redirect()->route('usuarios.index');
    }

    public function show($id)
    {
        $user = User::currentBranch()->where('id', $id)->first();
        if (!$user) {
            return view('errors.404');
        }
        return view('user.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::currentBranch()->where('id', $id)->first();
        $branches = Branch::currentAccount()->get();
        if (!$user) {
            return view('errors.404');
        }
        return view('user.edit', ['user' => $user, 'branches' => $branches]);
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
