<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    //

    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('retailer.manufacturers', compact('manufacturers'));
    }

    public function create()
    {
        return view('retailer.manufacturers');
    }

    public function store(Request $request)
    {
        Manufacturer::create($request->all());
        return redirect()->route('manufacturers.index');
    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('retailer.manufacturers', compact('manufacturer'));
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        $manufacturer->update($request->all());
        return redirect()->route('manufacturers.index');
    }
    

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return redirect()->route('manufacturers.index');
    }
}
