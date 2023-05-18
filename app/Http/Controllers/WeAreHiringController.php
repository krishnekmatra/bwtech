<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeAreHiring;
use DataTables;

class WeAreHiringController extends Controller
{
     public function index(Request $request)
    {
            if ($request->ajax()) {
                    $data = WeAreHiring::getWeAreHiringList();
                    return Datatables::of($data)
                        ->addColumn('action', function($row){
                            $url = url('admin/we-are-hiring/edit/'.$row->id);
                            $btn = '<a href="'.$url.'" class="edit btn btn-danger btn-sm text-white">Edit</a>&nbsp;&nbsp;';
                            $btn.= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm text-white removeWeAreHiring" data-id="'.$row->id.'">Delete</a>';

                            return $btn;
                     })
                    ->rawColumns(['action'])
                    ->make(true);
            }
                return view('admin.we_are_hiring.index');
    }

    public function create()
    {
       
        return view('admin.we_are_hiring.create');

    }
    public function store(Request $request)
    {
        try {
          
           WeAreHiring::saveWeAreHiring($request->input());
            return response()->json(['success' => true,
                'message' => 'WeAreHiring has been '.($request['id'] ? 'updated' : 'added')  .' successfully.'
          ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => 'something went wrong'], 200);
        }  
    }
    public function edit($id)
    {
        
        $WeAreHiring = WeAreHiring::find($id);
        return view('admin.we_are_hiring.create',compact('WeAreHiring'));
    }

    public function destroy($id)
    {
       try {
            
          $faq = WeAreHiring::find($id);
         
                
          $faq->delete();
            return response()->json(['success' => true,
                'message' => 'Faq has been removed successfully.'
          ], 200);

        } catch(\Exception $e){
            echo $e->getMessage();
            return response()->json(['success' => false,
                'message' => 'something went wrong'], 200);
        }  
    }
}
