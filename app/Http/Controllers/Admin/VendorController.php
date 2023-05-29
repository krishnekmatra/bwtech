<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests\admin\CreateVendorRequest;
use DataTables;
use App\Models\Role;


class VendorController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
				if ($request->ajax()) {
					$data = User::getVendors($request);
					return Datatables::of($data)
						
					->addColumn('action', function($row){
					 	$url = url('admin/user/edit')."/".$row['id'];
   						$btn = '<a href="'.$url.'" class="edit btn btn-primary btn-sm">Edit</a>';
   						
						
						return $btn;
					 })
					->addColumn('statusaction', function($row){
   						$value = $row['id'];
						$checked = ($row['status']== 1) ? 'checked' : '';
						$btn='<label class="switch"><input  type="checkbox" '.$checked.' value='.$value.'><span class="slider round"></span></label>&nbsp;';

						// $btn.= '<a href="javascript:void(0)" class="productactive btn btn-primary btn-sm">product Active</a>';
						return $btn;
					 })
					
					->skipTotalRecords()
					->rawColumns(['action','statusaction'])
					->make(true);
				}
	  

		return view('vendor.index');
	}

	public function customerList(Request $request)
	{
				if ($request->ajax()) {
					$data = User::getCustomers($request);
					return Datatables::of($data)
					
					
					->skipTotalRecords()
					->make(true);
				}
	  

		return view('customer.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		$role = Role::where('name','!=','admin')->get();
		return view('vendor.create',compact('role'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateVendorRequest $request)
	{
		//
		try {
			if($request->file('image')){
				if($request['id']){

					$image_path = public_path("vendor/".$request['old_image']);  // Value is not URL but directory file path
					if(\File::exists($image_path)) {
    					\File::delete($image_path);
					}
				}
			$image = uploadImage('vendor',$request->image);
		    $request['image'] = $image;
			}
			User::saveVendor($request->input());
			return response()->json(['success' => true,
				'message' => 'User has been '.($request['id'] ? 'updated' : 'added')  .' successfully.'
		  ], 200);
			

		} catch(\Exception $e){
			echo $e->getMessage();
			exit();
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
		$role = Role::where('name','!=','admin')->get();
		$vendor = User::find($id);
		return view('vendor.create',compact('vendor','role'));
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
	public function statusChange(Request $request){
		try {
			$status_msg = ($request->status == 0)? 'DeActive' : 'Active';
			User::where('id',$request->id)->update(['status'=>$request->status]);
			
			return response()->json(['success' => true,
				'message' => 'Vendor has been '.$status_msg  .' successfully.'
		  ], 200);

		} catch(\Exception $e){
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		}  

	}
	public function productStatusChange(Request $request){
		try {
			$product = Product::where('created_by',$request['id'])->update(['status'=>1]);
			
			return response()->json(['success' => true,
				'message' => 'product has been updated successfully.'
		  ], 200);

		} catch(\Exception $e){
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		}  

	}
}
