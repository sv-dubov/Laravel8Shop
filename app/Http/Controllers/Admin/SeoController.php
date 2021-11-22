<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $seo = Seo::firstOrFail();
        return view('admin.seo.index', compact('seo'));
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'meta_title' => 'nullable',
            'meta_author' => 'nullable',
            'meta_tag' => 'nullable',
            'meta_description' => 'nullable',
            'google_analytics' => 'nullable'
        ]);
        $seo = Seo::find($id);
        $seo->update($request->all());
        return redirect()->back()->with('status', 'SEO settings was updated successfully!');
    }
}
