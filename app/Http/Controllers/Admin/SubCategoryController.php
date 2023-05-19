<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\SubCategory;
use App\Models\SubCategoryFeature;
use DataTables;

class SubCategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request,$id)
	{
		//
		$cat_id = $id;
		if ($request->ajax()) {
			$data = SubCategory::with('category')->where('category_id',$cat_id)->get();

					return Datatables::of($data)
					->addColumn('category', function($row){
							
						return $row['category']['name'];
					 })
						->addColumn('action', function($row){
								$url = url('admin/category/edit')."/".$row->id;
								$sub_cat = url('admin/category/sub-cat/show').'/'.$row->id;
								$sub_cat_edit = url('admin/category/sub-cat/edit/').'/'.$row->id;
								$btn = '<a href="'.$sub_cat_edit.'" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;&nbsp;';
								$btn.= '<a  href="javascript:void(0)" class="removesubcategory btn btn-danger btn-sm text-white" data-id="'.$row->id.'">Delete</a>&nbsp;&nbsp;';
								return $btn;
					 })
					->rawColumns(['action', 'image'])
					->make(true);
		}
		return view('admin.sub-category.index',compact('cat_id'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create($id)
	{
		//
		$features = Feature::getFeatures();
		$cat_id = $id;
		return view('admin.sub-category.create',compact('cat_id','features'));
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
			
			SubCategory::saveSubcategory($request->input());
			return response()->json(['success' => true,
				'message' => 'Subcategory has been added successfully.'
		  ], 200);

		} catch(\Exception $e){
			echo $e->getmessage();
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
	   $features = Feature::getFeatures();
	   $SubCategoryFeature = SubCategoryFeature::where('sub_category_id',$id)->pluck('feature_id')->toArray();
	   
	   $subCat= SubCategory::find($id);
	   $cat_id = $subCat['category_id'];
	 
		return view('admin.sub-category.edit',compact('subCat','cat_id','features','SubCategoryFeature'));
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
				$post = $request->input();
				SubCategory::saveSubcategory($post);
			
				return response()->json(['success' => true,
					'message' => 'Subcategory has been updated successfully.'
		  	], 200);

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
		try{
		  $SubCategory = SubCategory::find($id);
		 
		  $SubCategory->delete();
			return response()->json(['success' => true,
				'message' => 'subcategory has been removed successfully.'
		  ], 200);

		} catch(\Exception $e){
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		}  
	}

}
