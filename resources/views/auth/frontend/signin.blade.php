@extends("layouts.fronted_master")
@section("title", " - Sign In")

@section("content")

<div class="login-register-area section-py" style="margin: 40px 0;">
<div class="container">
    <div class="row justify-content-center" style="margin: 40px 0;">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card p-4">
                    <div class="card-body CustomerLogin">
                        <form onsubmit="CustomerLogin(event)">
                            <h3 class="text-center">Customer</h3>
                            <div class="form-group mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off">
                                <span class="text-danger error-username error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                                <span class="text-danger error-password error"></span>
                            </div>
                            <button type="submit" style="width: 100%;" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                    <div class="card-body d-none WorkerLogin">
                        <form onsubmit="WorkerLogin(event)">
                            <h3 class="text-center">Worker</h3>
                            <div class="form-group mb-3">
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile" autocomplete="off">
                                <span class="text-danger error-mobile error"></span>
                            </div>
                            <!-- <div class="form-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                                <span class="text-danger error-password error"></span>
                            </div> -->
                            <button type="submit" style="width: 100%;" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <h2 class="text-white">SignIn</h2>
                            <button type="button" onclick="toggleLoginBody(event)" value="Customer" class="btn btn-info mt-3 Customer d-none">SignIn as a Customer</button>
                            <button type="button" onclick="toggleLoginBody(event)" value="Worker" class="btn btn-info mt-3 Worker">SignIn as a Worker</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@push("webjs")
<script>
    function CustomerLogin(event) {
        event.preventDefault();
        let formdata = new FormData(event.target)
        $.ajax({
            url: "/customer-login",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(".CustomerLogin .error").text("")
            },
            success: res => {
                if (res.error) {
                    $.each(res.error, (index, value) => {
                        $(".CustomerLogin .error-" + index).text(value)
                    })
                } else if (res.errors) {
                    $(".CustomerLogin .error-username").text(res.errors)
                } else {
                    $.notify(res, "success");
                    $("form").trigger("reset")
                    location.href = "{{route('customer.dashboard')}}"
                }
            }
        })
    }
    function WorkerLogin(event) {
        event.preventDefault();
        let formdata = new FormData(event.target)
        $.ajax({
            url: "/worker-login",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(".WorkerLogin .error").text("")
            },
            success: res => {
                if (res.error) {
                    $.each(res.error, (index, value) => {
                        $(".WorkerLogin .error-" + index).text(value)
                    })
                } else if (res.errors) {
                    $(".WorkerLogin .error-mobile").text(res.errors)
                } else {
                    $.notify(res, "success");
                    $("form").trigger("reset")
                    location.href = "/worker-dashboard"
                }
            }
        })
    }

    function toggleLoginBody(event) {
        $(".CustomerLogin .error").text("")
        $(".WorkerLogin .error").text("")
        if (event.target.value == 'Customer') {
            $(".CustomerLogin").removeClass("d-none")
            $(".WorkerLogin").addClass("d-none")
            $(".Customer").addClass("d-none")
            $(".Worker").removeClass("d-none")
        }else {
            $(".CustomerLogin").addClass("d-none")
            $(".WorkerLogin").removeClass("d-none")
            $(".Customer").removeClass("d-none")
            $(".Worker").addClass("d-none")
        }
    }
</script>
@endpush