@extends("layouts.fronted_master")
@section("title", " Website - Home")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="mobile-category-nav d-lg-none pt-4">
                <!--=======  category menu  =======-->
                <div class="hero-side-category">
                    <!-- Category Toggle Wrap -->
                    <div class="category-toggle-wrap">
                        <!-- Category Toggle -->
                        <button class="more-btn">
                            <span class="lnr lnr-text-align-left"></span> All Categories
                        </button>
                    </div>

                    <!-- Category Menu -->
                    <nav class="category-menu">
                        <ul>
                            <li class="menu-item-has-children menu-item-has-children-1">
                                <a href="#">Accessories &amp; Parts<i class="ion-ios-arrow-down"></i></a>
                                <!-- category submenu -->
                                <ul class="category-mega-menu category-mega-menu-1">
                                    <li><a href="#">Cables &amp; Adapters</a></li>
                                    <li><a href="#">Batteries</a></li>
                                    <li><a href="#">Chargers</a></li>
                                    <li><a href="#">Bags &amp; Cases</a></li>
                                    <li><a href="#">Electronic Cigarettes</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Televisions</a></li>
                            <li class="hidden" style="display: none">
                                <a href="#">Projectors</a>
                            </li>
                            <li>
                                <a href="#" id="more-btn"><i class="ion-ios-plus-empty"></i> More Categories</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Hero Slider Start -->
<section class="hero-section position-relative">
    <div class="container">
        <div class="row mb-n7">
            <div class="col-md-3">
                <div class="vertical-menu d-none d-lg-block">
                    <button class="menu-btn d-flex">
                        <span class="lnr lnr-text-align-left"></span>Browse categories
                    </button>
                    <ul class="vmenu-content">
                        <!-- <li class="menu-item">
                            <a href="#">Cookware<i class="ion-ios-arrow-right"></i></a>
                            <ul class="verticale-mega-menu flex-wrap">
                                <li>
                                    <a href="#">
                                        <strong> Baking & Pastry Mats</strong>
                                    </a>
                                    <ul class="submenu-item">
                                        <li><a href="#">Baking Cups</a></li>
                                        <li><a href="#">Baking Dishes</a></li>
                                        <li><a href="#">Baking Mats</a></li>
                                        <li><a href="#">Pastry Boards</a></li>
                                        <li><a href="#">Pastry Mats</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                        @foreach($categories as $item)
                        <li class="menu-item"><a href="#">{{$item->name}}</a></li>
                        @endforeach
                    </ul>
                    <!-- menu content -->
                </div>

            </div>
            <div class="col-md-9">
                <div class="hero-slider position-relative">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!-- swiper-slide start -->
                            @foreach($slider as $item)
                            <div class="hero-slide-item swiper-slide" style="background-image: url('{{asset($item->image != null ? $item->image : 'noImage.jpg')}}');background-repeat: no-repeat;background-size: cover;background-position: 0% center;">
                                <div class="hero-slide-content">
                                    <h2 class="title delay2 animated">{{$item->title}}</h2>
                                    <p class="text animated">{!! $item->description !!}</p>
                                    <a href="#" class="btn animated btn-primary text-white btn-hover-warning mb-3 mb-sm-0 text-uppercase">shopping Now</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- swiper navigation -->
                    <div class="swiper-button-prev">
                        <i class="fa fa-angle-left"></i>
                    </div>
                    <div class="swiper-button-next">
                        <i class="fa fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Slider End -->

<!-- Feature Product tab Start -->
<section class="section">
    <div class="container">
        <div class="row g-0">
            <div class="col-12">
                <div class="title-section text-center text-lg-start">
                    <div class="row">
                        <!-- title section Start -->
                        <div class="col-12 col-lg-4">
                            <h3 class="title">Featured Service</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="baking">
                        <div class="product-carousel1">
                            <div class="d-none d-sm-block swiper-navination-arrows">
                                <div class="swiper-button-prev">
                                    <span class="ion-android-arrow-back"></span>
                                </div>
                                <div class="swiper-button-next">
                                    <span class="ion-android-arrow-forward"></span>
                                </div>
                            </div>
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <!-- single slide Start -->
                                    @foreach($services as $item)
                                    <div class="swiper-slide">
                                        <div class="product-card" style="height:250px;">
                                            <a class="thumb" href="{{route('single.service', $item->slug)}}">
                                                <img src="{{asset($item->image != null ? $item->image : 'no-product-image.jpg')}}" alt="img" style="height: 150px;width: 100%;" />
                                            </a>
                                            <div class="product-content">
                                                <a class="product-category" href="#?">{{$item->category_name}}</a>
                                                <h3 class="product-title">
                                                    <a href="{{route('single.service', $item->slug)}}">{{$item->name}}</a>
                                                </h3>
                                                <!-- <span class="price regular-price">
                                                    ৳ 0
                                                </span> -->
                                                <button class="product-btn btn btn-primary btn-hover-warning" onclick="addCart({{$item->id}})">
                                                    Add to Cart
                                                </button>
                                            </div>
                                            <!-- actions links start -->
                                            <!-- <ul class="actions">
                                                <li class="action-item"><button class="action quick-view" data-bs-toggle="modal" data-bs-target="#quickview"><span class="lnr lnr-magnifier"></span></button></li>
                                                <li class="action-item"><button class="action wishlist" onclick="addWishlist({{$item->id}})"><span class="lnr lnr-heart"></span></button></li>
                                            </ul> -->
                                            <!-- actions links end -->
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- single slide End -->
                                </div>
                            </div>
                            @if(count($services) == 0)
                            <div class="text-center">
                                <img src="{{asset('no-product.png')}}" width="300">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Feature Product tab End -->

<!-- Worker tab Start -->
<section class="section  section-py">
    <div class="container">
        <div class="row g-0">
            <div class="col-12">
                <div class="title-section text-center text-lg-start">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <h3 class="title">Recent Worker</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="baking">
                        <div class="product-carousel1">
                            <div class="d-none d-sm-block swiper-navination-arrows">
                                <div class="swiper-button-prev">
                                    <span class="ion-android-arrow-back"></span>
                                </div>
                                <div class="swiper-button-next">
                                    <span class="ion-android-arrow-forward"></span>
                                </div>
                            </div>
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @if(Auth::guard('web')->check())
                                    @foreach($worker as $item)
                                    @if(Auth::guard('web')->user()->thana->district_id == $item->district_id)
                                    <div class="swiper-slide">
                                        <div class="product-card" style="position:relative;height:200px;border: 1px solid #cdcdcd;">
                                            @if($item->status == 'v')
                                            <span style="position: absolute;right:0;top:0;background: green;color: white;padding: 0px 5px;border-bottom-left-radius: 10px;">{{$item->status == 'v' ? 'Verified' : ''}}</span>
                                            @endif
                                            <a class="thumb text-center" href=""><img style="width: 100px;border:1px solid #e5e5e5;padding:2px;" src="{{asset($item->image != null ? $item->image : 'nouser.png')}}" alt="img" /></a>
                                            <div class="product-content text-center">
                                                <h3 class="product-title mt-3">
                                                    <a href="">{{$item->name}}</a>
                                                </h3>
                                                <span>Location: {{$item->thana->name}}, {{$item->thana->district->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @foreach($worker as $item)
                                    @if(Auth::guard('web')->user()->thana->district_id != $item->district_id)
                                    <div class="swiper-slide">
                                        <div class="product-card" style="position:relative;height:200px;border: 1px solid #cdcdcd;">
                                            @if($item->status == 'v')
                                            <span style="position: absolute;right:0;top:0;background: green;color: white;padding: 0px 5px;border-bottom-left-radius: 10px;">{{$item->status == 'v' ? 'Verified' : ''}}</span>
                                            @endif
                                            <a class="thumb text-center" href=""><img style="width: 100px;border:1px solid #e5e5e5;padding:2px;" src="{{asset($item->image != null ? $item->image : 'nouser.png')}}" alt="img" /></a>
                                            <div class="product-content text-center">
                                                <h3 class="product-title mt-3">
                                                    <a href="">{{$item->name}}</a>
                                                </h3>
                                                <span>Location: {{$item->thana->name}}, {{$item->thana->district->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @else
                                    @foreach($worker as $item)
                                    <div class="swiper-slide">
                                        <div class="product-card" style="position:relative;height:200px;border: 1px solid #cdcdcd;">
                                            @if($item->status == 'v')
                                            <span style="position: absolute;right:0;top:0;background: green;color: white;padding: 0px 5px;border-bottom-left-radius: 10px;">{{$item->status == 'v' ? 'Verified' : ''}}</span>
                                            @endif
                                            <a class="thumb text-center" href=""><img style="width: 100px;border:1px solid #e5e5e5;padding:2px;" src="{{asset($item->image != null ? $item->image : 'nouser.png')}}" alt="img" /></a>
                                            <div class="product-content text-center">
                                                <h3 class="product-title mt-3">
                                                    <a href="">{{$item->name}}</a>
                                                </h3>
                                                <span>Location: {{$item->thana->name}}, {{$item->thana->district->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            @if(count($worker) == 0)
                            <div class="text-center">
                                <img src="{{asset('no-product.png')}}" width="300">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Worker tab End -->

<!-- Banner Section Start -->
@php
$bann = array_chunk($banner, 3);
@endphp

@if(isset($bann[0]))
<div class="banner-section section-py">
    <div class="container">
        <div class="row mb-n7">
            @foreach($bann[0] as $item)
            <!-- banner box start -->
            <div class="col-md-4 mb-7">
                <a class="zoom-in text-center" href="shop-grid-left-sidebar.html" title="{{$item->title}}">
                    <img src="{{asset($item->image != null ? $item->image : 'no-image.jpg')}}" alt="img">
                </a>
            </div>
            <!-- banner box end -->
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- Banner Section End -->

<!-- Product tab Start -->
<section class="section-py">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-section">
                    <ul class="nav nav-pills product-tab-links2">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="pill" href="#newarrival">New Arrival</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#bestseller">Best Service</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#featuredproducts">Featured Service</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="newarrival">
                @if(count($services) != 0)
                <div class="row mb-n7">
                    <div class="col-lg-7 col-xl-8 mb-7 order-first order-lg-last">
                        <div class="product-carousel2">
                            <div class="d-none d-sm-block swiper-navination-arrows">
                                <div class="swiper-button-prev">
                                    <span class="ion-android-arrow-back"></span>
                                </div>
                                <div class="swiper-button-next">
                                    <span class="ion-android-arrow-forward"></span>
                                </div>
                            </div>
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($services->chunk(2) as $service)
                                    <!-- single slide Start -->
                                    <div class="swiper-slide">
                                        <div class="product-list">
                                            @foreach($service as $item)
                                            <div class="product-card">
                                                <a class="thumb" href="{{route('single.service', $item->slug)}}"><img src="{{asset($item->image != null ? $item->image : 'no-product-image.jpg')}}" alt="img" />
                                                </a>
                                                <div class="product-content">
                                                    <a class="product-category" href="#?">{{$item->category_name}}</a>
                                                    <h3 class="product-title">
                                                        <a href="{{route('single.service', $item->slug)}}">{{$item->name}}</a>
                                                    </h3>
                                                    <button class="product-btn btn btn-primary btn-hover-warning" onclick="addCart({{$item->id}})">
                                                        Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- single slide End -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @else
                <div class="text-center">
                    <img src="{{asset('no-product.png')}}" width="300">
                </div>
                @endif
            </div>

            <div class="tab-pane fade" id="bestseller">
                @if(count($services) != 0)
                <div class="row mb-n7">
                    <!-- <div class="col-lg-5 col-xl-4 mb-7">
                        <div class="product-card-large">
                            <a class="thumb" href="{{route('single.service', $services[0]->slug)}}"><img class="d-block mx-auto" src="{{asset($services[0]->image != null ? $services[0]->image : 'no-product-image.jpg')}}" alt="img" />
                            </a>
                            <div class="product-content">
                                <a class="product-category" href="#?">{{$services[0]->category_name}}</a>
                                <h3 class="product-title">
                                    <a href="{{route('single.service', $services[0]->slug)}}">{{$services[0]->name}}</a>
                                </h3>
                                <button class="product-btn-lg btn btn-primary btn-hover-warning" onclick="addCart({{$services[0]->id}})">
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-7 col-xl-8 mb-7 order-first order-lg-last">
                        <div class="product-carousel2">
                            <div class="d-none d-sm-block swiper-navination-arrows">
                                <div class="swiper-button-prev">
                                    <span class="ion-android-arrow-back"></span>
                                </div>
                                <div class="swiper-button-next">
                                    <span class="ion-android-arrow-forward"></span>
                                </div>
                            </div>
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($services->chunk(2) as $service)
                                    <!-- single slide Start -->
                                    <div class="swiper-slide">
                                        <div class="product-list">
                                            @foreach($service as $item)
                                            <div class="product-card">
                                                <a class="thumb" href="{{route('single.service', $item->slug)}}"><img src="{{asset($item->image != null ? $item->image : 'no-product-image.jpg')}}" alt="img" />
                                                </a>
                                                <div class="product-content">
                                                    <a class="product-category" href="#?">{{$item->category_name}}</a>
                                                    <h3 class="product-title">
                                                        <a href="{{route('single.service', $item->slug)}}">{{$item->name}}</a>
                                                    </h3>
                                                    <button class="product-btn btn btn-primary btn-hover-warning" onclick="addCart({{$item->id}})">
                                                        Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- single slide End -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center">
                    <img src="{{asset('no-product.png')}}" width="300">
                </div>
                @endif
            </div>
            <div class="tab-pane fade" id="featuredproducts">
                @if(count($services) != 0)
                <div class="row mb-n7">
                    <div class="col-lg-7 col-xl-8 mb-7 order-first order-lg-last">
                        <div class="product-carousel2">
                            <div class="d-none d-sm-block swiper-navination-arrows">
                                <div class="swiper-button-prev">
                                    <span class="ion-android-arrow-back"></span>
                                </div>
                                <div class="swiper-button-next">
                                    <span class="ion-android-arrow-forward"></span>
                                </div>
                            </div>
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($services->chunk(2) as $service)
                                    <!-- single slide Start -->
                                    <div class="swiper-slide">
                                        <div class="product-list">
                                            @foreach($service as $item)
                                            <div class="product-card">
                                                <a class="thumb" href="{{route('single.service', $item->slug)}}"><img src="{{asset($item->image != null ? $item->image : 'no-product-image.jpg')}}" alt="img" />
                                                </a>
                                                <div class="product-content">
                                                    <a class="product-category" href="#?">{{$item->category_name}}</a>
                                                    <h3 class="product-title">
                                                        <a href="{{route('single.service', $item->slug)}}">{{$item->name}}</a>
                                                    </h3>
                                                    <button class="product-btn btn btn-primary btn-hover-warning" onclick="addCart({{$item->id}})">
                                                        Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- single slide End -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center">
                    <img src="{{asset('no-product.png')}}" width="300">
                </div>
                @endif
            </div>
        </div>

    </div>
</section>
<!-- Product tab End -->

<!-- Banner Section Start -->
@if(isset($bann[1]))
<div class="banner-section section-py">
    <div class="container">
        <div class="row mb-n7">
            @foreach($bann[1] as $item)
            <!-- banner box start -->
            <div class="col-md-4 mb-7">
                <a class="zoom-in text-center" href="shop-grid-left-sidebar.html" title="{{$item->title}}">
                    <img src="{{asset($item->image != null ? $item->image : 'no-image.jpg')}}" alt="img">
                </a>
            </div>
            <!-- banner box end -->
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- Banner Section End -->

@foreach($isWebsiteCategoryProduct->take(3) as $key => $category)
<!-- Product tab Start -->
<section class="section-py">
    <div class="container">
        <div class="row g-0">
            <div class="col-12">
                <div class="title-section text-center text-lg-start">
                    <div class="row">
                        <!-- title section Start -->
                        <div class="col-12 col-lg-4">
                            <h3 class="title">{{$category->name}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade {{$key == 0 ? 'show active':''}}" id="{{$category->name}}">
                <div class="row mb-n7">
                    <div class="order-last order-lg-first col-lg-4 col-xl-3 custom-col-20 mb-7">
                        <a class="zoom-in text-center" href="#">
                            <img src="{{asset($category->image != null ? $category->image : 'noImage.jpg')}}" alt="img">
                        </a>
                    </div>
                    <div class="col-lg-8 col-xl-9 custom-col-80 mb-7">
                        <div class="product-list-carousel">
                            <div class="d-none d-sm-block swiper-navination-arrows">
                                <div class="swiper-button-prev">
                                    <span class="ion-android-arrow-back"></span>
                                </div>
                                <div class="swiper-button-next">
                                    <span class="ion-android-arrow-forward"></span>
                                </div>
                            </div>
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @if(count($category->service) > 0)
                                    @foreach($category->service->chunk(2) as $prod)
                                    <!-- single slide Start -->
                                    <div class="swiper-slide">
                                        @foreach($prod as $item)
                                        <!-- media-list -->
                                        <div class="media-list mb-4">
                                            <div class="media">
                                                <a class="thumb" href="{{route('single.service', $item->slug)}}"><img style="width:105px; height:105px;" src="{{asset($item->image != null ? $item->image : 'noImage.jpg')}}" alt="img" />
                                                </a>
                                                <div class="media-body">
                                                    <a class="product-category" href="#?">{{$category->name}}</a>
                                                    <h3 class="product-title">
                                                        <a href="{{route('single.service', $item->slug)}}">{{$item->name}}</a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- media-list end -->
                                        @endforeach
                                    </div>
                                    <!-- single slide End -->
                                    @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product tab End -->
@endforeach



<!-- Brand Slider Satrt -->

<!-- <div class="brand-section section-py">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="brand-carousel">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="single-brand">
                                    <a class="thumb" href="#"><img src="{{asset($item->image != null ? $item->image : 'noImage.jpg')}}" alt="brand logo"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination d-none"></div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Brand Slider End -->

<!-- Blog Section Start-->
<section class="blog-section section-py">
    <div class="container">
        <div class="row g-0">
            <div class="col-12">
                <div class="title-section">
                    <div class="row">
                        <!-- title section Start -->
                        <div class="col-12">
                            <h3 class="title">News & Events</h3>
                        </div>
                        <!-- title section End -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if($blog->count() > 0)
                <div class="blog-carousel">
                    <div class="d-none d-sm-block swiper-navination-arrows">
                        <div class="swiper-button-prev">
                            <span class="ion-android-arrow-back"></span>
                        </div>
                        <div class="swiper-button-next">
                            <span class="ion-android-arrow-forward"></span>
                        </div>
                    </div>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($blog as $item)
                            <!-- single-blog Start -->
                            <div class="swiper-slide">
                                <div class="blog-card">
                                    <div class="thumb">
                                        <a href="blog-details.html">
                                            <img src="{{asset($item->image != null ? $item->image : 'noImage.jpg')}}" alt="img" />
                                        </a>
                                    </div>
                                    <div class="blog-content">
                                        <h3 class="title">
                                            <a href="blog-details.html">{{$item->title}}</a>
                                        </h3>
                                        <a href="#"><span class="blog-meta">{{date("M d, Y", strtotime($item->date))}}</span></a>
                                    </div>
                                </div>
                            </div>
                            <!-- single-blog End -->
                            @endforeach
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center">Not Found Data</div>
                @endif

            </div>
        </div>
    </div>
</section>
<!-- Blog Section End-->
@endsection