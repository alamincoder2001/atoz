@extends("layouts.fronted_master")
@section("title", " - SignUp")
@section("content")
<div class="container">
    <div class="row justify-content-center" style="margin: 40px 0;">
        <div class="col-md-4">
            <div class="card-group mb-0">
                <div class="card p-4">
                    <div class="card-body RetailRegister">
                        <form onsubmit="RetailRegister(event)">
                            <h3 class="text-center">Register</h3>
                            <div class="form-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name" autocomplete="off">
                                <span class="text-danger error-name error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off">
                                <span class="text-danger error-username error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off">
                                <span class="text-danger error-email error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile" autocomplete="off">
                                <span class="text-danger error-mobile error"></span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select onchange="getUpazila(event)" name="district_id" class="form-select">
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
                                        <select name="thana_id" class="thana_id form-select">
                                            <option value="">Select Upazila</option>
                                        </select>
                                        <span class="text-danger error-thana_id error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                                <span class="text-danger error-password error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="off">
                                <span class="text-danger error-confirm_password error"></span>
                            </div>
                            <button type="submit" style="width: 100%;" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("webjs")
<script>
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
                        $(".thana_id").append(`<option value="${value.id}">${value.name}</option>`)
                    })
                }
            })
        } else {
            $(".thana_id").html(`<option value="">Select Upazila</option>`)
        }
    }

    function RetailRegister(event) {
        event.preventDefault();
        let formdata = new FormData(event.target)
        $.ajax({
            url: "/customer-register",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(".RetailRegister .error").text("")
            },
            success: res => {
                if (res.error) {
                    $.each(res.error, (index, value) => {
                        $(".RetailRegister .error-" + index).text(value)
                    })
                } else {
                    $.notify(res.msg, "success");
                    $("form").trigger("reset")
                    if (res.customer_type == 'Retail') {
                        location.href = "/customer-dashboard";
                    }
                }
            }
        })
    }
</script>
@endpush