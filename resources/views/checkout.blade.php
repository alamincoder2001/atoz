@extends("layouts.fronted_master")
@section("title", " - Checkout Page")
@section("content")
<nav class="breadcrumb-section section-py bg-light2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="bread-crumb-title">check out page</h3>
            </div>
        </div>
    </div>
</nav>
<form onsubmit="OrderPlace(event)">
    <div class="check-out-section section-py">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3 class="title">Billing Details</h3>
                        <form class="personal-information">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info">
                                        <label>Name</label>
                                        <input readonly type="text" value="{{Auth::guard('web')->user()->name}}" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="billing-select">
                                        <label for="inputState" class="form-label">District</label>
                                        <select disabled id="inputState" name="district_id" class="form-select mb-2">
                                            <option value="">Select a District</option>
                                            @foreach($districts as $item)
                                            <option value="{{$item->id}}" {{Auth::guard('web')->user()->district_id ? Auth::guard('web')->user()->district_id == $item->id ? 'selected':'':'' }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="billing-select">
                                        <label for="inputState" class="form-label">City</label>
                                        <select disabled id="inputState" name="thana_id" class="thana_id form-select mb-2">
                                            <option>Select a City</option>
                                            @foreach($upazilas as $item)
                                            <option value="{{$item->id}}" {{Auth::guard('web')->user()->thana_id ? Auth::guard('web')->user()->thana_id == $item->id ? 'selected':'':'' }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="billing-info">
                                        <label>Billing Address</label>
                                        <input class="billing-address" value="{{Auth::guard('web')->user()->address}}" name="address" placeholder="House number and street name" type="text" autocomplete="off" />
                                        <span class="text-danger error error-address"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info">
                                        <label>Postcode / ZIP</label>
                                        <input type="text" name="postcode" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info">
                                        <label>Mobile</label>
                                        <input type="text" readonly value="{{Auth::guard('web')->user()->mobile}}" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info">
                                        <label>Email Address</label>
                                        <input readonly type="text" value="{{Auth::guard('web')->user()->email}}" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="additional-info-wrap">
                            <!-- <h4 class="title">Additional information</h4> -->
                            <div class="additional-info">
                                <label class="mb-2">Order notes</label>
                                <textarea name="note" placeholder="Notes about your order, e.g. special notes for delivery. "></textarea>
                            </div>
                        </div>
                        <!-- <div class="checkout-account">
                            <input id="ship" class="checkout-toggle" type="checkbox" value="1" name="is_shipping" />
                            <label for="ship" style="cursor: pointer;">Ship to a different address?</label>
                        </div>
                        <div class="different-address open-toggle mt-5">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="billing-select">
                                        <label for="inputState1" class="form-label">District</label>
                                        <select id="inputState1" name="shipping_district" onchange="getUpazila(event)" class="form-select mb-3">
                                            <option>Select a District</option>
                                            @foreach($districts as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error error-shipping_district"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="billing-select">
                                        <label for="inputState1" class="form-label">Upazila</label>
                                        <select id="inputState1" onchange="shippingCharge(event)" name="shipping_thana" class="thana_id form-select mb-3">
                                            <option value="">Select a Upazila</option>
                                        </select>
                                        <span class="text-danger error error-shipping_thana"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info">
                                        <label>Shipping Address</label>
                                        <input class="billing-address" name="shipping_address" placeholder="House number and street name" type="text" />
                                        <span class="text-danger error error-shipping_address"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info">
                                        <label>Postcode / ZIP</label>
                                        <input type="text" name="shipping_postcode" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info">
                                        <label>Phone</label>
                                        <input type="text" name="shipping_mobile" />
                                        <span class="text-danger error error-shipping_mobile"></span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="your-order-area">
                        <h3 class="title">Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Service</li>
                                        <li>Quantity</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>
                                        @foreach(\Cart::content() as $item)
                                        <li>
                                            <span class="order-middle-left">{{$item->name}}</span>
                                            <span class="order-price"> {{$item->qty}} </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">SubTotal</li>
                                        <li>৳ <span class="checkoutsubTotal">{{ str_replace(",", "", \Cart::subtotal()) }}</span></li>
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    @php
                                        $charge = Auth::guard('web')->check() ? Auth::guard('web')->user()->thana_id ? Auth::guard('web')->user()->thana->charge : 0.00 : 0;
                                        $charge_second = $profile->minimum_qty <= \Cart::count() ? 0: $charge;
                                        $cartTotal = str_replace(",", "", \Cart::subtotal());
                                        $total = ($charge_second + (float)$cartTotal);
                                    @endphp
                                    <ul>
                                        <li class="your-order-shipping">Shipping Charge</li>
                                        <input type="hidden" class="shipping_charge" name="shipping_charge" value="{{$profile->minimum_qty <= \Cart::count() ? 0 : $charge}}">
                                        <li>৳ 
                                            <span class="shippingCharge">
                                                @if($profile->minimum_qty <= \Cart::count())
                                                    0.00
                                                @else
                                                    {{Auth::guard('web')->user()->thana_id ? Auth::guard('web')->user()->thana->charge : 0.00 }}
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Total</li>
                                        <li>৳ <span class="checkoutcartTotal">{{number_format($total, 2)}}</span></li>
                                    </ul>
                                </div> -->
                            </div>
                            <!-- <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel payment-accordion">
                                            <div class="panel-heading" id="method-two">
                                                <h4 class="panel-title" style="font-size: 14px;display: flex;gap: 5px;margin: 0;">
                                                    <input type="radio" name="payment_type" id="cash" value="Cash" checked> <label for="cash">Cash on Delivery</label>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="panel payment-accordion">
                                            <div class="panel-heading" id="method-three">
                                                <h4 class="panel-title">
                                                    <h4 class="panel-title" style="font-size: 14px;display: flex;gap: 5px;margin: 0;">
                                                        <input type="radio" name="payment_type" id="getway" value="Getway"> <label for="getway">Payment on Getway</label>
                                                    </h4>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="Place-order mt-25">
                            <button type="submit" class="btn btn-warning btn-lg w-100 btn-hover-primary">Place Order</button>
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
    function getUpazila(event) {
        if (event.target.value) {
            $(".thana_id").prop("disabled", false)
            $.ajax({
                url: location.origin + "/getUpazila/" + event.target.value,
                method: "GET",
                beforeSend: () => {
                    $(".thana_id").html(`<option value="">Select Upazila</option>`)
                },
                success: res => {
                    $.each(res, (index, value) => {
                        $(".thana_id").append(`<option data-charge="${value.charge}" value="${value.id}">${value.name}</option>`)
                    })
                }
            })
        }
    }

    function shippingCharge(event) {
        let charge = event.target.selectedOptions[0].getAttribute("data-charge");
        let minimum_qty = "{{$profile->minimum_qty}}"; 
        let cartQty = "{{\Cart::count()}}";
        let subtotal = $(".checkoutsubTotal").text()
        let total = +parseFloat(charge) + parseFloat(subtotal);
        if (Number(minimum_qty) <= Number(cartQty)) {
            $(".shippingCharge").text("0.00")
            $(".shipping_charge").val(0)
            $(".checkoutcartTotal").text(parseFloat(subtotal).toFixed(2))
        }else{
            $(".shippingCharge").text(charge)
            $(".shipping_charge").val(charge)
            $(".checkoutcartTotal").text(total.toFixed(2))
        }
    }

    // order place
    function OrderPlace(event) {
        event.preventDefault();
        let formdata = new FormData(event.target);
        formdata.append('shipping_charge', 0);
        formdata.append('payment_type', 'Cash');
        $.ajax({
            url: location.origin+"/place-order",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(".checkoutImage").removeClass("d-none")
                $(".error").text("");
            },
            success: res => {
                if(res.error){
                    $.each(res.error, (index, value) => {
                        $(".error-"+index).text(value);
                    })
                }else if(res.errors){
                    $.notify(res.errors, "error");
                    setTimeout(() => {
                        location.href = "/product";
                    }, 1000)
                }else{
                    $.notify(res.msg, "success");
                    setTimeout(() => {
                        location.href = "/";
                    }, 1000)
                }
            },
            complete: () => {
                setTimeout(() => {
                    $(".checkoutImage").addClass("d-none")
                }, 500)
            }
        })
    }
</script>
@endpush