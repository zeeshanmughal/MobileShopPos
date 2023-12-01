<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    // app/Http/Controllers/CategoryController.php

    public function index()
    {
        $categories = Category::all();
        return view('retailer.categories', compact('categories'));
    }

    public function create()
    {
        return view('retailer.categories');
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('retailer.categories', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index');
    }
    

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
