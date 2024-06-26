<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\controllers\ReviewController;
use App\Http\controllers\FavoriteController;
use App\Http\controllers\UserController;
use App\Http\controllers\CartController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/sendmail',[VerifyEmailController::class,'__invoke'])->name('verification.send');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::resource('products',ProductController::class);
// Route::post('reviews',[ReviewController::class,'store'])->name('reviews.store');

Route::middleware(['auth','verified'])->group(function(){
    Route::resource('products',ProductController::class);

    Route::post('reviews',[ReviewController::class,'store'])->name('reviews.store');

    Route::post('favorites/{product_id}',[FavoriteController::class,'store'])->name('favorites.store');
    Route::delete('favorites/{product_id}',[FavoriteController::class,'destroy'])->name('favorites.destroy');
});

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('products', ProductController::class);

//     Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

//     Route::post('favorites/{product_id}', [FavoriteController::class, 'store'])->name('favorites.store');
//     Route::delete('favorites/{product_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
// });
Route::controller(UserController::class)->group(function(){
    Route::get('users/mypage','mypage')->name('mypage');
    Route::get('users/mypage/edit','edit')->name('mypage.edit');
    Route::put('users/mypage','update')->name('mypage.update');
    Route::get('users/mypage/password/edit','edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password','update_password')->name('mypage.update_password');
    Route::get('users/mypage/favorite','favorite')->name('mypage.favorite');
});

Route::controller(CartController::class)->group(function(){
    Route::get('users/cart','index')->name('carts.index');
    Route::post('users/carts','store')->name('carts.store');
    Route::delete('users/carts','destroy')->name('carts.destroy');
});
