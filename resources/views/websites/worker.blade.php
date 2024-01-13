@extends('layouts.fronted_master')
@section('title', ' - Service Single Page')

@push('front_style')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <style>
        .form-select:focus { border-color: #ce5df6 !important; outline: 0; box-shadow: 0 0 0 0.25rem rgb(206 93 246 / 19%) !important; }
    </style>
@endpush

@section('front_content')

    <section class="listing-area mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="bread-crumb-title">Worker List</h3>
                </div>
            </div>
            <div class="p-3">
                <form onsubmit="filterWorker(event)">
                    <div class="row">
                        <div class="col-lg-5 pe-0"></div>
                        <div class="col-lg-3 pe-0">
                            <select onchange="getUpazila(event)" style="border: 1px solid #ce5cf691;" name="district_id" id="district_id" class="form-select">
                                <option value="">Select District</option>
                                @foreach($districts as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error error-district_id"></span>
                        </div>
                        <div class="col-lg-3">
                            <select name="thana_id" id="thana_id" class="form-select" style="border: 1px solid #ce5cf691;">
                                <option value="">Select Upazila</option>
                            </select>
                            <span class="text-danger error error-thana_id"></span>
                        </div>
                        <div class="col-lg-1 p-0">
                            <button type="submit" style="background: #ce5cf6; padding: 6px 15px; color: white; margin-top: 1px; border: 1px solid #ce5cf6;">Get</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="container">
            <div class="row workerShow">
                @if(Auth::guard('web')->check())
                    @foreach($worker as $item)
                        @if(Auth::guard('web')->user()->district_id == $item->district_id)
                            <div class="col-lg-3 mb-2">
                                <div class="card" title="{{$item->name}}" style="cursor: pointer;position:relative;box-shadow: 0 0 20px 3px #ce5cf645;">
                                    @if($item->status == 'v')
                                        <span style="position: absolute;right:0;top:0;background: green;color: white;padding: 0px 5px;border-bottom-left-radius: 10px;">{{$item->status == 'v' ? 'Verified' : ''}}</span>
                                    @endif
                                    <div style="display: flex;align-items:center;justify-content:center;padding-top:15px;">
                                        <img style="height: 150px;width:60%;border:1px solid #d1d1d1;" src="{{asset($item->image != null ? $item->image : 'nouser.png')}}" />
                                    </div>
                                    <div class="card-body">
                                        <ul style="margin-left: 15px; list-style: none;">
                                            <li class="position-relative">
                                                <i class="bx bx-user-circle mt-1" style="position: absolute;left:-10px;"></i>
                                                <span>&nbsp; {{$item->name}}</span>
                                            </li>
                                            <li class="position-relative">
                                                <i class="bx bx-map mt-1" style="position: absolute;left:-10px;"></i>
                                                <span>&nbsp; {{$item->address}}@if($item->address != null),@endif {{$item->thana->name}}, {{$item->thana->district->name}}</span>
                                            </li>
                                            <li class="mt-2">
                                                <a href="javascript:void(0)" onclick="viewWorker({{$item->id}})" style="background: #ce5cf6;padding: 5px;color: white;">View Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                @foreach($worker as $item)
                    @if(Auth::guard('web')->user()->district_id != $item->district_id)
                        <div class="col-lg-3 mb-2">
                            <div class="card" title="{{$item->name}}" style="cursor: pointer;position:relative;box-shadow: 0 0 20px 3px #ce5cf645;">
                                @if($item->status == 'v')
                                <span style="position: absolute;right:0;top:0;background: green;color: white;padding: 0px 5px;border-bottom-left-radius: 10px;">{{$item->status == 'v' ? 'Verified' : ''}}</span>
                                @endif
                                <div style="display: flex;align-items:center;justify-content:center;padding-top:15px;">
                                    <img style="height: 150px;width:60%;border:1px solid #d1d1d1;" src="{{asset($item->image != null ? $item->image : 'nouser.png')}}" />
                                </div>
                                <div class="card-body">
                                    <ul style="margin-left: 15px; list-style: none;">
                                        <li class="position-relative">
                                            <i class="bx bx-user-circle mt-1" style="position: absolute;left:-10px;"></i>
                                            <span>&nbsp; {{$item->name}}</span>
                                        </li>
                                        <li class="position-relative">
                                            <i class="bx bx-map mt-1" style="position: absolute;left:-10px;"></i>
                                            <span>&nbsp; {{$item->address}}@if($item->address != null),@endif {{$item->thana->name}}, {{$item->thana->district->name}}</span>
                                        </li>
                                        <li class="mt-2">
                                            <a href="javascript:void(0)" onclick="viewWorker({{$item->id}})" style="background: #ce5cf6;padding: 5px;color: white;">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @else
                    @foreach($worker as $item)
                        <div class="col-lg-3 mb-2">
                            <div class="card" title="{{$item->name}}" style="cursor: pointer;position:relative;box-shadow: 0 0 20px 3px #ce5cf645;">
                                @if($item->status == 'v')
                                <span style="position: absolute;right:0;top:0;background: green;color: white;padding: 0px 5px;border-bottom-left-radius: 10px;">{{$item->status == 'v' ? 'Verified' : ''}}</span>
                                @endif
                                <div style="display: flex;align-items:center;justify-content:center;padding-top:15px;">
                                    <img style="height: 150px;width:60%;border:1px solid #d1d1d1;" src="{{asset($item->image != null ? $item->image : 'nouser.png')}}" />
                                </div>
                                <div class="card-body">
                                    <ul style="margin-left: 15px; list-style: none;">
                                        <li class="position-relative">
                                            <i class="bx bx-user-circle mt-1" style="position: absolute;left:-10px;"></i>
                                            <span>&nbsp; {{$item->name}}</span>
                                        </li>
                                        <li class="position-relative">
                                            <i class="bx bx-map mt-1" style="position: absolute;left:-10px;"></i>
                                            <span>&nbsp; {{$item->address}}@if($item->address != null),@endif {{$item->thana->name}}, {{$item->thana->district->name}}</span>
                                        </li>
                                        <li class="mt-2">
                                            <a href="javascript:void(0)" onclick="viewWorker({{$item->id}})" style="background: #ce5cf6;padding: 5px;color: white;">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </section>



    {{-- view worker modal --}}
    <div class="modal fade" id="workerViewDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"
                        style="margin-top: -46px;margin-right: -37px;background-color: #ffffff;box-shadow: 0px 0px 5px 3px #ae45d866;background-image: none;font-size: 21px;font-weight: bold;z-index: 99999;height: 30px;width: 30px;border-radius: 50%;">
                        X
                    </button>
                </div>
                <div class="modal-body pb-3 pt-0">
                    <div class="row">
                        <div class="col-4">
                            <img src="" class="workerImg" alt="worker-image">
                        </div>
                        <div class="col-8">
                            <div class="text-start d-block mt-2 btn-top-txt mt-4" style="letter-spacing: .7px;">
                                <i class="bx bx-user-circle mt-1"></i> <span class="name">John Due</span>
                                <br>
                                <i class="bx bx-hash mt-1"></i> <span class="code"> #W809090</span>
                                <br>
                                <i class="bx bx-map mt-1"></i> <span class="address"> Singiar, Manikganj</span>
                                <br>
                                <i class="bx bx-phone mt-1"></i> <span class="phone"> 019748415114</span>
                            </div>
                        </div>
                        @auth
                            <div class="col-12">
                                <hr>
                                <div class="card border-0">
                                    <div class="card-body p-0">
                                        <form action="{{ url('review-store') }}" method="POST">
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <h5 class="fw-bold pt-1" style="color: #bd00ff;">Make A Review</h5>
                                                </div>
                                                <div class="col-6">
                                                    <div id="rateYo"></div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="rating" class="ratingVal">
                                            <input type="hidden" class="worker_id" name="worker_id">
                                            <input type="hidden" name="customer_id" value="{{ auth()->guard('web')->user()->id }}">
                                            <textarea name="message" cols="10" rows="3" style="border: 1px solid #bb00ff41;" class="form-control"></textarea>
                                            <button type="submit" class="btn btn-sm btn-success mt-1" style="float: right;">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('front_script')

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>
        $("#rateYo").rateYo({
            rating: 4.5,
            halfStar: true,
            multiColor: {
                "startColor": "#ff0000", //RED
                "endColor"  : "#bd00ff"  //logo color
            }
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $('.ratingVal').val(rating)
        });


        function viewWorker(id)
        {
            $.ajax({
                url: location.origin + "/worker-details/" + id,
                method: "GET",
                success: res => {
                    let w_img = res.worker.image != null ? location.origin+'/'+res.worker.image:location.origin+'/nouser.png';
                    // let w_address = res.worker.present_address+', '+res.worker.thana.name+','+res.worker.thana.district.name
                    let w_address = res.worker.thana.name+','+res.worker.thana.district.name
                    $("#workerViewDetails .workerImg").attr('src', w_img);
                    $("#workerViewDetails .name").text(res.worker.name);
                    $("#workerViewDetails .code").text(res.worker.worker_code);
                    $("#workerViewDetails .phone").text(res.worker.mobile);
                    $("#workerViewDetails .paddress").text(w_address);
                    $("#workerViewDetails .worker_id").val(res.worker.id);
                    $("#workerViewDetails").modal('show');
                }
            })
        }

        function getUpazila(event) {
            if (event.target.value) {
                $.ajax({
                    url: location.origin + "/getUpazila/" + event.target.value,
                    method: "GET",
                    beforeSend: () => {
                        $("#thana_id").html(`<option value="">Select Upazila</option>`)
                    },
                    success: res => {
                        $.each(res, (index, value) => {
                            $("#thana_id").append(`<option value="${value.id}">${value.name}</option>`)
                        })
                    }
                })
            } else {
                $("#thana_id").html(`<option value="">Select Upazila</option>`)
            }
        }

        function filterWorker(event) {
            event.preventDefault();
            if ($("#district_id").val() == "") {
                $(".error-district_id").text("Select district first")
                return
            }
            if ($("#thana_id").val() == "") {
                $(".error-district_id").text("")
                $(".error-thana_id").text("Select upazila first")
                return
            }
            $(".error-thana_id").text("")
            let formdata = new FormData(event.target)

            $.ajax({
                url: location.origin + "/filter-worker",
                method: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                beforeSend: () => {
                    $(".workerShow").html("")
                    $(".checkoutImage").removeClass("d-none")
                },
                success: res => {
                    if (res.length > 0) {
                        $.each(res, (index, value) => {
                            let row = `<div class="col-lg-3">
                                            <div class="card" title="${value.name}" style="cursor: pointer;">
                                                <div style="display: flex;align-items:center;justify-content:center;padding-top:15px;">
                                                    <img style="height: 150px;width:60%;border:1px solid #d1d1d1;" src="${value.image != null ? location.origin+'/'+value.image:location.origin+'/nouser.png'}" />
                                                </div>
                                                <div class="card-body">
                                                    <ul style="margin-left: 15px;">
                                                        <li class="position-relative">
                                                            <span class="fa fa-user" style="position: absolute;left:-15px;top:0;"></span>
                                                            <span>${value.name}</span>
                                                        </li>
                                                        <li class="position-relative">
                                                            <span class="fa fa-map-marker" style="position: absolute;left:-15px;top:0;"></span>
                                                            <span>${value.address}${value.address != null ? ',':''} ${value.thana.name}, ${value.thana.district.name}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>`;

                            $(".workerShow").append(row)
                        })
                    } else {
                        $(".workerShow").html(`<div class="text-center">Not Found Data</div>`)
                    }
                },
                complete: () => {
                    $(".checkoutImage").addClass("d-none")
                }
            })
        }
    </script>
@endpush
