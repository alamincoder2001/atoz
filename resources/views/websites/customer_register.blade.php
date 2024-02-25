@extends('layouts.fronted_master')
@section('title', 'Register Page')

@push('front_style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .c-control {
        height: 35px !important;
        border: 1px solid #ac51f0;
        border-radius: 5px;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ac51f0 !important;
        height: 35px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 30px !important;
    }
</style>
@endpush

@section('front_content')

<section class="listing-area mt-5">
    <div class="container" style="margin-top: 150px !important">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3"></div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="card pt-0" style="box-shadow: 0px 0px 20px 3px #994bf238;">
                    <h5 class="card-header border-0 text-center mt-2" style="color: #1f1f1f; letter-spacing: 1px; font-family: sans-serif;">Customer Register Form</h5>
                    <div class="card-body customerRegister" style="padding:10px 40px 40px 40px;">
                        <form onsubmit="customerRegister(event)">

                            <div class="form-group mb-3">
                                <input type="text" name="name" class="form-control c-control" placeholder="Name" autocomplete="off">
                                <span class="text-danger error-name error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="username" class="form-control c-control" placeholder="Username" autocomplete="off">
                                <span class="text-danger error-username error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control c-control" placeholder="Email" autocomplete="off">
                                <span class="text-danger error-email error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="mobile" class="form-control c-control" placeholder="Mobile" autocomplete="off">
                                <span class="text-danger error-mobile error"></span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select onchange="getUpazila(event)" name="district_id" class="form-select selectTwo">
                                            <option value="">Select District</option>
                                            @foreach($districts as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-district_id error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select name="thana_id" class="thana_id getThana form-select selectTwo" onchange="getArea(event)">

                                        </select>
                                        <span class="text-danger error-thana_id error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <select name="area_id" class="area_id getArea form-select selectTwo">

                                </select>
                                <span class="text-danger error-area_id error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" class="form-control c-control" placeholder="Password" autocomplete="off">
                                <span class="text-danger error-password error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="confirm_password" class="form-control c-control" placeholder="Confirm Password" autocomplete="off">
                                <span class="text-danger error-confirm_password error"></span>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" style="background-color: #ae54f1; border: 1px solid #ae54f1;">Register</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3"></div>
        </div>

    </div>
</section>

@endsection

@push('front_script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.selectTwo').select2();
    });

    function getUpazila(event) {
        if (event.target.value) {
            $.ajax({
                url: location.origin + "/getUpazila/" + event.target.value,
                method: "GET",
                beforeSend: () => {
                    $(".thana_id").html(`<option value="">Select Upazila</option>`)
                },
                success: res => {
                    $.each(res, (index, value) => {
                        $(".getThana").append(`<option value="${value.id}">${value.name}</option>`)
                    })
                }
            })
        } else {
            $(".thana_id").html(`<option value="">Select Upazila</option>`)
        }
    }

    function getArea(event) {
        if (event.target.value) {
            $.ajax({
                url: location.origin + "/getArea/" + event.target.value,
                method: "GET",
                beforeSend: () => {
                    $(".area_id").html(`<option value="">Select Area</option>`)
                },
                success: res => {
                    $.each(res, (index, value) => {
                        $(".getArea").append(`<option value="${value.id}">${value.name}</option>`)
                    })
                }
            })
        } else {
            $(".area_id").html(`<option value="">Select Area</option>`)
        }
    }

    function customerRegister(event) {
        event.preventDefault();
        let formdata = new FormData(event.target)
        $.ajax({
            url: "/customer-register",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(".customerRegister .error").text("")
            },
            success: res => {
                if (res.error) {
                    $.each(res.error, (index, value) => {
                        $(".customerRegister .error-" + index).text(value)
                    })
                } else {
                    Toastify({
                        text: res.msg,
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                    }).showToast();
                    // alert('Registered Successfully')
                    $("form").trigger("reset")
                    if (res.content > 0) {
                        setTimeout(() => {
                            location.href = "{{ url('checkout_page')}}"
                        }, 500);
                    } else {
                        location.href = "{{ url('customer-dashboard')}}"
                    }

                    // if (res.customer_type == 'Retail') {
                    //     location.href = "/customer-dashboard";
                    // }
                }
            }
        })
    }
</script>
@endpush