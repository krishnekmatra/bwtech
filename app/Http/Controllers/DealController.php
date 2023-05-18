<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Http\Requests\admin\CreateDealRequest;
use DataTables;
use App\Models\Product;
use App\Models\ProductDeal;


class DealController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			
			$data = Deal::getDeals();
			return Datatables::of($data)
				->addColumn('action', function($row){
					$url = url('admin/deal/edit/'.$row->id);
					$deal_url = url('admin/product/deal/'.$row->id);
					$btn = '<a href="'.$url.'" class="edit btn btn-danger btn-sm text-white">Edit</a>&nbsp;&nbsp;';
					$btn.= '<a href="'.$deal_url.'" class="edit btn btn-primary btn-sm text-white">Assign Deal</a>&nbsp;&nbsp;';
					$btn.= '<a  href="javascript:void(0)" class="removedeal btn btn-danger btn-sm text-white" data-id="'.$row->id.'">Delete</a>&nbsp;&nbsp;';
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
		}
		 return view('admin.deal.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		return view('admin.deal.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateDealRequest $request)
	{
		//
		try {
			
			Deal::saveDeal($request->input());
			
			return response()->json(['success' => true,
				'message' => 'Deal has been'.($request['id'] ? 'updated' : 'added')  .' successfully.'
		  ], 200);

		} catch(\Exception $e){
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		}  
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Deal  $deal
	 * @return \Illuminate\Http\Response
	 */
	public function show(Deal $deal)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Deal  $deal
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
		$deal = Deal::find($id);
		return view('admin.deal.create',compact('deal'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Deal  $deal
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Deal $deal)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Deal  $deal
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		try{
		  $deal = Deal::find($id);
		 
		  $deal->delete();
			return response()->json(['success' => true,
				'message' => 'deal has been removed successfully.'
		  ], 200);

		} catch(\Exception $e){
			echo $e->getMessage();
			return response()->json(['success' => false,
				'message' => 'something went wrong'], 200);
		}  
	}
	public function productDeals(Request $request,$id){
		if ($request->ajax()) {
					$data = Product::select('name','id','image')->where('status',1)->get();
					$dealProduct = ProductDeal::where('deal_id',$id)->pluck('product_id')->toArray();

					return Datatables::of($data)
					
					->editColumn('select_product', static function ($row)use($dealProduct) {
						if(in_array($row->id,$dealProduct)){
								return '<input type="checkbox" name="selectProducts[]" value="'.$row->id.'" class="selectProducts" checked/>';
						}else{
								return '<input type="checkbox" name="selectProducts[]" value="'.$row->id.'" class="selectProducts" />';
						}
            			
        			})
					->addColumn('image', function($row){
						$imageval = url('product/' . $row->image);
                    return '<img src="' . $imageval . '" height="30px" width="30px"/>';
					 })
						
					->rawColumns(['action', 'image','select_product'])
					->make(true);
			}
		return view('admin.deal.product-deal',compact('id'));
	}

	public function dealSave(Request $request){
		if(isset($request['checkedVal'])){
			foreach($request['checkedVal'] as $val){
        		$matchTheseDeal = ['product_id'=>$val,'deal_id' => $request['id']];
        		ProductDeal::updateOrCreate($matchTheseDeal,[
        			'product_id' => $val,
        			'deal_id' => $request['id']
        		]);
        	}
		}
		if(isset($request['uncheckedVal'])){
			foreach($request['uncheckedVal'] as $val){
				$matchTheseDeal = ['product_id'=>$val,'deal_id' => $request['id']];
				ProductDeal::where($matchTheseDeal)->delete();
			}
		}
		return response()->json(['success' => true,
				'message' => 'Product has been assigned successfully.'
		  ], 200);
	}
}
