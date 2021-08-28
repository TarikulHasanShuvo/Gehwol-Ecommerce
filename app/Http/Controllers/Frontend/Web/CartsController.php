<?php

namespace App\Http\Controllers\Frontend\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\GiftCertificateStoreRequest;
use App\Models\Cart;
use App\Models\GiftCertificate;
use App\Models\Order;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartsController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->check()) {
            $carts = Cart::with('cartable')->where('user_id', auth()->id())->get();
            Cookie::queue(Cookie::forget('_gft_au_'.auth()->id()));
        } else {
            $carts = Cart::with('cartable')->where('cookie_id', $request->cookie('shopping_busket'))->get();
            Cookie::queue(Cookie::forget('_gft_au_'.$request->cookie('shopping_busket')));
        }

        $carts = $carts->map(function($cart) {
            if($cart->cartable_type === Product::class) {
                $cart->product = $cart->cartable;
            } else {
                $cart->gift_certificate = $cart->cartable;
            }
            return $cart;
        });

        return view('site.cart')->with('carts', $carts);
    }

    public function checkout()
    {
        if(auth()->check()) {
            $data = [];
            $data['carts'] = Cart::with('cartable')->where('user_id', auth()->id())->get();
            $data['addresses'] = UserAddress::where('user_id', auth()->id())->get()->toArray();

            $data['carts'] = $data['carts']->map(function($cart) {
                if($cart->cartable_type === Product::class) {
                    $cart->product = $cart->cartable;
                } else {
                    $cart->gift_certificate = $cart->cartable;
                }
                return $cart;
            });

            return view('site.cart_shipping', $data);
        }
        Cookie::queue(Cookie::make('loginRedirectTo', '/cart/shipping', 10));
        return redirect()->to('/login');
    }

    public function payment(Request $request)
    {
        $order = Order::where('order_uid', $request->u)->where('orders.user_id', auth()->id())->first();
        $orderProducts = $order->products;
        $orderGifts = $order->gift_certificates;
        $intent = auth()->user()->createSetupIntent();
        return view('site.cart_payment', compact('intent', 'orderProducts', 'order', 'orderGifts'));
    }

    /**
     * @param GiftCertificateStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function giftAddToCart(GiftCertificateStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $gift = new GiftCertificate();
            $gift->recipient_name = $request->recipient_name;
            $gift->recipient_email = $request->recipient_email;
            $gift->client_name = $request->client_name;
            $gift->client_email = $request->client_email;
            $gift->amount = $request->amount;
            $gift->available_balance = $request->amount;
            $gift->gift_card_code = rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999);
            $gift->message = $request->message;
            if(auth()->check()) {
                $gift->user_id = auth()->id();
            } else {
                if($request->hasCookie('shopping_busket')) {
                    $cookie = $request->cookie('shopping_busket');
                } else {
                    $cookie = Str::random(10);
                    Cookie::queue(Cookie::make('shopping_busket', $cookie, 2880)); //2 days cookie
                }
                $gift->cookie_id = $cookie;
            }
            $gift->save();

            $this->store($request, $gift);
            DB::commit();

            return redirect()->to('/cart');
        } catch (\ErrorException $exception) {
            DB::rollback();
            return back()->with('error', $exception->getMessage());
        }
    }

    public function store(Request $request, GiftCertificate $certificate): Cart
    {
        try {
            $cart = new Cart();
            if(auth()->check()) {
                $cart->user_id = auth()->id();
            } else {
                if($request->hasCookie('shopping_busket')) {
                    $cookie = $request->cookie('shopping_busket');
                } else {
                    $cookie = Str::random(10);
                    Cookie::queue(Cookie::make('shopping_busket', $cookie, 2880)); //2 days cookie
                }
                $cart->cookie_id = $cookie;
            }
            $cart->quantity = 1;
            $cart->cartable_id = $certificate->id;
            $cart->cartable_type = GiftCertificate::class;
            $cart->price =  $request->amount;
            $cart->save();

            return $cart;

        } catch(QueryException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success'=> false
            ], 500);
        }
    }
}
