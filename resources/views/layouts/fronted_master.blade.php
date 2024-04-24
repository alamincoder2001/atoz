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
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/selectize.default.min.css')}}" />

    <!-- -- toastify -- -->
    <link rel="stylesheet" href="{{asset('css/toastify.min.css')}}">
    <script src="{{asset('js/toastify.min.js')}}"></script>
    <!-- --end toastify -- -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>@yield('front_title') | A2Z Services</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset($profile->navicon != null ? $profile->navicon : 'noImage.jpg') }}">
    @stack('front_style')
</head>

<body>

    <!-- Start Header Area -->
    <header class="header-area">
        <!-- Start Navbar Area -->
        <div class="navbar-area">
            <div class="a2z_service-responsive-nav">
                <div class="container">
                    <div class="a2z_service-responsive-menu">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                @if (isset($profile->logo))
                                <img src="{{ asset($profile->logo) }}" alt="logo" style="width: 115px; height: 45px;">
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="a2z_service-nav" @if (request()->segment(1) == '') style="background-color: white !important;" @else style="background-color: white !important;box-shadow: 0px 3px 20px 0px #dbdbdb;" @endif>
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-md navbar-fixed-top navbar-light">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            @if (isset($profile->logo))
                            <img src="{{ asset($profile->logo) }}" alt="logo" style="width: 115px; height: 45px;">
                            @endif
                        </a>

                        @if (request()->segment(1) != '')
                        <a class="navbar-brand d-flex align-items-center" href="javascript:void(0)" onclick="locationModal()">
                            <span>
                                <i class='bx bx-map' style="font-size: 25px; font-weight: bold;"></i>
                            </span>
                            <span class="locationName mt-1"></span>
                        </a>
                        @endif

                        <div class="collapse navbar-collapse mean-menu">

                            @if (request()->segment(1) != '')
                            <div class="search-overlay-form navbar-nav">
                                <form>
                                    <input type="text" class="input-search findService" placeholder="Search here...">
                                    <button type="submit" class="searchbtn">
                                        <i class="bx bx-search-alt" style="font-size: 25px;color: white !important;margin: 1px 0 0 0;padding-top: 5px;"></i>
                                    </button>
                                </form>
                            </div>
                            @endif

                            <ul class="navbar-nav">
                                @if (request()->segment(1) == '')
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
                                <li class="nav-item">
                                    <a href="{{ route('service.all') }}" class="nav-link">All Services</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('worker') }}" class="nav-link">Worker</a>
                                </li>
                            </ul>

                            <!-- -- if customer logged  -- -->
                            <div class="others-option">
                                <div class="d-flex align-items-center">

                                    @auth
                                    <div class="cart-btn dropdown">
                                        <a href="javascript:void(0)" class="dropbtn">
                                            <i class='bx bx-shopping-bag' style="font-size: 35px !important;"></i>
                                            <sup class="fs-6 fw-bold cartValues">0</sup>
                                        </a>
                                        <div class="dropdown-content">
                                            <div class="cartBagItems row mb-2"> </div>
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
                                        <a href="{{ url('customer-dashboard') }}" title="Dashboard" class="nav-link fw-bold">
                                            @auth
                                            {{ auth()->user()->name }}
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
                                        <a href="javascript:void(0)" onclick="showLoginRegisterOption()" class="nav-link fw-bold" style="color: rgba(0,0,0,.9);">
                                            Sign in
                                        </a>
                                    </div>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                        <!-- -- endif customer not logged  -- -->
                    </nav>
                </div>
            </div>
        </div>

        @if(request()->segment(1) != '')
        <div class="row searchItem d-none" style="margin-top: -17px;">
            <div class="col-3"></div>
            <div class="col-6">
                <ul class="list-group searchItems" style="width: 80%;margin: 0;margin-left: -29px">
                </ul>
            </div>
            <div class="col-3"></div>
        </div>
        @endif
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
                                <li><i class='bx bx-map'></i> <a href="javascript:void(0)" style="color: rgba(0,0,0,.9);">{{ $profile->address }}</a></li>
                                <li><i class='bx bx-phone-call'></i> <a href="tel:{{ $profile->mobile }}" style="color: rgba(0,0,0,.9);">{{ $profile->mobile }}</a></li>
                                <li><i class='bx bx-envelope'></i> <a href="javascript:void(0)"><span class="__cf_email__" style="color: rgba(0,0,0,.9);">{{ $profile->email }}</span></a></li>
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
                                    <i class='bx bxl-instagram'></i></a>
                            </li>
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
                                    <i class='bx bxl-linkedin'></i></a>
                            </li>
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
                                    <i class='bx bxl-youtube'></i></a>
                            </li>
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
                                <a href="javascript:void(0)" onclick="showLoginRegisterOption()" style="color: rgba(0,0,0,.9);">My Account</a>
                            </li>
                            @endif
                            @endauth
                            <li class="mb-2">
                                <a href="{{ url('customer_register') }}" style="color: rgba(0,0,0,.9);">Register</a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ url('worker') }}" style="color: rgba(0,0,0,.9);">Worker</a>
                            </li>
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
                                <img src="{{ asset('frontend/assets/img/play-store.png') }}" style="max-width:125px" alt="img">
                                <img src="{{ asset('frontend/assets/img/app-store.png') }}" style="max-width:125px" alt="img">
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

    <!-- LoginRegister Modal -->
    <div class="modal fade" id="loginRegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -46px;margin-right: -37px;background-color: #ffffff;box-shadow: 0px 0px 5px 3px #ae45d866;background-image: none;font-size: 21px;font-weight: bold;z-index: 99999;height: 30px;width: 30px;border-radius: 50%;">
                        X
                    </button>
                </div>
                <div class="modal-body" style="height: 70vh; padding: 40px 40px 0 40px; overflow: auto">

                    <div class="d-flex justify-content-center">
                        @if (isset($profile->logo))
                        <img src="{{ asset($profile->logo) }}" alt="logo" style="width: 127px; height: 70px;">
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
                                <div class="col-12">
                                    <div class="d-flex justify-content-center mt-2 btn-mnumber">
                                        <button type="button" onclick="usingMobile()" class="btn btn-success w-100">
                                            Signin as a worker
                                        </button>
                                    </div>
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


                        <!-- -- ============================= login register form======================= -- -->
                        <div class="col-12 loginRegister d-none">
                            <form action="" onsubmit="workerLogin(event)">
                                <span class="text-center d-block mt-2 btn-top-txt" style="letter-spacing: .7px;">
                                    <!-- -- Continue using mobile number  -- -->
                                    Continue as a worker
                                </span>
                                <div class="form-group mb-3 mt-5">
                                    <h6 style="margin-left: 88px;">Mobile Number</h6>
                                    <div class="input-group d-flex justify-content-center" style="width: 244px !important;height: 45px !important;border: 1px solid #ac51f0;border-radius: 5px;margin-left: 88px; padding: 5px !important;">
                                        <span class="input-group-text" style="height: 33px !important;background-color: white;border: none;">
                                            <img src="{{ asset('bd.png') }}" alt="img" style="height: 27px;width: 37px;padding: 0px !important;margin-left: -11px;">
                                            &nbsp;+88
                                        </span>
                                        <input type="number" id="mobileNumberInput" class="form-control" style="height: 33px !important;border: none;font-size: 13px;" placeholder="Ex: 01237458454" name="mobile">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-1 btn-mnumber">
                                    <button type="submit" class="btn btn-success continue_btn" disabled style="width: 246px;">Continue</button>
                                </div>

                                <div class="d-flex justify-content-center mt-2">
                                    <a href="javascript:void(0)" onclick="tryOtherOption()" class="p-2 otherOptionBTN" style="letter-spacing: .7px;">Try with other
                                        option</a>
                                </div>
                            </form>
                        </div>
                        <!-- -- =============================end login register form======================= -- -->

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- -- ===================== Customer Login ================================================ -- -->
    <div class="modal fade" id="customerLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -46px;margin-right: -37px;background-color: #ffffff;box-shadow: 0px 0px 5px 3px #ae45d866;background-image: none;font-size: 21px;font-weight: bold;z-index: 99999;height: 30px;width: 30px;border-radius: 50%;">
                        X
                    </button>
                </div>
                <div class="modal-body" style="padding: 10px 40px 10px 40px; overflow: auto">

                    <div class="d-flex justify-content-center">
                        @if (isset($profile->logo))
                        <img src="{{ asset($profile->logo) }}" alt="logo" style="width: 127px; height: 70px;">
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12 CustomerLogin">
                            <form action="" onsubmit="CustomerLogin(event)">
                                <span class="text-center d-block mt-2 btn-top-txt" style="letter-spacing: .7px;">
                                    Continue as a Customer </span>
                                <div class="form-group mb-2 mt-4">
                                    <div class="d-flex justify-content-center" style="width: 244px !important;height: 35px !important;border: 1px solid #ac51f0;border-radius: 5px;margin-left: 88px; padding: 5px !important;">
                                        <input type="text" name="mobile" class="form-control" style="height: 25px !important;border: none;font-size: 13px;" placeholder="Mobile">
                                    </div>
                                    <span class="text-danger error-mobile error d-flex justify-content-center"></span>
                                </div>
                                <div class="form-group mb-2">
                                    <div class="d-flex justify-content-center" style="width: 244px !important;height: 35px !important;border: 1px solid #ac51f0;border-radius: 5px;margin-left: 88px; padding: 5px !important;">
                                        <input type="password" class="form-control" name="password" style="height: 25px !important;border: none;font-size: 13px;" placeholder="Password">
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

    <!-- -- Location Select Modal -- -->
    <div class="modal fade" id="locationSelectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-title">
                    <h5 class="text-center p-3" style="box-shadow: 0px 20px 20px 0px #57287e1f; margin-bottom:0;font-size: 18px;">
                        <span class="divisionTxt">Select Your City</span>
                        <span class="districtTxt d-none">Select Your Area in</span>
                        <span class="divisionArea d-none" onclick="backToDivision()" role="button">
                            <i class='bx bx-map' style="font-size: 19px"></i>
                            <span class="divisionName mt-1">Dhaka</span>
                        </span>
                    </h5>
                </div>
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -135px;margin-right: -37px;background-color: #ffffff;box-shadow: 0px 0px 5px 3px #ae45d866;background-image: none;font-size: 21px;font-weight: bold;z-index: 99999;height: 30px;width: 30px;border-radius: 50%;">
                        X
                    </button>
                </div>
                <div class="modal-body" style="height: 60vh; padding: 0 40px 0 40px; overflow: auto; background-color: #f9f8fb !important">
                    <div class="row pt-0 pb-2 divisionList">
                        @foreach ($divisions as $div)
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                @php
                                $divData = ['id' => $div->id, 'name' => $div->name];
                                @endphp
                                <a href="javascript:void(0)" class="ps-4 pe-3 pt-2 pb-0" onclick="divisionSelect({{ json_encode($divData) }})">
                                    <img src="{{ asset('frontend/assets/img/division/' . $div->img) }}" style="width:286px; height: 121px;" class="card-img-top" alt="{{ $div->name }}">
                                    <div class="card-body pb-1">
                                        <p class="card-text text-center fw-bold" style="font-size: 19px; color:#a755f7;">{{ $div->name }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row pt-0 pb-2 districtList d-none">
                        <div class="d-flex mb-3">
                            <input class="form-control me-2 csearch" oninput="findDistrict(event)" type="text" placeholder="Find your area" aria-label="Search">
                        </div>

                        <div class="row distrList">
                            <!-- -- will append division wise district  -- -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- -- add cart Modal -- -->
    <div class="modal fade" id="serviceAddToCartModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-title">
                    <h5 class="text-center p-3" style="box-shadow: 0px 20px 20px 0px #57287e1f; margin-bottom:0;font-size: 18px;">
                        <span class="serviceTxt"></span>
                        <span class="" onclick="locationModal()" role="button">
                            in <i class='bx bx-map' style="font-size: 19px"></i>
                            <span class="locationName mt-1">Dhaka</span>
                        </span>
                    </h5>
                </div>
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -135px;margin-right: -37px;background-color: #ffffff;box-shadow: 0px 0px 5px 3px #ae45d866;background-image: none;font-size: 21px;font-weight: bold;z-index: 99999;height: 30px;width: 30px;border-radius: 50%;">
                        X
                    </button>
                </div>
                <div class="modal-body" style="height: 50vh; padding: 0 40px 0 40px; background-color: #f9f8fb !important">

                    <div class="row pt-0 pb-2">

                        <div class="col-8">



                            <div class="serviceSingleTop">
                                <div class="row" style="background-color: #cdcbcb21; padding: 10px 0 0 0;">
                                </div>

                                <h6 class="mt-2">Select More Service -</h6>

                                <div class="showServices">
                                    <!-- -- service append -- -->
                                </div>
                            </div>

                        </div>

                        <div class="col-4">

                            <h6 class="mt-2" style="border-bottom: 1px dashed #9307cb40;">Cart Items</h6>
                            <div class="cartItems">
                                <!-- -- append cart data -- -->
                            </div>


                            <div class="cartEmpty d-none">
                                <div class="emptyCart mt-5">
                                    <p class="text-center" style="opacity: .3; font-size: 35px; font-family: sans-serif;">Empty Cart</p>
                                    <span class="text-center" style="opacity: .3;font-family: sans-serif;display: flex;justify-content: space-around;">
                                        Order a service just few clicks!
                                        <br>so what are you waiting for...
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0 pb-0 mb-0">
                    <br>
                    @auth
                    <a href="{{ url('checkout_page') }}" class="btn btn-primary btn-lg checkout_btn" disabled style="z-index: 999; margin: 0 -12px 0 0;border-radius: 0;width: 35%;background-color: #3f1c62;border: 1px solid #3f1c62;">
                        Proceed To Checkout &nbsp; <i class='bx bxs-chevrons-right' style="color: #fbfafc !important;"></i>
                    </a>
                    @else
                    <a href="javascript:void(0)" onclick="showLoginRegisterOption()" class="btn btn-primary btn-lg checkout_btn" disabled style="z-index: 999; margin: 0 -12px 0 0;border-radius: 0;width: 35%;background-color: #3f1c62;border: 1px solid #3f1c62;">
                        Proceed To Checkout &nbsp; <i class='bx bxs-chevrons-right' style="color: #fbfafc !important;"></i>
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>


    <!-- -- message section -- -->
    @if(Session::has('success'))
    <script>
        Toastify({
            text: "{{ Session::get('success') }}",
            duration: 2000,
            close: true,
            gravity: "top",
            backgroundColor: "linear-gradient(to right, #4caf50, #4caf50)"
        }).showToast();
    </script>
    @endif
    @if(Session::has('error'))
    <script>
        Toastify({
            text: "{{ Session::get('error') }}",
            duration: 2000,
            close: true,
            gravity: "top",
            backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"
        }).showToast();
    </script>
    @endif
    <!-- -- end message section -- -->



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
    <script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/meanmenu.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/contact-form-script.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script src="{{asset('frontend/assets/js/selectize.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //=============== search by service name, slug and code ======================
        $(".searchItem").addClass('d-none');

        $('.findService').on('keyup change', function() {
            let serviceFind = $(this).val();
            if (serviceFind.length > 0) {
                $(".searchItem").removeClass('d-none');

                $.ajax({
                    url: '/get_service',
                    type: "POST",
                    data: {
                        serviceName: serviceFind.trim()
                    },
                    beforeSend: () => {
                        $(".searchItems").html()
                    },
                    success: function(res) {
                        if (res.length > 0) {
                            let row = "";
                            $.each(res, (index, value) => {
                                row += `<li class="list-group-item">
                                    <a href="${location.origin+'/service-single/'+value.slug}">
                                        <span style="float: left;">${value.name}</span>
                                        <span style="float: right;">
                                            <i class="bx bx-right-arrow-alt" style="font-size: 19px;font-weight: bold;"></i>
                                        </span>
                                    </a>
                                </li>`;
                                $(".searchItems").html(row)
                            })
                        } else {
                            $(".searchItems").html(`<li class="list-group-item">
                                <a href="javascript:void(0)">
                                    <span class="text-center">Service Not Available</span>
                                </a>
                            </li>`)
                        }
                    },
                });

            } else {
                $(".searchItem").addClass('d-none');
            }
        })
    </script>


    <!-- -- cart functionality -- -->
    <script>
        itemsCart();

        function cartModal(data) {
            let id = data.id;
            $("#serviceAddToCartModal .serviceTxt").text(data.name);
            $.ajax({
                url: '/cart_modal_data',
                method: 'POST',
                data: {
                    id: id
                },
                success: res => {
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
                    } else {
                        $("#serviceAddToCartModal .checkout_btn").addClass('disabled');
                        $(".cartEmpty").removeClass('d-none');
                    }

                    $("#serviceAddToCartModal").modal('show');

                    // push cart item
                    itemsCart();
                }
            });
        }

        function itemsCart() {
            $.ajax({
                url: '/getCartItems',
                method: 'GET',
                data: '',
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
                            cartData += `<div class="row serviceSingle">
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

                        if (res.cartCount && res.cartCount > 0) {
                            $(".cartBagCheckoutBtn").removeClass('d-none');
                            $.each(res.content, (index, cartItem) => {
                                cartBag += `<a href="javascript:void(0)" onclick="cartDelete('${cartItem.rowId}')" style="font-weight: 600;" title="Click to remove from cart">
                                   <span class="p-2"> ${cartItem.name} </span>
                                    &nbsp;  X
                                </a>`
                            })
                        } else {
                            $(".cartBagCheckoutBtn").addClass('d-none');
                            cartBag = `<div class="col-12">
                                <h6 class="p-3 text-center">
                                    No Item Found
                                </h6>
                            </div>`
                        }


                        $(".cartItems").append(cartData);
                        $(".cartBagItems").append(cartBag);
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
                    data: {
                        rowId: id
                    },
                    success: res => {
                        $("." + id).remove()
                        $(".product-cart-remove-" + id).remove()
                        itemsCart();
                    }
                })
            }
        }

        function addToCart(id) {
            $.ajax({
                url: '/addcart',
                method: 'POST',
                data: {
                    id: id
                },
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
        } else {
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
        function customerLogin() {
            $("#loginRegisterModal").modal('hide');
            $("#customerLogin").modal('show');
        }

        //===========================================//END//---Login Register process =====================================================
    </script>

    <!-- -- cart -- -->
    <script>
        function orderNow(id) {
            $.ajax({
                url: "/addcart",
                method: "POST",
                data: {
                    id: id
                },
                success: res => {
                    location.href = "{{route('checkout.page')}}"
                }
            })
        }
    </script>
    <!-- -- end cart -- -->

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
                        Toastify({
                            text: res.success,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                        }).showToast();

                        $("form").trigger("reset")
                        if (res.content > 0) {
                            location.href = "{{ url('checkout_page')}}"
                        } else {
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