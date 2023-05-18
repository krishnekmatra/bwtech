<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\contactUsInquiry;
use App\Models\Faq;
use App\Http\Requests\CreateContactRequest;
use App\Models\WeAreHiring;
use DataTables;

use Mail; 

class ContactUsController extends Controller
{
		//
		public function leads(Request $request){
       		if ($request->ajax()) {
                    $data = contactUsInquiry::get();
                    return Datatables::of($data)
                    ->make(true);
            }
            return view('admin.contact-us.index');
    	}
    
		public function index(){
			$contact = ContactUs::first();
			$faq = Faq::orderBy('created_at','desc')->get();
			return view('contact-us',compact('contact','faq'));
		}

		public function weAreHiring(){
			$we_are_hiring = WeAreHiring::get();
			return view('pages.we-are-hiring',compact('we_are_hiring'));

		}

		public function whatWeDo($type){
			if($type == 'send'){
				return view('pages.send');
			}else{
				return view('pages.brandstore');
			}
		}

		public function aboutUs(){
			return view('pages.about-us');

		}

		public function addContactUs(){
			$contact = ContactUs::first();
			return view('admin.contact-us.create',compact('contact'));
		}

		public function contactusSave(Request $request){
			try {
			
			   
					ContactUs::saveContact($request->input());
					
					return response()->json(['success' => true,
						'message' => 'successfully save'
					], 200);

			} catch(\Exception $e)		{
				echo $e->getMessage();
					return response()->json(['success' => false,
						'message' => 'something went wrong'], 200);
					}
			}
		
		public function inquiry(CreateContactRequest $request){
			try {
			
			   $to_email = ContactUs::pluck('email')->first();
				 $data =  [
				 	'name' => $request['name'],
				 	'description' => $request['description'],
				 	'email' => $request['email']
				 ];
					contactUsInquiry::saveInquiry($request->input());
					 Mail::send('emails.contact-us', ['data' => $data], function($message) use($request, $to_email){
              			$message->to($to_email);
              			$message->from($request->email);
              			$message->subject('Contact Us inquiry');
          			});
					return response()->json(['success' => true,
						'message' => 'your query has been submited successfully.'
					], 200);

			} catch(\Exception $e)		{
				echo $e->getMessage();
					return response()->json(['success' => false,
						'message' => 'something went wrong'], 200);
					}
			}
		}
