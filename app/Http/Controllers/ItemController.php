<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('retailer.items', compact('items'));
    }

    public function create()
    {
        return view('retailer.create_item');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'item_category' => 'required',
            'sku' => 'required',
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
            'device_model' => $request->device_model,
            'warranty' => $request->warranty,
            'imei' => $request->imei,
            'condition' => $request->condition,
            'physical_location' => $request->physical_location,
            'sub_category' => $request->sub_category,
            'upc_code' => $request->upc_code,
            'short_description' => $request->short_description,
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
        return view('retailer.create_item', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
         'sku'=>'required',
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
            'device_model' => $request->device_model,
            'warranty' => $request->warranty,
            'imei' => $request->imei,
            'condition' => $request->condition,
            'physical_location' => $request->physical_location,
            'sub_category' => $request->sub_category,
            'upc_code' => $request->upc_code,
            'short_description' => $request->short_description,
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
