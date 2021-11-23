<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function info()
    {
        $info = DB::table('site_info')->first();
        return view('admin.site_info.index', compact('info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = array();
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['email'] = $request->email;
        $data['company_name'] = $request->company_name;
        $data['company_address'] = $request->company_address;
        $data['facebook'] = $request->facebook;
        $data['youtube'] = $request->youtube;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        DB::table('site_info')->where('id', $id)->update($data);
        return redirect()->back()->with('status', 'Site info was updated successfully!');
    }
}
