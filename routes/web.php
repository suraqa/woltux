<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
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

// Homepage Route
Route::get('/', [PagesController::class, "index"]);

// Auth routes
Auth::routes();

// Products routes
Route::resource('product', ProductController::class);

// Cart routes
Route::get("/cart/add/{product}", [CartController::class, "add"])->name("cart.add");
Route::get("/cart/get", [CartController::class, "getCartItems"])->name("cart.get");
Route::delete("/cart/delete/{product}", [CartController::class, "deleteCartItem"])->name("cart.delete");
Route::get("/cart/show", [CartController::class, "showCart"])->name("cart.show");
Route::put("/cart/update/{product}", [CartController::class, "update"])->name("cart.update");

// Wishlist route
Route::get("/wishlist", [WishlistController::class, "index"])->name("wishlist.index");
Route::get("/wishlist/add/{product}", [WishlistController::class, "add"])->name("wishlist.add");
Route::put("/wishlist/update/{product}", [WishlistController::class, "update"])->name("wishlist.update");
Route::get("/wishlist/add/cart/{product}", [WishlistController::class, "addToCart"])->name("wishlist.addToCart");
Route::get("/wishlist/add-all", [WishlistController::class, "addAlltoCart"]);
Route::delete("/wishlist/delete/{product}", [WishlistController::class, "delete"]);
Route::delete("/wishlist/delete-all", [WishlistController::class, "deleteAll"]);


//Checkout route
Route::get("/checkout", [CheckoutController::class, "index"])->name("checkout");
Route::post("/checkout", [CheckoutController::class, "checkout"])->name("checkout.post");

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::post("/pay", function() {
//     return "done";
// });
