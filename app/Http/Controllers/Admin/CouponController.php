<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $coupon = Coupon::all();
        return view('admin.coupon.index', compact('coupon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon' => 'required',
            'discount' => 'required'
        ]);

        $coupon = Coupon::add($request->all());

        return redirect()->route('coupons.index', $coupon);
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'coupon' => 'required',
            'discount' => 'required'
        ]);

        $coupon = Coupon::find($id);
        $coupon->edit($request->all());
        return redirect()->route('coupons.index');
    }

    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return redirect()->route('coupons.index');
    }
}
