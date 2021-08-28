<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wishlists\AddToWishlistRequestValidation;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class WishlistsController extends Controller
{
    /**
     * @param AddToWishlistRequestValidation $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToWishlist(AddToWishlistRequestValidation $request)
    {
        return $this->store($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $cookie = null;
            if(auth()->check()) {
                $wList = Wishlist::where('user_id', auth()->id())->where('product_id', $request->product_id)->first();
                if($wList) {
                    return response()->json([
                        'message' => 'This product already exists to your wish list.',
                        'success'=> true,
                    ]);
                } else {
                    $wList = new Wishlist();
                }
                $wList->user_id = auth()->id();
            } else {
                if($request->hasCookie('wishlist_busket')) {
                    $cookie = $request->cookie('wishlist_busket');
                    $wList = Wishlist::where('cookie_id', $cookie)->where('product_id', $request->product_id)->first();
                    if($wList) {
                        return response()->json([
                            'message' => 'This product already exists to your wish list.',
                            'success'=> true,
                        ]);
                    } else {
                        $wList = new Wishlist();
                    }

                } else {
                    $cookie = Str::random(10);
                    Cookie::queue(Cookie::make('wishlist_busket', $cookie, 2880)); //2 days cookie
                    $wList = new Wishlist();
                }

                $wList->cookie_id = $cookie;
            }

            $wList->product_id = $request->product_id;
            $wList->save();

            return response()->json([
                'message' => 'Successfully added to wish list.',
                'success'=> true,
                'wishlist_count' => $this->getWishListCount($request, $cookie),
            ]);

        } catch(QueryException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success'=> false
            ], 500);
        }
    }


    /**
     * @param $wId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($wId, Request $request)
    {
        try {
            if($wId === 'all') {
                if(auth()->check()) {
                    Wishlist::where('user_id', auth()->id())->delete();
                } elseif($request->hasCookie('wishlist_busket')) {
                    Wishlist::where('cookie_id', $request->cookie('wishlist_busket'))->delete();
                }
            } else {
                $wList = Wishlist::findOrFail($wId);
                $wList->delete();
            }

            return response()->json([
                'message' => 'Item(s) removed from wish list!',
                'success'=> true
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Item not found!',
                'success'=> false
            ], 400);
        }
    }

    /**
     * @param Request $request
     * @return int
     */
    public function getWishListCount(Request $request, $cookie): int
    {
        if(auth()->check()) {
            return Wishlist::where('user_id', auth()->id())->count();
        } else {
            if($cookie) {
                return Wishlist::where('cookie_id', $cookie)->count();
            } else {
                return 0;
            }
        }
    }

}
