@extends("layouts.backend_master")

@section("title", "Admin Settings Page")
@section("breadcrumb_title", "Settings")
@section("breadcrumb_item", "Admin Setting Page")

@section("content")
<!-- Column -->
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <p style="margin: 0;">Company Logo</p>
                        <div class="d-flex align-items-center gap-2" style="margin-bottom: 10px;">
                            <img src="{{asset($data->logo != null ? $data->logo : 'noImage.jpg')}}" class="imglogo" style="width: 60%;height: 40px;border: 1px solid #c1c1c1;margin-top: 5px;">
                            <input type="file" id="logo" name="logo" autocomplete="off" class="form-control shadow-none" onchange="logoUpdate(event)">
                        </div>
                        <span class="text-danger error error-logo"></span>
                    </div>
                    <div class="form-group">
                        <p style="margin: 0;">Navicon</p>
                        <div class="d-flex align-items-center gap-2" style="margin-bottom: 10px;">
                            <img src="{{asset($data->navicon != null ? $data->navicon : 'noImage.jpg')}}" class="imgnav" style="width: 50%;height: 85px;border: 1px solid #c1c1c1;margin-top: 5px;">
                            <input type="file" id="navicon" name="navicon" autocomplete="off" class="form-control shadow-none" onchange="naviconUpdate(event)">
                        </div>
                        <span class="text-danger error error-navicon"></span>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form onsubmit="Update(event)">
                        <div class="row">
                            <!-- <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="text-center m-0">Owner Profile</h3>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <p style="margin: 0;">Owner Image</p>
                                            <div class="d-flex align-items-center gap-2" style="margin-bottom: 10px;">
                                                <img src="{{asset($data->ownerimage != null ? $data->ownerimage : 'noImage.jpg')}}" class="imgowner" style="width: 20%;height: 85px;border: 1px solid #c1c1c1;margin-top: 5px;">
                                                <input type="file" id="ownerimage" name="ownerimage" autocomplete="off" class="form-control shadow-none" onchange="ownerimageUpdate(event)">
                                            </div>
                                            <span class="text-danger error error-ownerimage"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="ownername">Owner Name</label>
                                            <input type="text" name="ownername" id="ownername" value="{{$data->ownername}}" autocomplete="off" class="form-control shadow-none">
                                            <span class="text-danger error error-ownername"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="ownerdesignation">Owner Designation</label>
                                            <input type="text" name="ownerdesignation" id="owner_designation" value="{{$data->ownerdesignation}}" autocomplete="off" class="form-control shadow-none">
                                            <span class="text-danger error error-ownerdesignation"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin: 8px 0;"> -->
                            <div class="col-lg-12">
                                <h3 class="text-center m-0">Company Profile</h3>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" name="company_name" id="company_name" value="{{$data->company_name}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-company_name"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" id="mobile" value="{{$data->mobile}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-mobile"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="{{$data->email}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-email"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" autocomplete="off" style="display: inherit;width: 100%; border: 1px solid #d5d5d5;" class="shadow-none">{{$data->address}}</textarea>
                                    <span class="text-danger error error-address"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="mobile_second">Mobile Second</label>
                                    <input type="text" name="mobile_second" id="mobile_second" value="{{$data->mobile_second}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-mobile_second"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="email_second">Email Second</label>
                                    <input type="email" name="email_second" id="email_second" value="{{$data->email_second}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-email_second"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="address_second">Address Second</label>
                                    <textarea name="address_second" autocomplete="off" style="display: inherit;width: 100%; border: 1px solid #d5d5d5;" class="shadow-none">{{$data->address_second}}</textarea>
                                    <span class="text-danger error error-address_second"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="url" name="facebook" id="facebook" value="{{$data->facebook}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-facebook"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="url" name="instagram" id="instagram" value="{{$data->instagram}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-instagram"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="url" name="twitter" id="twitter" value="{{$data->twitter}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-twitter"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="url" name="linkedin" id="linkedin" value="{{$data->linkedin}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-linkedin"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="youtube">Youtube</label>
                                    <input type="url" name="youtube" id="youtube" value="{{$data->youtube}}" autocomplete="off" class="form-control shadow-none">
                                    <span class="text-danger error error-youtube"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-sm px-3 shadow-none">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function Update(event) {
        event.preventDefault();
        var formdata = new FormData(event.target);
        $.ajax({
            url: location.origin + "/admin/setting",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(".error").text("")
            },
            success: res => {
                if (!res.error) {
                    $.notify(res, "success");
                } else {
                    $.each(res.error, (index, value) => {
                        $(".error-" + index).text(value)
                    })
                }
            }
        })
    }

    function logoUpdate(event) {
        event.preventDefault();

        var formdata = new FormData()
        formdata.append("logo", event.target.files[0]);
        $.ajax({
            url: location.origin + "/admin/logoUpdate",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: () => {
                $(".error").text("")
            },
            success: res => {
                if (!res.error) {
                    document.querySelector('.imglogo').src = window.URL.createObjectURL(event.target.files[0])
                    $("#logo").val("")
                    $.notify(res, "success");
                } else {
                    $.each(res.error, (index, value) => {
                        $(".error-" + index).text(value)
                    })
                }
            }
        })
    }

    function naviconUpdate(event) {
        event.preventDefault();

        var formdata = new FormData()
        formdata.append("navicon", event.target.files[0]);
        $.ajax({
            url: location.origin + "/admin/naviconUpdate",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: () => {
                $(".error").text("")
            },
            success: res => {
                if (!res.error) {
                    document.querySelector('.imgnav').src = window.URL.createObjectURL(event.target.files[0])
                    $("#navicon").val("")
                    $.notify(res, "success");
                } else {
                    $.each(res.error, (index, value) => {
                        $(".error-" + index).text(value)
                    })
                }
            }
        })
    }

    function ownerimageUpdate(event) {
        event.preventDefault();

        var formdata = new FormData()
        formdata.append("ownerimage", event.target.files[0]);
        $.ajax({
            url: location.origin + "/admin/ownerimageUpdate",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: () => {
                $(".error").text("")
            },
            success: res => {
                if (!res.error) {
                    document.querySelector('.imgowner').src = window.URL.createObjectURL(event.target.files[0])
                    $("#ownerimage").val("")
                    $.notify(res, "success");
                } else {
                    $.each(res.error, (index, value) => {
                        $(".error-" + index).text(value)
                    })
                }
            }
        })
    }
</script>
@endpush