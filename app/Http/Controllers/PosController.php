<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class PosController extends Controller
{
    //
    public function index(Request $request, Category $category = null){
        $categories =  Category::all();
       $items = Item::when($category, function ($query) use ($category) {
        return $query->where('item_category', $category->id);
    })->paginate(10);
   
       return view('retailer.pos.index',compact('categories', 'items', 'category'));
    }
    // public function pos(){
    //     return view('retailer.pos.pos');
    // }
    
}
