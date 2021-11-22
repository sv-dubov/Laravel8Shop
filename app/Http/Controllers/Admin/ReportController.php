<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function todayOrders()
    {
        $today = date('d-m-y');
        $order = Order::where('status', 0)->where('date', $today)->get();
        return view('admin.report.today_order', compact('order'));
    }

    public function todayDelivery()
    {
        $today = date('d-m-y');
        $order = Order::where('status', 3)->where('date', $today)->get();
        return view('admin.report.today_delivery', compact('order'));
    }

    public function thisMonth()
    {
        $month = date('F');
        $order = Order::where('status', 3)->where('month', $month)->get();
        return view('admin.report.this_month', compact('order'));
    }

    public function search()
    {
        return view('admin.report.search');
    }


    public function searchByYear(Request $request)
    {
        $year = $request->year;
        $total = Order::where('status', 3)->where('year', $year)->sum('total');
        $order = Order::where('status', 3)->where('year', $year)->get();
        return view('admin.report.search_by_year', compact('order', 'total'));
    }

    public function searchByMonth(Request $request)
    {
        $month = $request->month;
        $total = Order::where('status', 3)->where('month', $month)->sum('total');
        $order = Order::where('status', 3)->where('month', $month)->get();
        return view('admin.report.search_by_month', compact('order', 'total'));
    }

    public function SearchByDate(Request $request)
    {
        $date = $request->date;
        $new_date = date('d-m-y', strtotime($date));
        $total = Order::where('status', 3)->where('date', $new_date)->sum('total');
        $order = Order::where('status', 3)->where('date', $new_date)->get();
        return view('admin.report.search_by_date', compact('order', 'total'));
    }
}
