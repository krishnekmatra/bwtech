<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use DataTables;

class FaqController extends Controller
{
    //
    public function index(Request $request)
    {
            if ($request->ajax()) {
                    $data = Faq::getFaq();
                    return Datatables::of($data)
                        ->addColumn('action', function($row){
                            $url = url('admin/faq/edit/'.$row->id);
                            $btn = '<a href="'.$url.'" class="edit btn btn-danger btn-sm text-white">Edit</a>&nbsp;&nbsp;';
                            $btn.= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm text-white removeFaq" data-id="'.$row->id.'">Delete</a>';

                            return $btn;
                     })
                    ->rawColumns(['action'])
                    ->make(true);
            }
                return view('admin.faq.index');
    }

    public function create()
    {
       
        return view('admin.faq.create');

    }
    public function store(Request $request)
    {
        try {
          
           Faq::saveFaq($request->input());
            return response()->json(['success' => true,
                'message' => 'Faq has been '.($request['id'] ? 'updated' : 'added')  .' successfully.'
          ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => 'something went wrong'], 200);
        }  
    }
    public function edit($id)
    {
        
        $faq = Faq::find($id);
        return view('admin.faq.create',compact('faq'));
    }

    public function destroy($id)
    {
       try {
            
          $faq = Faq::find($id);
         
                
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
