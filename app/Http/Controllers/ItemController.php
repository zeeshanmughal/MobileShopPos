<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_name' => 'required',
            'item_category' => 'required',
            // Add validation rules for other fields here
        ]);

        Item::create($validatedData);

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'item_name' => 'required',
            'item_category' => 'required',
            // Add validation rules for other fields here
        ]);

        $item->update($validatedData);

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
