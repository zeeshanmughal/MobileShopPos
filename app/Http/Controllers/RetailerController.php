<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetailerController extends Controller
{
    //
    public function dashboard(){
        $total_customers = Customer::where('walk_in_customer',0)->count();
        $total_walkin = Customer::where('walk_in_customer',1)->count();
        $total_items = Item::count();

        return view('retailer.dashboard',compact('total_customers','total_walkin','total_items'));
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
