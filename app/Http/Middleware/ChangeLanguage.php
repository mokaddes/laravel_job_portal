<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class ChangeLanguage
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

        $lang = Session::get('lang') ?? 'de';
        app()->setLocale(session('lang', $lang));
        return $next($request);
    }
}
