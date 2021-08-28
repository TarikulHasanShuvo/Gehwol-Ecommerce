<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddNewAddressRequest;
use App\Http\Requests\Users\ChangePasswordRequestValidation;
use App\Models\NewsLetterSubscription;
use App\Models\UserAddress;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function updateUser(Request $request) {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'business_name' => 'required',
        ]);

        $user = User::where('id', Auth::id())->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'business_name' => $request->business_name,
            'customer_number' => $request->customer_number,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->back()->with('success', 'User info successfully updated!');
    }

    public function addressView() {
        $default_address = UserAddress::where('user_id', Auth::id())->where('is_default', 1)->first();
        $addresses = UserAddress::where('user_id', Auth::id())->where('is_default', 0)->get();
        return view('dashboard.address', compact('default_address', 'addresses'));
    }

    public function addNewAddress(StoreAddNewAddressRequest $request) {
        if(isset($request->is_default)) {
            UserAddress::where('user_id', Auth::id())->where('is_default', 1)->update(['is_default' => 0]);
        }

        UserAddress::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'business_name' => $request->business_name,
            'phone' => $request->phone,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'is_default' => isset($request->is_default)? 1: 0,
            'user_id' => Auth::id()
        ]);

        Session::flash('status', 'Successfully New Address Added');
        return redirect()->back();
    }

    public function editAddress($id) {
        $address = UserAddress::where('id', $id)->first();
        return view('dashboard.address_edit')->with('address', $address);
    }

    public function updateAddress(StoreAddNewAddressRequest $request, $id) {
        $address = UserAddress::where('id', $id)->first();
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->business_name = $request->business_name;
        $address->phone = $request->phone;
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->postal_code = $request->postal_code;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->is_default = isset($request->is_default)? 1: 0;
        $address->save();

        Session::flash('status', 'Successfully Address Updated.');
        return redirect()->back();
    }

    public function recentProducts() {
        $recentProducts = Product::orderBy('id', 'desc')->with('images')->paginate(10);
        return view('dashboard.recent')->with('recentProducts', $recentProducts);
    }

    /**
     * @param ChangePasswordRequestValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(ChangePasswordRequestValidation $request)
    {
        if (!(Hash::check($request->get('current_password'), auth()->user()->password))) {
            return back()->with('error', 'Invalid Current Password!');
        }

        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();
        return back()->with('success', 'Password successfully updated!');

    }

    public function deleteAddress($id) {
        UserAddress::where('id', $id)->delete();
        return response()->json([
            'message' => 'Successfully Address Deleted',
            'success'=> true
        ], 200);
    }

    public function updateNewsletterSubscription(Request $request) {
        if(isset($request->newsletter_subscription)) {
            NewsLetterSubscription::updateOrCreate(
                [
                    'email' => Auth::user()->email
                ],

                [
                    'status' => 1
                ]
            );
        } else {
            NewsLetterSubscription::where('email', Auth::user()->email)->delete();
        }

        return back()->with('success', 'Successfully Subscription Updated.');
    }
}
