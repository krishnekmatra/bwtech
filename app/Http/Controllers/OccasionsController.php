<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Occasions;
use DataTables;
use App\Http\Requests\CreateOccasionRequest;
use App\Models\ProductOccasion;
use App\Models\Product;


class OccasionsController extends Controller
{
    //
    public function index(Request $request){
        if ($request->ajax()) {
            
            $data = Occasions::orderBy('created_at','desc');
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $url = url('admin/occasion/edit/'.$row->id);
                    $occasion_url = url('admin/product/occasion/'.$row->id);
                    $btn = '<a href="'.$url.'" class="edit btn btn-danger btn-sm text-white">Edit</a>&nbsp;&nbsp;';
                    $btn.= '<a href="'.$occasion_url.'" class="edit btn btn-primary btn-sm text-white">Assign Occasions</a>&nbsp;&nbsp;';
                    $btn.= '<a  href="javascript:void(0)" class="removeOccasions btn btn-danger btn-sm text-white" data-id="'.$row->id.'">Delete</a>&nbsp;&nbsp;';
                    return $btn;
                })
                ->skipTotalRecords()
                ->rawColumns(['action'])
                ->make(true);
        }
         return view('admin.occasions.index');
    }

    public function create()
    {
        //
        return view('admin.occasions.create');
    }

    public function store(CreateOccasionRequest $request)
    {
        //
        try {
            
            Occasions::saveOccasion($request->input());
            
            return response()->json(['success' => true,
                'message' => 'Occasion has been '.($request['id'] ? 'updated' : 'added')  .' successfully.'
          ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => 'something went wrong'], 200);
        }  
    }

    public function edit($id)
    {
        //
        $occasion = Occasions::find($id);
        return view('admin.occasions.create',compact('occasion'));

    }

    public function destroy($id)
    {
        try{
          $deal = Occasions::find($id);
         
          $deal->delete();
            return response()->json(['success' => true,
                'message' => 'Occasions has been removed successfully.'
          ], 200);

        } catch(\Exception $e){
            echo $e->getMessage();
            return response()->json(['success' => false,
                'message' => 'something went wrong'], 200);
        }  
    }
    public function occasionDeals(Request $request,$id){
        if ($request->ajax()) {
                    $data = Product::select('name','id','image')->where('status',1)->get();
                    $dealProduct = ProductOccasion::where('occasion_id',$id)->pluck('product_id')->toArray();

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
        return view('admin.occasions.product-occasion',compact('id'));
    }

    public function occasionSave(Request $request){
        if(isset($request['checkedVal'])){
            foreach($request['checkedVal'] as $val){
                $matchTheseDeal = ['product_id'=>$val,'occasion_id' => $request['id']];
                ProductOccasion::updateOrCreate($matchTheseDeal,[
                    'product_id' => $val,
                    'occasion_id' => $request['id']
                ]);
            }
        }
        if(isset($request['uncheckedVal'])){
            foreach($request['uncheckedVal'] as $val){
                $matchTheseDeal = ['product_id'=>$val,'occasion_id' => $request['id']];
                ProductOccasion::where($matchTheseDeal)->delete();
            }
        }
        return response()->json(['success' => true,
                'message' => 'Product has been assigned successfully.'
          ], 200);
    }

}
