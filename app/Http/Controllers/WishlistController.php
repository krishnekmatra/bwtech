<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\ProductWishList;
use PDF;

class WishlistController extends Controller
{
	//
	public function store(Request $request){
		$client_id = \Auth::user()->id;
		$wishlist = Wishlist::create([
			'name' => $request['name'],
			'client_id' => $client_id
		]);
		ProductWishList::create([
			'client_id' => $client_id,
			'product_id' => $request->product_id,
			'wishlist_id' => $wishlist->id
		]);
		 $count = ProductWishList::where('client_id',$client_id)->count();
        \Session::put('wishlistCount',$count);
		 
		 $html= '<li><input type="checkbox" name="wishlist[]" id="wishlist" class="wishlist" value="'.$wishlist->id.'" checked="checked"/>'.$request['name'].'</li>';
		 
		 return response()->json(['success' => true,
				'html' => $html,
				'count' => $count
		  ], 200);
	}
	public function getUserWishList($product_id){
		if (\Auth::user()){
			$client_id = \Auth()->user()->id;
			$wishlist = Wishlist::with('ProductWishList')->where('client_id',$client_id)->get();
			$html = '';

			foreach($wishlist as $value){
				$product_array = $value->ProductWishList->pluck('product_id')->toArray();
				if(in_array($product_id,$product_array)){
					$checked = 'checked=checked';
				}else{
					$checked = '';
				}
			
				$html.= '<li><input type="checkbox" name="wishlist[]" id="wishlist" class="wishlist" value="'.$value['id'].'" '.$checked.'/>'.$value['name'].'</li>';

			}
			return $html;
		}
	}
		
		
	
	public function assignProduct(Request $request){
		$wishlist_id =  $request->wishlist_id;
		$product_id =  $request->product_id;
		$client_id = \Auth()->user()->id;
		$matchThese = [
			'wishlist_id' => $wishlist_id,
			'product_id' => $product_id,
			'client_id' => $client_id
		];
		$productWishList = ProductWishList::where($matchThese)->first();
		if($productWishList){
			$productWishList->delete();
		}else{
			ProductWishList::create($matchThese);
		}
        $count = ProductWishList::where('client_id',$client_id)->count();
        \Session::put('wishlistCount',$count);
        return $count;
	}

	public function wishlist(){
		$client_id = \Auth()->user()->id;
		$wishlist = Wishlist::withCount('ProductWishList')->where('client_id',$client_id)->get();
		return view('wishlist.index',compact('wishlist'));
	}

	public function wishlistDownload($id){
	$wishlist = Wishlist::with('ProductWishList.getProduct.category.subCategory')->where('id',$id)->first();

		 $data = [
            'wishlists' => $wishlist
        ]; 
            
        $pdf = PDF::loadView('wishlistPDF', $data);
     
        return $pdf->download($wishlist['name'].'.pdf');
	}

	public function wishlistView($id){
		$wishlist = Wishlist::with('ProductWishList.getProduct')->where('id',$id)->first();

		 
        return view('wishlist.detail',compact('wishlist'));
	}

	public function removeProductWishlist(Request $request){
		$id = $request->id;

		ProductWishList::where('id',$id)->delete();
		$client_id = \Auth()->user()->id;
        $count = ProductWishList::where('client_id',$client_id)->count();
        \Session::put('wishlistCount',$count);
		return response()->json(['success' => true,
				'message' => 'Product has been deleted sucessfully',
				'count' => $count
		  ], 200);

	}

	public function savewishlist(Request $request){
		$id = $request->id;
		Wishlist::where('id',$id)->update([
			'name' => $request->name
		]);	
		return response()->json(['success' => true,
				'message' => 'wishlist has been updated sucessfully',
		  ], 200);
	}

	public function removewishlist(Request $request){
		
		$id = $request->id;
		
		Wishlist::where('id',$id)->delete();
		
		$client_id = \Auth()->user()->id;
        
        $count = ProductWishList::where('client_id',$client_id)->count();

        \Session::put('wishlistCount',$count);

		return response()->json(['success' => true,
				'message' => 'wishlist has been deleted sucessfully',
				'count' => $count
		  ], 200);
	}
}
