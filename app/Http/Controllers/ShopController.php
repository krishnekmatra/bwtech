<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\SubCategoryFeature;
use App\Models\ProductDeal;


class ShopController extends Controller
{
	//
	public function productList(Request $request){
		 $brand = Product::with('feature_attributes')->where('status',1)->get();
		 $allcategory = 1;
		$product = Product::where('status',1);
		$product=$product->orderBy('created_at','desc')->paginate(12);
		$filter = false;
		 return view ('allproduct',compact('brand','product','allcategory','filter'));
		
	}
	public function dealsProduct(Request $request){
		$product = ProductDeal::with('getProduct')->get();
		return view ('dealsproduct',compact('product'));

	}
	public function index($category,Request $request){
		
		$cat_slug = $category;
		$category = Category::with(['subCategory'])->where('slug',$category)->first();
		
		$cat_id = $category['id'];
		$cat_name = $category['name'];
		if(@$category){
				$select_cat_id = url('shop').'/'.@$category['slug'];	
		}else{
			$select_cat_id = '';
		}
		
		$subCategory = $category['subCategory'];
		
		$features = SubCategoryFeature::with('featureName.FeatureAttributes')->where('category_id',$cat_id)->groupBy('feature_id')->get();
		

    	$filter = true;
		$product = Product::where('category_id',$cat_id)->where('status',1);
		$product=$product->orderBy('created_at','desc')->paginate(12);
		
		
		return view ('shop',compact('cat_id','subCategory','features','cat_name','product','cat_slug','select_cat_id','filter'));
	}
    
    public function filterResult(Request $request){

    	$product = Product::select('*');
    	if($request['cat_id']){
    		$product->where('category_id',$request['cat_id']);
    	}
    	

    	if($request['brand_array']){
    		$array = $request['brand_array'];
    		 $product->whereHas('productFeatures', function ($q) use($array) {
    			 $q->whereIn('feature_attribute_id', $array);
			}, '=', count($array));
    			
    	}
		if($request['min_price'] > 0 && $request['max_price']  > 0)
        {
            $product->whereBetween('price', [$request['min_price'] , $request['max_price'] ]);
        }
       
        if($request['max_price'] == 5000){
        	$product->where('price','>=',$request['max_price']);
        }
        if($request['page_limit']){
        	$page_limit = $request['page_limit'];
        }else{
        	$page_limit = 12;
        }
    	$product = $product->where('status',1);
    	
    	if($request['sort_by']){
    		$product->orderBy($request['sort_by'],$request['order_by']);
    	}else{
    		 $product->orderBy('created_at','desc');
		}
    	$product= $product->paginate($page_limit);
  
		if ($request->ajax()) {
			return view('presult', compact('product'));
		}
    }

	public function subCategoryList($category_name,$subcategory_name){
		
		$cat_slug = $category_name;
		
		$category = Category::with(['subCategory'])->where('slug',$category_name)->first();
		$subCategory = $category['subCategory'];
		$cat_name = $category['name'];
		$sub_cat = SubCategory::where('slug',$subcategory_name)->first();
		$subcategory_name = $sub_cat['name'];
       if(@$category){
				$select_cat_id = url('shop').'/'.@$category['slug'];	
		}else{
			$select_cat_id = '';
		}

		$product = Product::where('sub_category_id',$sub_cat['id'])->where('category_id',$sub_cat['category_id'])->where('status',1); 
		

		$product = $product->orderBy('created_at','desc')->paginate(12);
		

		$brand = Product::with('feature_attributes')
		->where('category_id',$sub_cat['category_id'])->where('sub_category_id',$sub_cat['id'])->where('status',1)->groupBy('feature_attribute_id')->get();
		

		return view ('subCategoryshop',compact('sub_cat','product','cat_name','subcategory_name','brand','subCategory','cat_slug','select_cat_id'));
	
	}

	public function searchProduct(Request $request){
		 
		$search_txt = $request->input('q');
		$category = Category::with(['subCategory'])->where('name',$search_txt)->first();
		$subCategory = @$category['subCategory'];
		$cat_name = @$category['name'];
		$cat_slug = @$category['slug'];
		if(@$category){
				$select_cat_id = url('shop').'/'.@$category['slug'];	
		}else{
			$select_cat_id = '';
		}
		

		$brand = Product::with('feature_attributes')
		->where('products.name', 'LIKE','%'. $search_txt .'%')
		->orWhere(function($q) use($search_txt) {
			$q->whereHas('category', function ($query) use ($search_txt) {
				$query->where('name','like', '%'. $search_txt .'%');
			 });
			// ->orWhereHas('feature_attributes',function($query) use( $search_txt){
		 	//      $query->where('name','like', '%'. $search_txt .'%');

		 	//  })->orWhereHas('productFeatures',function($query) use( $search_txt){
			//     $query->where('name','like', '%'. $search_txt .'%');
			//  });
		})
		
		 ->where('status',1)->get();

    	
		$product = Product::where('products.name', 'LIKE','%'. $search_txt .'%')
		->orWhere(function($q) use($search_txt) {
			$q->whereHas('category', function ($query) use ($search_txt) {
				 $query->where('name','like', '%'. $search_txt .'%');
			 });
			// ->orWhereHas('feature_attributes',function($query) use( $search_txt){
		 	//      $query->where('name','like', '%'. $search_txt .'%');

		 	//  })->orWhereHas('productFeatures',function($query) use( $search_txt){
			//     $query->where('name','like', '%'. $search_txt .'%');
			//  });
		})
		->where('status',1);
		
		$filter = false;
		$product = $product->orderBy('created_at','desc')->paginate(12);
		return view ('search',compact('brand','product','search_txt','subCategory','cat_name','cat_slug','select_cat_id','filter'));

		
	}

	public function searchProductResult(Request $request) {

		$search_txt = $request['search_txt'];

		$product = Product::where('products.name', 'LIKE','%'. $search_txt .'%')
		->orWhere(function($q) use($search_txt) {
			$q->whereHas('category', function ($query) use ($search_txt) {
				 $query->where('name','like', '%'. $search_txt .'%');
			 })
			->orWhereHas('feature_attributes',function($query) use( $search_txt){
		 	     $query->where('name','like', '%'. $search_txt .'%');

		 	 })->orWhereHas('subCategory',function($query) use( $search_txt){
			    $query->where('name','like', '%'. $search_txt .'%');
			 });
		})
		->where('status',1);
		
		if($request['brand_array']){
    		//$product->whereIn('feature_attribute_id',$request['brand_array']);
    	}

    	if($request['warranty']){
    		$product->where('warrenty',$request['warranty']);
    	}

    	if($request['min_price'] > 0 && $request['max_price']  > 0)
        {
            $product->whereBetween('price', [$request['min_price'] , $request['max_price'] ]);
        }
        
        if($request['min_qty'] > 0 && $request['max_qty']  > 0)
        {
            $product->whereBetween('maq', [$request['min_qty'] , $request['max_qty'] ]);
        }
        
        if($request['max_qty'] == 150) {
        	 $product->where('maq','>=',$request['max_qty']);
        }
        
        if($request['max_price'] == 5000){
        	$product->where('price','>=',$request['max_price']);
        }
        
        if($request['page_limit']){
        	$page_limit = $request['page_limit'];
        }else{
        	$page_limit = 12;
        }
		
		

		$product = $product->orderBy('created_at','desc')->paginate($page_limit);
		return view('presult', compact('product'));
		
	}
}
