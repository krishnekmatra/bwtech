<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubCategoryFeature;
use App\Models\Product;
use App\Models\Deal;
use App\Models\ProductDeal;
use App\Models\FeatureAttribute;
use App\Models\Feature;
use App\Models\UploadImage;
use Response;
use App\Imports\ImportProducts;
use App\Imports\ImportEditProducts;

use App\Exports\ProductEditExport;
use App\Exports\ExportSubcategoryFeature;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductFeture;
use Carbon\Carbon;


use DataTables;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		//
		if ($request->ajax()) {
					$data = Product::getProducts($request);

					return Datatables::of($data)
					->editColumn('select_product', static function ($row) {
					
							return '<input type="checkbox" name="selectProducts[]" value="'.$row->id.'" class="activeproducts" id="activeproducts" />';
					})
					->addColumn('category_name', function($row){
						return $row->category->name;
					 })
					->addColumn('subcategory_name',function($row){
						return $row->subCategory->name;
					})
					->addColumn('createdBy',function($row){
						if(getAuthGaurd() == 'admin'){
							return $row->createdBy->name;	
						}else{
							return '';
						}
						
					})
					->addColumn('image', function($row){
						$imageval = url('product/' . $row->image);
                    	return '<img src="' . $imageval . '" height="30px" width="30px"/>';
					 })
						->addColumn('action', function($row){
								$url = url(getAuthGaurd().'/product/edit')."/".$row->id;
								$btn = '<a href="'.$url.'" class="edit btn btn-primary btn-sm text-white"><i class="fe fe-edit"></i></a>&nbsp;&nbsp;';
								if(getAuthGaurd() == 'admin'){
									$btn.= '<a class="removeProduct btn btn-danger btn-sm text-white" data-id='.$row["id"].'><i class="fe fe-trash"></i></a>';
									
								}
									
								
								
								return $btn;
					 })
					->addColumn('statusChange', function($row){
						if(getAuthGaurd() == 'admin'){
							$value = $row['id'];
							$checked = ($row['status']== 1) ? 'checked' : '';
							$btn='<label class="switch"><input  type="checkbox" '.$checked.' value='.$value.'><span class="slider round"></span></label>&nbsp;';
						}else{
							$status = ($row['status']== 0) ? 'DeActive' : 'Active';
							$class = ($row['status']== 0) ? 'danger' : 'success';
							$btn= '<span  class="edit btn btn-'.$class.' btn-sm">'.$status.'</span>&nbsp;&nbsp;';
						}
						return $btn;
					})
					->rawColumns(['select_product','action', 'image','statusChange'])
					->make(true);
			}
			return view('product.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		$category =  Category::getCategoriesList();
		return view('product.create',compact('category'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		try {
			if($request->file('image')){
				if($request['id']){

				$image_path = public_path("product/".$request['old_image']);  // Value is not URL but directory file path
					if(\File::exists($image_path)) {
    					\File::delete($image_path);
					}
				}
			 	$image = uploadImage('product',$request->image);
		    	$request['image'] = $image;
			}
			if($request->file('image1')){
				if($request['id']){

				$image_path = public_path("product/".$request['old_image1']);  // Value is not URL but directory file path
					if(\File::exists($image_path)) {
    					\File::delete($image_path);
					}
				}
			 	$image = uploadImage('product',$request->image1);
		    	$request['image1'] = $image;
			}
			if($request->file('image2')){
				if($request['id']){

				$image_path = public_path("product/".$request['old_image2']);  // Value is not URL but directory file path
					if(\File::exists($image_path)) {
    					\File::delete($image_path);
					}
				}
			 	$image = uploadImage('product',$request->image2);
		    	$request['image2'] = $image;
			}
			if($request->file('image3')){
				if($request['id']){

				$image_path = public_path("product/".$request['old_image3']);  // Value is not URL but directory file path
					if(\File::exists($image_path)) {
    					\File::delete($image_path);
					}
				}
			 	$image = uploadImage('product',$request->image3);
		    	$request['image3'] = $image;
			}

		 	if($request['id']){
		 		if($request['image_url']){
		 			$explode_image = explode('product/',$request['image_url']);
        			if(isset($explode_image[1])){
        				
           				if (\File::exists(public_path('product/'.$explode_image[1]))) {
           					$request['image'] = $explode_image[1];
		 							}else{
		 								
		 								return response()->json(['success' => false,
											'message' => 'Image Does not exist'], 200);
		 							}
		 					}else{
		 						return response()->json(['success' => false,
											'message' => 'Image Does not exist'], 200);
		 							
		 					}
		 		}
		 	}
		 	Product::saveProduct($request->input());
			return response()->json(['success' => true,
				'message' => 'Product has been '.($request['id'] ? 'updated' : 'added')  .' successfully.'
		  ], 200);

		} catch(\Exception $e){
			echo $e->getMessage();
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		} 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
		$product = Product::find($id);
		$category =  Category::get();
		$subCategory = SubCategory::where('category_id',$product['category_id'])->get();
		$brand = SubCategoryFeature::where('sub_category_id',$product['sub_category_id'])->get();
		return view('product.create',compact('category','product','subCategory'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * get subcategory by id
	 */ 
	public function getSubCategoryById(Request $request){
		$category_id = $request->input('category_id');
		$sub_cat = SubCategory::where('category_id',$category_id)->select(['name','id'])->get();
		return response()->json($sub_cat);
	}

	public function subCategoryFeatures(Request $request){
		if(@$request['product_id']){
			$product_feature = ProductFeture::where('product_id',$request['product_id'])->where('type','select')->pluck('feature_attribute_id')->toArray();

			$product_feature_text = ProductFeture::where('product_id',$request['product_id'])->where('type','text')->select('features_id','value')->get()->toArray();

		}else{
			$product_feature = [];
			$product_feature_text = [];
		}
		$features = SubCategory::with('features.featureName.FeatureAttributes')->where('id',$request['subcategory_id'])->get();


		return view ('product.subcat-feature',compact('features','product_feature','product_feature_text'));
	}

	public function getBrand(Request $request){
		$subcategory_id = $request->input('sub_category_id');
		$brand = SubCategoryFeature::where('sub_category_id',$subcategory_id)->get();
		return response()->json($brand);
	}

	public function statusChange(Request $request){
		try {
			$status_msg = ($request->status == 0)? 'DeActive' : 'Active';
			Product::where('id',$request->id)->update(['status'=>$request->status]);
			
			return response()->json(['success' => true,
				'message' => 'Product has been '.$status_msg  .' successfully.'
		  ], 200);

		} catch(\Exception $e){
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		}  

	}
	public function getProductDetail($id){

		$user = \Auth()->user();
		$product = Product::with('category','subCategory','getBrands','productFeatures.feature_attribute_name','productFeatures.feature_name')->where('slug',$id)->first();
		return view('product.detail',compact('product','user'));
	}

	public function productImage(Request $request){
		
		if ($request->ajax()) {
			$client_id = \Auth::guard(getAuthGaurd())->user()->id;
			$data = UploadImage::where('client_id',$client_id)->orderBy('created_at','desc')->get();

				return Datatables::of($data)
						->addColumn('image_url', function($row){
							$url = url('product/'.$row['name']);
							

							return $url;
					 })
						->addColumn('image', function($row){
							$url = url('product/'.$row['name']);
							return '<img src="' . $url . '" height="30px" width="30px"/>';

					 })
						->addColumn('action', function($row){
							$url = url('product/'.$row['name']);
							$id = $row['id'];
							$btn = '<a data-url="'.$url.'" class="copyText btn btn-danger btn-sm text-white">copy</a>&nbsp;&nbsp;';
							$btn.= '<a  href="javascript:void(0)" class="removeImage btn btn-danger btn-sm text-white" data-id="'.$id.'">Delete</a>&nbsp;&nbsp;';
							

							return $btn;
					 })
					->rawColumns(['image_url','image','action'])
					->make(true);
		}
		return view('product.image');
	}

	public function saveImage(Request $request){
		 if ($request->hasfile('files')) {
		 	$image = $request->file('files');
     	    $imageName = time() . rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
  			$destination = public_path() . '/'.'product';

		  //check directory avilable
		  if (!is_dir($destination)) {
		            \File::makeDirectory($destination, $mode = 0777, true, true);
		  }
  		$fileName = str_replace(" ", "-", $imageName);
  		$image->move($destination, $fileName);
  		
  		UploadImage::create([
  			"name" =>  $fileName,
  			"client_id" => \Auth::guard(getAuthGaurd())->user()->id
  		]);
  		return json_encode(['success'=>true]);
    }else{
    	return json_encode(['success'=>false]);
    }

	}
	public function ProductSampleDownload($id){
		 $subcat = SubCategory::where('id',$id)->pluck('name')->first();
		 return Excel::download(new ExportSubcategoryFeature($id), $subcat.'.xlsx');
	}

	public function ProductEditExport(Request $request){
		$currentTime = Carbon::now();

		 return Excel::download(new ProductEditExport($request->input()),$currentTime.'.xlsx');

	}

	public function ProductImport(){
		  $subcategory = SubCategory::get();
		  return view('product.import',compact('subcategory'));
	}

	public function import(Request $request){
	//	Excel::import(new ImportProducts, request()->file('file'));
		
     \DB::beginTransaction();
		try{
			if($request->type == 'edit' ){
				$import = new ImportEditProducts($request->product_subcategory_id);
			}else{
				$import = new ImportProducts;
			}

			$import->import($request->file);

			if ($import->failures()->isNotEmpty()) {
				\DB::rollBack();
				return response()->json([
				  'success' => false,
				  'message' => $import->failures(),
				  'type' => 'bulk_upload'
				], 200);
				
			} else {
				\DB::commit();
				return response()->json([
					'success' => true,
					'message' => 'Product Imported Sucessfully',
				], 200);
			}
		}catch(\Exception $e){
			echo $e->getMessage();
			\DB::rollBack();
			return response()->json([
				'success' => false,
				'message' => config('constants.SOMETHING_WENT_WRONG')
			], 200);
		}
      // return back();
	}



	public function productImageRemove(Request $request){
		$UploadImage = UploadImage::find($request->id);
		if($UploadImage['name']){
			$image_path = public_path("product/".$UploadImage['name']);  
					if(\File::exists($image_path)) {
    					\File::delete($image_path);
					}
			$UploadImage->delete();
		}
		return response()->json(['success' => true,
				'message' => 'Image has been  deleted successfully'
		  ], 200);
	}

	public function productRemove(Request $request){
		try {
			
		  $product = Product::find($request->id);
		  if($product['image']){
		  	 $image_path = public_path("product/".$product['image']);  
			  if(\File::exists($image_path)) {
	    			\File::delete($image_path);
			  }
		  }
		 
				
		  $product->delete();
			return response()->json(['success' => true,
				'message' => 'Product has been removed successfully.'
		  ], 200);

		} catch(\Exception $e){
			echo $e->getMessage();
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		}  
	}

	public function changeStatus(Request $request){
		if(isset($request['checkedVal'])){
			foreach($request['checkedVal'] as $val){
        		Product::where('id',$val)->update([
        			'status' => $request['status'],
        		]);
        	}
		}
		
		return response()->json(['success' => true,
				'message' => 'Product status changed successfully.'
		  ], 200);
	}
}
