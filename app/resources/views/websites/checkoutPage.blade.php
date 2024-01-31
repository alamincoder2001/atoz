@extends('layouts.fronted_master')
@section('title', ' - Checkout Page')

@push('front_style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* .c-control{ height: 35px !important; border: 1px solid #ac51f0; border-radius: 5px;} */
        .select2-container--default .select2-selection--single { border: 1px solid #b5b5b5 !important; height: 35px !important;}
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: 30px !important; }
    </style>
    <style>
        #customScrol {
            zoom: 0.9;
            scroll-behavior: smooth;
        }
        input{border: 1px solid #b5b5b5 !important; background-color: white!important;}
        /* card-btn */
        .default-btn { background-color: #a755f7 !important; color: #ffffff; }
        .default-btn:hover {background-color: #6001ff !important; }
        .cCustom{background-color: #ffffff;border: none;box-shadow: 0px 3px 20px 3px #cf58f624;}
        .fs-13{font-size: 13px !important;}
        .rowCustom{border-bottom: .5px solid #e3e2e2 !important;}
        .col-16 {width: 11% !important; }
        .activecard{ border: 1px solid #672e7b;}

    </style>

@endpush

@section('front_content')

    <section class="listing-area my-5">
        <div class="container">
            <form onsubmit="OrderPlace(event)">
                <div class="row" style="margin-top: 100px !important;">
                    <div class="col-md-6">
                        <div class="card cCustom mt-4" style="border: 1px solid #ce5cf65e !important;">
                            <h4 class="card-header bg-white pb-0 border-0">
                                <div class="row">
                                    <div class="col-1">
                                        <button type="button" style="background-color: #ce5cf6;border: 1px solid #ce5cf6; border-radius: 3px;">
                                            <i class='bx bx-home' style="font-size: 27px; color:white !important;"></i>
                                        </button>
                                    </div>
                                    <div class="col-11">
                                        <span>Address</span>
                                        <p>Expert will arrive at the address given below.</p>
                                    </div>
                                </div>
                            </h4>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label"><b>Name<sup class="text-danger">*</sup> </b></label>
                                            <input type="text" readonly class="form-control" id="name" value="{{Auth::guard('web')->user()->name}}" placeholder="House number" style="border-radius: 3px; height: 39px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mobile" class="form-label"><b>Mobile<sup class="text-danger">*</sup> </b></label>
                                            <input type="text" readonly class="form-control" id="mobile" value="{{Auth::guard('web')->user()->mobile}}" placeholder="House number" style="border-radius: 3px; height: 39px;">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="road_no" class="form-label"><b>District<sup class="text-danger">*</sup></b></label>
                                            <select id="inputDistrict" onchange="getUpazila()" name="district_id" class="form-select mb-2 selectTwo" style="border-radius: 3px; height: 39px;">
                                                <option value="">Select a District</option>
                                                @foreach($districts as $item)
                                                    <option value="{{$item->id}}" {{Auth::guard('web')->user()->district_id ? Auth::guard('web')->user()->district_id == $item->id ? 'selected':'':'' }}>
                                                        {{$item->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="road_no" class="form-label"><b>City<sup class="text-danger">*</sup></b></label>
                                            <div class="form-group">
                                                <select name="billing_thana" class="thana_id getThana form-select selectTwo" style="border-radius: 3px; height: 39px;">

                                                </select>
                                                <span class="text-danger error-thana_id error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label"><b>Email Address</b></label>
                                            <input type="email" class="form-control" value="{{Auth::guard('web')->user()->email}}" id="email" disabled style="border-radius: 3px; height: 39px;">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="postcode" class="form-label"><b>Postcode / ZIP</b></label>
                                            <input type="text" class="form-control" id="postcode" name="postcode" style="border-radius: 3px; height: 39px;">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label"><b>Billing Address<sup class="text-danger">*</sup> </b></label>
                                            <textarea class="form-control" id="address" name="address" style="background:none;border-color: #b5b5b5 !important;border-radius: 3px; height: 39px;">{{Auth::guard('web')->user()->address}}</textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- shipping address -->
                                    <div class="col-md-12">
                                        <div class="mb-3 d-flex align-items-center">
                                            <input type="checkbox" value="1" id="is_shipping" onchange="IsShipping(event)" name="is_shipping" checked>
                                            <label for="is_shipping" style="margin: 0;margin-left: 8px;" class="form-label"><b>Same as</b></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="road_no" class="form-label"><b>District<sup class="text-danger">*</sup></b></label>
                                            <select id="shippingDistrict" onchange="getUpazilaShipping()" name="shipping_district" class="form-select mb-2 selectTwo" style="border-radius: 3px; height: 39px;">
                                                <option value="">Select a District</option>
                                                @foreach($districts as $item)
                                                    <option value="{{$item->id}}" {{Auth::guard('web')->user()->district_id ? Auth::guard('web')->user()->district_id == $item->id ? 'selected':'':'' }}>
                                                        {{$item->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="road_no" class="form-label"><b>City<sup class="text-danger">*</sup></b></label>
                                            <div class="form-group">
                                                <select name="shipping_thana" id="shipping_thana" class="shipping_thana getshippingThana form-select selectTwo" style="border-radius: 3px; height: 39px;">

                                                </select>
                                                <span class="text-danger error-shipping_thana error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="shipping_address" class="form-label"><b>Shipping Address</b></label>
                                            <textarea class="form-control" style="background:none;border-color: #b5b5b5 !important;border-radius: 3px; height: 39px;" id="shipping_address" name="shipping_address">{{Auth::guard('web')->user()->address}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-4">
                    <div class="card cCustom" style="height: 100vh;">
                            <h4 class="card-header border-0 bg-white">Order Summary</h4>
                            <div class="card-body">

                                <div class="row rowCustom pb-1">
                                    <div class="col-md-12">

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Sl</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @if(isset($items) && count($items) > 0)
                                                    @php
                                                        $i = 0;
                                                    @endphp
                                                    @foreach ($items as $cart)
                                                        <tr class="{{ $cart->rowId }}">
                                                            <th scope="row">{{ ++$i }}</th>
                                                            <td>
                                                                <img src="{{asset($cart->options->image != null ? $cart->options->image : '/no-product-image.jpg')}}" width="55" alt="img">
                                                            </td>
                                                            <td>{{ $cart->name }}</td>
                                                            <td>
                                                                <a onclick="cartDelete('{{$cart->rowId}}')"
                                                                    style="cursor: pointer;background: red;padding: 0 5px;border-radius: 50%;color: white;font-weight: 600;">
                                                                    <span>X</span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan="4" align="center">
                                                            <img src="{{ asset('emptycart.png') }}" width="150">
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-md-12 mt-4">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-1">
                                                    <button type="button" style="background-color: #ce5cf6;border: 1px solid #ce5cf6; border-radius: 3px;">
                                                        <i class='bx bx-pencil' style="font-size: 21px; color:white !important;"></i>
                                                    </button>
                                                </div>
                                                <div class="col-11">
                                                    <label for="order_note" class="form-label">You can add any additional notes with your order!</label>
                                                </div>
                                            </div>
                                            <textarea class="form-control" style="border: 1px solid #b5b5b5;background-color: white;border-radius: 3px;" id="order_note" name="note" rows="2" placeholder="Write here"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-lg btn-success w-100">
                                            Place Order
                                        </button>
                                    </div>
                                </div>

                            </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@push('front_script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        $(document).ready(function() {
            $('.selectTwo').select2();
            let district_id = $("#inputDistrict").val();
            getCity(district_id);
            getCityShipping(district_id);

            let isShipp = $("#is_shipping").val();
            if (isShipp == 1) {
                $("#shippingDistrict").attr("disabled", true)
                $("#shipping_thana").attr("disabled", true)
                $("#shipping_address").prop("disabled", true)
            }
        });

        function IsShipping(event){
            if (!event.target.checked) {
                $("#shippingDistrict").attr("disabled", false)
                $("#shipping_thana").attr("disabled", false)
                $("#shipping_address").prop("disabled", false)
            }else{
                $("#shippingDistrict").attr("disabled", true)
                $("#shipping_thana").attr("disabled", true)
                $("#shipping_address").prop("disabled", true)
            }
        }

        setTimeout(() => {
            let customerDefaultCity_id = "{{ Auth::guard('web')->user()->thana_id }}";
            $(".getThana").val(customerDefaultCity_id).trigger('change')
            $(".getshippingThana").val(customerDefaultCity_id).trigger('change')
       }, 1000);

        function getUpazila()
        {
            let district_id = $("#inputDistrict").val();
            getCity(district_id);
        }


        function getCity(id) {
            if (id) {
                $.ajax({
                    url: location.origin + "/getUpazila/" + id,
                    method: "GET",
                    beforeSend: () => {
                        $(".thana_id").html(`<option value="">Select city</option>`)
                    },
                    success: res => {
                        $.each(res, (index, value) => {
                            $(".getThana").append(`<option value="${value.id}">${value.name}</option>`)
                        })
                    }
                })
            } else {
                $(".thana_id").html(`<option value="">Select city</option>`)
            }
        }
        function getUpazilaShipping()
        {
            let district_id = $("#shippingDistrict").val();
            getCityShipping(district_id);
        }


        function getCityShipping(id) {
            if (id) {
                $.ajax({
                    url: location.origin + "/getUpazila/" + id,
                    method: "GET",
                    beforeSend: () => {
                        $(".shipping_thana").html(`<option value="">Select city</option>`)
                    },
                    success: res => {
                        $.each(res, (index, value) => {
                            $(".getshippingThana").append(`<option value="${value.id}">${value.name}</option>`)
                        })
                    }
                })
            } else {
                $(".shipping_thana").html(`<option value="">Select city</option>`)
            }
        }

        // get current location name
        if (getDataFromLocalStorage('districtName') == null) {
            $('#area').val('Dhaka');
        }else{
            $('#area').val(getDataFromLocalStorage('districtName'));
        }

        // check mobile number
        $('#person_number').on('input', function() {
            var inputValue = $(this).val();
            var inputLength = inputValue.length;

            if (inputLength == 11) {
                var mobileNumber = inputValue;
                var regex = /^01[3-9][0-9]{8}$/

                if (regex.test(mobileNumber)) {
                    $('.confirm_btn').prop('disabled', false);
                } else {
                    $('.confirm_btn').prop('disabled', true);
                }
            } else {
                $('.confirm_btn').prop('disabled', true);
            }
        });

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
                        Toastify({
                            text: res.error,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                        }).showToast();
                    }else{
                        Toastify({
                            text: res.msg,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                        }).showToast();

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
