<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Price;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('retailer.items', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('retailer.create_item',compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'item_category' => 'required',
            'sku' => 'required',
            'quantity'=>'required|min:0',
            'price'=>'required||min:1'
            // Add validation rules for other fields here
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->image){
            $image_path = saveImage($request->image, 'items');

        }
        Item::create([
            'item_name' => $request->item_name,
            'item_category' => $request->item_category,
            'sku' => $request->sku,
            'manufacturer' => $request->manufacturer,
            'sub_category' => $request->sub_category,
            'short_description' => $request->short_description,
            'quantity'=>$request->quanity,
            'price'=>$request->price,
            'image' => $image_path
        ]);

        if ($request->save_and_add_new == 1) {
            return redirect()->route('item.create')
                ->with('success', 'Item has been added successfully.');
        }

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully');
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        
        return response()->json($item);
    }

    public function edit(Item $item)
    {
        $categories = Category::all();

        return view('retailer.create_item', compact('item','categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'item_category' => 'required',
            'sku' => 'required',
            'quantity'=>'required|min:0',
            'price'=>'required|min:1'
            // Add validation rules for other fields here
        ]);

        // Find the item by ID
        $item = Item::findOrFail($id);

        if($request->hasFile('image')){
            $image_path = saveImage($request->image, 'items');
        }else{

            $image_path = $item->image;
        }

        $itemArray = [
            'item_name' => $request->item_name,
            'item_category' => $request->item_category,
            'sku' => $request->sku,
            'manufacturer' => $request->manufacturer,
            'sub_category' => $request->sub_category,
            'short_description' => $request->short_description,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'image' => $image_path
        ];

        $item->update($itemArray);

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }
}
