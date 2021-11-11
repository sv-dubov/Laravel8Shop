<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //$category = Category::where('parent_id', null)->get();
        $category = Category::whereNull('parent_id')->get();
        return view('admin.category.index', compact('category'));
    }

    public function show(Category $category)
    {
        $categories = Category::where('parent_id', $category->id)->get();
        return view('admin.category.show', compact('category', 'categories'));
    }

    public function create(Request $request)
    {
        $parent = null;
        if ($request->get('parent')) {
            $parent = Category::findOrFail($request->get('parent'));
        }
        return view('admin.category.create', compact('parent'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|max:255',
            'parent' => 'nullable|exists:categories,id'
        ]);

        $category = Category::create([
            'category_name' => $request['category_name'],
            'parent_id' => $request['parent'],
        ]);
        return redirect()->back()->with('status', 'Category was added successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|max:255'
        ]);
        $category->edit($request->all());
        return redirect()->back()->with('status', 'Category was updated successfully!');
    }

    public function destroy(Category $category)
    {
        if ($category->children->count()) {
            return back()->withErrors('Page contains subcategory(-ies). Please, remove subcategory(-ies) at first');
        }
        $category->remove();
        return redirect()->route('categories.index');
    }
}
