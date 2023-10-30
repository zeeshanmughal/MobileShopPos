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
        return view('retailer.customers');
    }

    public function walk_in(){
        return view('retailer.walk_in');
    }

    public function items(){
        return view('retailer.items');
    }
}
