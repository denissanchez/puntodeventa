<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;

class CheckAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $branch = \Auth::user()->branch;
        $account = Account::find($branch->account_id);

        if ($account->is_active) {
            return $next($request);
        }

        return response('La cuenta está desactivada, comunicate con el administrador', 400);

    }
}
