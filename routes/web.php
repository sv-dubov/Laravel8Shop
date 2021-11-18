<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishlistController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Newsletter Front
Route::post('newsletter/store', [FrontController::class, 'storeNewsletter'])->name('newsletter.store');

//Add Wishlist
Route::get('add/wishlist/{id}', [WishlistController::class, 'addWishlist']);

//Add to Cart
Route::get('add/tocart/{id}', [CartController::class, 'addCart']);
Route::get('check', [CartController::class, 'check']);
Route::get('show/cart', [CartController::class, 'showCart'])->name('show.cart');
Route::get('remove/cart/{rowId}', [CartController::class, 'removeFromCart']);
Route::post('update/cart/item/', [CartController::class, 'updateCartItem'])->name('update.cart-item');

Route::get('/cart/product/view/{id}', [CartController::class, 'viewProduct']);
Route::post('insert/tocart/', [CartController::class, 'insertCart'])->name('insert.to.cart');

Route::get('user/checkout/', [CartController::class, 'checkout'])->name('user.checkout');
Route::get('user/wishlist/', [CartController::class, 'wishlist'])->name('user.wishlist');

Route::post('user/apply/coupon/', [CartController::class, 'coupon'])->name('apply.coupon');
Route::get('user/remove/coupon/', [CartController::class, 'removeCoupon'])->name('remove.coupon');

Route::get('/product/details/{id}/{product_name}', [\App\Http\Controllers\ProductController::class, 'details']);
Route::post('/cart/product/add/{id}', [\App\Http\Controllers\ProductController::class, 'addCart']);

//Payment
Route::get('user/payment', [CartController::class, 'paymentIndex'])->name('payment.index');
Route::post('user/payment/process', [PaymentController::class, 'payment'])->name('payment.process');
Route::post('user/stripe/charge', [PaymentController::class, 'stripeCharge'])->name('stripe.charge');

//Products list page
Route::get('products/category/{id}', [\App\Http\Controllers\ProductController::class, 'productList']);

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('user.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile/{id}', [MainAdminController::class, 'profile'])->name('admin.profile');
Route::get('/admin/profile/edit/{id}', [MainAdminController::class, 'edit'])->name('admin.profile.edit');
Route::post('/admin/profile/store/{id}', [MainAdminController::class, 'store'])->name('admin.profile.store');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('/categories', CategoryController::class);
    Route::resource('/brands', BrandController::class)->except(['create', 'show']);
    Route::resource('/coupons', CouponController::class)->except(['create', 'show']);
    Route::get('/newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');
    Route::get('/newsletters/{id}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');
    Route::get('/products/all', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/add', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::post('/products/images/update/{id}', [ProductController::class, 'updateImages'])->name('products.update.images');
    Route::get('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/status/{id}', [ProductController::class, 'status'])->name('products.status');
});

Route::get('/user/logout', [MainUserController::class, 'logout'])->name('user.logout');
Route::get('/user/profile/edit', [MainUserController::class, 'edit'])->name('profile.edit')->middleware('verified');
Route::post('/user/profile/store', [MainUserController::class, 'store'])->name('profile.store')->middleware('verified');
Route::get('/user/password/view', [MainUserController::class, 'passwordView'])->name('user.password.view')->middleware('verified');
Route::post('/user/profile/update', [MainUserController::class, 'passwordUpdate'])->name('password.update')->middleware('verified');

