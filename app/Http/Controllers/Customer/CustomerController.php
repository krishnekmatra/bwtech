<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class CustomerController extends Controller
{
    //
    public function dashboard(){
        $client_id = \Auth::user()->id;
        $inquiry = Inquiry::with('product.createdBy')->where('client_id',$client_id)->where('type','enquiry')->orderBy('created_at','DESC')->get();

        $rfq = Inquiry::with('product.createdBy')->where('client_id',$client_id)->where('type','rfq')->orderBy('created_at','DESC')->get();
         return view('customer.dashboard',compact('inquiry','rfq'));
    }
    public function shop()
    {
        return view ('shop');
    }
    public function product()
    {
        return view ('product');
    }
}
