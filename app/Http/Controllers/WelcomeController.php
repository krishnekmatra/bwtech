<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
Use App\Models\User;
Use App\Models\Deal;
Use App\Models\Banner;



class WelcomeController extends Controller
{
	//
	public function index(){
		
		$deal = Deal::with('productDeals.getProduct')
		->get()
		->map(function( $deals ){
				$deals->productDeals = $deals->productDeals->take(10);
				return $deals;
		});

        $banner = Banner::orderBy('sorting','desc')->get();
        $download = Banner::where('type','download')->pluck('image')->first();
        
		$product = Product::getLatestProduct();
		//$vendor = User::getLatestVendor();
		return view('welcome',compact('product','deal','banner','download'));
	}
}
