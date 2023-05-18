<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class VendorController extends Controller
{
    //
    public function dashboard(){
        $client_id = \Auth::guard(getAuthGaurd())->user()->id;

        $product_active = Product::where('status',1)->where('created_by',$client_id)->count();
        $product_deactive = Product::where('status',0)->where('created_by',$client_id)->count();
        return view('vendor.dashboard',compact('product_active','product_deactive'));
    }
}
