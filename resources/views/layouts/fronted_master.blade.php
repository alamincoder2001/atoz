<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$profile->company_name}}@yield("title")</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset($profile->navicon != null ? $profile->navicon : 'noImage.jpg')}}" />
    @include("layouts.frontend.style")

    <style>
        .ImageBackground .imageShow {
            display: block;
            height: 120px;
            width: 100%;
            margin-top: 10px;
            border: 1px solid #042ab5;
            border-bottom: 0;
            box-sizing: border-box;
        }

        .ImageBackground input {
            display: none;
        }

        .ImageBackground label {
            background: #042ab5;
            width: 100%;
            color: white;
            padding: 5px;
            text-align: center;
            cursor: pointer;
            font-family: monospace;
            text-transform: uppercase;
        }

        .page-link.disabled,
        .disabled>.page-link {
            color: gray !important;
        }

        .page-item.active .page-link {
            color: #ffffff !important;
            background: #223b97 !important;
            border: none !important;
        }

        .page-link:hover {
            background: #2b46a8 !important;
            border: 1px solid #2b46a8 !important;
        }

        /* Rating style */
        .rating input[type="radio"]:not(:nth-of-type(0)) {
            /* hide visually */
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        .rating [type="radio"]:not(:nth-of-type(0))+label {
            display: none;
        }

        label[for]:hover {
            cursor: pointer;
        }

        .rating .stars label:before {
            content: "★";
        }

        .stars label {
            color: lightgray;
        }

        .stars label:hover {
            text-shadow: 0 0 1px #000;
        }

        .rating [type="radio"]:nth-of-type(1):checked~.stars label:nth-of-type(-n+1),
        .rating [type="radio"]:nth-of-type(2):checked~.stars label:nth-of-type(-n+2),
        .rating [type="radio"]:nth-of-type(3):checked~.stars label:nth-of-type(-n+3),
        .rating [type="radio"]:nth-of-type(4):checked~.stars label:nth-of-type(-n+4),
        .rating [type="radio"]:nth-of-type(5):checked~.stars label:nth-of-type(-n+5) {
            color: orange !important;
        }

        .rating [type="radio"]:nth-of-type(1):focus~.stars label:nth-of-type(1),
        .rating [type="radio"]:nth-of-type(2):focus~.stars label:nth-of-type(2),
        .rating [type="radio"]:nth-of-type(3):focus~.stars label:nth-of-type(3),
        .rating [type="radio"]:nth-of-type(4):focus~.stars label:nth-of-type(4),
        .rating [type="radio"]:nth-of-type(5):focus~.stars label:nth-of-type(5) {
            color: darkorange !important;
        }

        .stars{
            font-size: 22px;
        }
    </style>

</head>

<body style="position: relative;">
    <div class="cartImage d-none" style="position: fixed;left: 0;top: 0;z-index: 999999;width: 100%;height:100%;background:#1f74f336;display: flex;justify-content: center;align-items: center;">
        <img src="{{asset('shopping-cart.gif')}}">
    </div>
    <div class="checkoutImage d-none" style="position: fixed;left: 0;top: 0;z-index: 999999;width: 100%;height:100%;background:#e7e7e740;display: flex;justify-content: center;align-items: center;">
        <img src="{{asset('loading.gif')}}" width="150">
    </div>
    <!-- Modal -->
    <div class="modal fade offcanvas-modal" id="exampleModal">
        <div class="modal-dialog offcanvas-dialog">
            <div class="modal-content">
                <div class="modal-header offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="#" class="offcanvas-form">
                    <div class="input-group border">
                        <div class="input-group-text">
                            <select class="form-select d-none d-xl-block" aria-label="Default select example">
                                <option selected="">All categories</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control border-0" placeholder="Enter your search key ... " />
                        <div class="input-group-text">
                            <button class="btn btn-primary btn-hover-warning" type="submit">
                                Search
                            </button>
                        </div>
                    </div>
                </form>

                <!-- offcanvas-mobile-menu start -->

                <nav id="offcanvasNav" class="offcanvas-menu">
                    <ul>
                        <li>
                            <a href="{{route('website')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('service')}}">Service</a>
                        </li>
                        <li>
                            <a href="{{route('worker')}}">Worker</a>
                        </li>
                        <li>
                            <a href="{{route('blog')}}">Blog</a>
                        </li>
                        <li>
                            <a href="{{route('contact')}}">Contact</a>
                        </li>
                    </ul>

                    <div class="offcanvas-social">
                        <ul>
                            <li>
                                <a href="#"><i class="ion-social-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="ion-social-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="ion-social-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="ion-social-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- offcanvas-mobile-menu end -->
                <div class="header-top">
                    <p>
                        Email:
                        <a class="header-top-link" href="https://www.gmail.com">{{$profile->email}}</a>
                    </p>
                    <p>Free Shipping for all Order</p>

                    <ul id="offcanvas-menu2" class="blog-ctry-menu blog-ctry-menu2">
                        @if(Auth::guard('web')->check() || Auth::guard('worker')->check())
                        @if(Auth::guard('web')->check())
                        <li>
                            <a href="javascript:void(0)">My Account</a>
                            <ul class="category-sub-menu">
                                <li>
                                    <a href="{{route('customer.dashboard')}}">Account</a>
                                </li>
                                <li>
                                    <a href="{{route('customer.logout')}}">Sign Out</a>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li>
                            <a href="javascript:void(0)">My Account</a>
                            <ul class="category-sub-menu">
                                <li>
                                    <a href="{{route('worker.dashboard')}}">Account</a>
                                </li>
                                <li>
                                    <a href="{{route('worker.logout')}}">Sign Out</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @else
                        <li>
                            <a href="{{route('showSignUpForm')}}">Sign Up</a>
                        </li>
                        <li>
                            <a href="{{route('showSignInForm')}}">Sign In</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Header  Start -->
    @include("layouts.frontend.navbar")
    <!-- Header  End -->
    <main>
        @yield("content")
    </main>


    <footer class="footer-section" style="background: #bec6ff99;padding-top: 10px;">
        <div class="footer-top position-relative">
            <div class="container">
                <div class="row g-0">
                    <div class="col-12">
                        <div class="section-py">
                            <div class="row mb-n7">
                                <div class="col-lg-2">
                                    <div style="height:50px;"></div>
                                    <div class="footer-widget d-flex align-items-center flex-column">
                                        <a class="footer-logo" href="#" style="width: 50%;height: 100px;border: 1px solid #919191;padding: 2px;">
                                            <img title="{{$profile->ownername}}" style="width:100%;height: 100%;" src="{{asset($profile->ownerimage != null ? $profile->ownerimage : 'nouser.png' )}}" alt="footer-logo" />
                                        </a>
                                        <ul class="address mt-3">
                                            <li>{{$profile->ownername}}, {{$profile->ownerdesignation}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <h4>Address-1</h4>
                                    <ul class="footer-address">
                                        <li>
                                            <span class="sign fa fa-globe"></span>
                                            <span>{{$profile->company_name}}</span>
                                        </li>
                                        <li>
                                            <span style="left: -19px;font-size:16px;" class="sign fa fa-map-marker"></span>
                                            <span>{{$profile->address}}</span>
                                        </li>
                                        <li>
                                            <span class="sign fa fa-phone"></span>
                                            <span>
                                                <a href="tel:/{{$profile->mobile}}">+880 {{$profile->mobile}}</a>
                                            </span>
                                        </li>
                                        <li>
                                            <span style="font-size: 13px;" class="sign fa fa-envelope-o"></span>
                                            <span>
                                                <a href="mailto:/{{$profile->email}}">{{$profile->email}}</a>
                                            </span>
                                        </li>
                                    </ul>
                                    <h4>Address-2</h4>
                                    <ul class="footer-address">
                                        <li>
                                            <span class="sign fa fa-globe"></span>
                                            <span>{{$profile->company_name}}</span>
                                        </li>
                                        <li>
                                            <span style="left: -19px;font-size:16px;" class="sign fa fa-map-marker"></span>
                                            <span>{{$profile->address_second}}</span>
                                        </li>
                                        <li>
                                            <span class="sign fa fa-phone"></span>
                                            <span>
                                                <a href="tel:/{{$profile->mobile}}">+880 {{$profile->mobile_second}}</a>
                                            </span>
                                        </li>
                                        <li>
                                            <span style="font-size: 13px;" class="sign fa fa-envelope-o"></span>
                                            <span>
                                                <a href="mailto:/{{$profile->email}}">{{$profile->email_second}}</a>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-5">
                                    <div style="height:30px;"></div>
                                    <div class="card" style="background: none;">
                                        <div class="card-header">
                                            <h5 class="m-0 text-center">Our service</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">Hello World</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <h4>Social Link</h4>
                                    <ul>
                                        <li style="margin-bottom: 5px;">
                                            <a href="{{$profile->facebook}}" target="_blank" style="padding: 7px 5px;">
                                                <span style="width: 25px;text-align: center;background: gray;padding: 5px;border-radius:5%;" class="fa fa-facebook"></span>
                                                <span>Facebook</span>
                                            </a>
                                        </li>
                                        <li style="margin-bottom: 5px;">
                                            <a href="{{$profile->youtube}}" target="_blank" style="padding: 7px 5px;">
                                                <span style="width: 25px;text-align: center;background: gray;padding: 5px;border-radius:5%;" class="fa fa-youtube"></span>
                                                <span>Youtube</span>
                                            </a>
                                        </li>
                                        <li style="margin-bottom: 5px;">
                                            <a href="{{$profile->linkedin}}" target="_blank" style="padding: 7px 5px;">
                                                <span style="width: 25px;text-align: center;background: gray;padding: 5px;border-radius:5%;" class="fa fa-linkedin"></span>
                                                <span>Linkedin</span>
                                            </a>
                                        </li>
                                        <li style="margin-bottom: 5px;">
                                            <a href="{{$profile->twitter}}" target="_blank" style="padding: 7px 5px;">
                                                <span style="width: 25px;text-align: center;background: gray;padding: 5px;border-radius:5%;" class="fa fa-twitter"></span>
                                                <span>Twitter</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- coppy right satrt -->
        <div class="copy-right-section border-top" style="margin-top: 25px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 order-last order-md-first">
                        <div class="copyright-info text-center text-md-start">
                            <p>
                                Copyright &copy; {{date("Y")}}
                                <a href="https://linktechbd.com/" target="_blank">Link-Up Technology Ltd.</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-end mb-3 mb-md-0">
                        <img src="{{asset('frontend')}}/assets/images/payment.png" alt="images">
                    </div>
                </div>
            </div>
        </div>
        <!-- coppy right end -->
    </footer>

    @include("layouts.frontend.script")


    <!-- Modals -->
    <!-- quick view modal -->

    <!-- Modal -->
    <div class="modal fade" id="quickview" tabindex="-1" aria-labelledby="quickview">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body my-6">
                    <div class="row mb-n10">
                        <div class="col-xl-6 col-lg-6 mb-10">
                            <div class="product-detail_img vertical-slider_wrap">
                                <div class="swiper-container pd-vertical_slider lightgallery">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="single-img">
                                                <img src="{{asset('frontend')}}/assets/images/products/product2.jpg" alt="Product Image" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="single-img">
                                                <img src="{{asset('frontend')}}/assets/images/products/product3.jpg" alt="Product Image" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="single-img">
                                                <img src="{{asset('frontend')}}/assets/images/products/product4.jpg" alt="Product Image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="vertical-slider_nav">
                                    <div class="swiper-navination-vertical d-none d-md-inline-block">
                                        <div class="swiper-button-prev">
                                            <span class="lnr lnr-chevron-up"></span>
                                        </div>
                                        <div class="swiper-button-next">
                                            <span class="lnr lnr-chevron-down"></span>
                                        </div>
                                    </div>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a href="#?">
                                                <img src="{{asset('frontend')}}/assets/images/products/small/2.jpg" alt="Product Thumnail" /></a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="#?">
                                                <img src="{{asset('frontend')}}/assets/images/products/small/3.jpg" alt="Product Thumnail" /></a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="#?"><img src="{{asset('frontend')}}/assets/images/products/small/4.jpg" alt="Product Thumnail" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-10">
                            <div class="content">
                                <h3 class="title">Leaf & Bean Electric Milk Frother & Warmer</h3>
                                <span class="price-lg regular-price mb-2 d-block">$83.90</span>
                                <p>
                                    The Crown Summit Backpack is equally at home in a gym locker, study cube
                                    or a pup tent, so be sure yours is packed with books, a bag lunch, water
                                    bottles, yoga block, laptop, or whatever else you want in hand. Rugged
                                    enough for day hikes and camping trips, it has two large zippered
                                    compartments and padded, adjustable shoulder straps.
                                </p>
                                <h4 class="modal-quantity">Quantity</h4>
                                <div class="product-count style d-flex my-4">
                                    <div class="count d-flex">
                                        <input type="number" min="1" max="100" step="1" value="1" />
                                        <div class="button-group">
                                            <button class="count-btn increment">
                                                <span class="lnr lnr-chevron-up"></span>
                                            </button>
                                            <button class="count-btn decrement">
                                                <span class="lnr lnr-chevron-down"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary btn-hover-warning text-uppercase">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-hover-warning text-uppercase">Add to my wishlist</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add to wishlist -->


</body>

</html>