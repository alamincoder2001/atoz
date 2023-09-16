<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\TechnicianController as AdminTechnicianController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\Admin\ThanaContoller;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Auth\FrontendLoginController;
use App\Http\Controllers\Auth\LoginController;
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

// Admin Login Route
Route::group(["prefix" => "admin"], function () {
    Route::get('/', [LoginController::class, 'showAdminLoginForm']);
    Route::post('/', [LoginController::class, 'AdminLogin'])->name('admin.login');
    Route::get('/logout', [DashboardController::class, 'AdminLogout'])->name('admin.logout');

    // admin dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/get-profit', [DashboardController::class, 'getProfit'])->name('admin.getprofit');

    //profile Route
    Route::get('/profile', [DashboardController::class, 'profileIndex'])->name('admin.profile');
    Route::post('/profile', [DashboardController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::post('/profileImage', [DashboardController::class, 'imageUpdate'])->name('admin.profile.imageUpdate');
    //setting Route
    Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting');
    Route::post('/setting', [SettingController::class, 'updateSetting'])->name('admin.setting.store');
    Route::post('/logoUpdate', [SettingController::class, 'logoUpdate'])->name('admin.setting.logoUpdate');
    Route::post('/naviconUpdate', [SettingController::class, 'naviconUpdate'])->name('admin.setting.naviconUpdate');
    Route::post('/ownerimageUpdate', [SettingController::class, 'ownerimageUpdate'])->name('admin.setting.ownerimageUpdate');
    Route::post('/hotImageUpdate', [SettingController::class, 'hotImageUpdate'])->name('admin.setting.hotImageUpdate');

    // Website content route
    // Banner Route
    Route::get('/banner', [BannerController::class, 'index'])->name('admin.banner.index');
    Route::get('/banner/fetch/{id?}', [BannerController::class, 'fetch'])->name('admin.banner.fetch');
    Route::post('/banner', [BannerController::class, 'store'])->name('admin.banner.store');
    Route::post('/banner/delete', [BannerController::class, 'destroy'])->name('admin.banner.destroy');
    // Brand Route
    Route::get('/brand', [BrandController::class, 'index'])->name('admin.brand.index');
    Route::get('/brand/fetch/{id?}', [BrandController::class, 'fetch'])->name('admin.brand.fetch');
    Route::post('/brand', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::post('/brand/delete', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
    // Category Route
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/fetch/{id?}', [CategoryController::class, 'fetch'])->name('admin.category.fetch');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::post('/category/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    // Sub-Category Route
    Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('admin.subcategory.index');
    Route::get('/subcategory/fetch/{id?}', [SubcategoryController::class, 'fetch'])->name('admin.subcategory.fetch');
    Route::post('/subcategory', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::post('/subcategory/delete', [SubcategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
    // unit Route
    Route::get('/unit', [UnitController::class, 'index'])->name('admin.unit.index');
    Route::get('/unit/fetch/{id?}', [UnitController::class, 'fetch'])->name('admin.unit.fetch');
    Route::post('/unit', [UnitController::class, 'store'])->name('admin.unit.store');
    Route::post('/unit/delete', [UnitController::class, 'destroy'])->name('admin.unit.destroy');
    // partner Route
    Route::get('/partner', [PartnerController::class, 'index'])->name('admin.partner.index');
    Route::get('/partner/fetch/{id?}', [PartnerController::class, 'fetch'])->name('admin.partner.fetch');
    Route::post('/partner', [PartnerController::class, 'store'])->name('admin.partner.store');
    Route::post('/partner/delete', [PartnerController::class, 'destroy'])->name('admin.partner.destroy');
    // product Route
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/fetch/{id?}', [ProductController::class, 'fetch'])->name('admin.product.fetch');
    Route::post('/product', [ProductController::class, 'store'])->name('admin.product.store');
    Route::post('/product/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::get("product/published", [ProductController::class, 'published'])->name("admin.product.published");
    Route::post("product/published", [ProductController::class, 'savePublished'])->name("admin.product.savepublished");
    // Administration route

    // district Route
    Route::get('/district', [DistrictController::class, 'index'])->name('admin.district.index');
    Route::get('/district/fetch/{id?}', [DistrictController::class, 'fetch'])->name('admin.district.fetch');
    Route::post('/district', [DistrictController::class, 'store'])->name('admin.district.store');
    Route::post('/district/delete', [DistrictController::class, 'destroy'])->name('admin.district.destroy');
    // thana Route
    Route::get('/thana', [ThanaContoller::class, 'index'])->name('admin.thana.index');
    Route::get('/thana/fetch/{id?}', [ThanaContoller::class, 'fetch'])->name('admin.thana.fetch');
    Route::post('/thana', [ThanaContoller::class, 'store'])->name('admin.thana.store');
    Route::post('/thana/delete', [ThanaContoller::class, 'destroy'])->name('admin.thana.destroy');

    //order route
    Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/order-proccessing', [OrderController::class, 'proccessing'])->name('admin.order.proccessing');
    Route::get('/order-delivery', [OrderController::class, 'delivery'])->name('admin.order.delivery');
    Route::get('/order-canceled', [OrderController::class, 'canceled'])->name('admin.order.canceled');
    Route::post('/order/fetch', [OrderController::class, 'fetch'])->name('admin.order.fetch');
    Route::post('/order/status', [OrderController::class, 'changeStatus'])->name('admin.order.status');
    Route::post('/order/delete', [OrderController::class, 'destroy'])->name('admin.order.destroy');
    Route::get('/order/invoice/{invoice}', [OrderController::class, 'invoice'])->name('admin.order.invoice');
    Route::post('/order/update', [OrderController::class, 'update'])->name("admin.order.update");
    Route::get('/order/report', [OrderController::class, 'report'])->name("admin.order.report");
    Route::post('/order/commission', [OrderController::class, 'getCommission'])->name("admin.order.commission");
    // blog route
    Route::get('/blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('/blog/fetch/{id?}', [BlogController::class, 'fetch'])->name('admin.blog.fetch');
    Route::post('/blog', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::post('/blog/delete', [BlogController::class, 'destroy'])->name('admin.blog.destroy');

    // bank route
    Route::get('/bank', [BankController::class, 'index'])->name('admin.bank.index');
    Route::get('/bank/fetch/{id?}', [BankController::class, 'fetch'])->name('admin.bank.fetch');
    Route::post('/bank', [BankController::class, 'store'])->name('admin.bank.store');
    Route::post('/bank/delete', [BankController::class, 'destroy'])->name('admin.bank.destroy');

    // slider route
    Route::get('/slider', [SliderController::class, 'index'])->name('admin.slider.index');
    Route::get('/slider/fetch/{id?}', [SliderController::class, 'fetch'])->name('admin.slider.fetch');
    Route::post('/slider', [SliderController::class, 'store'])->name('admin.slider.store');
    Route::post('/slider/delete', [SliderController::class, 'destroy'])->name('admin.slider.destroy');

    // customer route
    Route::get('/customer', [AdminCustomerController::class, 'index'])->name("admin.customer.index");
    Route::get('/customer/delete/{id}', [AdminCustomerController::class, 'destroy'])->name("admin.customer.destroy");
    Route::post('/customer/status', [AdminCustomerController::class, 'status'])->name("admin.customer.status");
    Route::get('/customer/fetch/{id?}', [AdminCustomerController::class, 'fetch'])->name("admin.customer.fetch");

    // technician route
    Route::get('/technician', [AdminTechnicianController::class, 'index'])->name("admin.technician.index");
    Route::get('/technician/delete/{id}', [AdminTechnicianController::class, 'destroy'])->name("admin.technician.destroy");
    Route::post('/technician/status', [AdminTechnicianController::class, 'status'])->name("admin.technician.status");
    Route::get('/technician/fetch/{id?}', [AdminTechnicianController::class, 'fetch'])->name("admin.technician.fetch");
    Route::post('/technician/rating', [AdminTechnicianController::class, 'rating'])->name("admin.technician.rating");
});
