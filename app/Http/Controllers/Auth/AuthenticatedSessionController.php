<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\ProductWishList;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
        {
            \Session::put('isLogin',0);
                return view('auth.login');
        }
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        Auth::guard('web')->logout();
        $request->session()->regenerateToken();
        $request->authenticate();

        $request->session()->regenerate();
        $client_id = \Auth()->user()->id;
        $count = ProductWishList::where('client_id',$client_id)->count();
        \Session::put('wishlistCount',$count);
        return response()->json(['success' => true,
                'message' => 'You are Logged in as Admin'
          ], 200);

      //  return redirect('dashboard')
      //      ->with('status','You are Logged in as Admin!');

       // return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
