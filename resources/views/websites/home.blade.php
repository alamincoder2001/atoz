@extends('layouts.fronted_master')
@section('front_title', ' Website - Home')
@push('front_style')
<style>
    /* ================= page custom css ==================== */
    .feedback-slides.owl-theme .owl-nav [class*=owl-]:hover,
    .feedback-slides.owl-theme .owl-nav [class*=owl-]:focus {
        background-color: #863ed2 !important;
        color: #ffffff !important;
        border-color: #e660fb !important;
    }

    .single-feedback-item .info::before {
        background-image: none !important;
    }

    .section-title {
        margin-bottom: 15px !important;
    }

    #owl-example.owl-carousel.owl-drag .owl-item {
        width: 200px !important;
    }

    .single-listing-box .listing-badge {
        background-color: #863ed2;
    }

    .single-listing-box .listing-badge::before {
        border-bottom: #863ed2;
    }

    .single-listing-item .listing-image .listing-tag a {
        color: #b654f1;
    }

    .single-listing-item .listing-image .listing-tag:hover {
        background-color: #863ed2 !important;
    }

    .single-listing-item:hover .listing-image .listing-tag,
    .single-listing-item:focus .listing-image .listing-tag {
        background-color: #863ed2 !important;
    }

    .single-listing-item .listing-discount span {
        background-color: #b756f2;
    }

    .single-listing-item .listing-discount span::before {
        background-color: #b756f2;
    }

    .single-listing-item .listing-discount span::after {
        background-color: #b756f2;
    }

    /* how it work and about section */
    .home-header p {
        color: rgba(0, 0, 0, .8);
        text-transform: uppercase;
        line-height: 1.29;
        position: relative;
        padding-left: 40px;
        font-weight: 500;
    }

    .home-header p:before {
        position: absolute;
        top: 8px;
        left: 0;
        content: "";
        width: 30px;
        height: 1px;
        background-color: #979797;
    }

    .ccircle {
        background-color: #c559f4;
        display: flex;
        color: #fff;
        justify-content: center;
        font-weight: 600;
        font-size: 25px;
        border-radius: 50%;
    }

    .list-group-flush>.list-group-item {
        border-width: 0 0 0 !important;
        padding: 10px 0 !important;
    }

    /* customer feedback button */
    .feedback-slides.owl-theme .owl-nav [class*=owl-]:hover,
    .feedback-slides.owl-theme .owl-nav [class*=owl-]:focus {
        background-color: #863ed252 !important;
    }

    #owl-category_slide>div.owl-nav>button.owl-prev {
        z-index: 1;
        width: 30px;
        height: 40px;
        border-radius: 50%;
        position: absolute;
        font-size: 48px;
        color: #863ed2;
        top: 27%;
        left: 0;
        transform: translatey(-50%);
    }


    #owl-category_slide>div.owl-nav>button.owl-next {
        z-index: 1;
        width: 30px;
        height: 40px;
        border-radius: 50%;
        position: absolute;
        left: 97%;
        font-size: 48px;
        color: #863ed2;
        top: 27%;
        transform: translatey(-50%);
    }

    .owl-theme .owl-nav [class*=owl-]:hover {
        background: none !important;
    }
</style>
@endpush
@section('front_content')

<!-- Start Main Banner Area -->
<div class="home-area" style="position: relative; height: 70vh;">
    <div class="home-slides owl-carousel owl-theme" style="position: relative; height: 60vh !important;">
        @foreach ($slider as $slider)
        <div class="hero-banner" style="background-image: url({{ asset($slider->image) }});"></div>
        @endforeach
        {{-- <div class="hero-banner" style="background-image: url({{ asset('frontend/assets/img/slider-1.png') }});">
    </div>
    <div class="hero-banner" style="background-image: url({{ asset('frontend/assets/img/slider-3.1.png') }});"></div> --}}
</div>

<div class="main-banner-content">
    <h1>Your Personal Assistant</h1>
    <h4 style="color: white">One-stop solution for your services. Order any service, anytime.</h4>

    <div class="row">
        <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2"></div>
        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8">
            <div class="main-search-wrap">
                <form>
                    <div class="row">

                        <div class="col-lg-5 col-md-6">
                            <div class="form-group">
                                <label>
                                    <a href="javascript:void(0)" class="d-flex align-items-center" onclick="locationModal()">
                                        <span><i class="bx bx-map" style="font-size: 25px;font-weight: bold;"></i></span>
                                        <span class="locationName"></span>
                                    </a>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="form-group">
                                <label><i class='bx bxs-keyboard'></i></label>
                                <input type="text" placeholder="Which service you want today?" class="serviceFind">
                            </div>
                        </div>
                    </div>

                    <div class="main-search-btn">
                        <button type="submit" style="background-color: #7b3edb; padding: 20px 40px;">
                            <i class='bx bx-search-alt' style="color: white !important; font-size: 25px;"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="row searchItem d-none" style="margin-top: 1px;z-index: 99999 !important;">
                <div class="col-4"></div>
                <div class="col-8">
                    <ul class="list-group serviceItems">
                        <li class="list-group-item ">
                            <a href="">
                                <span style="float: left;">An itemee</span>
                                <span style="float: right;">
                                    <i class='bx bx-right-arrow-alt' style="font-size: 19px;font-weight: bold;"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2"></div>
    </div>

    {{-- service card --}}
    <div class="feedback-area mt-5" style="position: absolute;bottom: -29vh;left: 0;width: 100%;z-index: 999999;">
        <div class="container" style="box-shadow: 0px 5px 20px 12px #a64ff026;border-radius: 15px;background-color: #ffffffff;">
            {{-- <div class="container" style="box-shadow: -1px -5px 20px 5px #a64ff038;border-radius: 15px;"> --}}


            <div class="row">
                <div id="owl-category_slide" class="owl-carousel owl-theme d-flex justify-content-center">
                    @foreach ($categories as $category)
                    <div class="item p-2">
                        <a href="{{ route('category_wise.service', $category->slug) }}" style="display: grid; justify-content: space-around;">
                            <img src="{{ asset($category->image) }}" class="rounded-circle" style="height: 80px !important; width: 80px !important;" alt="image">
                            <span>{{ $category->name }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>

                {{-- <div class="owl-carousel owl-theme">
                            @foreach ($categories as $category)
                                <div class="item">
                                    <div class="p-2">
                                        <a href="{{ route('category_wise.service', $category->slug) }}" style="display: grid; justify-content: space-around;">
                <img src="{{ asset($category->image) }}" class="rounded-circle" style="height: 80px !important; width: 80px !important;" alt="image">
                <span>{{ $category->name }}</span>
                </a>
            </div>
        </div>
        @endforeach
        <div class="item">2</div>
        <div class="item">3</div>
        <div class="item">4</div>
        <div class="item">5</div>
        <div class="item">6</div>
        <div class="item">7</div>
        <div class="item">8</div>
        <div class="item">9</div>
    </div> --}}
    {{-- <div class="btn-wrap">
                            <button class="prev-btn">Previous</button>
                            <button class="next-btn">Next</button>
                        </div> --}}

</div>
</div>
</div>
{{-- End service card --}}
</div>
</div>
<!-- End Main Banner Area -->

<!-- Start popular service -->
<section class="listing-area">

    <div class="container" style="margin-top: 85px !important;">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title" style="display: flex; justify-content: flex-start;">
                    <h3 style="font-weight: bold; color: #323334;border-bottom: 2px dashed #cc57f55e;">Popular Service</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="section-title" style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('services') }}" class="d-flex" style="color: #7b3edb;font-weight: bold;">
                        View All
                        <i class="bx bx-chevron-right" style="font-size: 25px;font-weight: bold;"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="listing-slides owl-carousel owl-theme">
            @foreach ($services as $key => $ser)
            @php
            $cdata = [
            'id' => $ser->id,
            'name' => $ser->name,
            ]
            @endphp
            <div class="single-listing-box">
                <a href="javascript:void(0)" onclick="cartModal({{ json_encode($cdata) }})" class="listing-image">
                    {{-- <a href="{{ route('single.service', $ser->slug) }}" class="listing-image"> --}}
                    <img src="{{ asset($ser->image) }}" style="width: 344px !important; height: 238px !important;" alt="image">
                </a>
                <div class="listing-badge">
                    Add To Cart
                </div>
                <div class="listing-content">
                    <div class="content">
                        <h3><a href="{{ route('single.service', $ser->slug) }}">{{ $ser->name }}</a></h3>
                        {{-- <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <span class="rating-count">2 reviews</span>
                                </div> --}}
                    </div>
                </div>
            </div>
            @if($key == 2)
            @break
            @endif
            @endforeach

        </div>
    </div>
</section>
<!-- End popular service -->

<!-- Start trending -->
<section class="listing-area">

    <div class="container mt-5">
        <div class="section-title" style="display: flex; justify-content: flex-start;">
            <h3 style="font-weight: bold; color: #323334;border-bottom: 2px dashed #cc57f55e;">Recently View</h3>
        </div>
        <div class="row">
            @foreach ($services_trending as $key => $serTrend)
            <div class="col-lg-4 col-sm-12 col-md-6">
                <div class="single-listing-item" style="box-shadow: 0 0 20px 1px #e760fb40;">

                    <div class="listing-image">
                        <a href="{{ route('single.service', $serTrend->slug) }}" class="d-block">
                            <img src="{{ asset($serTrend->image) }}" style="width: 344px !important; height: 238px !important;" alt="image">
                        </a>
                        <div class="listing-tag">
                            <a href="{{ route('single.service', $serTrend->slug) }}" class="d-block">{{ $serTrend->name }}</a>
                        </div>
                    </div>

                    {{-- <div class="listing-badge closed">Closed!</div> --}}
                    {{-- <div class="listing-badge">Open!</div> --}}
                    {{-- <span class="listing-discount">
                                <span>-15% OFF</span>
                            </span> --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End trending -->

<!-- Start trending -->
<section class="listing-area">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title" style="display: flex; justify-content: flex-start;">
                    <h3 style="font-weight: bold; color: #323334;border-bottom: 2px dashed #cc57f55e">Trending</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="section-title" style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('services') }}" class="d-flex" style="color: #7b3edb;font-weight: bold;">
                        View All
                        <i class="bx bx-chevron-right" style="font-size: 25px;font-weight: bold;"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="listing-slides owl-carousel owl-theme">
            @foreach ($services_trending as $key => $serTrend)
            <div class="single-listing-box">
                @auth
                {{-- <a href="{{ route('single.service', $serTrend->slug) }}" class="listing-image"> --}}
                <a href="javascript:void(0)" onclick="orderNow({{ $serTrend->id }})" class="listing-image">
                    <img src="{{ asset($serTrend->image) }}" style="width: 344px !important; height: 238px !important;" alt="image">
                </a>
                <a href="javascript:void(0)" onclick="orderNow({{ $serTrend->id }})" class="listing-badge">Order Now</a>
                @else
                {{-- <a href="{{ route('single.service', $serTrend->slug) }}" class="listing-image"> --}}
                <a href="javascript:void(0)" onclick="showLoginRegisterOption()" class="listing-image">
                    <img src="{{ asset($serTrend->image) }}" style="width: 344px !important; height: 238px !important;" alt="image">
                </a>
                <a href="javascript:void(0)" onclick="showLoginRegisterOption()" class="listing-badge">Order Now</a>
                @endauth
                <div class="listing-content">
                    <div class="content">
                        <h3><a href="{{ route('single.service', $serTrend->slug) }}">{{ $serTrend->name }}</a></h3>
                        {{-- <div class="rating">
                                    <i class='bx bxs-star' style="color:#9f9f9f !important"></i>
                                    <i class='bx bxs-star' style="color:#9f9f9f !important"></i>
                                    <i class='bx bxs-star' style="color:#9f9f9f !important"></i>
                                    <i class='bx bxs-star' style="color:#9f9f9f !important"></i>
                                    <i class='bx bxs-star' style="color:#9f9f9f !important"></i>
                                    <span class="rating-count">2 reviews</span>
                                </div> --}}
                    </div>
                </div>
            </div>
            @if($key == 2)
            @break
            @endif
            @endforeach

        </div>
    </div>
</section>
<!-- End trending -->

<!-- Start Video Area -->
<section class="listing-area">
    <div class="container mt-5">
        <div class="home-header">
            <p class="sub-title">How to order a service</p>
            <div class="section-title" style="display: flex; justify-content: flex-start;">
                <h3 style="font-weight: bold; color: #323334;">{{ $howToOrder->name }}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <section class="video-area ptb-100" data-jarallax='{"speed": 0.3}'>
                    <div class="container">
                        <div class="video-content">
                            <a href="{{ $howToOrder->video_link }}" class="video-btn popup-youtube">
                                <i class='bx bx-play'></i>
                            </a>
                        </div>
                    </div>
                    <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -100;">
                        <div style="background-position: 50% 50%; background-size: 100%; background-repeat: no-repeat; background-image: url(asset({{ $howToOrder->thumbnail }})); position: fixed; top: 0px; left: 0px; width: 987.733px; height: 555.6px; overflow: hidden; pointer-events: none; margin-left: -104.367px; margin-top: -134.3px; visibility: visible; transform: translateY(-2.33437px) translateZ(0px);"></div>
                    </div>
                </section>
            </div>

            <div class="col-sm-12 offset-md-1 col-md-5">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="ccircle">1</span>
                                    </div>
                                    <div class="col-10">
                                        <h4 class="#323334">{{ $howToOrder->title }}</h4>
                                        <p>{{ $howToOrder->description }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="ccircle">2</span>
                                    </div>
                                    <div class="col-10">
                                        <h4 class="#323334">{{ $howToOrder->title_two }}</h4>
                                        <p>{{ $howToOrder->description_two }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="ccircle">3</span>
                                    </div>
                                    <div class="col-10">
                                        <h4 class="#323334">{{ $howToOrder->title_three }}</h4>
                                        <p>{{ $howToOrder->description_three }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Video Area -->

<!-- Start Video Area -->
{{-- <section class="video-area ptb-100 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="video-content">
                <span class="sub-title">Watch Video</span>
                <h2>Get Ready To Start Your Exciting Journey</h2>
                <a href="https://www.youtube.com/watch?v=bk7McNUjWgw" class="video-btn popup-youtube"><i
                        class='bx bx-play'></i></a>
            </div>
        </div>
    </section> --}}
<!-- End Video Area -->

<!-- Start Feedback/Review Area -->
@if(isset($reviews) && count($reviews) > 0)
<section class="feedback-area mt-5 mb-5">
    <div class="container">
        <div class="home-header pb-3">
            <p class="sub-title" style="font-weight: bold">Some of our customer reviews...</p>
            {{-- <div class="section-title" style="display: flex; justify-content: flex-start;">
                        <h3 style="font-weight: bold; color: #323334;">Real Happy Customers, Real Stories...</h3>
                    </div> --}}
        </div>

        <div class="feedback-slides owl-carousel owl-theme" style="box-shadow: 0 0 20px 5px #a64ff038;border-radius: 15px;">
            @foreach ($reviews as $review)
            <div class="single-feedback-item">
                <p class="p-3">“{{ $review->message }}”</p>
                <div class="info">
                    <h3>
                        @if(isset($review->customer))
                        {{ $review->customer->name }}
                        @endif
                    </h3>
                    {{-- <span>Switzerland</span> --}}
                    <span>
                        @switch($review->rating)
                        @case(1)
                        <i class='bx bxs-star' style="color: red !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        @break
                        @case(1.5)
                        <i class='bx bxs-star' style="color: red !important"></i>
                        <i class='bx bxs-star-half' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        @break
                        @case(2)
                        <i class='bx bxs-star' style="color: rgba(255, 0, 0, 0.50) !important"></i>
                        <i class='bx bxs-star' style="color: rgba(255, 0, 0, 0.50) !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        @break
                        @case(2.5)
                        <i class='bx bxs-star' style="color: rgba(255, 0, 0, 0.50) !important"></i>
                        <i class='bx bxs-star' style="color: rgba(255, 0, 0, 0.50) !important"></i>
                        <i class='bx bxs-star-half' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        @break
                        @case(3)
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        @break
                        @case(3.5)
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star-half' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        @break
                        @case(4)
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        @break
                        @case(4.5)
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star-half' style="color: #bd00ff !important"></i>
                        @break
                        @case(5)
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        @break
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #bd00ff !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        <i class='bx bxs-star' style="color: #b3b3b3 !important"></i>
                        @default
                        @endswitch
                    </span>
                    @if(isset($review->customer))
                    <img src="{{ asset($review->customer->image != null ? $review->customer->image : 'nouser.png') }}" class="shadow rounded-circle" alt="image">
                    @endif
                </div>
            </div>
            @endforeach

            {{-- <div class="single-feedback-item">
                        <p class="p-3">“I initially contacted your company for a leaky faucet issue in my kitchen, explained the issue in simple terms, and provided a transparent estimate for the repairs.
                            It was evident that he was highly skilled and experienced in his work.”</p>
                        <div class="info">
                            <h3>David Warner</h3>
                            <span>Antarctica</span>
                            <img src="{{ asset('frontend/assets/img/user3.jpg') }}" class="shadow rounded-circle"
            alt="image">
        </div>
    </div> --}}
    </div>
    </div>
</section>
@endif
<!-- End Feedback Area -->

@endsection

@push('front_script')
<script>
    // custom owl-carousel
    $(document).ready(function($) {
        $("#owl-category_slide").owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            items: 4
        });
        var owl = $("#owl-category_slide");
        owl.owlCarousel();
        $(".next-btn").click(function() {
            owl.trigger("next.owl.carousel");
        });
        $(".prev-btn").click(function() {
            owl.trigger("prev.owl.carousel");
        });
        $(".prev-btn").addClass("disabled");
        $(owl).on("translated.owl.carousel", function(event) {
            if ($(".owl-prev").hasClass("disabled")) {
                $(".prev-btn").addClass("disabled");
            } else {
                $(".prev-btn").removeClass("disabled");
            }
            if ($(".owl-next").hasClass("disabled")) {
                $(".next-btn").addClass("disabled");
            } else {
                $(".next-btn").removeClass("disabled");
            }
        });
    });










    //=============== search by service name, slug and code ======================
    $('.serviceFind').on('keyup change', function() {
        let serviceFind = $(this).val();
        if (serviceFind.length > 1) {
            $(".searchItem").removeClass('d-none');

            $.ajax({
                url: '/get_service',
                type: "POST",
                data: {
                    serviceName: serviceFind.trim()
                },
                beforeSend: () => {
                    $(".serviceItems").html("")
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
                        })
                        $(".serviceItems").html(row);
                    } else {
                        $(".serviceItems").html(`<li class="list-group-item">
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

    $(document).ready(function() {
        $("#owl-example").owlCarousel({

            itemsDesktop: [1499, 1],
            itemsDesktopSmall: [1199, 3],
            itemsTablet: [899, 2],
            itemsMobile: [599, 1],
            navigation: true,
            // loop: true,
            navigationText: [
                '<span class="fa-stack"><i class="bx bx-user fa-stack-1x"></i><i class="bx bx-chevron-left fa-stack-1x fa-inverse"></i></span>',
                '<span class="fa-stack"><i class="bx bx-pencil fa-stack-1x"></i><i class="bx bx-chevron-right fa-stack-1x fa-inverse"></i></span>'
            ],
        });
    });
</script>
@endpush