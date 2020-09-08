<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
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

        $user->assignRole('account-administrator');

        return redirect()->route('admin.accounts.index');
    }

    public function show(Account $account)
    {
        return view('admin.account.show')->with([ 'account' => $account ]);
    }

    public function edit(Account $account)
    {
        return view('admin.account.edit')->with([ 'account' => $account ]);
    }

    public function update(UpdateAccountRequest $request, $id)
    {

    }

    public function destroy(Account $account)
    {
        $account->is_active = false;
        $account->save();
        return redirect()->route('admin.accounts.index');
    }

    public function enable(Account $account)
    {
        $account->is_active = true;
        $account->save();
        return redirect()->route('admin.accounts.index');
    }
}
