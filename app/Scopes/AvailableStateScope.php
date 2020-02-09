<?php


namespace App\Scopes;


use App\Utils\StateInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AvailableStateScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('state', StateInfo::CONFIRMED_STATE);
    }
}
