<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('admin.partials._header', function($view){
            $view->with('admin', Admin::all());
        });
    }
}
