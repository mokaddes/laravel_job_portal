<?php

namespace App\QueryFilters;

use Closure;

class SearchFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('search')) {
            return $next($request);
        }

        $queryBuilder = $next($request);
        return $queryBuilder
            ->where('status', '=', 1)
            ->where('deadline', '>=', date('Y-m-d'))
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('company', 'like', '%' . request('search') . '%')
            ->orWhere('location', 'like', '%' . request('search') . '%')
            ->orWhere('context', 'like', '%' . request('search') . '%');
    }
}
