<?php


namespace App\Pipelines\Filters;


use Closure;
use App\Pipelines\Pipeline;

class SearchFilter implements Pipeline
{
    public function handle($content, Closure $next)
    {
        if (request()->has('search')) {
            $builder->where('name', request()->search);
        }
        return $next($builder);
    }
}
