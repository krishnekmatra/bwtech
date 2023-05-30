<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inquiry;
use App\Models\User;


class AdminController extends Controller
{
    //
    public function dashboard(){

        $product_active = Product::where('status',1)->count();
        $product_deactive = Product::where('status',0)->count();

        $inquiry_rfq = Inquiry::where('type','rfq')->count();
        $inquiry = Inquiry::where('type','enquiry')->count();

        $vendor = getRole('Sales Team');
        $customer = getRole('Management');

        $total_vendor = User::where('role_id',$vendor)->count();
        $total_customer = User::where('role_id',$customer)->count();

        return view('admin.dashboard',compact('product_active','product_deactive','inquiry_rfq','inquiry','total_vendor','total_customer'));
    }
}
