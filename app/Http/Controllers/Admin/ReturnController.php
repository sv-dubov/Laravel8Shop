<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function returnRequest()
    {
        $order = Order::where('return_order', 1)->get();
        return view('admin.return.request', compact('order'));
    }

    public function returnApprove($id)
    {
        Order::where('id', $id)->update(['return_order' => 2]);
        return redirect()->back()->with('status', 'Order\'s return was approved!');
    }

    public function returnSuccess()
    {
        $order = Order::where('return_order', 2)->get();
        return view('admin.return.return_list', compact('order'));
    }
}
