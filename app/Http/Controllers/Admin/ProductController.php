<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $product = Product::all();
        return view('admin.product.index', compact('product'));
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return view('admin.product.show', compact('product'));
    }

    public function create()
    {
        $category = Category::with('allChildren')->whereNull('parent_id')->orderBy('category_name', 'asc')->get();
        $brand = Brand::all();
        return view('admin.product.create', compact('category', 'brand'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'product_quantity' => 'required|numeric',
            'product_details' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'selling_price' => 'required'
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['product_details'] = $request->product_details;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['discount_price'] = $request->discount_price;
        $data['selling_price'] = $request->selling_price;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['status'] = 1;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if ($image_one && $image_two && $image_three) {
            $image_one_name = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            $path_one = public_path('upload/products_images/' . $image_one_name);
            Image::make($image_one->getRealPath())->resize(300, 300)->save($path_one);
            $data['image_one'] = 'upload/products_images/' . $image_one_name;

            $image_two_name = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            $path_two = public_path('upload/products_images/' . $image_two_name);
            Image::make($image_two->getRealPath())->resize(300, 300)->save($path_two);
            $data['image_two'] = 'upload/products_images/' . $image_two_name;

            $image_three_name = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            $path_three = public_path('upload/products_images/' . $image_three_name);
            Image::make($image_three->getRealPath())->resize(300, 300)->save($path_three);
            $data['image_three'] = 'upload/products_images/' . $image_three_name;

            $product = DB::table('products')->insert($data);
            return redirect()->back()->with('status', 'Product was added successfully!');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::with('allChildren')->whereNull('parent_id')->orderBy('category_name', 'asc')->get();
        $brand = Brand::all();
        return view('admin.product.edit', compact(
            'category',
            'brand',
            'product'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255',
            'product_quantity' => 'required|numeric',
            'product_details' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'selling_price' => 'required'
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['product_details'] = $request->product_details;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['discount_price'] = $request->discount_price;
        $data['selling_price'] = $request->selling_price;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = Carbon::now();

        $update = DB::table('products')->where('id', $id)->update($data);
        if ($update) {
            return redirect()->back()->with('status', 'Product was updated successfully!');
        } else {
            return redirect()->back()->with('status', 'Nothing to update!');
        }
    }

    public function updateImages(Request $request, $id)
    {
        $old_one = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;
        $data = array();
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if ($image_one) {
            unlink($old_one);
            $image_name = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            $path_one = public_path('upload/products_images/' . $image_name);
            Image::make($image_one->getRealPath())->resize(300, 300)->save($path_one);
            $data['image_one'] = 'upload/products_images/' . $image_name;
            DB::table('products')->where('id', $id)->update($data);
            return redirect()->back()->with('status', 'Image One was updated successfully!');
        }

        if ($image_two) {
            unlink($old_two);
            $image_name = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            $path_two = public_path('upload/products_images/' . $image_name);
            Image::make($image_two->getRealPath())->resize(300, 300)->save($path_two);
            $data['image_two'] = 'upload/products_images/' . $image_name;
            DB::table('products')->where('id', $id)->update($data);
            return redirect()->back()->with('status', 'Image Two was updated successfully!');
        }

        if ($image_three) {
            unlink($old_three);
            $image_name = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            $path_three = public_path('upload/products_images/' . $image_name);
            Image::make($image_three->getRealPath())->resize(300, 300)->save($path_three);
            $data['image_three'] = 'upload/products_images/' . $image_name;
            DB::table('products')->where('id', $id)->update($data);
            return redirect()->back()->with('status', 'Image Three was updated successfully!');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $image1 = $product->image_one;
        $image2 = $product->image_two;
        $image3 = $product->image_three;
        unlink($image1);
        unlink($image2);
        unlink($image3);
        $product->remove();
        return redirect()->route('products.index')->with('status', 'Product was deleted!');
    }

    public function status($id)
    {
        $product = Product::find($id);
        $product->toggleStatus();
        return redirect()->back()->with('status', 'Product status was updated!');
    }
}
