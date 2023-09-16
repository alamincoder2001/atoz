@extends("layouts.fronted_master")
@section("title", " - Technician Dashboard")

@section("content")

<nav class="breadcrumb-section mb-3 section-py bg-light2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="bread-crumb-title">My Account</h3>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <!-- My Account Tab Menu Start -->
        <div class="col-lg-3 col-12 mb-5">
            <div class="myaccount-tab-menu nav" role="tablist">
                <a href="#dashboad" data-bs-toggle="tab" aria-selected="true" role="tab" class="active"><i class="fa fa-tachometer"></i> Dashboard</a>
                <a href="#account-info" data-bs-toggle="tab" class="" aria-selected="false" role="tab" tabindex="-1"><i class="fa fa-user"></i> Account Details</a>
                <a href="{{route('technician.logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>
        <!-- My Account Tab Menu End -->
        <!-- My Account Tab Content Start -->
        <div class="col-lg-9 col-12 mb-5">
            <div class="tab-content" id="myaccountContent">
                <!-- Single Tab Content Start -->
                <div class="tab-pane fade active show" id="dashboad" role="tabpanel">
                    <div class="myaccount-content">
                        <h3>Dashboard</h3>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="technician-img-section">
                                    <img src="{{asset(Auth::guard('technician')->user()->image != null ? Auth::guard('technician')->user()->image : 'nouser.png')}}" class="technicianImage" alt="">
                                    <input type="file" name="image" class="form-control" onchange="imageUpdate(event)">
                                </div>
                                <span class="text-danger error-image"></span>
                            </div>
                        </div>

                        <div class="welcome mb-20">
                            <p>
                                Hello, <strong>{{Auth::guard('technician')->user()->name}}</strong> (<a href="{{route('technician.logout')}}" class="logout"> Logout</a>)
                            </p>
                        </div>

                        <p class="mb-0">
                            From your account dashboard. you can easily check &amp;
                            account details and edit your password.
                        </p>
                    </div>
                </div>
                <!-- Single Tab Content End -->

                <!-- Single Tab Content Start -->
                <div class="tab-pane fade" id="account-info" role="tabpanel">
                    <div class="myaccount-content">
                        <h3 class="p-0">Account Details</h3>

                        <div class="account-details-form">
                            <form onsubmit="updateTechnician(event)">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-5">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{Auth::guard('technician')->user()->name}}">
                                        <span class="text-danger error error-name"></span>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-5">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{Auth::guard('technician')->user()->username}}">
                                        <span class="text-danger error error-username"></span>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-5">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{Auth::guard('technician')->user()->email}}">
                                        <span class="text-danger error error-email"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-5">
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{Auth::guard('technician')->user()->mobile}}">
                                        <span class="text-danger error error-mobile"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-5">
                                        <select onchange="getUpazila(event)" style="height: 38px;border-radius:0;line-height:1;" name="district_id" id="district_id" class="form-select">
                                            <option value="">Select District</option>
                                            @foreach($districts as $item)
                                            <option value="{{$item->id}}" {{Auth::guard('technician')->user()->district_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error error-district_id"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-5">
                                        <select style="height: 38px;border-radius:0;line-height:1;" name="thana_id" id="thana_id" class="form-select">
                                            <option value="">Select Upazila</option>
                                            @foreach($upazilas as $item)
                                            <option value="{{$item->id}}" {{Auth::guard('technician')->user()->thana_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error error-thana_id"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-5">
                                        <select style="height: 38px;border-radius:0;line-height:1;" name="gender" id="gender" class="form-select">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{Auth::guard('technician')->user()->gender == 'Male' ? 'selected':''}}>Male</option>
                                            <option value="Female" {{Auth::guard('technician')->user()->gender == 'Female' ? 'selected':''}}>Female</option>
                                            <option value="Others" {{Auth::guard('technician')->user()->gender == 'Others' ? 'selected':''}}>Others</option>
                                        </select>
                                        <span class="text-danger error error-gender"></span>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-5">
                                        <textarea class="form-control" name="address" id="address" placeholder="Address">{{Auth::guard('technician')->user()->address}}</textarea>
                                    </div>

                                    <div class="col-12 mb-5">
                                        <h4>Password change</h4>
                                    </div>

                                    <div class="col-lg-4 col-12 mb-5">
                                        <input id="old_password" class="form-control" name="old_password" placeholder="Current Password" type="password">
                                        <span class="text-danger error error-old_password"></span>
                                    </div>

                                    <div class="col-lg-4 col-12 mb-5">
                                        <input id="new_password" class="form-control" name="new_password" placeholder="New Password" type="password">
                                        <span class="text-danger error error-new_password"></span>
                                    </div>

                                    <div class="col-lg-4 col-12 mb-5">
                                        <input id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password" type="password">
                                        <span class="text-danger error error-confirm_password"></span>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-warning btn-hover-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Tab Content End -->
            </div>
        </div>
        <!-- My Account Tab Content End -->
    </div>
</div>


@endsection

@push("webjs")
<script>
    function imageUpdate(event) {
        if (event.target.files[0]) {
            let formdata = new FormData();
            formdata.append("image", event.target.files[0])
            $.ajax({
                url: location.origin+"/technician-imageUpdate",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: res => {
                    if (res.error) {
                        $(".error-image").text(res.error.image);
                    }else{
                        $.notify(res, "success");
                        document.querySelector(".technicianImage").setAttribute('src', window.URL.createObjectURL(event.target.files[0]))
                        event.target.value = "";
                    }
                }
            })
        }
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

    function updateTechnician(event) {
        event.preventDefault();
        let formdata = new FormData(event.target)
        $.ajax({
            url: location.origin+"/technician-update",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: () => {
                $(".account-details-form").find(".error").text("")
            },
            success: res => {
                if(res.error){
                    $.each(res.error, (index, value) => {
                        $(".account-details-form").find(".error-"+index).text(value)
                    })
                }else if(res.errors){
                    $(".account-details-form").find(".error-old_password").text(res.errors)
                }else{
                    $.notify(res, "success")
                }
            }
        })
    }
</script>
@endpush