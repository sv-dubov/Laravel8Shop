<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $brand = Brand::all();
        return view('admin.brand.index', compact('brand'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

        $brand = Brand::add($request->all());
        $brand->uploadLogo($request->file('brand_logo'));

        return redirect()->route('brands.index');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|max:255',
            'brand_logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

        $brand = Brand::find($id);
        $brand->edit($request->all());
        $brand->uploadLogo($request->file('brand_logo'));
        return redirect()->route('brands.index');
    }

    public function destroy($id)
    {
        Brand::find($id)->remove();
        return redirect()->route('brands.index');
    }
}
