<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Cart;
use Illuminate\Http\Request;
use Response;
use Session;

class CartController extends Controller
{
    public function addCart($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $data = array();
        if ($product->discount_price == null) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return response::json(['success' => 'Product was added to your Cart']);
        } else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return response::json(['success' => 'Product was added to your Cart']);
        }
    }

    public function check()
    {
        $content = Cart::content();
        return response()->json($content);
    }

    public function showCart()
    {
        $cart = Cart::content();
        return view('pages.cart', compact('cart'));
    }

    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with('status', 'Product was removed from your Cart!');
    }

    public function updateCartItem(Request $request)
    {
        $rowId = $request->productid;
        $qty = $request->qty;
        Cart::update($rowId, $qty);
        return redirect()->back()->with('status', 'Product\'s quantity was updated!');
    }

    public function viewProduct($id)
    {
        $product = DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->join('brands','products.brand_id','brands.id')
            ->select('products.*','categories.category_name','brands.brand_name')
            ->where('products.id',$id)
            ->first();
        $color = $product->product_color;
        $product_color = explode(',', $color);
        $size = $product->product_size;
        $product_size = explode(',', $size);
        return response::json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }

    public function insertCart(Request $request)
    {
        $id = $request->product_id;
        $product = DB::table('products')->where('id', $id)->first();
        $color = $request->color;
        $size = $request->size;
        $qty = $request->qty;
        $data = array();
        if ($product->discount_price == null) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            return redirect()->back()->with('status', 'Product was added to your Cart');
        } else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            return redirect()->back()->with('status', 'Product was added to your Cart');
        }
    }

    public function checkout()
    {
        if (Auth::check()) {
            $cart = Cart::content();
            $settings = DB::table('settings')->first();
            return view('pages.checkout', compact('cart', 'settings'));
        } else {
            return redirect()->route('login')->with('status', 'At first sign in your account');
        }
    }

    public function wishlist()
    {
        $user_id = Auth::id();
        $product = DB::table('wishlists')
            ->join('products', 'wishlists.product_id', 'products.id')
            ->select('products.*', 'wishlists.user_id')
            ->where('wishlists.user_id', $user_id)
            ->get();
        return view('pages.wishlist', compact('product'));
    }

    public function coupon(Request $request)
    {
        $coupon = $request->coupon;
        $check = DB::table('coupons')->where('coupon', $coupon)->first();
        if ($check) {
            Session::put('coupon', [
                'name' => $check->coupon,
                'discount' => $check->discount,
                'balance' => Cart::Subtotal() - $check->discount
            ]);
            return redirect()->back()->with('status', 'Coupon was applied successfully');
        } else {
            return redirect()->back()->with('status', 'Invalid coupon');
        }
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        return redirect()->back()->with('status', 'Coupon was removed');
    }

    public function paymentIndex()
    {
        $cart = Cart::Content();
        $settings = DB::table('settings')->first();
        return view('pages.payment', compact('cart', 'settings'));
    }
}
