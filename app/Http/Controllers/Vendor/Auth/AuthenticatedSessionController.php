<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorLoginRequest;
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
		return view('auth.vendor.login');
	}

	/**
	 * Handle an incoming authentication request.
	 */
	public function store(VendorLoginRequest $request)
	{

		 if(Auth::guard('vendor')->attempt($request->only('email','password'),$request->filled('remember'))){
		 	 Auth::guard('web')->logout();
        $request->session()->regenerateToken();
    	  //$request->authenticate();
    	  $request->session()->regenerate();
        return response()->json(['success' => true,
                'message' => 'You are Logged in as Vendor'
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
		Auth::guard('web')->logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect('/vendor');
	}
}
