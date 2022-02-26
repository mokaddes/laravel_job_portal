<?php

namespace App\QueryFilters;

use Closure;

class IndustryFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('industry')) {
            return $next($request);
        }

        $queryBuilder = $next($request);
        return $queryBuilder
            ->where('job_post.deadline', '>=', date('Y-m-d'))
            ->where('industries', '=', request()->query('industry'));
    }
}
