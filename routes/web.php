<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GiftCertificateController;
use App\Http\Controllers\Admin\WholesaleController;
use App\Http\Controllers\NewsLetterSubscriptionController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/email', function () {
    return view('emails.gift_certificate');
});

Route::group(array('prefix' => 'api/v1'), function() {
    Route::post('wishlists', [\App\Http\Controllers\Frontend\Api\WishlistsController::class, 'addToWishlist'])->name('api.wishlists.add');
    Route::delete('wishlists/{wishlist}', [\App\Http\Controllers\Frontend\Api\WishlistsController::class, 'destroy'])->name('api.wishlists.destroy');
    Route::post('carts', [\App\Http\Controllers\Frontend\Api\CartsController::class, 'addToCart'])->name('api.carts.add');
    Route::put('carts/{cart}', [\App\Http\Controllers\Frontend\Api\CartsController::class, 'update'])->name('api.carts.update');
    Route::delete('carts/{cart}', [\App\Http\Controllers\Frontend\Api\CartsController::class, 'destroy'])->name('api.carts.destroy');
    Route::get('carts/count', [\App\Http\Controllers\Frontend\Api\CartsController::class, 'getCartCount'])->name('api.carts.count');
    Route::post('carts/gift-certificate', [\App\Http\Controllers\Frontend\Api\CartsController::class, 'addGiftCertificate'])->name('api.carts.gift_cert');
    Route::post('gifts/balance-check', [\App\Http\Controllers\Frontend\Api\GiftsController::class, 'checkGiftCardBalance'])->name('api.gifts.balance');
});

Route::group(array('prefix' => 'forms'), function() {
    Route::post('/newsletter', 'App\Http\Controllers\FormsController@subscribeToNewsletter');
    Route::post('/contact_us', 'App\Http\Controllers\FormsController@contactUs');
    Route::post('/review', 'App\Http\Controllers\FormsController@review');
    Route::post('/payment', 'App\Http\Controllers\FormsController@payment');
    Route::post('/register_for_event', 'App\Http\Controllers\FormsController@register_for_event');
    Route::post('/add_address', 'App\Http\Controllers\FormsController@add_address');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});


Route::get('/',[SiteController::class, 'home'])->name('home');
Route::get('/category',[SiteController::class, 'viewCategoryProducts'])->name('category.products');
Route::get('/product/{id}',[SiteController::class, 'viewProductDetails'])->name('product.details');
Route::post('/product/add-reviews/{id}',[SiteController::class, 'storeProductReviews'])->name('product.store.reviews');

// for contact
Route::post('/save-contact',[ContactController::class,'saveContact']);

Route::get('/contact_us', function () {
    return view('site.contact_us');
});

Route::get('/about', function () {
    return view('site.about');
});

Route::get('/wholesale', [WholesaleController::class,'index']);
Route::post('/save-wholesale', [WholesaleController::class,'store']);
Route::post('/save-subscription', [NewsLetterSubscriptionController::class,'store']);

Route::get('/shipping', function () {
    return view('site.shipping');
});

Route::get('/blog',[BlogController::class,'getAllBlog']);

Route::get('/blog/details/{id}', [BlogController::class,'getBlogDetails']);

Route::get('/cart', [\App\Http\Controllers\Frontend\Web\CartsController::class, 'index']);

Route::post('/orders', [\App\Http\Controllers\Frontend\Web\OrdersController::class, 'store'])->middleware('auth')->name('orders.store');
Route::post('/orders/{id}/payment', [\App\Http\Controllers\Frontend\Web\OrdersController::class, 'payment'])->middleware('auth')->name('orders.payment');
Route::get('/cart/shipping', [\App\Http\Controllers\Frontend\Web\CartsController::class, 'checkout']);
Route::post('/cart/gift', [\App\Http\Controllers\Frontend\Web\CartsController::class, 'giftAddToCart'])->name('carts.gift');


Route::get('/cart/payment', [\App\Http\Controllers\Frontend\Web\CartsController::class, 'payment'])->middleware('auth');

Route::get('/gift',[GiftCertificateController::class,'index'])->name('gift');
//Route::post('/gift/store',[GiftCertificateController::class,'store'])->name('gift.store')->middleware('auth');
Route::get('/gift/redeem', function () {
    return view('site.gift_redeem');
});
Route::get('/gift/balance', function () {
    return view('site.gift_balance');
});
Route::get('/education', function () {
    return view('site.education');
});
Route::get('/education/event', function () {
    return view('site.education_event');
});
Route::get('/search', [\App\Http\Controllers\Frontend\Web\SearchController::class, 'index']);

//Route::get('/login', function () {
//    return view('auth.login');
//});
//Route::get('/register', function () {
//    return view('auth.register');
//});

Route::get('/dashboard', function () {
    return view('dashboard.personal');
})->middleware('auth')->name('dashboard');

Route::get('/dashboard/address',[UserController::class, 'addressView'])->middleware('auth')->name('dashboard.address');

Route::get('/dashboard/wishlist', [\App\Http\Controllers\Frontend\Web\WishlistsController::class, 'index'])->middleware('auth')->name('dashboard.wishlist');

Route::get('/dashboard/recent', [UserController::class, 'recentProducts'])->middleware('auth')->name('dashboard.recent');

Route::get('/dashboard/events', function () {
    return view('dashboard.events');
})->middleware('auth')->name('dashboard.events');


Route::get('/dashboard/address/new', function () {
    return view('dashboard.address_new');
})->middleware('auth')->name('dashboard.address_new');

Route::post('/dashboard/address/new', [UserController::class, 'addNewAddress'])->middleware('auth')->name('dashboard.new_address');

Route::get('/dashboard/address/edit/{id}', [UserController::class, 'editAddress'])->middleware('auth')->name('dashboard.address_edit');
Route::post('/dashboard/address/edit/{id}', [UserController::class, 'updateAddress'])->middleware('auth')->name('dashboard.edit_address');
Route::post('/dashboard/address/delete/{id}', [UserController::class, 'deleteAddress'])->middleware('auth')->name('dashboard.delete_address');
Route::post('/dashboard/newsletter-subscription/update', [UserController::class, 'updateNewsletterSubscription'])->middleware('auth')->name('users.newsletter_subscription');


Route::get('/dashboard/orders', [\App\Http\Controllers\Frontend\Web\OrdersController::class, 'index'])->middleware('auth')->name('dashboard.orders');
Route::get('/dashboard/orders/{uid}', [\App\Http\Controllers\Frontend\Web\OrdersController::class, 'show'])->middleware('auth');

//Route::get('/dashboard/orders/order', function () {
//    return view('dashboard.order');
//})->middleware('auth')->name('dashboard.order');


Route::get('/soon', function () {
    return view('site.soon');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
