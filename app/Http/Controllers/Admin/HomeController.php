<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $date = date('d-m-y');
        $today = Order::where('date', $date)->sum('total');
        $month = date('F');
        $thisMonth = Order::where('month', $month)->sum('total');
        $year = date('Y');
        $thisYear = Order::where('year', $year)->sum('total');
        $deliveredToday = Order::where('date', $date)->where('status', 3)->sum('total');
        $deliveredMonth = Order::where('month', $month)->where('status', 3)->sum('total');
        $deliveredYear = Order::where('year', $year)->where('status', 3)->sum('total');
        $returnedToday = Order::where('date', $date)->where('return_order', 2)->sum('total');
        $returnedMonth = Order::where('month', $month)->where('return_order', 2)->sum('total');
        $returnedYear = Order::where('year', $year)->where('return_order', 2)->sum('total');
        $products = Product::get()->count();
        $brands = Brand::get()->count();
        $users = User::get()->count();
        return view('admin.index',
            compact('today', 'thisMonth', 'thisYear', 'deliveredToday', 'deliveredMonth', 'deliveredYear',
                'products', 'brands', 'users', 'returnedToday', 'returnedMonth', 'returnedYear'));
    }
}
