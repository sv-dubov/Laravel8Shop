<?php

namespace App\Http\Controllers;

use App\Models\Admin\Product;
use DB;
use Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function details($id, $product_name)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $color = $product->product_color;
        $product_color = explode(',', $color);
        $size = $product->product_size;
        $product_size = explode(',', $size);
        return view('pages.product_details', compact('product', 'product_color', 'product_size'));
    }

    public function addCart(Request $request, $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $data = array();
        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            //return \Response::json(['success' => 'Product was added on your Cart']);
            return redirect()->back()->with('status', 'Product was added successfully!');
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
            //return \Response::json(['success' => 'Product was added on your Cart']);
            return redirect()->back()->with('status', 'Product was added successfully!');
        }
    }
}
