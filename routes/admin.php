<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GiftCertificateController;
use App\Http\Controllers\Admin\WholesaleController;
use App\Http\Controllers\Frontend\Web\OrdersController;
use App\Http\Controllers\NewsLetterSubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', function () {
            return view('auth.admin-login');
        })->name('login');
        Route::post('/login', [AuthController::class, 'store']);
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');


        Route::get('/category', [CategoryController::class, 'index'])->name('category');
        Route::get('/category/list', [CategoryController::class, 'getCategories'])->name('category.list');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::post('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('category.delete');

        Route::get('/product', [ProductController::class, 'index'])->name('product');
        Route::get('/product/related-data', [ProductController::class, 'getProductRelatedData']);
        Route::get('/product/list', [ProductController::class, 'getProducts'])->name('product.list');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
        Route::post('/product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('product.delete');

        Route::get('/order', [\App\Http\Controllers\Admin\OrdersController::class, 'index'])->name('order');

        Route::get('/event', [\App\Http\Controllers\Admin\EventsController::class, 'index'])->name('event');

        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::get('/contact/list', [ContactController::class, 'getContact']);
        Route::post('/contact/change-read', [ContactController::class, 'changeContactRead']);

        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/blog/list', [BlogController::class, 'getBlogs']);
        Route::post('/blog/store', [BlogController::class, 'store']);
        Route::post('/blog/update', [BlogController::class, 'update']);
        Route::delete('/blog/delete/{id}', [BlogController::class, 'delete']);

        Route::get('/gift-certificate', [GiftCertificateController::class, 'adminIndex'])->name('gift-certificate');
        Route::get('/gift-certificate/list', [GiftCertificateController::class, 'getGiftCertificates']);
        Route::put('/gift-certificate/update/{id}', [GiftCertificateController::class, 'updateGiftCertificate']);
        Route::delete('/gift-certificate/delete/{id}', [GiftCertificateController::class, 'deleteGiftCertificate']);

        Route::get('/wholesale', [WholesaleController::class, 'adminIndex'])->name('wholesale');
        Route::get('/wholesale/list', [WholesaleController::class, 'getWholesales']);
        Route::put('/wholesale/change-read', [WholesaleController::class, 'changeWholesaleRead']);

        Route::get('/subscription', [NewsLetterSubscriptionController::class, 'adminIndex'])->name('subscription');
        Route::get('/subscription/list', [NewsLetterSubscriptionController::class, 'getSubscriptions']);
        Route::put('/subscription/update', [NewsLetterSubscriptionController::class, 'update']);
        // order
        Route::put('/order/{id}', [OrdersController::class, 'updateOrder']);
        Route::delete('/order/{id}', [OrdersController::class, 'deleteOrder']);
    });
});

// only admin api
Route::prefix('api/v1/admin')->group(function () {
    Route::get('orders', [\App\Http\Controllers\Admin\Api\OrdersController::class, 'index']);
    Route::apiResource('events', \App\Http\Controllers\Admin\Api\EventsController::class);
});
