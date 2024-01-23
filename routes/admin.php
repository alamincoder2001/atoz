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
use App\Http\Controllers\Admin\AreaManagerController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PaymentCollectionController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\HowToOrderController;
use App\Http\Controllers\WorkerCommissionController;

// Admin Login Route
Route::group(["prefix" => "admin"], function () {
    Route::get('/', [LoginController::class, 'showAdminLoginForm']);
    Route::post('/', [LoginController::class, 'AdminLogin'])->name('admin.login');
    Route::get('/logout', [DashboardController::class, 'AdminLogout'])->name('admin.logout');

    // admin dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/get-profit', [DashboardController::class, 'getProfit'])->name('admin.getprofit');

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
    // Administration route

    // district Route
    Route::get('/district', [DistrictController::class, 'index'])->name('admin.district.index');
    Route::get('/district/fetch/{id?}', [DistrictController::class, 'fetch'])->name('admin.district.fetch');
    Route::post('/district', [DistrictController::class, 'store'])->name('admin.district.store');
    Route::post('/district/delete', [DistrictController::class, 'destroy'])->name('admin.district.destroy');

    // How To Order
    Route::get('how-to-order', [HowToOrderController::class, 'howToOrder'])->name('admin.howto.order');
    Route::post('how-to-order', [HowToOrderController::class, 'howToOrderUpdate']);

    // thana Route
    Route::get('/thana', [ThanaContoller::class, 'index'])->name('admin.thana.index');
    Route::get('/thana/fetch/{id?}', [ThanaContoller::class, 'fetch'])->name('admin.thana.fetch');
    Route::post('/thana', [ThanaContoller::class, 'store'])->name('admin.thana.store');
    Route::post('/thana/delete', [ThanaContoller::class, 'destroy'])->name('admin.thana.destroy');

    //order route
    Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::post('/get-orderDetails', [OrderController::class, 'orderDetails'])->name('admin.order.detail');
    Route::get('/order-assign', [OrderController::class, 'assign'])->name('admin.order.assign');
    Route::post('/order/assign-worker', [OrderController::class, 'assignWorker'])->name('admin.order.assignworker');
    Route::get('/order-delivery', [OrderController::class, 'delivery'])->name('admin.order.delivery');
    Route::get('/order-canceled', [OrderController::class, 'canceled'])->name('admin.order.canceled');
    Route::post('/order/fetch', [OrderController::class, 'fetch'])->name('admin.order.fetch');
    Route::post('/order/delete', [OrderController::class, 'destroy'])->name('admin.order.destroy');
    Route::get('/order/invoice/{invoice}', [OrderController::class, 'invoice'])->name('admin.order.invoice');
    Route::get('/order/report', [OrderController::class, 'report'])->name("admin.order.report");

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
    Route::get('/customer', [CustomerController::class, 'index'])->name("admin.customer.index");
    Route::get('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name("admin.customer.destroy");
    Route::post('/customer/status', [CustomerController::class, 'status'])->name("admin.customer.status");
    Route::get('/customer/fetch/{id?}', [CustomerController::class, 'fetch'])->name("admin.customer.fetch");

    // worker route
    Route::get('/worker/assign-service', [WorkerController::class, 'assignService'])->name("admin.worker.assignservice");
    Route::get('/worker/list', [WorkerController::class, 'list'])->name("admin.worker.list");
    Route::get('/worker', [WorkerController::class, 'create'])->name("admin.worker.create");

    Route::get('/pending_worker', [WorkerController::class, 'pendingWorker'])->name('admin.worker.pending.list');
    Route::get('/get_pending_worker', [WorkerController::class, 'getPendingWorker']);
    Route::match(['get', 'post'], '/get_active_worker', [WorkerController::class, 'getActiveWorker']);
    Route::get('/worker-assign-order', [WorkerController::class, 'workerAssignOrder']);

    Route::get('/get-worker/{id?}', [WorkerController::class, 'index'])->name("admin.worker.index");
    Route::post('/worker', [WorkerController::class, 'store'])->name("admin.worker.store");
    // Route::get('/worker/delete/{id}', [WorkerController::class, 'destroy'])->name("admin.worker.destroy");
    Route::post('/worker/delete', [WorkerController::class, 'destroy'])->name("admin.worker.destroy");
    Route::post('/worker/change_status', [WorkerController::class, 'workerStatus'])->name("admin.worker.changeStatus");
    Route::post('/update/worker', [WorkerController::class, 'update'])->name('admin.worker.update');
    Route::post('/worker/status', [WorkerController::class, 'status'])->name("admin.worker.status");
    Route::get('/worker/fetch/{id?}', [WorkerController::class, 'fetch'])->name("admin.worker.fetch");
    Route::post('/worker/rating', [WorkerController::class, 'rating'])->name("admin.worker.rating");
    Route::post('/worker/assignwork-status-change', [WorkerController::class, 'statusChange'])->name("admin.worker.status.change");
    // worker wise report
    Route::get('/worker/wise/report/{id}', [WorkerController::class, 'workerWiseReport']);

    //user Route
    Route::get('/user', [AdminAccessController::class, 'create'])->name('admin.user.create');
    Route::get('/get-user/{id?}', [AdminAccessController::class, 'index'])->name('admin.user.index');
    Route::post('/user', [AdminAccessController::class, 'store'])->name('admin.user.store');
    Route::post('/update/user', [AdminAccessController::class, 'update'])->name('admin.user.update');
    Route::post('/user/delete', [AdminAccessController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/user/permission/{id}', [AdminAccessController::class, 'permissionEdit'])->name('admin.user.permission');
    Route::post('/user/store-permission', [AdminAccessController::class, 'permissionStore'])->name('admin.store.permission');

    //manager Route
    Route::get('/manager', [AreaManagerController::class, 'create'])->name('admin.manager.create');
    Route::get('/manager/list', [AreaManagerController::class, 'list'])->name('admin.manager.list');
    Route::get('/get-manager/{id?}', [AreaManagerController::class, 'index'])->name('admin.manager.index');
    Route::post('/manager', [AreaManagerController::class, 'store'])->name('admin.manager.store');
    Route::post('/update/manager', [AreaManagerController::class, 'update'])->name('admin.manager.update');
    Route::post('/manager/delete', [AreaManagerController::class, 'destroy'])->name('admin.manager.destroy');
    Route::get('/manager/wise/worker/report/{id}', [AreaManagerController::class, 'getManagerWiseWorkerReport']);

    // commission Route
    Route::get('/commission-list', [CommissionController::class, 'list'])->name('admin.commission.list');
    Route::post('/commission-fetch', [CommissionController::class, 'fetch'])->name('admin.commission.fetch');
    Route::post('/pay-commission', [CommissionController::class, 'payCommission'])->name('admin.pay.commission');
    Route::post('/order/commission', [CommissionController::class, 'getCommission'])->name("admin.order.commission");

    // payment collection
    Route::get('/payment-collection', [PaymentCollectionController::class, 'index'])->name('admin.payment.collection');
    Route::get('/get-worker-payment', [PaymentCollectionController::class, 'getPayment']);
    Route::get('/get-workers-withDueAmount', [PaymentCollectionController::class, 'getWorkerWithDueAmount']);
    Route::post('/worker/store/payment-collection', [PaymentCollectionController::class, 'storePayment']);
    Route::post('/worker/delete/payment-collection', [PaymentCollectionController::class, 'deletePayment']);
    Route::get('/worker/payment-receive/{id}', [PaymentCollectionController::class, 'paymentReceive']);

    Route::get('worker/commission', [WorkerCommissionController::class, 'index'])->name('admin.worker.commission');
    Route::get('/get-worker-commission', [WorkerCommissionController::class, 'getCommission']);
    Route::get('/get-workers-with-commission', [WorkerCommissionController::class, 'getWorkerWithCommission']);
    Route::post('/worker/commission-store', [WorkerCommissionController::class, 'storeWorkerCommission']);
    Route::get('/worker/commission-receive/{id}', [WorkerCommissionController::class, 'commissionReceive']);
    Route::post('/worker/delete/commission', [WorkerCommissionController::class, 'deleteWorkerCommission']);
    Route::get('/due-worker-list', [WorkerCommissionController::class, 'dueListWorker'])->name('admin.due.worker');

    // Order Due add by area manager
    Route::post('/order/add-due', [OrderController::class, 'dueAdd']);
});
