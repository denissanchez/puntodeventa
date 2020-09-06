<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Models\Account;
use App\Models\Branch;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('admin.account.index')->with([
            'accounts' => $accounts
        ]);
    }

    public function create()
    {
        return view('admin.account.create');
    }

    public function store(StoreAccountRequest $request)
    {
        $account = Account::create([
            'name' => $request->post('name'),
            'ruc' => $request->post('ruc'),
            'address' => $request->post('address'),
            'is_active' => true
        ]);

        $branch = Branch::create([
            'account_id' => $account->id,
            'name' => $request->post('name'),
            'ruc' => $request->post('ruc'),
            'address' => $request->post('address'),
        ]);

        $user = User::create([
            'branch_id' => $branch->id,
            'name' => $request->post('user_name'),
            'email' => $request->post('user_email'),
            'password' => \Hash::make($request->post('user_password')),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
