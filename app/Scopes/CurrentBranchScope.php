<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class CurrentBranchScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('branch_id', Auth::user()->id);
    }
}
