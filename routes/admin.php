<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ThanaContoller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAccessController;

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

    // Category Route
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/fetch/{id?}', [CategoryController::class, 'fetch'])->name('admin.category.fetch');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::post('/category/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    // partner Route
    Route::get('/partner', [PartnerController::class, 'index'])->name('admin.partner.index');
    Route::get('/partner/fetch/{id?}', [PartnerController::class, 'fetch'])->name('admin.partner.fetch');
    Route::post('/partner', [PartnerController::class, 'store'])->name('admin.partner.store');
    Route::post('/partner/delete', [PartnerController::class, 'destroy'])->name('admin.partner.destroy');

    // service Route
    Route::get('/service', [ServiceController::class, 'index'])->name('admin.service.index');
    Route::get('/service/fetch/{id?}', [ServiceController::class, 'fetch'])->name('admin.service.fetch');
    Route::post('/service', [ServiceController::class, 'store'])->name('admin.service.store');
    Route::post('/service/delete', [ServiceController::class, 'destroy'])->name('admin.service.destroy');
    Route::get("service/published", [ServiceController::class, 'published'])->name("admin.service.published");
    Route::post("service/published", [ServiceController::class, 'savePublished'])->name("admin.service.savepublished");
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

    //user Route
    Route::get('/user', [AdminAccessController::class, 'create'])->name('admin.user.create');
    Route::get('/get-user/{id?}', [AdminAccessController::class, 'index'])->name('admin.user.index');
    Route::post('/user', [AdminAccessController::class, 'store'])->name('admin.user.store');
    Route::post('/update/user', [AdminAccessController::class, 'update'])->name('admin.user.update');
    Route::post('/user/delete', [AdminAccessController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/user/permission/{id}', [AdminAccessController::class, 'permissionEdit'])->name('admin.user.permission');
    Route::post('/user/store-permission', [AdminAccessController::class, 'permissionStore'])->name('admin.store.permission');
});
