<?php

namespace App\QueryFilters;

use Closure;

class LocationFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('location')) {
            return $next($request);
        }

        $queryBuilder = $next($request);
        return $queryBuilder
            ->where('deadline', '>=', date('Y-m-d'))
            ->where('location', '=',  request()->query('location'));
    }
}
