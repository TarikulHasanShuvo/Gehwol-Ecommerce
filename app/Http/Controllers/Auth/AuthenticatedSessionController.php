<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if($request->hasCookie('loginRedirectTo')) {
            $redirectTo = $request->cookie('loginRedirectTo');
            Cart::where('user_id', auth()->id())->delete();
            Cart::where('cookie_id', $request->cookie('shopping_busket'))->update(['user_id' => auth()->id(), 'cookie_id'=> NULL]);
            Cookie::queue(Cookie::forget('loginRedirectTo'));

            if($request->hasCookie('_gft_au_'.$request->cookie('shopping_busket'))) {
                Cookie::queue(Cookie::make('_gft_au_'.auth()->id(), $request->cookie('_gft_au_'.$request->cookie('shopping_busket')), 30));
                Cookie::queue(Cookie::forget('_gft_au_'.$request->cookie('shopping_busket')));
            }


            return redirect()->to($redirectTo);
        }

        if($request->hasCookie('wishlist_busket')) {
            Wishlist::where('cookie_id', $request->cookie('wishlist_busket'))->update(['user_id' => auth()->id(), 'cookie_id'=> NULL]);
            Cookie::queue(Cookie::forget('wishlist_busket'));
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
