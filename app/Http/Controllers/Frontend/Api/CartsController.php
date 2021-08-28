<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Carts\AddToCartRequestValidation;
use App\Models\Cart;
use App\Models\GiftCertificate;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartsController extends Controller
{
    /**
     * @param AddToCartRequestValidation $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(AddToCartRequestValidation $request)
    {
        $cart = $this->store($request);
        $cookie = $cart->cookie_id;
        return response()->json([
            'data' => $cart,
            'no_of_products' => $this->getCartCount($request, $cookie),
            'success'=> true,
        ]);
    }

    /**
     * @param Request $request
     * @return Cart
     */
    public function store(Request $request): Cart
    {
        try {
            $product = $this->getProductDetail($request->product_id);

            if(auth()->check()) {
                $cart = Cart::where('user_id', auth()->id())->where('cartable_type', Product::class)->where('cartable_id', $request->product_id)->orderBy('id', 'desc')->first();
                if($cart) {
                    $cart->quantity += $request->quantity?$request->quantity:1;
                } else {
                    $cart = new Cart();
                    $cart->quantity = $request->quantity?$request->quantity:1;
                }
                $cart->user_id = auth()->id();
            } else {
                if($request->hasCookie('shopping_busket')) {
                    $cookie = $request->cookie('shopping_busket');

                    $cart = Cart::where('cookie_id', $cookie)->where('cartable_type', Product::class)->where('cartable_id', $request->product_id)->orderBy('id', 'desc')->first();
                    if($cart) {
                        $cart->quantity += $request->quantity?$request->quantity:1;
                    } else {
                        $cart = new Cart();
                        $cart->quantity = $request->quantity?$request->quantity:1;
                    }

                } else {
                    $cookie = Str::random(10);
                    Cookie::queue(Cookie::make('shopping_busket', $cookie, 2880)); //2 days cookie
                    $cart = new Cart();
                }

                $cart->cookie_id = $cookie;

            }

            $cart->cartable_id = $request->product_id;
            $cart->cartable_type = Product::class;
            $cart->price = $product->price;
            $cart->save();

            return $cart;

        } catch(QueryException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success'=> false
            ], 500);
        }
    }

    /**
     * @param $productId
     * @return Product
     */
    public function getProductDetail($productId): Product
    {
        try {
            return Product::find($productId);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Product not found!',
                'success'=> false
            ], 400);
        }
    }

    /**
     * @param Request $request
     * @return int
     */
    public function getCartCount(Request $request, $cookie = null)
    {
        $cartCount = 0;
        if(auth()->check()) {
            $cartCount = Cart::where('user_id', auth()->id())->count();
        } else {
            if($cookie) {
                $cartCount = Cart::where('cookie_id', $cookie)->count();
            } elseif ($request->hasCookie('shopping_busket')) {
                $cookie = $request->cookie('shopping_busket');
                $cartCount = Cart::where('cookie_id', $cookie)->count();
            } else {
                $cartCount = 0;
            }
        }

        if($request->has('wishlist')) {
            return response()->json([
                'cart_count' => $cartCount,
                'wishlist_count' => $this->getWishListCount($request),
                'success'=> true
            ], 200);
        } else {
            return $cartCount;
        }
    }

    /**
     * @param Request $request
     * @return int
     */
    public function getWishListCount(Request $request): int
    {
        if(auth()->check()) {
            return Wishlist::where('user_id', auth()->id())->count();
        } else {
            if($request->hasCookie('wishlist_busket')) {
                return Wishlist::where('cookie_id', $request->cookie('wishlist_busket'))->count();
            } else {
                return 0;
            }
        }
    }

    /**
     * @param $cartId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($cartId, Request $request)
    {
        try {
            if($cartId === 'all') {
                if(auth()->check()) {
                    Cart::where('user_id', auth()->id())->delete();
                } elseif($request->hasCookie('shopping_busket')) {
                    Cart::where('cookie_id', $request->cookie('shopping_busket'))->delete();
                }
            } else {
                $cart = Cart::findOrFail($cartId);
                $cart->delete();
            }

            return response()->json([
                'message' => 'Cart removed!',
                'success'=> true
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Cart not found!',
                'success'=> false
            ], 400);
        }
    }

    /**
     * @param $cartId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($cartId, Request $request)
    {
        try {
            $cart = Cart::findOrFail($cartId);
            $cart->quantity = $request->quantity;
            $cart->save();

            return response()->json([
                'data' => $cart,
                'success'=> true
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Cart not found!',
                'success'=> false
            ], 400);
        }
    }

    public function addGiftCertificate(Request $request)
    {
        $gift = GiftCertificate::paid()->where('gift_card_code', $request->gift_card_code)->select('available_balance','gift_card_code', 'amount')->first();
        if(!$gift) {
            if(auth()->check()) {
                Cookie::queue(Cookie::forget('_gft_au_'.auth()->id()));
            } else {
                Cookie::queue(Cookie::forget('_gft_au_'.$request->cookie('shopping_busket')));
            }
            return response()->json([
                'message' => 'invalid gift certificate',
                'success'=> false,
            ],400);
        }

        $gift->name = 'Gift Certificate $'.$gift->amount;
        $data = ['gift_card_code' => $gift->gift_card_code, 'available_balance'=> $gift->available_balance, 'name'=>'Gift Certificate $'.$gift->amount];

        if(auth()->check()) {
            Cookie::queue(Cookie::make('_gft_au_'.auth()->id(), json_encode($data), 30)); //15 mins
        } else {
            $cookieId = $request->cookie('shopping_busket');
            Cookie::queue(Cookie::make('_gft_au_'.$cookieId, json_encode($data), 30));
        }

        return response()->json([
            'data' => $gift,
            'success'=> true,
        ],200);
    }
}
