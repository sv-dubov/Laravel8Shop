<?php

namespace App\Http\Controllers;

use DB;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddCart($id)
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
            return \Response::json(['success' => 'Product was added on your Cart']);
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
            return \Response::json(['success' => 'Product was added on your Cart']);
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
}
