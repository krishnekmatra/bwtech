<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use DataTables;

class BannerController extends Controller
{
	//
	public function index(Request $request){
		if ($request->ajax()) {
					$data = Banner::getBanners();
					return Datatables::of($data)
					->addColumn('Type', function($row){
					  return $row['type'];
					 })
					->addColumn('image', function($row){
						$imageval = url('banner/' . $row->image);
					return '<img src="' . $imageval . '" height="30px" weight="30px"/>';
					 })
						->addColumn('action', function($row){
								$url = url('admin/banner/edit')."/".$row->id;
								$btn = '<a href="'.$url.'" class="edit btn btn-primary btn-sm text-white"><i class="fe fe-edit"></i></a>&nbsp;&nbsp;';
								$btn.= '<a class="removeBanner btn btn-danger btn-sm text-white" data-id='.$row["id"].'><i class="fe fe-trash"></i></a>';
									
								return $btn;
					 })
				   
					->rawColumns(['action', 'image'])
					->make(true);
			}
			return view('admin.banner.index');
	}
	public function create()
	{
		//
		$type = [
			'main',
			'sub',
			'sale',
			'download',
			'special'
		];
		return view('admin.banner.create',compact('type'));

	}
	public function store(Request $request)
	{
		try {
			$type = ['sub' => 2,'sale'=>2,'download'=>1,'special' =>1];
			if($request['id'] == 0){
				$total_banner = Banner::where('type',$request['type'])->count();
				foreach ($type as $key => $value) {
					if($key == $request['type']){
						if($total_banner >= $value){
							return response()->json(['success' => false,
								'message' => 'Your limit reached out.'], 200);
						}
					}
				}
			}
			if($request->file('image')){
				if($request['id']){

					$image_path = public_path("banner/".$request['old_image']);  // Value is not URL but directory file path
					if(\File::exists($image_path)) {
						\File::delete($image_path);
					}
				}
				$image = uploadImage('banner',$request->image);
			$request['image'] = $image;
			}

			
			Banner::saveBanner($request->input());
			return response()->json(['success' => true,
				'message' => 'Banner has been '.($request['id'] ? 'updated' : 'added')  .' successfully.'
		  ], 200);

		} catch(\Exception $e){
			echo $e->getMessage();
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		}  
	}
	public function edit($id)
	{
		//
		$type = [
			'main',
			'sub',
			'sale',
			'download',
			'special'
		];
		$banner = Banner::find($id);
		return view('admin.banner.create',compact('banner','type'));
	}

	public function destroy($id)
	{
	   try {
			
		  $banner = Banner::find($id);
		  if($banner['image']){
			 $image_path = public_path("banner/".$banner['image']);  
			  if(\File::exists($image_path)) {
					\File::delete($image_path);
			  }
		  }
		 
				
		  $banner->delete();
			return response()->json(['success' => true,
				'message' => 'Banner has been removed successfully.'
		  ], 200);

		} catch(\Exception $e){
			echo $e->getMessage();
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		}  
	}


}
