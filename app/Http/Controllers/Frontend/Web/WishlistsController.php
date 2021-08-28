<?php

namespace App\Http\Controllers\Frontend\Web;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistsController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', auth()->id())->paginate(10);
        return view('dashboard.wishlist')->with('wishlists', $wishlists);
    }
}
