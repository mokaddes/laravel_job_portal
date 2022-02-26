<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer(['*'],function($view){
            $data = Setting::first();
            $global = new \stdClass;
            $global->lang_id = $data && $data->site_lang_id ? $data->site_lang_id : '';
            $global->zone_id = $data && $data->time_zone_id ? $data->time_zone_id : '';

            $view->with(['global'=>$global]);

       });

       Paginator::useBootstrap();
    }
}
