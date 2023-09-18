@extends("layouts.fronted_master")
@section("title", " - Product Page")
@section("content")
<form action="{{route('service')}}" method="GET">
    <nav class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="{{route('website')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>

    <div class="shop-product-tab section-pb">
        <div class="container">
            <div class="row mb-n7">
                <div class="col-lg-8 col-xl-9">
                    <img class="mb-4" src="{{asset('frontend')}}/assets/images/banner/shop-banner.jpg" alt="banner" />
                    <div class="grid-nav-wraper bg-lighten2 mb-30">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <nav class="shop-grid-nav">
                                    <ul class="nav nav-tabs align-items-center" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#home" role="tab">
                                                <i class="ion-grid"></i></a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"><i class="ion-android-menu"></i></a>
                                        </li>
                                        <li>
                                            <span class="total-products text-capitalize">There are {{count($service)}} services.</span>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-12 col-md-6 position-relative">
                                <div class="shop-grid-button d-flex align-items-center">
                                    <span class="sort-by">Sort by:</span>
                                    <span class="chevron-arrow-down ion-android-arrow-dropdown"></span>
                                    <select class="form-select" name="sortBy" aria-label="Default select example" onchange="$('form').submit()">
                                        <option selected value="" @php echo isset($_GET['sortBy']) && $_GET['sortBy']=="" ? "selected" : "" ; @endphp>Default</option>
                                        <option value="ascending" @php echo isset($_GET['sortBy']) && $_GET['sortBy']=="ascending" ? "selected" : "" ; @endphp>Name, A to Z</option>
                                        <option value="descending" @php echo isset($_GET['sortBy']) && $_GET['sortBy']=="descending" ? "selected" : "" ; @endphp>Name, Z to A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="home" role="tabpanel">
                            <div class="row grid-view g-0 shop-grid-5">
                                @foreach($service as $item)
                                <!-- single slide Start -->
                                <div class="col-xl-2 col-lg-3 col-sm-6 col-md-4">
                                    <div class="product-card">
                                        <a class="thumb" href="{{route('single.service', $item->slug)}}"><img src="{{asset($item->image != null ? $item->image : 'no-product-image.jpg')}}" alt="img" />
                                            <div class="onsales-badges">
                                                <span class="badge bg-dark">new</span>
                                            </div>
                                        </a>
                                        <div class="product-content">
                                            <a class="product-category" href="#?">{{$item->category_name}}</a>
                                            <h3 class="product-title">
                                                <a href="{{route('single.service', $item->slug)}}">{{$item->name}}</a>
                                            </h3>
                                            <span class="price regular-price">
                                                ৳ 0
                                            </span>
                                            <button type="button" class="product-btn btn btn-primary btn-hover-warning" onclick="addCart({{$item->id}})">
                                                Add to cart
                                            </button>
                                        </div>
                                        <!-- actions links start -->
                                        <ul class="actions">
                                            <li class="action-item"><button type="button" class="action quick-view"><span class="lnr lnr-magnifier"></span></button></li>
                                            <li class="action-item"><button type="button" class="action wishlist" onclick="addWishlist({{$item->id}})"><span class="lnr lnr-heart"></span></button></li>
                                        </ul>
                                        <!-- actions links end -->
                                    </div>
                                </div>
                                <!-- single slide End -->
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <div class="row g-0 grid-view-list overflow-hidden">
                                @foreach($service as $item)
                                <div class="col-12 mb-7">
                                    <div class="border-bottom pb-7 pb-lg-0">
                                        <div class="row mb-n7 align-items-center">
                                            <!-- single slide Start -->
                                            <div class="col-lg-3 mb-7">
                                                <div class="product-card-list">
                                                    <a class="thumb" href="{{route('single.service', $item->slug)}}">
                                                        <img src="{{asset($item->image != null ? $item->image : 'no-product-image.jpg')}}" alt="img" />
                                                        <div class="onsales-badges">
                                                            <span class="badge bg-dark">new</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-7">
                                                <div class="product-content-list">
                                                    <a class="product-category" href="#">{{$item->category_name}}</a>
                                                    <h3 class="product-title">
                                                        <a href="{{route('single.service', $item->slug)}}">{{$item->name}}</a>
                                                    </h3>
                                                    <p>
                                                        {!! $item->description !!}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-7">
                                                <div class="product-content-list">
                                                    <span class="price-list regular-price">
                                                        ৳ 0
                                                    </span>
                                                    <button type="button" class="product-btn-list btn btn-primary btn-hover-warning" onclick="addCart({{$item->id}})">
                                                        Add to cart
                                                    </button>
                                                </div>
                                                <!-- actions links start -->
                                                <ul class="actions-list">
                                                    <li class="action-item-list"><button type="button" class="action quick-view"><span class="lnr lnr-magnifier"></span></button></li>
                                                    <li class="action-item-list"><button type="button" class="action wishlist" onclick="addWishlist({{$item->id}})"><span class="lnr lnr-heart"></span></button></li>
                                                </ul>
                                                <!-- actions links end -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="row g-0 align-items-center mt-md-5">
                        <!-- <div class="col-12 col-sm-6 mb-8">
                        <p class="Showing">Showing 1-15 of 16 item(s)</p>
                    </div> -->
                        <div class="col-12 col-sm-12 text-center mb-8">
                            <!-- pagination start -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-sm-end">
                                    {{$service->links('vendor.pagination.bootstrap-4')}}
                                </ul>
                            </nav>
                            <!-- pagination start -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 mb-7 order-lg-first">
                    <div class="widgets">
                        <div class="widget-card">
                            <h3 class="title"><span>Categories</span></h3>

                            <div class="search-filter">
                                <form action="#">
                                    <!-- widget-inner -->
                                    <div class="widget-inner">
                                        @foreach($categories as $item)
                                        <div class="widget-check-box">
                                            <input type="radio" name="category" id="{{$item->id}}" />
                                            <label for="{{$item->id}}">{{$item->name}} ({{$item->service->count()}})</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection