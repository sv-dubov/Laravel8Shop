<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;
use App\Models\Admin\Shipping;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function viewOrder($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        $shipping = Shipping::where('order_id', $id)->firstOrFail();
        $details = OrderDetail::where('order_id', $id)->get();
        return view('admin.order.view_order', compact('order', 'shipping', 'details'));
    }

    public function pendingOrders()
    {
        $order = Order::where('status', 0)->get();
        return view('admin.order.orders', compact('order'));
    }

    public function acceptedOrders()
    {
        $order = Order::where('status', 1)->get();
        return view('admin.order.orders', compact('order'));
    }

    public function processOrders()
    {
        $order = Order::where('status', 2)->get();
        return view('admin.order.orders', compact('order'));
    }

    public function deliveredOrders()
    {
        $order = Order::where('status', 3)->get();
        return view('admin.order.orders', compact('order'));
    }

    public function canceledOrders()
    {
        $order = Order::where('status', 4)->get();
        return view('admin.order.orders', compact('order'));
    }

    public function paymentAccept($id)
    {
        Order::where('id', $id)->update(['status' => 1]);
        return redirect()->back()->with('status', 'Payment was accepted');
    }

    public function paymentCancel($id)
    {
        Order::where('id', $id)->update(['status' => 4]);
        return redirect()->back()->with('status', 'Order was canceled');
    }

    public function deliveryProcess($id)
    {
        Order::where('id', $id)->update(['status' => 2]);
        return redirect()->back()->with('status', 'Order was sent to delivery');
    }

    public function deliveryDone($id)
    {
        Order::where('id', $id)->update(['status' => 3]);
        return redirect()->back()->with('status', 'Order was delivered');
    }
}
