<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use DB; 
use App\Models\User;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        $valid = validToken($request->route('token'));
        if(!$valid){
           return view('auth.expiretoken');
        }
        return view('auth.admin.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
         $request->validate([
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'token' => $request->token
                              ])
                              ->first();
          if(!$updatePassword){
             return response()->json(['success' => false,
                'message' => 'Invalid Token'
        ], 200);
          }
  
          $user = User::where('email', $updatePassword->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          \DB::table('password_resets')->where(['token'=> $request->token])->delete();
  
         return response()->json(['success' => true,
                'message' => 'Your password has been changed!'
        ], 200);
    }
}
