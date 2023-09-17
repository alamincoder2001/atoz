<?php

use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\Auth\FrontendLoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('website');
Route::get('/product', [HomeController::class, 'ProductShow'])->name('product');
Route::get('/product-single/{slug}', [HomeController::class, 'singleProductShow'])->name('single.product');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/technician', [HomeController::class, 'technician'])->name('technician');
Route::get('/technician-details/{id}', [HomeController::class, 'technicianDetails'])->name('technician.details');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// cart add route
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/addcart', [CartController::class, 'addCart'])->name('addcart');
Route::post('/updatecart', [CartController::class, 'updateCart'])->name('updatecart');
Route::post('/removecart', [CartController::class, 'removeCart'])->name('removecart');

// wishlist add route
Route::post('/addwishlist', [WishlistController::class, 'addWishlist'])->name('addwishlist');
Route::post('/deletewishlist', [WishlistController::class, 'deleteWishlist'])->name('deletewishlist');

//
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/place-order', [CheckoutController::class, 'CheckOut'])->name('place.order');

// Technician and customer login
Route::get('/login', [FrontendLoginController::class, 'showSignInForm'])->name('showSignInForm')->middleware('checkAuth');
Route::get('/register', [FrontendLoginController::class, 'showSignUpForm'])->name('showSignUpForm')->middleware('checkAuth');
Route::post('/customer-register', [FrontendLoginController::class, 'CustomerRegister'])->name('customer.register')->middleware('checkAuth');
Route::post('/customer-login', [FrontendLoginController::class, 'CustomerLogin'])->name('customer.login')->middleware('checkAuth');
Route::post('/technician-register', [FrontendLoginController::class, 'TechnicianRegister'])->name('technician.register')->middleware('checkAuth');
Route::post('/technician-login', [FrontendLoginController::class, 'TechnicianLogin'])->name('technician.login')->middleware('checkAuth');

// customer dashboard
Route::get("/customer-dashboard", [CustomerController::class, 'index'])->name('customer.dashboard');
Route::post("/customer-update", [CustomerController::class, 'update'])->name('customer.update');
Route::post("/customer-imageUpdate", [CustomerController::class, 'imageUpdate'])->name('customer.imageUpdate');
Route::get("/customer-logout", [CustomerController::class, 'logout'])->name('customer.logout');
Route::post("/customer-rating", [CustomerController::class, 'customerRating'])->name('customer.rating');
// order edit
Route::post("/order-edit", [CustomerController::class, 'OrderEdit'])->name('order.edit');
Route::post("/order-delete", [CustomerController::class, 'OrderDelete'])->name('order.delete');

// technician dashboard
Route::get("/technician-dashboard", [TechnicianController::class, 'index'])->name('technician.dashboard');
Route::post("/technician-update", [TechnicianController::class, 'update'])->name('technician.update');
Route::post("/technician-imageUpdate", [TechnicianController::class, 'imageUpdate'])->name('technician.imageUpdate');
Route::get("/technician-logout", [TechnicianController::class, 'logout'])->name('technician.logout');
Route::post("/filter-technician", [TechnicianController::class, 'filterTechnician'])->name('filter.technician');
// get data from database
Route::get("/getUpazila/{id}", [HomeController::class, "getUpazila"]);
Route::get('/setting/fetch', [HomeController::class, 'fetch'])->name('setting.fetch');
