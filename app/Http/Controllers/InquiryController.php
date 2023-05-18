<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inquiry;
use Carbon\Carbon;
use DataTables;
use App\Http\Requests\CreateEnquiryRequest;
use App\Http\Requests\CreateRfqRequest;
use Mail; 
use App\Models\ContactUs;


class InquiryController extends Controller
{
	//
	public function customerInquiry(CreateEnquiryRequest $request){
		$product = Product::find($request['product_id']);
		$client_id = \Auth::user()->id;

		$check = Inquiry::whereDate('created_at',Carbon::today())->where([
			'product_id' => $request['product_id'],
			'quantity' => $request['quantity'],
			'client_id' => $client_id,
		])->first();

		if(!$check){
		 
		 $inquiry = Inquiry::create([
			'product_id' => $request['product_id'],
			'quantity' => ($request['quantity'])? $request['quantity'] : 1,
			'client_id' => $client_id,
			'vendor_id' => $product['created_by'],
			'enquiry' => $request['enquiry'],
			'type' => 'enquiry'
		 ]);

			return response()->json(['success' => true,
				'message' => 'Inquiry has been send sucessfully',
			], 200);
		}else{
			return response()->json(['success' => false,
				'message' => 'Already this product has been submited'], 200);
		}
		
	}

	public function inquiryView($id){
	
		
		$inquiry = Inquiry::with('product.createdBy')->find($id);

		return view('inquiry.detail',compact('inquiry'));
		
	}

	public function inquirylist(Request $request) {
	  
	  if ($request->ajax()) {
				$data = Inquiry::with(['product.createdBy','customer']);
				if(getAuthGaurd() == 'vendor'){
					$client_id = \Auth::guard(getAuthGaurd())->user()->id;
					$data->where('vendor_id',$client_id);
				}
				$data->where('type','enquiry');
				$data = $data->orderBy('created_at','desc')->get();
				return Datatables::of($data)
				->addColumn('name', function($row){
					return $row['product']['name'];
				 })
				->addColumn('price', function($row){
					return $row['product']['price'];
				 })
				->addColumn('quantity', function($row){
					return $row['quantity'];
				 })
				->addColumn('vendor',function($row){
					return $row['product']['createdBy']['name'];
				})
				->addColumn('customer_detail',function($row){
					return $row['customer']['name'];
				})
				->addColumn('image', function($row){
					$imageval = url('product/' . $row['product']['image']);
					return '<img src="' . $imageval . '" height="30px" width="30px"/>';
				 })
				->addColumn('created_at', function($row){
					$date = date('d-m-Y',strtotime($row['created_at']));
					return $date;
				 })
				->addColumn('action', function($row){
					$url = url(getAuthGaurd().'/inquiry/view')."/".$row->id;
					$btn = '<a href="'.$url.'" class="edit btn btn-primary btn-sm">View</a>&nbsp;&nbsp;';
					return $btn;
				 })
					
				->rawColumns(['action','image'])
				->make(true);
		}
		return view('inquiry.admin-inquiry-list');
	}

	public function rfqlist(Request $request) {
		 if ($request->ajax()) {
				$data = Inquiry::with(['customer']);
				if(getAuthGaurd() == 'vendor'){
					$client_id = \Auth::guard(getAuthGaurd())->user()->id;
					$data->where('vendor_id',$client_id);
				}
				$data->where('type','rfq');
				$data = $data->orderBy('created_at','desc')->get();
				return Datatables::of($data)
				
				->addColumn('delivery_date',function($row){
					return $row['delivery_date'];
				})
				->addColumn('customer_detail',function($row){
					return $row['customer']['name'];
				})
				->addColumn('created_at', function($row){
					$date = date('d-m-Y',strtotime($row['created_at']));
					return $date;
				 })
				->addColumn('action', function($row){
					$url = url(getAuthGaurd().'/inquiry/view')."/".$row->id;
					$btn = '<a href="'.$url.'" class="edit btn btn-primary btn-sm">View</a>&nbsp;&nbsp;';
					return $btn;
				 })
				->rawColumns(['action'])
				->make(true);
		}
		return view('inquiry.admin-inquiry-rfq-list');
	}
	public function submitanenquiry(){
		$user = \Auth()->user();
		return view('submit-enquiry',compact('user'));
	}

	public function savesubmitanenquiry(CreateRfqRequest $request){
		$post = $request->input();
		$client_id = \Auth::user()->id;
		$to_email = ContactUs::pluck('email')->first();

		$data = [
			'quantity' => ($request['quantity'])? $request['quantity'] : 1,
			'client_id' => $client_id,
			'enquiry' => $request['enquiry'],
			'prefered_category' => $request['prefered_category'],
			'prefered_brand' => $request['prefered_brand'],
			'min' => $request['min'],
			'max' => $request['max'],
			'delivery_date' => $request['delivery_date']
		];
		$inquiry = Inquiry::create($data);
		$data['email'] = $request['email'];
		$data['name'] = $request['name'];
		$data['phone'] = $request['phone'];
		 Mail::send('emails.rfq', ['data' => $data], function($message) use($request, $to_email){
              			$message->to($to_email);
              			$message->from($request->email);
              			$message->subject('Request for Quotations');
          			});
		
		return response()->json(['success' => true,
				'message' => 'Inquiry has been send sucessfully',
			], 200);
	}
}
