<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\MainUserController;
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

//Newsletter Front
Route::post('newsletter/store', [FrontController::class, 'storeNewsletter'])->name('newsletter.store');

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
Route::get('/user/profile', [MainUserController::class, 'profile'])->name('user.profile');
Route::get('/user/profile/edit', [MainUserController::class, 'edit'])->name('profile.edit');
Route::post('/user/profile/store', [MainUserController::class, 'store'])->name('profile.store');
Route::get('/user/password/view', [MainUserController::class, 'passwordView'])->name('user.password.view');
Route::post('/user/profile/update', [MainUserController::class, 'passwordUpdate'])->name('password.update');

