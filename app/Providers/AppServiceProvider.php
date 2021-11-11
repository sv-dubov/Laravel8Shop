<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
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

        view()->composer('layouts.menubar', function($view){
            $view->with('categories', Category::with('allChildren')->whereNull('parent_id')->orderBy('category_name', 'asc')->get());
            $view->with('mainSliderProduct', Product::where('main_slider', '1')->latest()->first());
        });

        view()->composer('layouts.app', function($view){
            $view->with('parentCategories', Category::whereNull('parent_id')->orderBy('category_name', 'asc')->get());
        });
    }
}
