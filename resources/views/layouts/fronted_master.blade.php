<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links of CSS files -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/odometer.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

    {{-- toastify --}}
    <link rel="stylesheet" href="{{asset('css/toastify.min.css')}}">
    <script src="{{asset('js/toastify.min.js')}}"></script>
    {{--end toastify --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>@yield('front_title') | A2Z Services</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png"
        href="{{ asset($profile->navicon != null ? $profile->navicon : 'noImage.jpg') }}">

    <style>
        .a2z_service-nav .navbar .others-option .option-item .cart-btn a span {
            background-color: #a24af3 !important;
        }

        .nav-link {
            color: rgba(0, 0, 0, .9) !important;
        }

        .main-search-wrap form .form-group .nice-select .list .option.selected {
            background-color: #a24af3 !important;
        }

        .main-search-wrap form .form-group .nice-select::after {
            border-color: #a24af3 !important;
        }

        .main-search-wrap form .form-group .nice-select::after {
            border-color: #a24af3 !important;
        }

        i {
            color: #7b3edb !important;
        }

        footer .footer-bottom-area {
            background-color: rgba(0, 0, 0, .05) !important;
            padding: 23px 0 !important;
            width: 100% !important;
        }

        .footer-area {
            padding-top: 50px !important;
        }

        .locationName {
            color: #323334 !important;
            font-weight: 900;
            letter-spacing: 1px;
            margin-left: 5px;
            font-size: 17px;
        }

        /* searchbar */
        .input-search {
            height: 25px;
            min-height: 40px;
            border-radius: 5px;
            border: 1px solid #8080809e;
            padding: 20px 5px;
            width: 495px;
        }

        .searchbtn {
            position: relative !important;
            top: 5px !important;
            right: -3.5px !important;
            background-color: #ce5cf6;
            border: none;
            border-radius: 0px !important;
            height: 41px !important;
            width: 41px;
            margin-left: -45px;
            padding: 3px 7px 9px 7px;
        }

        .go-top:hover {
            background-color: #7f00ff73 !important;
        }

        /* custom modal */
        .btn-close {
            color: #9307cb;
            opacity: 1;
        }

        .btn-close:hover {
            color: #9307cb;
            opacity: 1;
        }

        .btn-success {
            color: #fff !important;
            background-color: #ac51f0 !important;
            border-color: #d75bf5 !important;
        }

        .btn-success:hover+.btn-success:active+.btn-success:focus {
            color: #fff !important;
            background-color: #ac51f0 !important;
            border: 1px solid #d75bf5 !important;
        }

        .btn-check:active+.btn-success:focus,
        .btn-check:checked+.btn-success:focus,
        .btn-success.active:focus,
        .btn-success:active:focus,
        .show>.btn-success.dropdown-toggle:focus {
            box-shadow: 0 0 0 0.25rem rgb(172 81 240) !important;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .btn-check:focus+.btn-success,
        .btn-success:focus {
            box-shadow: 0 0 0 0.25rem rgb(178 92 243) !important;
        }

        .otherOptionBTN:hover {
            background-color: #ac51f054 !important;
            color: #9307cb !important;
        }

        .loginSignupBTN {
            color: #ac51f0 !important;
            border-color: #ac51f0 !important;
            height: 28px !important;
            padding: 0 5px !important;
            margin-left: 5px !important;
        }

        .loginSignupBTN:hover {
            color: white !important;
            background-color: #ac51f0;
            border-color: #ac51f0 !important;
        }

        .loginSignupBTN:focus {
            box-shadow: 0 0 0 0.25rem rgb(172 81 240 / 28%) !important;
        }

        button:disabled,
        button[disabled] {
            cursor: not-allowed !important;
        }

        .csearch {
            border: 1px solid #7b3edb !important;
            border-radius: 5px !important;
            color: rgba(0, 0, 0, .8) !important;
            background-color: #ffffff !important;
        }

        .list-group-item {
            border: 1px solid rgb(123 62 219 / 10%) !important;
        }

        /* btn-primary */
        .btn-check:focus+.btn-primary,

        .btn-primary:focus {
            box-shadow: none !important;
        }
        .btn.disabled,
        .btn:disabled,
        fieldset:disabled .btn {
            pointer-events: all !important;
            opacity: .75 !important;
            cursor: not-allowed !important;
        }

        .btn-outline-primary { background-color: #9307cb !important; color: white; border: 1px solid !important; }
        .btn-outline-primary:focus{ box-shadow: none !important;}

        /* custom */
        .fs-13{ font-size: 13px !important; }
        .fs-13-c{font-size: 13px; color: #585555; }


        /* ==================== custom overflow for cart modal ======================= */
        div.cartItems {
            height: 50vh !important;
            overflow-x: hidden !important;
            overflow-y: auto !important;
        }

        .cartItems::-webkit-scrollbar
        {
          width: 1px;
          /* background-color: #9307cb; */
        }
        .cartItems::-webkit-scrollbar-thumb
        {
          background-color: #9307cb;
          border: 2px solid #9307cb;
        }

        div.serviceSingleTop,div.serviceList{
            height: 57vh !important;
            overflow-x: hidden !important;
            overflow-y: auto !important;
        }

        .serviceSingleTop::-webkit-scrollbar
        {
          width: 1px;
        }
        .serviceList::-webkit-scrollbar
        {
          width: 1px;
        }

        .serviceList::-webkit-scrollbar-thumb
        {
          background-color: #9307cb;
          border: 2px solid #9307cb;
        }
        .serviceSingleTop::-webkit-scrollbar-thumb
        {
          background-color: #9307cb;
          border: 2px solid #9307cb;
        }
        /* ====================End custom overflow for cart modal ======================= */

        /*===================== Header cart items ======================================= */
            .dropbtn {
                padding: 16px;
                font-size: 16px;
                border: none;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #ffffff;
                min-width: 250px;
                overflow: hidden;
                box-shadow: 0px 8px 16px 0px rgba(255, 0, 242, 0.2);
                z-index: 1;
            }

            .dropdown-content a {
                color: #9307cb;;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }
            .dropdown-content a:hover {background-color: #ddd;}
            .dropdown:hover .dropdown-content {display: block;}
        /*=====================End Header cart items =====================================*/

    </style>

    @stack('front_style')
</head>

<body>

    <!-- Start Header Area -->
    <header class="header-area">

        {{-- <div class="top-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12">
                            <ul class="header-contact-info">
                                <li>Welcome to a2z_service</li>
                                <li>Call: <a href="tel:+01321654214">+01 321 654 214</a></li>
                                <li>
                                    <div class="dropdown language-switcher d-inline-block">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ asset('frontend/assets/img/us-flag.jpg') }}" alt="image">
                                            <span>Eng <i class='bx bx-chevron-down'></i></span>
                                        </button>

                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item d-flex align-items-center">
                                                <img src="assets/img/germany-flag.jpg" class="shadow-sm" alt="flag">
                                                <span>Ger</span>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex align-items-center">
                                                <img src="assets/img/france-flag.jpg" class="shadow-sm" alt="flag">
                                                <span>Fre</span>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex align-items-center">
                                                <img src="assets/img/spain-flag.jpg" class="shadow-sm" alt="flag">
                                                <span>Spa</span>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex align-items-center">
                                                <img src="assets/img/russia-flag.jpg" class="shadow-sm" alt="flag">
                                                <span>Rus</span>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex align-items-center">
                                                <img src="assets/img/italy-flag.jpg" class="shadow-sm" alt="flag">
                                                <span>Ita</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="top-header-discount-info">
                                <p><strong>50% OFF</strong> all new directory! <a href="listing-1.html">Discover Now!</a></p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <ul class="header-top-menu">
                                <li><a href="login.html"><i class='bx bxs-user'></i> My Account</a></li>
                                <li><a href="#"><i class='bx bx-plus-circle'></i> Add Listing</a></li>
                                <li><a href="register.html"><i class='bx bx-log-in-circle'></i> Register</a></li>
                                <li><a href="login.html"><i class='bx bx-log-in'></i> Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}

        <!-- Start Navbar Area -->
        <div class="navbar-area">
            <div class="a2z_service-responsive-nav">
                <div class="container">
                    <div class="a2z_service-responsive-menu">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                @if (isset($profile->logo))
                                    <img src="{{ asset($profile->logo) }}" alt="logo"
                                        style="width: 115px; height: 45px;">
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="a2z_service-nav"
                @if (request()->segment(1) == '') style="background-color: white !important;" @else style="background-color: white !important;box-shadow: 0px 3px 20px 0px #dbdbdb;" @endif>
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-md navbar-fixed-top navbar-light">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{-- <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="logo"> --}}
                            @if (isset($profile->logo))
                                <img src="{{ asset($profile->logo) }}" alt="logo"
                                    style="width: 115px; height: 45px;">
                            @endif
                        </a>

                        @if (request()->segment(1) != '')
                            <a class="navbar-brand d-flex" href="javascript:void(0)" onclick="locationModal()">
                                <span>
                                    <i class='bx bx-map'style="font-size: 25px; font-weight: bold;"></i>
                                </span>
                                <span class="locationName mt-1">Dhaka</span>
                            </a>
                        @endif

                        <div class="collapse navbar-collapse mean-menu">

                            @if (request()->segment(1) != '')
                                <div class="search-overlay-form navbar-nav">
                                    <form>
                                        <input type="text" class="input-search findService" placeholder="Search here...">
                                        <button type="submit" class="searchbtn">
                                            <i class="bx bx-search-alt"
                                            style="font-size: 25px;color: white !important;margin: 1px 0 0 0;padding-top: 5px;"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif

                            <ul class="navbar-nav">
                                @if (request()->segment(1) == '')
                                    {{-- <li class="nav-item">
                                        <a href="#" class="nav-link">AC Repaire <i
                                                class='bx bx-chevron-down'></i></a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a href="listing-1.html" class="nav-link">Listing
                                                    Layout 1</a></li>

                                            <li class="nav-item"><a href="listing-2.html" class="nav-link">Listing
                                                    Layout 2</a></li>

                                            <li class="nav-item"><a href="listing-3.html" class="nav-link">Listing
                                                    Layout 3</a></li>

                                            <li class="nav-item"><a href="listing-4.html" class="nav-link">Listing
                                                    Layout 4</a></li>

                                            <li class="nav-item"><a href="listing-5.html" class="nav-link">Listing
                                                    Layout 5</a></li>

                                            <li class="nav-item"><a href="single-listing.html" class="nav-link">Listing
                                                    Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item"><a href="#" class="nav-link">Appliance Repaire <i
                                                class='bx bx-chevron-down'></i></a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a href="listing-1.html" class="nav-link">Listing
                                                    Layout 1</a></li>

                                            <li class="nav-item"><a href="listing-2.html" class="nav-link">Listing
                                                    Layout 2</a></li>

                                            <li class="nav-item"><a href="listing-3.html" class="nav-link">Listing
                                                    Layout 3</a></li>

                                            <li class="nav-item"><a href="listing-4.html" class="nav-link">Listing
                                                    Layout 4</a></li>

                                            <li class="nav-item"><a href="listing-5.html" class="nav-link">Listing
                                                    Layout 5</a></li>

                                            <li class="nav-item"><a href="single-listing.html"
                                                    class="nav-link">Listing Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item"><a href="#" class="nav-link">Beauty & Wellness <i
                                                class='bx bx-chevron-down'></i></a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a href="listing-1.html" class="nav-link">Listing
                                                    Layout 1</a></li>

                                            <li class="nav-item"><a href="listing-2.html" class="nav-link">Listing
                                                    Layout 2</a></li>

                                            <li class="nav-item"><a href="listing-3.html" class="nav-link">Listing
                                                    Layout 3</a></li>

                                            <li class="nav-item"><a href="listing-4.html" class="nav-link">Listing
                                                    Layout 4</a></li>

                                            <li class="nav-item"><a href="listing-5.html" class="nav-link">Listing
                                                    Layout 5</a></li>

                                            <li class="nav-item"><a href="single-listing.html"
                                                    class="nav-link">Listing Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item"><a href="#" class="nav-link">Men's Care & Salon <i
                                                class='bx bx-chevron-down'></i></a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a href="listing-1.html" class="nav-link">Listing
                                                    Layout 1</a></li>

                                            <li class="nav-item"><a href="listing-2.html" class="nav-link">Listing
                                                    Layout 2</a></li>

                                            <li class="nav-item"><a href="listing-3.html" class="nav-link">Listing
                                                    Layout 3</a></li>

                                            <li class="nav-item"><a href="listing-4.html" class="nav-link">Listing
                                                    Layout 4</a></li>

                                            <li class="nav-item"><a href="listing-5.html" class="nav-link">Listing
                                                    Layout 5</a></li>

                                            <li class="nav-item"><a href="single-listing.html"
                                                    class="nav-link">Listing Details</a></li>
                                        </ul>
                                    </li> --}}
                                    {{-- {{ dd($category->name) }} --}}
                                    @foreach (App\Models\Category::latest()->get() as $key => $cate)
                                        <li class="nav-item">
                                            <a href="{{ route('category_wise.service', $cate->slug) }}" class="nav-link">
                                                {{ $cate->name }}
                                            </a>
                                        </li>
                                        @if($key == 6)
                                            @break
                                        @endif
                                    @endforeach
                                @endif
                                {{-- <li class="nav-item"><a href="" class="nav-link" style="color: rgba(0,0,0,.9);">Blog</a></li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('service.all') }}" class="nav-link">All Services</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('worker') }}" class="nav-link">Worker</a>
                                </li>
                            </ul>

                            {{-- if customer logged  --}}
                            <div class="others-option">
                                <div class="d-flex align-items-center">

                                    @auth
                                        <div class="cart-btn dropdown">
                                            <a href="javascript:void(0)" class="dropbtn">
                                                <i class='bx bx-shopping-bag' style="font-size: 35px !important;"></i>
                                                <sup class="fs-6 fw-bold cartValues">0</sup>
                                            </a>
                                            <div class="dropdown-content">
                                                <div class="cartBagItems row mb-2">   </div>
                                                <div class="row cartBagCheckoutBtn">
                                                    <div class="col-12">
                                                        @auth
                                                            <a href="{{ url('checkout_page') }}"
                                                                style="color: white !important;background: #9307cb;padding: 1px;text-align: center;">
                                                                Proceed To Checkout &nbsp; <i class='bx bxs-chevrons-right' style="color: #fbfafc !important;"></i>
                                                            </a>
                                                            @else
                                                                <a href="javascript:void(0)" onclick="showLoginRegisterOption()"
                                                                    style="color: white !important;background: #9307cb;padding: 1px;text-align: center;">
                                                                    Proceed To Checkout &nbsp; <i class='bx bxs-chevrons-right' style="color: #fbfafc !important;"></i>
                                                                </a>
                                                        @endauth
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="option-item">
                                            <a href="{{ url('customer-dashboard') }}" title="Checkout Page" class="nav-link fw-bold">
                                                <i class="bx bx-cart" style="font-size: 25px !important;"></i>
                                            </a>
                                        </div> --}}
                                        <div class="option-item">
                                            <a href="{{ url('customer-dashboard') }}" title="Dashboard" class="nav-link fw-bold">
                                                 @auth
                                                    {{ auth()->user()->name }}
                                                     <!--<i class="bx bx-user fw-bold" style="font-size: 25px !important;"></i> --}}-->
                                                @endauth
                                            </a>
                                        </div>
                                        <div class="option-item">
                                            <a href="{{route('customer.logout')}}" title="Dashboard" class="nav-link fw-bold">
                                                <i class="bx bx-log-out-circle fw-bold" style="font-size: 25px !important;"></i>
                                            </a>
                                        </div>
                                    @else
                                        @if(auth()->guard('worker')->check())
                                            <div class="option-item">
                                                <a href="{{ url('worker-dashboard') }}" title="Dashboard" class="nav-link fw-bold">
                                                    {{ auth()->guard('worker')->user()->name }}
                                                    <!--<i class="bx bx-home fw-bold" style="font-size: 25px !important;"></i>-->
                                                </a>
                                            </div>
                                            <div class="option-item">
                                                <a href="{{route('worker.logout')}}" title="Dashboard" class="nav-link fw-bold">
                                                    <i class="bx bx-log-out-circle fw-bold" style="font-size: 25px !important;"></i>
                                                </a>
                                            </div>
                                        @else

                                            <div class="cart-btn dropdown">
                                                <a href="javascript:void(0)" class="dropbtn">
                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#serviceAddToCartModal"> --}}
                                                    <i class='bx bx-shopping-bag' style="font-size: 35px !important;"></i>
                                                    <sup class="fs-6 fw-bold cartValues">0</sup>
                                                </a>
                                                <div class="dropdown-content">
                                                    <div class="cartBagItems row mb-2">

                                                    </div>
                                                    <div class="row cartBagCheckoutBtn">
                                                        <div class="col-12">
                                                            @auth
                                                                <a href="{{ url('checkout_page') }}" style="color: white !important;background: #9307cb;padding: 1px;text-align: center;">
                                                                    Proceed To Checkout &nbsp; <i class='bx bxs-chevrons-right' style="color: #fbfafc !important;"></i>
                                                                </a>
                                                                @else
                                                                    <a href="javascript:void(0)" onclick="showLoginRegisterOption()" style="color: white !important;background: #9307cb;padding: 1px;text-align: center;">
                                                                        Proceed To Checkout &nbsp; <i class='bx bxs-chevrons-right' style="color: #fbfafc !important;"></i>
                                                                    </a>
                                                            @endauth
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="option-item">
                                                <a href="{{ url('customer_register') }}" class="nav-link fw-bold" style="color: rgba(0,0,0,.9);">
                                                    Sign Up
                                                </a>
                                            </div>
                                            <div class="option-item">
                                                <a href="javascript:void(0)" onclick="showLoginRegisterOption()"
                                                    class="nav-link fw-bold" style="color: rgba(0,0,0,.9);">
                                                    Sign in
                                                </a>
                                            </div>

                                            {{-- <div class="option-item">
                                                <a href="{{ url('customer-dashboard') }}" title="Checkout Page" class="nav-link fw-bold">
                                                    <i class="bx bx-cart" style="font-size: 25px !important;"></i>
                                                </a>
                                            </div> --}}
                                        @endif
                                    @endauth



                                        {{-- user profile --}}
                                        {{-- <a href="#">
                                            <i class='bx bx-user-circle' style="font-size: 35px !important;"></i>
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- endif customer not logged  --}}

                        </div>
                    </nav>
                </div>
            </div>

            @if(request()->segment(1) != '')
                <div class="row searchItem d-none" style="margin-top: -17px;">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <ul class="list-group searchItems" style="margin-left: 2%; width: 75%;">
                            {{-- append searchItem --}}
                        </ul>
                    </div>
                    <div class="col-3"></div>
                </div>
            @endif
        </div>
        <!-- End Navbar Area -->
    </header>
    <!-- End Header Area -->

    @yield('front_content')

    <!-- Start Footer Area -->
    <footer class="footer-area" style="background-color:#ebecef; margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 style="color: rgba(0,0,0,.9)">{{ $profile->company_name }}</h4>

                        <div class="about-the-store">
                            {{-- <p style="color: rgba(0,0,0,.9);">A2Z Service offers you flexible and responsive listing
                                experience.</p> --}}
                            <ul class="footer-contact-info">
                                <li><i class='bx bx-map'></i> <a href="javascript:void(0)"
                                        style="color: rgba(0,0,0,.9);">{{ $profile->address }}</a></li>
                                <li><i class='bx bx-phone-call'></i> <a href="tel:{{ $profile->mobile }}"
                                        style="color: rgba(0,0,0,.9);">{{ $profile->mobile }}</a></li>
                                <li><i class='bx bx-envelope'></i> <a href="javascript:void(0)"><span class="__cf_email__"
                                            style="color: rgba(0,0,0,.9);">{{ $profile->email }}</span></a></li>
                            </ul>
                        </div>

                        <ul class="social-link">
                            <li>
                                @if(isset($profile->facebook) && $profile->facebook != null)
                                    <a href="{{ $profile->facebook }}" target="_blank" class="d-block" target="_blank">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                @else
                                    <a href="javascript:void(0)" class="d-block" target="_blank">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                @endif
                            </li>
                            <li>
                                @if(isset($profile->twitter) && $profile->twitter != null)
                                    <a href="{{ $profile->twitter }}" target="_blank" title="Twitter" class="d-block" target="_blank">
                                        <i class="fw-bold">X</i>
                                    </a>
                                @else
                                    <a href="javascript:void(0)" title="Twitter" class="d-block" target="_blank">
                                        <i class="fw-bold">X</i>
                                    </a>
                                @endif
                            </li>
                            <li>
                                @if(isset($profile->instagram) && $profile->instagram != null)
                                    <a href="{{ $profile->instagram }}" target="_blank" class="d-block" target="_blank">
                                        <i class='bx bxl-instagram'></i></a></li>
                                    </a>
                                @else
                                    <a href="javascript:void(0)" class="d-block" target="_blank">
                                        <i class='bx bxl-instagram'></i></a></li>
                                    </a>
                                @endif
                            </li>
                            <li>
                                @if(isset($profile->linkedin) && $profile->linkedin != null)
                                    <a href="{{ $profile->linkedin }}" target="_blank" class="d-block" target="_blank">
                                        <i class='bx bxl-linkedin'></i></a></li>
                                    </a>
                                @else
                                    <a href="javascript:void(0)" class="d-block" target="_blank">
                                        <i class='bx bxl-linkedin'></i></a></li>
                                    </a>
                                @endif
                            </li>
                            <li>
                                @if(isset($profile->youtube) && $profile->youtube != null)
                                    <a href="{{ $profile->youtube }}" target="_blank" class="d-block" target="_blank">
                                        <i class='bx bxl-youtube'></i></a></li>
                                    </a>
                                @else
                                    <a href="javascript:void(0)" class="d-block" target="_blank">
                                        <i class='bx bxl-youtube'></i></a></li>
                                    </a>
                                @endif
                            </li>


                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget pl-4">
                        <h4 style="color: rgba(0,0,0,.9)">Quick Links</h4>

                        <ul class="quick-links" style="color: rgba(0,0,0,.9);">
                            <li class="mb-1"><a href="javascript:void(0)" style="color: rgba(0,0,0,.9);">Blog</a></li>
                            <li class="mb-1"><a href="javascript:void(0)" style="color: rgba(0,0,0,.9);">Privacy Policy</a></li>
                            <li class="mb-1"><a href="{{ $howToOrder->video_link }}" target="_blank" style="color: rgba(0,0,0,.9);">How It Works</a></li>
                            <li class="mb-1"><a href="javascript:void(0)" style="color: rgba(0,0,0,.9);">Terms of use</a></li>
                            {{-- <li class="mb-1"><a href="{{ url('worker') }}" style="color: rgba(0,0,0,.9);">Worker</a></li> --}}
                            {{-- <li class="mb-1"><a href="javascript:void(0)" href="{{ url('contact') }}" style="color: rgba(0,0,0,.9);">Contact Us</a></li> --}}
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 style="color: rgba(0,0,0,.9)">Customer Support</h4>
                        <ul class="customer-support">
                            @auth
                                <li class="mb-2"><a href="{{ route('customer.dashboard') }}" style="color: rgba(0,0,0,.9);">My Account</a></li>
                                @else
                                    @if(auth()->guard('worker')->check())
                                        <li class="mb-2"><a href="{{ route('worker.dashboard') }}" style="color: rgba(0,0,0,.9);">My Account</a></li>
                                        @else
                                        <li class="mb-2">
                                            <a href="javascript:void(0)" onclick="showLoginRegisterOption()" style="color: rgba(0,0,0,.9);">My Account</a></li>
                                    @endif
                            @endauth
                            {{-- <li class="mb-1"><a href="checkout.html" style="color: rgba(0,0,0,.9);">Checkout</a></li> --}}
                            {{-- <li class="mb-1"><a href="cart.html" style="color: rgba(0,0,0,.9);">Cart</a></li> --}}
                            <li class="mb-2">
                                <a href="{{ url('customer_register') }}" style="color: rgba(0,0,0,.9);">Register</a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ url('worker') }}" style="color: rgba(0,0,0,.9);">Worker</a>
                            </li>
                            {{-- <li><a href="contact.html" style="color: rgba(0,0,0,.9);">Help & Support</a></li> --}}
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 style="color: rgba(0,0,0,.9);font-size: 19px;font-weight: 700;">DOWNLOAD OUR APP</h4>
                        <div class="footer-newsletter-box">
                            <p style="color: rgba(0,0,0,.9);">Tackle your to-do list wherever you are with our mobile
                                app & make your life easy.</p>

                            <div class="d-flex">
                                <img src="{{ asset('frontend/assets/img/play-store.png') }}" style="max-width:125px"
                                    alt="img">
                                <img src="{{ asset('frontend/assets/img/app-store.png') }}" style="max-width:125px"
                                    alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="footer-bottom-area m-0">
                <div class="d-flex justify-content-center">
                    <p style="color: rgba(0,0,0,.9)">
                        Copyright
                        <i class='bx bx-copyright'></i>
                        {{ now()->year }}
                        <a href="#" target="_blank" style="color: rgba(0,0,0,.9)">A2Z Service |</a>
                        Developed By
                        <a href="https://linktechbd.com/" target="_blank" style="color: rgba(0,0,0,.9)">Link-Up
                            Technology Ltd.</a> | All rights reserved.
                    </p>
                </div>
            </div>
        </div>

        <div class="lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </footer>
    <!-- End Footer Area -->

    <div class="go-top"><i class='bx bx-chevron-up' style="color: #fff"></i></div>

    <!-- Start Shopping Cart Modal -->
    {{-- <div class="modal right fade shoppingCartModal" id="shoppingCartModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class='bx bx-x'></i></span>
                    </button>
                    <div class="modal-body">
                        <h3>My Cart (3)</h3>
                        <div class="products-cart-content">
                            <div class="products-cart">
                                <div class="products-image">
                                    <a href="javascript:void(0)">
                                        <img src="" alt="image">
                                    </a>
                                </div>
                                <div class="products-content">
                                    <h3><a href="#">Painting Service</a></h3>
                                    <span>Quantity: 01</span>
                                    <div class="products-price">
                                        ৳700
                                    </div>
                                    <a href="#" class="remove-btn"><i class='bx bx-trash'></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="products-cart-subtotal">
                            <span>Subtotal</span>
                            <span class="subtotal">৳700.00</span>
                        </div>
                        <div class="products-cart-btn">
                            <a href="cart.html" class="default-btn">View Cart & Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    <!-- End Shopping Cart Modal -->

    <!-- LoginRegister Modal -->
    <div class="modal fade" id="loginRegisterModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="loginRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal"
                        aria-label="Close"
                        style="margin-top: -46px;margin-right: -37px;background-color: #ffffff;box-shadow: 0px 0px 5px 3px #ae45d866;background-image: none;font-size: 21px;font-weight: bold;z-index: 99999;height: 30px;width: 30px;border-radius: 50%;">
                        X
                    </button>
                </div>
                <div class="modal-body" style="height: 70vh; padding: 40px 40px 0 40px; overflow: auto">

                    <div class="d-flex justify-content-center">
                        @if (isset($profile->logo))
                            <img src="{{ asset($profile->logo) }}" alt="logo"
                                style="width: 127px; height: 70px;">
                        @endif
                    </div>


                    <div class="row">
                        <div class="offset-2 col-8 loginRegisterOption">
                            <span class="text-center d-block mt-3 btn-top-txt signup">Login with</span>
                            <span class="text-center d-block mt-3 btn-top-txt login d-none">Login with</span>
                            <div class="d-flex justify-content-center mt-2 btn-customer">
                                <button type="button" onclick="customerLogin()" class="btn btn-success w-100">
                                    Signin as a customer</button>
                            </div>

                            <div class="row">
                                {{-- <div class="col-6">
                                    <a href="" class="btn btn-sm border d-flex justify-content-center p-2"
                                        style="font-size: 13px;">
                                        <i class='bx bxl-facebook'
                                            style="font-size: 19px; background-color: #475993; color: white !important; margin-right: 5px;"></i>
                                        Facebook
                                    </a>
                                </div> --}}
                                <div class="col-12">
                                    <div class="d-flex justify-content-center mt-2 btn-mnumber">
                                        <button type="button" onclick="usingMobile()" class="btn btn-success w-100">
                                            Signin as a worker
                                        </button>
                                    </div>
                                    {{-- <a href="" class="btn btn-sm border d-flex justify-content-center p-2"
                                        style="font-size: 13px;">
                                        <i class='bx bxl-google'
                                            style="font-size: 19px; background-color: #bbb7b7a3; margin-right: 5px;"></i>
                                        Google
                                    </a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-center pt-3 pb-3 signup">
                            <span style="font-size: 14px;">
                                By signing in I agree to the
                                <a href="javascript:void(0)" class="text-primary">Terms & Condition</a>
                            </span>
                        </div>

                        <div class="col-12 d-flex justify-content-center pt-4 pb-4 signup">
                            <span style="font-size: 14px;">Don’t have an account in A2ZService.com?</span>
                            <a href="{{ url('customer_register') }}" class="btn btn-outline-info btn-sm loginSignupBTN ">Signup Now</a>
                        </div>

                        <div class="col-12 d-flex justify-content-center pt-5 pb-0 login d-none">
                            <span style="font-size: 14px;">Don’t have an account in A2ZService.com?</span>
                            <a href="{{ url('customer_register') }}" class="btn btn-outline-info btn-sm loginSignupBTN">Signup Now</a>
                        </div>


                        {{-- ============================= login register form======================= --}}
                        <div class="col-12 loginRegister d-none">
                            <form action="" onsubmit="workerLogin(event)">
                                <span class="text-center d-block mt-2 btn-top-txt" style="letter-spacing: .7px;">
                                    {{-- Continue using mobile number  --}}
                                    Continue as a worker
                                </span>
                                <div class="form-group mb-3 mt-5">
                                    <h6 style="margin-left: 88px;">Mobile Number</h6>
                                    <div class="input-group d-flex justify-content-center"
                                        style="width: 244px !important;height: 45px !important;border: 1px solid #ac51f0;border-radius: 5px;margin-left: 88px; padding: 5px !important;">
                                        <span class="input-group-text"
                                            style="height: 33px !important;background-color: white;border: none;">
                                            <img src="{{ asset('bd.png') }}" alt="img"
                                                style="height: 27px;width: 37px;padding: 0px !important;margin-left: -11px;">
                                            &nbsp;+88
                                        </span>
                                        <input type="number" id="mobileNumberInput" class="form-control"
                                            style="height: 33px !important;border: none;font-size: 13px;"
                                            placeholder="Ex: 01237458454" name="mobile">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-1 btn-mnumber">
                                    <button type="submit" class="btn btn-success continue_btn" disabled
                                        style="width: 246px;">Continue</button>
                                </div>

                                <div class="d-flex justify-content-center mt-2">
                                    <a href="javascript:void(0)" onclick="tryOtherOption()"
                                        class="p-2 otherOptionBTN" style="letter-spacing: .7px;">Try with other
                                        option</a>
                                </div>
                            </form>
                        </div>
                        {{-- =============================end login register form======================= --}}

                    </div>

                </div>
                {{-- <div class="modal-footer border-0 d-flex justify-content-center mb-3">
                        <span>Don’t have an account in A2ZService.com?</span>
                        <button type="button" class="btn btn-outline-info btn-sm">Understood</button>
                    </div> --}}
            </div>
        </div>
    </div>

    {{-- ===================== Customer Login ================================================ --}}
    <div class="modal fade" id="customerLogin" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="loginRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal"
                        aria-label="Close"
                        style="margin-top: -46px;margin-right: -37px;background-color: #ffffff;box-shadow: 0px 0px 5px 3px #ae45d866;background-image: none;font-size: 21px;font-weight: bold;z-index: 99999;height: 30px;width: 30px;border-radius: 50%;">
                        X
                    </button>
                </div>
                <div class="modal-body" style="padding: 10px 40px 10px 40px; overflow: auto">

                    <div class="d-flex justify-content-center">
                        @if (isset($profile->logo))
                            <img src="{{ asset($profile->logo) }}" alt="logo"
                                style="width: 127px; height: 70px;">
                        @endif
                    </div>
                    <div class="row">
                         <div class="col-12 CustomerLogin">
                            <form action="" onsubmit="CustomerLogin(event)">
                                <span class="text-center d-block mt-2 btn-top-txt" style="letter-spacing: .7px;">
                                    Continue as a customer </span>
                                <div class="form-group mb-2 mt-4">
                                    <div class="d-flex justify-content-center"
                                        style="width: 244px !important;height: 35px !important;border: 1px solid #ac51f0;border-radius: 5px;margin-left: 88px; padding: 5px !important;">
                                        <input type="text" name="username" class="form-control" style="height: 25px !important;border: none;font-size: 13px;"
                                            placeholder="Username">
                                    </div>
                                    <span class="text-danger error-username error d-flex justify-content-center"></span>
                                </div>
                                <div class="form-group mb-2">
                                    <div class="d-flex justify-content-center"
                                        style="width: 244px !important;height: 35px !important;border: 1px solid #ac51f0;border-radius: 5px;margin-left: 88px; padding: 5px !important;">
                                        <input type="password" class="form-control" name="password" style="height: 25px !important;border: none;font-size: 13px;"
                                            placeholder="Password">
                                    </div>
                                    <span class="text-danger error-password error d-flex justify-content-center"></span>
                                </div>

                                <div class="d-flex justify-content-center mt-1">
                                    <button type="submit" class="btn btn-success" style="width: 246px;">Continue</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-12 d-flex justify-content-center pt-4 pb-4">
                            <span style="font-size: 14px;">Don't have an account in A2ZService.com? <a href="{{ url('customer_register') }}" style="color:#ac51f0">Signup Now</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Location Select Modal --}}
    <div class="modal fade" id="locationSelectModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="loginRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-title">
                    <h5 class="text-center p-3"
                        style="box-shadow: 0px 20px 20px 0px #57287e1f; margin-bottom:0;font-size: 18px;">
                        <span class="divisionTxt">Select Your City</span>
                        <span class="districtTxt d-none">Select Your Area in</span>
                        <span class="divisionArea d-none" onclick="backToDivision()" role="button">
                            <i class='bx bx-map'style="font-size: 19px"></i>
                            <span class="divisionName mt-1">Dhaka</span>
                        </span>
                    </h5>
                </div>
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal"
                        aria-label="Close"
                        style="margin-top: -135px;margin-right: -37px;background-color: #ffffff;box-shadow: 0px 0px 5px 3px #ae45d866;background-image: none;font-size: 21px;font-weight: bold;z-index: 99999;height: 30px;width: 30px;border-radius: 50%;">
                        X
                    </button>
                </div>
                <div class="modal-body"
                    style="height: 60vh; padding: 0 40px 0 40px; overflow: auto; background-color: #f9f8fb !important">
                    <div class="row pt-0 pb-2 divisionList">
                        @foreach ($divisions as $div)
                            <div class="col-md-6 mb-2">
                                <div class="card">
                                    @php
                                        $divData = ['id' => $div->id, 'name' => $div->name];
                                    @endphp
                                    <a href="javascript:void(0)" class="ps-4 pe-3 pt-2 pb-0"
                                        onclick="divisionSelect({{ json_encode($divData) }})">
                                        <img src="{{ asset('frontend/assets/img/division/' . $div->img) }}"
                                            style="width:286px; height: 121px;" class="card-img-top"
                                            alt="{{ $div->name }}">
                                        <div class="card-body pb-1">
                                            <p class="card-text text-center fw-bold"
                                                style="font-size: 19px; color:#a755f7;">{{ $div->name }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row pt-0 pb-2 districtList d-none">
                        <div class="d-flex mb-3">
                            <input class="form-control me-2 csearch" oninput="findDistrict(event)" type="text"
                                placeholder="Find your area" aria-label="Search">
                        </div>

                        <div class="row distrList">
                            {{-- will append division wise district  --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- add cart Modal --}}
    <div class="modal fade" id="serviceAddToCartModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="loginRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-title">
                    <h5 class="text-center p-3"
                        style="box-shadow: 0px 20px 20px 0px #57287e1f; margin-bottom:0;font-size: 18px;">
                        <span class="serviceTxt"></span>
                        <span class="" onclick="locationModal()" role="button">
                            in <i class='bx bx-map'style="font-size: 19px"></i>
                            <span class="locationName mt-1">Dhaka</span>
                        </span>
                    </h5>
                </div>
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal"
                        aria-label="Close"
                        style="margin-top: -135px;margin-right: -37px;background-color: #ffffff;box-shadow: 0px 0px 5px 3px #ae45d866;background-image: none;font-size: 21px;font-weight: bold;z-index: 99999;height: 30px;width: 30px;border-radius: 50%;">
                        X
                    </button>
                </div>
                <div class="modal-body"
                    style="height: 50vh; padding: 0 40px 0 40px; background-color: #f9f8fb !important">

                    <div class="row pt-0 pb-2">

                        <div class="col-8">

                            {{-- <div class="serviceList">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="card mb-3 border-0">
                                            <div class="row g-0">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('frontend/assets/img/ac_installation-indor_unit.jpg') }}" class="img-fluid rounded-start mt-4" alt="service_img">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="card-body mt-1">
                                                        <h6 class="card-title pb-0">AC Installation & Uninstallation (Indoor Unit) 1 Ton - 2 Ton</h6>
                                                        <ul style="margin-top: -7px;">
                                                            <li class="fs-13-c"><p class="card-text fs-13">Extra Charges will be applicable for materials, Gas charge </p></li>
                                                            <li class="fs-13-c"><p class="card-text fs-13">Hanging Charge Excluded</p></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-5">
                                           <center>
                                                <a href="javascript:void(0)" onclick="serviceSingle()" class="btn btn-outline-primary">
                                                    Next <i class='bx bx-right-arrow-alt text-white'></i>
                                                </a>
                                           </center>
                                           <div class="d-flex mt-2">
                                            <small class="text-body-secondary"> Start from</small> &nbsp;
                                            <span style=" font-size: 15px; font-weight: 800; color: #9307cb; ">৳ 900</span>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="serviceSingleTop">
                                <div class="row" style="background-color: #cdcbcb21; padding: 10px 0 0 0;">
                                    {{-- <div class="col-6">
                                        <h6 class="d-flex" onclick="serviceList()" role="button">
                                            <i class='bx bx-arrow-back fw-bold mt-1'></i>
                                            &nbsp; &nbsp; <p class="serviceTxt"></p>
                                        </h6>
                                    </div> --}}
                                    {{-- <div class="col-12">
                                        <p class="d-flex align-item-end">2 Option Available</p>
                                    </div> --}}
                                </div>

                                <h6 class="mt-2">Select More Service -</h6>

                                <div class="showServices">
                                    {{-- service append --}}
                                </div>

                                {{-- <div class="row serviceSingle">
                                    <div class="col-md-9">
                                        <div class="card mb-3 border-0">
                                            <div class="row g-0">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('frontend/assets/img/ac_installation-both_unit.jpg') }}" class="img-fluid rounded-start mt-4" alt="service_img">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="card-body mt-1">
                                                        <h6 class="card-title pb-0">AC Installation & Uninstallation (Both Unit) 1 Ton - 2 Ton</h6>
                                                        <ul style="margin-top: -7px;">
                                                            <li class="fs-13-c"><p class="card-text fs-13">Air conditioner hook-up and mounting </p></li>
                                                            <li class="fs-13-c"><p class="card-text fs-13">Refrigerant pressure, electric voltage, and ampere checkup</p></li>
                                                        </ul>
                                                        <p class="card-text">
                                                            <span style=" font-size: 15px; font-weight: 800; color: #9307cb; ">৳ 3,100</span>
                                                            <small class="text-body-secondary">/ piece</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:void(0)" onclick="addToCart()" class="btn btn-outline-primary mt-5">Add <i class='bx bx-plus text-white' ></i></a>
                                    </div>
                                </div> --}}
                            </div>

                        </div>

                        <div class="col-4">

                            <h6 class="mt-2" style="border-bottom: 1px dashed #9307cb40;">Cart Items</h6>
                            <div class="cartItems">
                                {{-- append cart data --}}

                                {{-- <div class="row serviceSingle" style="margin-top: -15px;">
                                    <div class="col-md-7 card border-0">
                                        <div class="card-body mt-1">
                                            <h6 class="card-title pb-0">AC Installation & Uninstallation (Both Unit) 1 Ton - 2 Ton</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm mt-4">
                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="border: 1px solid #532581;background-color: #ffffff;padding: 1px;cursor: pointer;">
                                                <i class='bx bx-minus fw-bold' style="font-size: 21px"></i>
                                            </span>
                                            <input type="number" class="form-control" min="1" value="1" style="height: 31px !important; border: 1px solid #532581;" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="border: 1px solid #532581;color: gray;">
                                                piece <i class='bx bx-plus fw-bold' style="font-size: 21px"></i>
                                            </span>
                                        </div>
                                        <span style="font-size: 14px;float: right;margin-top: 5px;">৳ 1,500</span>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div> --}}

                                {{-- <div class="row mt-3">
                                    <div class="col-md-6">
                                        <h6 style="color: #9307cb;">Subtotal</h6>
                                    </div>
                                    <div class="col-md-5">
                                        <span class="subtotal" style="display: flex;justify-content: flex-end;color: #9307cb;font-size: 15px;font-weight: bold;">1,500</span>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div> --}}
                            </div>


                            <div class="cartEmpty d-none">
                                <div class="emptyCart mt-5">
                                    <p class="text-center"
                                        style="opacity: .3; font-size: 35px; font-family: sans-serif;">Empty Cart</p>
                                    <span class="text-center"
                                        style="opacity: .3;font-family: sans-serif;display: flex;justify-content: space-around;">
                                        Order a service just few clicks!
                                        <br>so what are you waiting for...
                                    </span>
                                </div>

                                {{-- <p class="mt-5 text-center bg-warning fw-bold text-white"
                                    style="border-radius: 5px;padding: 3px;margin-top: 113px !important;">
                                    <i class='bx bx-error'
                                        style="color: #ffffff !important; font-size:19px; font-weight: 900;"></i>
                                    &nbsp;
                                    Minimum order amount is ৳50.
                                </p> --}}
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0 pb-0 mb-0">
                    <br>
                    @auth
                        <a href="{{ url('checkout_page') }}" class="btn btn-primary btn-lg checkout_btn" disabled
                            style="z-index: 999; margin: 0 -12px 0 0;border-radius: 0;width: 35%;background-color: #3f1c62;border: 1px solid #3f1c62;">
                            Proceed To Checkout &nbsp; <i class='bx bxs-chevrons-right'
                                style="color: #fbfafc !important;"></i>
                        </a>
                        @else
                            <a href="javascript:void(0)" onclick="showLoginRegisterOption()" class="btn btn-primary btn-lg checkout_btn" disabled
                                style="z-index: 999; margin: 0 -12px 0 0;border-radius: 0;width: 35%;background-color: #3f1c62;border: 1px solid #3f1c62;">
                                Proceed To Checkout &nbsp; <i class='bx bxs-chevrons-right'
                                    style="color: #fbfafc !important;"></i>
                            </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>


    {{-- message section --}}
        @if(Session::has('success'))
            <script>
                Toastify({text: "{{ Session::get('success') }}", duration: 2000, close: true, gravity: "top",  backgroundColor: "linear-gradient(to right, #4caf50, #4caf50)"}).showToast();
            </script>
        @endif
        @if(Session::has('error'))
            <script>
                Toastify({text: "{{ Session::get('error') }}", duration: 2000, close: true, gravity: "top",  backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"}).showToast();
            </script>
        @endif
    {{-- end message section --}}



    <!-- Links of JS files -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/appear.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/rangeSlider.min.js') }}"></script>
    {{-- <script src="{{ asset('frontend/assets/js/nice-select.min.js') }}"></script> --}}
    <script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/meanmenu.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/contact-form-script.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //=============== search by service name, slug and code ======================
        $(".searchItem").addClass('d-none');

        $('.findService').on('keyup change', function(){
            let serviceFind = $(this).val();
            if (serviceFind.length > 2) {
                $(".searchItem").removeClass('d-none');

                $.ajax({
                    url: '/get_service',
                    type: "POST",
                    data: {
                        serviceName: serviceFind
                    },
                    beforeSend: () => {
                        $(".searchItems").html(`<li class="list-group-item">
                                <a href="javascript:void(0)">
                                    <span class="text-center">Service Not Available</span>
                                </a>
                            </li>`)
                    },
                    success: function(res) {
                        $.each(res, (index, value) => {
                            $(".searchItems").html(`<li class="list-group-item">
                                <a href="${location.origin+'/service-single/'+value.slug}">
                                    <span style="float: left;">${value.name}</span>
                                    <span style="float: right;">
                                        <i class="bx bx-right-arrow-alt" style="font-size: 19px;font-weight: bold;"></i>
                                    </span>
                                </a>
                            </li>`)
                        })
                    },
                });

            }else{
                $(".searchItem").addClass('d-none');
            }
        })
    </script>


    {{-- cart functionality --}}
    <script>
    //    setInterval(() => {
            itemsCart();
    //    }, 1000);
        // cart modal
        function cartModal(data) {
            let id = data.id;
            $("#serviceAddToCartModal .serviceTxt").text(data.name);
            $.ajax({
                url:'/cart_modal_data',
                method:'POST',
                data:{id:id},
                success: res =>{
                    if (res.warning) {
                        // for error
                        Toastify({
                            text: res.warning,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"
                        }).showToast();
                    }

                    $(".showServices").html('');

                    let serviceItems = '';
                    // push services
                    $.each(res.services, (index, service) => {
                        serviceItems += `<div class="row serviceSingle">
                            <div class="col-md-9">
                                <div class="card mb-3 border-0">
                                    <div class="row g-0">
                                        <div class="col-md-2">
                                            <img src="${location.origin+'/'+service.image}" class="img-fluid rounded-start mt-4" alt="service_img">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body mt-1">
                                                <h6 class="card-title pb-0 mt-3">
                                                    ${service.name}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:void(0)" onclick="addToCart(${service.id})" class="btn btn-outline-primary mt-5">Add <i class='bx bx-plus text-white' ></i></a>
                            </div>
                        </div>`
                    })
                    $(".showServices").append(serviceItems);

                    if (res.content.length > 0) {
                        $("#serviceAddToCartModal .checkout_btn").removeClass('disabled');
                        $(".cartItems").removeClass('d-none');
                        $(".cartEmpty").addClass('d-none');
                    }else{
                        $("#serviceAddToCartModal .checkout_btn").addClass('disabled');
                        $(".cartEmpty").removeClass('d-none');
                    }

                    $("#serviceAddToCartModal").modal('show');

                    // push cart item
                    itemsCart();
                }
            });
        }

        function itemsCart()
        {
            $.ajax({
                url:'/getCartItems',
                method:'GET',
                data:'',
                success: res => {
                    // console.log(res);
                    $(".cartValues").text(res.cartCount);
                    if (res.content) {
                        $(".cartEmpty").addClass('d-none');
                        $("#serviceAddToCartModal .checkout_btn").removeClass('disabled');
                        $(".cartItems").removeClass('d-none');
                        $(".cartItems").html('');
                        $(".cartBagItems").html('');
                        let cartBag = '';
                        let cartData = '';
                        $.each(res.content, (index, cartItem) => {
                            cartData +=`<div class="row serviceSingle">
                                        <div class="col-md-9 card border-0">
                                            <div class="card-body mt-1">
                                                <h6 class="card-title pb-0">${cartItem.name}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3 border-0 pb-0 mt-3">
                                            <a onclick="cartDelete('${cartItem.rowId}')"
                                                style="cursor: pointer;background: red;padding: 0 3px;border-radius: 50%;color: white;font-weight: 600;">
                                                <span>X</span>
                                            </a>
                                        </div>
                                    </div>`
                        })

                        if (res.cartCount && res.cartCount > 0)
                        {
                            $(".cartBagCheckoutBtn").removeClass('d-none');
                            $.each(res.content, (index, cartItem) => {
                                cartBag +=`<a href="javascript:void(0)" onclick="cartDelete('${cartItem.rowId}')" style="font-weight: 600;" title="Click to remove from cart">
                                   <span class="p-2"> ${cartItem.name} </span>
                                    &nbsp;  X
                                </a>`
                            })
                        }else{
                            $(".cartBagCheckoutBtn").addClass('d-none');
                            cartBag = `<div class="col-12">
                                <h6 class="p-3 text-center">
                                    No Item Found
                                </h6>
                            </div>`
                        }


                        $(".cartItems").append(cartData);
                        $(".cartBagItems").append(cartBag);
                    // }else{
                    //     $("#serviceAddToCartModal .checkout_btn").addClass('disabled');
                    //     $(".cartEmpty").removeClass('d-none');
                    }
                }
            })
        }

        // remove from cart
        function cartDelete(id) {
            if (confirm("Are you sure you want to remove from cart?")) {
                $.ajax({
                    url: location.origin + "/removecart",
                    method: "POST",
                    dataType: "JSON",
                    data: {  rowId: id },
                    success: res => {
                        $("." + id).remove()
                        $(".product-cart-remove-"+id).remove()
                        itemsCart();
                    }
                })
            }
        }

        function addToCart(id)
        {
            $.ajax({
                url:'/addcart',
                method:'POST',
                data:{id:id},
                success: res => {
                    Toastify({
                        text: res.msg,
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                    }).showToast();
                    $(".cartEmpty").addClass('d-none');
                    $(".cartItems").removeClass('d-none');
                    $(".checkout_btn").removeClass('disabled');
                    itemsCart();
                }
            })
        }
    </script>


    <script>
        if (getDataFromLocalStorage('districtName') == null) {
            $('.locationName').text('Dhaka');
        }else{
            $('.locationName').text(getDataFromLocalStorage('districtName'));
        }

        //=============== Store data in local storage ================================
        function setDataInLocalStorage(key, value, expirationMinutes) {
            var expirationTime = new Date().getTime() + (expirationMinutes * 60 * 1000);
            var dataToStore = {
                value: value,
                expiration: expirationTime
            };
            localStorage.setItem(key, JSON.stringify(dataToStore));
        }

        // Retrieve data from local storage
        function getDataFromLocalStorage(key) {
            var storedData = localStorage.getItem(key);
            if (storedData) {
                var parsedData = JSON.parse(storedData);
                if (parsedData.expiration > new Date().getTime()) {
                    return parsedData.value;
                } else {
                    // Data has expired, so remove it from local storage
                    localStorage.removeItem(key);
                }
            }
            return null; // Data not found or expired
        }

        // set customer location into local storage for 5 minutes
        function setDistrict(areaName) {
            $('.locationName').text(areaName);
            let key = "districtName";
            let data = areaName;
            let addTime = 60 // minutes/1 hour
            setDataInLocalStorage(key, data, addTime);
            $("#locationSelectModal").modal('hide');
        }
        //=================== local storage end ======================================

        // location modal
        function locationModal() {
            $("#locationSelectModal").modal('show');
        }

        var districtArr = [];
        var detailsArray = [];

        function districtList() {
            let districtList = "";
            $.each(detailsArray, (index, value) => {
                districtList += `<div class="col-md-6 mb-1 districtList_${value.id}">
                                    <a href="javascript:void(0)" onclick="setDistrict('${value.name}')">
                                        <ul class="list-group">
                                            <li class="list-group-item">${value.name}</li>
                                        </ul>
                                    </a>
                                </div>`;
            })
            $(".distrList").html(districtList);
        }

        async function findDistrict(event) {
            detailsArray = []
            if (event.target.value) {
                detailsArray = districtArr.filter(district => district.name.toLowerCase().startsWith(event.target.value
                    .toLowerCase()));
            } else {
                detailsArray = districtArr;
            }
            await districtList();
        }

        // select division
        function divisionSelect(data) {
            $(".divisionArea").removeClass('d-none');
            $(".districtList").removeClass('d-none');
            $(".districtTxt").removeClass('d-none');
            $(".divisionList").addClass('d-none');
            $(".divisionTxt").addClass('d-none');
            $(".divisionName").text(data.name);
            let id = data.id;
            // find division wise district=======================================
            $.ajax({
                url: '/get_district_name',
                type: "POST",
                data: {
                    id: id
                },
                success: function(res) {
                    $(".distrList").html("");
                    districtArr = res.district;
                    detailsArray = districtArr;
                    districtList();
                },
            });
        }

        function backToDivision() {
            $(".divisionArea").addClass('d-none');
            $(".districtList").addClass('d-none');
            $(".districtTxt").addClass('d-none');

            $(".divisionList").removeClass('d-none');
            $(".divisionTxt").removeClass('d-none');
        }

        //=========================================== Login Register process =====================================================
        function showLoginRegisterOption() {
            $("#loginRegisterModal").modal('show');
            $("#serviceAddToCartModal").modal('hide');
        }

        // login option show
        function loginNow() {
            $('.loginRegisterOption').removeClass('d-none');
            $('.login').removeClass('d-none');
            $('.signup').addClass('d-none');
            $('.loginRegister').addClass('d-none');
        }

        // signup option show
        function signupNow() {
            $('.loginRegisterOption').removeClass('d-none');
            $('.signup').removeClass('d-none');
            $('.login').addClass('d-none');
            $('.loginRegister').addClass('d-none');
        }

        // show login register form
        function usingMobile() {
            $('.loginRegister').removeClass('d-none');
            $('.loginRegisterOption').addClass('d-none');
            $('.signup').addClass('d-none');
            $('.login').addClass('d-none');
        }

        // login with other option
        function tryOtherOption() {
            $('.loginRegisterOption').removeClass('d-none');
            $('.login').removeClass('d-none');
            $('.loginRegister').addClass('d-none');
            $('.signup').addClass('d-none');
        }

        // check mobile number
        $('#mobileNumberInput').on('input', function() {
            var inputValue = $(this).val();
            var inputLength = inputValue.length;

            if (inputLength == 11) {
                var mobileNumber = inputValue;
                var regex = /^01[3-9][0-9]{8}$/

                if (regex.test(mobileNumber)) {
                    $('.continue_btn').prop('disabled', false);
                    // alert("Mobile number is valide");
                } else {
                    $('.continue_btn').prop('disabled', true);
                    // alert("Mobile number is not valide");
                }
            } else {
                $('.continue_btn').prop('disabled', true);
            }
        });


        // customer login
        function customerLogin()
        {
            $("#loginRegisterModal").modal('hide');
            $("#customerLogin").modal('show');
        }

        //===========================================//END//---Login Register process =====================================================
    </script>

    {{-- @auth
        <script>
            let areaName = "{{auth()->user()->thana->district->name}}";
            let key = "districtName";
            let data = areaName;
            let addTime = 60 // minutes/1 hour
            setDataInLocalStorage(key, data, addTime);
        </script>
    @endauth --}}

    {{-- cart --}}
    <script>
        function orderNow(id)
        {
            $.ajax({
                url: "/addcart",
                method: "POST",
                data: {id:id},
                success: res => {
                    location.href = "{{route('checkout.page')}}"
                }
            })
        }
    </script>
    {{-- end cart --}}

    <script>
        // customer login
        function CustomerLogin(event) {
            event.preventDefault();
            let formdata = new FormData(event.target)
            $.ajax({
                url: "/customer-login",
                method: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                beforeSend: () => {
                    $(".CustomerLogin .error").text("")
                },
                success: res => {
                    if (res.error) {
                        $.each(res.error, (index, value) => {
                            $(".CustomerLogin .error-" + index).text(value)
                        })
                    } else if (res.errors) {
                        $(".CustomerLogin .error-username").text(res.errors)
                    } else {
                        // alert('Login Successfully');
                        Toastify({
                            text: res.success,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                        }).showToast();

                        $("form").trigger("reset")
                        if (res.content > 0) {
                            setTimeout(() => {
                                location.href = "{{ url('checkout_page')}}"
                            }, 500);
                        }else{
                            window.location.reload();
                        }
                    }
                }
            })
        }

        function workerLogin(event) {
            event.preventDefault();
            let formdata = new FormData(event.target)
            $.ajax({
                url: "/worker-login",
                method: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                beforeSend: () => {
                    $(".WorkerLogin .error").text("")
                },
                success: res => {
                    if (res.error) {
                        alert(res.error);
                        // for error
                        Toastify({
                            text: res.error,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"
                        }).showToast();
                    } else if (res.errors) {
                        // for error
                        Toastify({
                            text: res.errors,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"
                        }).showToast();
                    } else {
                        // for success
                        Toastify({
                            text: res,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                        }).showToast();


                        $("form").trigger("reset")
                        setTimeout(() => {
                            location.href = "/worker-dashboard"
                        }, 500);
                    }
                }
            })
        }
    </script>

    @stack('front_script')
</body>

</html>
