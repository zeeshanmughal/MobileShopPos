<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetailerController extends Controller
{
    //
    public function dashboard(){
        return view('retailer.dashboard');
    }


    public function customers(){
        return view('retailer.customer_create');
    }

    public function walkInByRetailer(){
        return view('retailer.walkIn_by_retailer');
    }

    public function items(){
        return view('retailer.items');
    }
}
