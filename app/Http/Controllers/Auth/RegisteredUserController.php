<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Models\Wishlist;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'type' => 'required|in:customer,esthetician',
            'email' => 'required|string|email|max:255|unique:users',
            'business_name' => 'required',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'type' => $request->type,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'business_name' => $request->business_name,
            'customer_number' => $request->customer_number,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if($request->hasCookie('loginRedirectTo')) {
            $redirectTo = $request->cookie('loginRedirectTo');
            Cart::where('user_id', auth()->id())->delete();
            Cart::where('cookie_id', $request->cookie('shopping_busket'))->update(['user_id' => auth()->id(), 'cookie_id'=> NULL]);
            Cookie::queue(Cookie::forget('loginRedirectTo'));

            return redirect()->to($redirectTo);
        }

        if($request->hasCookie('wishlist_busket')) {
            Wishlist::where('cookie_id', $request->cookie('wishlist_busket'))->update(['user_id' => auth()->id(), 'cookie_id'=> NULL]);
            Cookie::queue(Cookie::forget('wishlist_busket'));
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
