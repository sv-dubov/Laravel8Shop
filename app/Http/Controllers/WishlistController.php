<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function addWishlist($id)
    {
        $userid = Auth::id();
        $check = DB::table('wishlists')->where('user_id', $userid)->where('product_id', $id)->first();
        $data = array(
            'user_id' => $userid,
            'product_id' => $id,
        );

        if (Auth::Check()) {
            if ($check) {
                return \Response::json(['error' => 'This product is already on your wishlist']);
            } else {
                DB::table('wishlists')->insert($data);
                return \Response::json(['success' => 'Product was added on wishlist']);
            }
        } else {
            return \Response::json(['error' => 'At first sign in your account']);
        }
    }
}
