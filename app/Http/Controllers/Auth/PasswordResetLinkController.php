<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Str;
use Hash;
use Mail; 
use DB; 
use Carbon\Carbon; 
class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    
 public function store(Request $request){
          
          $role =getRole('admin');
        
          $user = User::where('email',$request['email'])->first();
          
          if($user['role_id'] == $role){
             return response()->json(['success' => false,
                'message' => 'The email is not valid for this account.'
            ], 200);
          }else{
             $token = Str::random(64);
             //checck data avialbe
             $updatePassword = DB::table('password_resets')->where([
                    'email' => $request->email
            ])->first();
             if(!$updatePassword){
                  DB::table('password_resets')->insert([
                    'email' => $request->email, 
                    'token' => $token, 
                    'created_at' => Carbon::now()
            ]);
             }else{
                \DB::table('password_resets')->where(['email'=> $request->email])->update(['token' => $token]);
  
             }
           
            $email = $request->email;
             Mail::send('emails.customer-forgot-password', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
             return response()->json(['success' => true,
                'message' => 'We have emailed your password reset link!'
            ], 200);
          }
        
    }
}
