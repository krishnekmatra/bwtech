<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FeatureAttribute;
use Illuminate\Http\Request;
use App\Http\Requests\admin\CreateFeatureRequest;
use DataTables;
use Illuminate\Support\Str;

class FeatureController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		
			if ($request->ajax()) {
					$data = Feature::getFeatures();
					return Datatables::of($data)
						->addColumn('action', function($row){
							$url = url('admin/feature/edit/'.$row->id);
							$btn = '<a href="'.$url.'" class="edit btn btn-danger btn-sm text-white">Edit</a>&nbsp;&nbsp;';
							$btn.= '<a href="javascript:void(0)" class="deleteFeature btn btn-danger btn-sm text-white" data-id="'.$row->id.'">Delete</a>';

							return $btn;
					 })
					->rawColumns(['action'])
					->make(true);
			}
				return view('admin.feature.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		 return view('admin.feature.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateFeatureRequest $request)
	{
		try {
			
			Feature::saveFeature($request->input());
			
			return response()->json(['success' => true,
				'message' => 'Feature has been '.($request['id'] ? 'updated' : 'added')  .' successfully.'
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
	 * @param  \App\Models\Feature  $feature
	 * @return \Illuminate\Http\Response
	 */
	public function show(Feature $feature)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Feature  $feature
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
			$feature = Feature::find($id);
			$featureAttribute = FeatureAttribute::select( \DB::raw("(GROUP_CONCAT(name,'|',id )) as `names`"))->where('feature_id',$id)->groupBy('feature_id')->get();
		 	return view('admin.feature.edit',compact('feature','featureAttribute'));
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Feature  $feature
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Feature $feature)
	{
		//
		$post = $request->input();
		$trimmed = trim($post['name']); // Trims both ends

		$res =  str_replace('', '_', $trimmed);
      	$post['slug'] = Str::slug($res);
				Feature::where('id',$post['id'])->update([
					'name' => $post['name'],
					'feature_type'=> $post['feature_type'],
					'slug' => $post['slug'],
					'search_type' => $post['search_type']
				]);
				foreach($post['feature_value'] as $key=>$value){
						
						$decode = json_decode($value,true);
						$array = (array)$decode;
						foreach($array as $val){
							if(isset($val['id'])){
								$id = $val['id'];
							}else{
								$id = 0;
							}
							$matchThese = ['id'=>$id];
							FeatureAttribute::updateOrCreate($matchThese,[
								'name' =>$val['value'] ,
								'feature_id' => $post['id']
							]);
							
						}
				}
				if(isset($post['removeIds'])){
					$explode_ids = explode(',',$post['removeIds']);
					foreach($explode_ids as $ids){
							FeatureAttribute::where('id',$ids)->delete();
					}
				}
				return response()->json(['success' => true,
					'message' => 'Feature has been updated successfully.'
		  	], 200);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Feature  $feature
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
			 try {

            $feature  = Feature::find($id);
            $feature->delete();

            return response()->json(['success' => true,
                     'message' => 'deleted sucessfully'
            ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => 'something went wrong'], 200);
        }  
	}
}
