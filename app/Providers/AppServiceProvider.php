<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Auth;
use DB;
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
            $view->with('getWishlist', DB::table('wishlists')->where('user_id', Auth::id())->get());
        });

        view()->composer('pages.index', function($view){
            $view->with('featuredProducts', Product::where('status', '1')->orderBy('id', 'desc')->limit(8)->get());
            $view->with('trendProducts', Product::where('status', '1')->where('trend', '1')->orderBy('id', 'desc')->limit(8)->get());
            $view->with('bestProducts', Product::where('status', '1')->where('best_rated', '1')->orderBy('id', 'desc')->limit(8)->get());
            $view->with('hotDealProducts', Product::where('status', '1')->where('hot_deal', '1')->orderBy('id', 'desc')->limit(3)->get());
            $view->with('hotNewProducts', Product::where('status', '1')->where('hot_new', '1')->orderBy('id', 'desc')->limit(10)->get());
            $view->with('midSliderProducts', Product::where('status', '1')->where('mid_slider', '1')->orderBy('id', 'desc')->limit(3)->get());
            $view->with('parentCategories', Category::whereNull('parent_id')->orderBy('category_name', 'asc')->get());
        });
    }
}
