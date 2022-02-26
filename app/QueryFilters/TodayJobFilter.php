<?php

namespace App\QueryFilters;

use Closure;

class TodayJobFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('today_job')) {
            return $next($request);
        }

        $queryBuilder = $next($request);
        return $queryBuilder
            ->where('publish_date', '=', date('Y-m-d'))
            ->where('deadline', '>=', date('Y-m-d'));
    }
}
