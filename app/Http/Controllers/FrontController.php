<?php

namespace App\Http\Controllers;

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
}
