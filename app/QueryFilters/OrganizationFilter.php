<?php

namespace App\QueryFilters;

use Closure;

class OrganizationFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('organization')) {
            return $next($request);
        }

        $queryBuilder = $next($request);
        return $queryBuilder
            ->where('deadline', '>=', date('Y-m-d'))
            ->where('company', '=',  request()->query('organization'));
    }
}
