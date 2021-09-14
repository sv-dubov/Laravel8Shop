<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\AdminController;
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
});

Route::get('/user/logout', [MainUserController::class, 'logout'])->name('user.logout');
Route::get('/user/profile', [MainUserController::class, 'profile'])->name('user.profile');
Route::get('/user/profile/edit', [MainUserController::class, 'edit'])->name('profile.edit');
Route::post('/user/profile/store', [MainUserController::class, 'store'])->name('profile.store');
Route::get('/user/password/view', [MainUserController::class, 'passwordView'])->name('user.password.view');
Route::post('/user/profile/update', [MainUserController::class, 'passwordUpdate'])->name('password.update');

