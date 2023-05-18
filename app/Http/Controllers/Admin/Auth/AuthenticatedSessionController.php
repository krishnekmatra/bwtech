<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
		/**
		 * Display the login view.
		 */
		public function create(): View
		{
				return view('auth.admin.login');
		}

		/**
		 * Handle an incoming authentication request.
		 */
		public function store(AdminLoginRequest $request)
		{
			
        if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
			Auth::guard('web')->logout();
        	$request->session()->regenerateToken();
	        $request->session()->regenerate();
	        //Authentication passed...
	        return response()->json(['success' => true,
                'message' => 'You are Logged in as Admin'
          ], 200);
    	  }else{
    	  		return response()->json(['success' => false,
                		'message' => 'Login failed, please try again'
          		], 200);
        	}
		}

		/**
		 * Destroy an authenticated session.
		 */
		public function destroy(Request $request): RedirectResponse
		{
				$url = getAuthGaurd();
				
				Auth::guard('web')->logout();

				$request->session()->invalidate();

				$request->session()->regenerateToken();
				return redirect($url == 'web' ? '/' : $url.'/login');
		}
}
