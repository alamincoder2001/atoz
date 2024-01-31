@extends('layouts.fronted_master')
@section('title', 'Category Wise Services')

@push('front_style')
    <style>
        #customScrol {
            zoom: 0.9;
            scroll-behavior: smooth;
        }
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #ffffff !important;
            border-right: 5px solid #cf58f6 !important;
            font-weight: 700;
        }

        /* service card */
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
        .page-title-area { position: relative; z-index: 1; padding-top: 95px; padding-bottom: 0; background-color: #742f8d; }
        .breadcame{display: flex; justify-content: space-evenly; margin: 15px 0 45px -150px;}
        .list-style{list-style: square; font-size: 17px;}

        /* price card */
        #element{position:fixed;bottom:0;right: 0; border: 1px solid #d75efb45;box-shadow: -12px 0px 20px 5px #d75efb1c;}
        /* card-btn */
        .default-btn { background-color: #a755f7 !important; color: #ffffff; }
        .default-btn:hover {background-color: #6001ff !important; }

        /*============== custom webkit ====================*/
        div.cateItems {
            height: 80vh !important;
            overflow-x: hidden !important;
            overflow-y: auto !important;
        }

        .cateItems::-webkit-scrollbar
        {
          width: 1px;
        }
        .cateItems::-webkit-scrollbar-thumb
        {
          background-color: #9307cb;
          border: 2px solid #9307cb;
        }
    </style>
@endpush

@section('front_content')



<!-- End listing Details Area -->
    <section class="listing-area mt-5">
        <div class="container" style="margin-top: 100px !important;">

            <div class="row">

                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3" style="border-right: 1px solid #d75efb45;box-shadow: 5px 0px 7px 0px #d75efb1c;">
                    <div class="mt-3">
                        <nav id="service-all" class="navbar navbar-light bg-light">
                            <nav class="nav nav-pills flex-column">
                                @foreach ($categories as $cate)
                                    <a class="nav-link" style="@if($cate->id == $category->id) color: #742f8d !important; font-weight: bold; @endif"
                                         href="{{ route('category_wise.service', $cate->slug) }}">
                                        {{ $cate->name }}
                                    </a>
                                @endforeach
                            </nav>
                        </nav>
                    </div>
                </div>

                <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9" id="customScrol">

                    <div data-bs-spy="scroll" data-bs-target="#service-all" data-bs-offset="50" tabindex="0">

                        <section class="listing-area">
                            <div class="container-fluid mt-3">

                                <div class="section-title mb-3" style="display: flex; justify-content: flex-start;">
                                    <h3 style="font-weight: bold; color: #323334;">{{ $category->name }}</h3>
                                </div>
                                <div class="row cateItems">
                                    @if(isset($category->service))
                                        @forelse ($category->service as $key => $ser)
                                            <div class="col-lg-4 col-sm-12 col-md-6">
                                                <div class="single-listing-item" style="box-shadow: 0 0 20px 1px #e760fb40;">

                                                    <div class="listing-image">
                                                        <a href="{{ route('single.service', $ser->slug) }}" class="d-block">
                                                            <img src="{{ asset($ser->image) }}"
                                                                style="width: 344px !important; height: 238px !important;"
                                                                alt="image">
                                                        </a>
                                                        <div class="listing-tag">
                                                            <a href="{{ route('single.service', $ser->slug) }}" class="d-block">{{ $ser->name }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty

                                            <div class="col-12">
                                                <div class="single-listing-item">
                                                    <div class="listing-tag text-center p-5">
                                                        <span> Oops! Service Not Available</span>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforelse
                                    @endif
                                </div>

                            </div>
                        </section>


                    </div>
                </div>
            </div>

            {{-- <div class="card" id="element">
                <div class="card-body">
                    <h3>{{ $service->name }}</h3>
                    <div class="listing-details-header">
                        <div class="align-items-center">
                            <div class="listing-price">
                                <div class="listing-review">
                                    <div class="review-stars">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                    </div>
                                    <span class="reviews-total d-inline-block">(2 reviews)</span>
                                </div>
                                <div class="price" style="color:#a755f7">৳ 399</div>
                                <a href="#" class="default-btn">Order Now!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </section>
@endsection

@push('front_script')
    <script>

    </script>
@endpush
