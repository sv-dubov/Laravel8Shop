<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function storeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:newsletters|max:55',
        ]);
        $data = array();
        $data['email'] = $request->email;
        DB::table('newsletters')->insert($data);
        return redirect()->back()->with('status', 'Thank you for the subscription!');
    }

    public function orderTracking(Request $request)
    {
        $user_id = Auth::id();
        $code = $request->code;
        $track = DB::table('orders')->where('status_code', $code)->where('user_id', $user_id)->first();
        if ($track) {
            return view('pages.tracking', compact('track'));
        } else {
            return redirect()->back()->with('status', 'Status code is invalid!');
        }
    }
}
