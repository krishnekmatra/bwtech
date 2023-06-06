<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Occasions;
use App\Models\ProductOccasion;
use App\Models\FeatureAttribute;
use App\Models\Product;

class GiftController extends Controller
{
	//
	public function index(Request $request,$type,$value){

		if($type == 'occasions'){
			
			$occasion = Occasions::where('slug',$value)->first();
			$occasion_id =$occasion['id'];
			$main_name = $occasion['name'];
			$feature_attribute_id = '';
			$filter = false;
			$product = ProductOccasion::join('products','products.id','=','product_occasions.product_id')
			->where('occasion_id',$occasion_id)
			->where('products.status',1);
			

 		}
		else if($type == 'brand'){
			$occasion_id = '';
			$feature_attribute_id = FeatureAttribute::where('name',$value)->pluck('id')->first();
			$main_name = $value;
			$product = Product::where('feature_attribute_id',$feature_attribute_id)->where('status',1);
		}else{
			$occasion_id = '';
			$feature_attribute_id = '';
			$explode_value = explode('-',$value);
			$main_name = $value;
			$product = Product::where('status',1);
			if($explode_value[1] == 5000){
        	$product->where('price','>=',$explode_value[1]);
       }else{
       	$product ->whereBetween('price', [$explode_value[0] , $explode_value[1] ]);
       }
			 
				
		}
		 $product->orderBy('products.created_at','desc');
		$product = $product->paginate(12);
					$filter = false;

		return view('gift', compact('product','occasion_id','feature_attribute_id','type','value','main_name','filter'));
	}

	public function shopByFilter(Request $request){

		if($request['type'] == 'occasions'){
				$product = ProductOccasion::join('products','products.id','=','product_occasions.product_id')
			->where('occasion_id',$request['occasion_id'])
			->where('products.status',1);

		}else if($request['type'] == 'price'){
			$explode_value = explode('-',$request['range']);
			$product = Product::where('status',1);
			if($explode_value[1] == 5000){
        	$product->where('price','>=',$explode_value[1]);
       }else{
       	$product ->whereBetween('price', [$explode_value[0] , $explode_value[1] ]);
       }
		}
		else{
				$product = Product::where('feature_attribute_id',$request['feature_attribute_id'])->where('status',1);

	  }
	 	 if($request['warranty']){
	 	 	  if($request['type'] == 'occasions'){
    			$product->where('products.warrenty',$request['warranty']);
    		}else{
    			$product->where('warrenty',$request['warranty']);
    		}
    	}

    	if($request['min_price'] > 0 && $request['max_price']  > 0)
        {
        	  if($request['type'] == 'occasions'){
        	  	 $product->whereBetween('products.price', [$request['min_price'] , $request['max_price'] ]);
        	  }else{
           	 $product->whereBetween('products.price', [$request['min_price'] , $request['max_price'] ]);
        	  }
        }
        if($request['min_qty'] > 0 && $request['max_qty']  > 0)
        {
        	   if($request['type'] == 'occasions'){
        	   		$product->whereBetween('products.maq', [$request['min_qty'] , $request['max_qty'] ]);
        	   }else{
        	   	 $product->whereBetween('maq', [$request['min_qty'] , $request['max_qty'] ]);
        	   }
           
        }
        if($request['max_qty'] == 150) {
        	 if($request['type'] == 'occasions'){
        	 			$product->where('products.maq','>=',$request['max_qty']);
        	 }else{
        	 	$product->where('maq','>=',$request['max_qty']);
        	 }
        	 
        }
        if($request['max_price'] == 5000){
        	if($request['type'] == 'occasions'){
        		$product->where('products.price','>=',$request['max_price']);
        	}else{
        		$product->where('price','>=',$request['max_price']);
        	}
        }
	
		if($request['page_limit']){
       $page_limit = $request['page_limit'];
    }else{
       $page_limit = 12;
    }
    	
    if($request['sort_by']){
    	if($request['type'] == 'occasions'){
    	    $product->orderBy('products.'.$request['sort_by'],$request['order_by']);
    	}else{
    		$product->orderBy($request['sort_by'],$request['order_by']);
    	}
    }else{
    		 $product->orderBy('created_at','desc');
		}

		$product = $product->paginate($page_limit);
		return view('presult', compact('product'));
	}
}
