@extends("layouts.fronted_master")
@section("title", " - Single Product Page")
@section("content")
<!-- bread-crumb2 start -->
<nav class="breadcrumb-section">
    <div class="container wrapper">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="{{route('website')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- bread-crumb2 start -->
<form onsubmit="singleCart(event)">
    <div class="single-product-wrap">
        <div class="container wrapper">
            <div class="row mb-n10">
                <div class="col-lg-5 mb-10">
                    <div class="product-detail_img vertical-slider_wrap2">
                        <div class="swiper-container pd-vertical_slider2 lightgallery">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="single-img">
                                        <img src="{{asset($product->image != null ? $product->image : 'no-product-image.jpg')}}" alt="Product Image" />
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="single-img">
                                        <img src="{{asset($product->image != null ? $product->image : 'no-product-image.jpg')}}" alt="Product Image" />
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="single-img">
                                        <img src="{{asset($product->image != null ? $product->image : 'no-product-image.jpg')}}" alt="Product Image" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="vertical-slider_nav2">
                            <div class="swiper-navination-vertical2 d-none d-md-inline-block">
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
                                        <img src="{{asset($product->image != null ? $product->image : 'no-product-image.jpg')}}" alt="Product Thumnail" /></a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#?">
                                        <img src="{{asset($product->image != null ? $product->image : 'no-product-image.jpg')}}" alt="Product Thumnail" /></a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#?"><img src="{{asset($product->image != null ? $product->image : 'no-product-image.jpg')}}" alt="Product Thumnail" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mb-10">
                    <div class="content">
                        <h3 class="title">{{$product->name}}</h3>
                        <a class="open-comment-form"><span>Product Code: </span>{{$product->product_code}}</a>
                        <div class="mb-1">
                            <span class="price-lg regular-price d-inline-block">
                                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->customer_type == 'Wholesale')
                                ৳ {{$product->wholesale_rate}}
                                @else
                                ৳ {{$product->selling_rate}}
                                @endif
                            </span>
                            @if($product->discount > 0)
                            <span class="badge bg-success">Save 6%</span>
                            @endif
                        </div>
                        <p class="border-bottom pb-4">
                            {!! $product->description !!}
                        </p>
                        <h4 class="modal-quantity">Quantity</h4>
                        <div class="product-count style d-flex my-4">
                            <div class="count d-flex">
                                <input type="number" id="qty" min="1" max="100" step="1" value="1" />
                                <div class="button-group">
                                    <button type="button" class="count-btn increment">
                                        <span class="lnr lnr-chevron-up"></span>
                                    </button>
                                    <button type="button" class="count-btn decrement">
                                        <span class="lnr lnr-chevron-down"></span>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-hover-warning text-uppercase">
                                    Add to cart
                                </button>
                            </div>
                        </div>
                        <div>
                            <button type="button" onclick="addWishlist({{$product->id}})">Add to wishlist</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-py" style="margin-top: 30px;">
        <div class="container wrapper">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs single-product-tab justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#description" role="tab">Description</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#productdetails" role="tab">Product Details</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="single-product-desc">
                                <p>
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="productdetails" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="single-product-desc">
                                <div class="product-anotherinfo-wrapper">
                                    <ul>
                                        <li><span>Weight</span> 400 g</li>
                                        <li><span>Dimensions</span>10 x 10 x 15 cm</li>
                                        <li><span>Materials</span> 60% cotton, 40% polyester</li>
                                        <li>
                                            <span>Other Info</span> American heirloom jean shorts
                                            pug seitan letterpress
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push("webjs")
<script>
    function singleCart(event) {
        event.preventDefault();
        let qty = $("#qty").val();
        let product_id = "{{$product->id}}";
        $.ajax({
            url: location.origin + "/addcart",
            method: "POST",
            dataType: "JSON",
            data: {
                id: product_id,
                quantity: qty
            },
            beforeSend: () => {
                $(".checkout-scroll").html("")
                $(".cartImage").removeClass("d-none")
            },
            success: res => {
                $.notify(res.msg, "success");
                $.each(res.content, (index, value) => {
                    let row = `
                        <li class="checkout-cart-list">
                            <div class="checkout-img">
                                <img class="product-image" src="${value.options.image != null ? location.origin+"/"+value.options.image: location.origin+'/no-product-image.jpg'}" alt="img" />
                                <span class="product-quantity">${value.qty}x</span>
                            </div>
                            <div class="checkout-block">
                                <a class="product-name" href="{{route('product')}}">${value.name}</a>
                                <span class="product-price">৳ ${value.price}</span>
                                <a class="remove-cart" row-id="${value.rowId}" onclick="removeCart(event)">
                                    x
                                </a>
                            </div>
                        </li>
                    `;
                    $(".checkout-scroll").append(row)
                })

                // total calculate
                $(".subTotal label").text(res.subtotal)
                $(".Total label").text(res.subtotal)
                $(".cartTotalCount").text(res.cartCount)
            },
            complete: () => {
                setTimeout(() => {
                    $(".cartImage").addClass("d-none")
                }, 500)
            }
        })
    }
</script>
@endpush