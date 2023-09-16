<?php

namespace App\Providers;

use App\District;
use App\Models\BankAccount;
use App\Models\Brand;
use App\Models\Setting;
use App\Thana;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::share("profile", Setting::first());
        View::share("brand", Brand::latest()->get());
        View::share("category", Setting::latest()->get());
        View::share("districts", District::orderBy("name", "ASC")->get());
        View::share("upazilas", Thana::orderBy("name", "ASC")->get());
        View::share("bank", BankAccount::where("status", "a")->take(2)->get());
        Schema::defaultStringLength(191);
    }
}
