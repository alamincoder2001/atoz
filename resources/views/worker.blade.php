@extends("layouts.fronted_master")
@section("title", " - Worker List")
@section("content")
<nav class="breadcrumb-section section-py bg-light2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="bread-crumb-title">Worker List</h3>
            </div>
        </div>
        <div class="p-3" style="background: #caedef;">
            <form onsubmit="filterWorker(event)">
                <div class="row">
                    <div class="col-lg-3 pe-0">
                        <select onchange="getUpazila(event)" name="district_id" id="district_id" class="form-select">
                            <option value="">Select District</option>
                            @foreach($districts as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-district_id"></span>
                    </div>
                    <div class="col-lg-3">
                        <select name="thana_id" id="thana_id" class="form-select">
                            <option value="">Select Upazila</option>
                        </select>
                        <span class="text-danger error error-thana_id"></span>
                    </div>
                    <div class="col-lg-1 p-0">
                        <button type="submit" style="background: #1732b9;padding: 6px 15px; color: white; margin-top: 1px;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>

<section class="bg-light" style="padding-bottom: 25px;">
    <div class="container">
        <div class="row workerShow">
            @if(Auth::guard('web')->check())
            @foreach($worker as $item)
            @if(Auth::guard('web')->user()->district_id == $item->district_id)
            <div class="col-lg-3">
                <div class="card" title="{{$item->name}}" style="cursor: pointer;position:relative;">
                    @if($item->status == 'v')
                    <span style="position: absolute;right:0;top:0;background: green;color: white;padding: 0px 5px;border-bottom-left-radius: 10px;">{{$item->status == 'v' ? 'Verified' : ''}}</span>
                    @endif
                    <div style="display: flex;align-items:center;justify-content:center;padding-top:15px;">
                        <img style="height: 150px;width:60%;border:1px solid #d1d1d1;" src="{{asset($item->image != null ? $item->image : 'nouser.png')}}" />
                    </div>
                    <div class="card-body">
                        <ul style="margin-left: 15px;">
                            <li class="position-relative">
                                <span class="fa fa-user" style="position: absolute;left:-15px;top:0;"></span>
                                <span>{{$item->name}}</span>
                            </li>
                            <li class="position-relative">
                                <span class="fa fa-map-marker" style="position: absolute;left:-15px;top:0;"></span>
                                <span>{{$item->address}}@if($item->address != null),@endif {{$item->thana->name}}, {{$item->thana->district->name}}</span>
                            </li>
                            <li class="mt-2">
                                <a href="{{route('worker.details', $item->id)}}" style="background: #2b46a8;padding: 5px;color: white;">Show Details</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @foreach($worker as $item)
            @if(Auth::guard('web')->user()->district_id != $item->district_id)
            <div class="col-lg-3">
                <div class="card" title="{{$item->name}}" style="cursor: pointer;position:relative;">
                    @if($item->status == 'v')
                    <span style="position: absolute;right:0;top:0;background: green;color: white;padding: 0px 5px;border-bottom-left-radius: 10px;">{{$item->status == 'v' ? 'Verified' : ''}}</span>
                    @endif
                    <div style="display: flex;align-items:center;justify-content:center;padding-top:15px;">
                        <img style="height: 150px;width:60%;border:1px solid #d1d1d1;" src="{{asset($item->image != null ? $item->image : 'nouser.png')}}" />
                    </div>
                    <div class="card-body">
                        <ul style="margin-left: 15px;">
                            <li class="position-relative">
                                <span class="fa fa-user" style="position: absolute;left:-15px;top:0;"></span>
                                <span>{{$item->name}}</span>
                            </li>
                            <li class="position-relative">
                                <span class="fa fa-map-marker" style="position: absolute;left:-15px;top:0;"></span>
                                <span>{{$item->address}}@if($item->address != null),@endif {{$item->thana->name}}, {{$item->thana->district->name}}</span>
                            </li>
                            <li class="mt-2">
                                <a href="{{route('worker.details', $item->id)}}" style="background: #2b46a8;padding: 5px;color: white;">Show Details</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @else
            @foreach($worker as $item)
            <div class="col-lg-3">
                <div class="card" title="{{$item->name}}" style="cursor: pointer;position:relative;">
                    @if($item->status == 'v')
                    <span style="position: absolute;right:0;top:0;background: green;color: white;padding: 0px 5px;border-bottom-left-radius: 10px;">{{$item->status == 'v' ? 'Verified' : ''}}</span>
                    @endif
                    <div style="display: flex;align-items:center;justify-content:center;padding-top:15px;">
                        <img style="height: 150px;width:60%;border:1px solid #d1d1d1;" src="{{asset($item->image != null ? $item->image : 'nouser.png')}}" />
                    </div>
                    <div class="card-body">
                        <ul style="margin-left: 15px;">
                            <li class="position-relative">
                                <span class="fa fa-user" style="position: absolute;left:-15px;top:0;"></span>
                                <span>{{$item->name}}</span>
                            </li>
                            <li class="position-relative">
                                <span class="fa fa-map-marker" style="position: absolute;left:-15px;top:0;"></span>
                                <span>{{$item->address}}@if($item->address != null),@endif {{$item->thana->name}}, {{$item->thana->district->name}}</span>
                            </li>
                            <li class="mt-2">
                                <a href="{{route('worker.details', $item->id)}}" style="background: #2b46a8;padding: 5px;color: white;">Show Details</a>
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
@endsection

@push("webjs")
<script>
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
            $(".error-district_id").text("District select first")
            return
        }
        if ($("#thana_id").val() == "") {
            $(".error-district_id").text("")
            $(".error-thana_id").text("Upazila select first")
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