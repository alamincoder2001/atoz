<?php

use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Auth\FrontendLoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('login', function(){
    return redirect('/');
});

Route::get('/', [HomeController::class, 'index'])->name('website');
Route::get('/services', [HomeController::class, 'ServiceShow'])->name('service.all');
Route::get('/service-single/{slug}', [HomeController::class, 'singleServiceShow'])->name('single.service');
Route::get('/category-wise/{slug}', [HomeController::class, 'categoryWiseServiceShow'])->name('category_wise.service');
Route::get('/checkout_page',[HomeController::class, 'checkoutPage'])->name('checkout.page');

Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/worker', [HomeController::class, 'worker'])->name('worker');
Route::get('/worker-details/{id}', [HomeController::class, 'workerDetails'])->name('worker.details');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// review
Route::post('/review-store', [ReviewController::class, 'storeReview']);

// find service by name
Route::post('/get_service', [HomeController::class, 'searchService']);

// get division wise district
Route::post('/get_district_name', [HomeController::class, 'getDistrict']);

// search service
// Route::post('/search/service', [HomeController::class, 'searchService'])->name('search.service');

// cart add route
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/addcart', [CartController::class, 'addCart'])->name('addcart');
Route::get('/getCartItems', [CartController::class, 'getCartItems']);
Route::post('/updatecart', [CartController::class, 'updateCart'])->name('updatecart');
Route::post('/removecart', [CartController::class, 'removeCart'])->name('removecart');

Route::post('/cart_modal_data', [CartController::class, 'cartModalData']);

// wishlist add route
Route::post('/addwishlist', [WishlistController::class, 'addWishlist'])->name('addwishlist');
Route::post('/deletewishlist', [WishlistController::class, 'deleteWishlist'])->name('deletewishlist');

//
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/place-order', [CheckoutController::class, 'CheckOut'])->name('place.order');

// worker and customer login
// Route::get('/login', [FrontendLoginController::class, 'showSignInForm'])->name('showSignInForm')->middleware('checkAuth');
Route::get('/register', [FrontendLoginController::class, 'showSignUpForm'])->name('showSignUpForm')->middleware('checkAuth');
Route::post('/customer-register', [FrontendLoginController::class, 'CustomerRegister'])->name('customer.register')->middleware('checkAuth');
Route::post('/customer-login', [FrontendLoginController::class, 'CustomerLogin'])->name('customer.login')->middleware('checkAuth');
Route::post('/worker-login', [FrontendLoginController::class, 'WorkerLogin'])->name('worker.login')->middleware('checkAuth');

// customer dashboard
Route::get("/customer-dashboard", [CustomerController::class, 'index'])->name('customer.dashboard');
Route::post("/customer-update", [CustomerController::class, 'update'])->name('customer.update');
Route::post("/customer-imageUpdate", [CustomerController::class, 'imageUpdate'])->name('customer.imageUpdate');
Route::get("/customer-logout", [CustomerController::class, 'logout'])->name('customer.logout');
Route::post("/customer-rating", [CustomerController::class, 'customerRating'])->name('customer.rating');
// order edit
Route::post("/order-edit", [CustomerController::class, 'OrderEdit'])->name('order.edit');
Route::post("/order-delete", [CustomerController::class, 'OrderDelete'])->name('order.delete');

// worker dashboard
Route::get("/worker-dashboard", [WorkerController::class, 'index'])->name('worker.dashboard');
Route::post("/worker-update", [WorkerController::class, 'update'])->name('worker.update');
Route::post("/worker-imageUpdate", [WorkerController::class, 'imageUpdate'])->name('worker.imageUpdate');
Route::get("/worker-logout", [WorkerController::class, 'logout'])->name('worker.logout');
Route::post("/filter-worker", [WorkerController::class, 'filterWorker'])->name('filter.worker');
Route::post("/order-status-update", [WorkerController::class, 'statusUpdate'])->name('workerorder.status.update');

// worker order view
Route::get('view-worker-order-details/{id}', [WorkerController::class, 'viewWorkerOrder']);

// get data from database
Route::get("/getUpazila/{id}", [HomeController::class, "getUpazila"]);
Route::get('/setting/fetch', [HomeController::class, 'fetch'])->name('setting.fetch');

// customer register page
Route::get('customer_register', [HomeController::class, 'customerRegister']);
