<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Admin\Category;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use Auth;
use DB;
use Cart;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        view()->composer('admin.partials._header', function($view){
            $view->with('admin', Admin::all());
        });

        view()->composer('layouts.menubar', function($view){
            $view->with('categories', Category::with('allChildren')->whereNull('parent_id')->orderBy('category_name', 'asc')->get());
        });

        view()->composer('layouts.app', function($view){
            $view->with('parentCategories', Category::whereNull('parent_id')->orderBy('category_name', 'asc')->get());
            $view->with('childrenCategoriesOne', Category::whereNotNull('parent_id')->take(6)->get());
            $view->with('childrenCategoriesTwo', Category::whereNotNull('parent_id')->skip(6)->take(6)->get());
            $view->with('getWishlist', DB::table('wishlists')->where('user_id', Auth::id())->get());
            $view->with('siteInfo', DB::table('site_info')->first());
        });

        view()->composer('pages.contact', function($view){
            $view->with('info', DB::table('site_info')->first());
        });

        view()->composer('user.index', function($view){
            $view->with('getOrders', Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get());
        });

        view()->composer('pages.order_return', function($view){
            $view->with('getOrders', Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get());
        });

        view()->composer('pages.index', function($view){
            $view->with('mainSliderProduct', Product::where('main_slider', '1')->latest()->first());
            $view->with('featuredProducts', Product::where('status', '1')->orderBy('id', 'desc')->limit(8)->get());
            $view->with('trendProducts', Product::where('status', '1')->where('trend', '1')->orderBy('id', 'desc')->limit(8)->get());
            $view->with('bestProducts', Product::where('status', '1')->where('best_rated', '1')->orderBy('id', 'desc')->limit(8)->get());
            $view->with('hotDealProducts', Product::where('status', '1')->where('hot_deal', '1')->orderBy('id', 'desc')->limit(3)->get());
            $view->with('hotNewProducts', Product::where('status', '1')->where('hot_new', '1')->orderBy('id', 'desc')->limit(10)->get());
            $view->with('midSliderProducts', Product::where('status', '1')->where('mid_slider', '1')->orderBy('id', 'desc')->limit(3)->get());
            $view->with('parentCategories', Category::whereNull('parent_id')->orderBy('category_name', 'asc')->get());
        });

        view()->composer('pages.payment.stripe', function($view){
            $view->with('cart', Cart::Content());
            $view->with('settings', DB::table('settings')->first());
        });

        view()->composer('pages.payment.oncash', function($view){
            $view->with('cart', Cart::Content());
            $view->with('settings', DB::table('settings')->first());
        });
    }
}
