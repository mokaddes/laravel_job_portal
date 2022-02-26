<?php

namespace App\QueryFilters;

use Closure;

class CategoryFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('category')) {
            return $next($request);
        }

        $queryBuilder = $next($request);
        return $queryBuilder
            ->leftJoin('job_category', 'job_category.pk_no', '=', 'job_post.job_category_id')
            ->where('job_post.deadline', '>=', date('y-m-d'))
            ->where('job_category.url_slug', '=', request()->get('category'));
    }
}
