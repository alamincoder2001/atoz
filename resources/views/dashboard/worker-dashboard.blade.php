@extends("layouts.fronted_master")
@section("title", " - Worker Dashboard")

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
                <a href="#order-info" data-bs-toggle="tab" class="" aria-selected="false" role="tab" tabindex="-1"><i class="fa fa-shopping-cart"></i> Order Details</a>
                <a href="#account-info" data-bs-toggle="tab" class="" aria-selected="false" role="tab" tabindex="-1"><i class="fa fa-user"></i> Account Details</a>
                <a href="{{route('worker.logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
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
                                    <img src="{{asset(Auth::guard('worker')->user()->image != null ? Auth::guard('worker')->user()->image : 'nouser.png')}}" class="workerImage" alt="">
                                    <input type="file" name="image" class="form-control" onchange="imageUpdate(event)">
                                </div>
                                <span class="text-danger error-image"></span>
                            </div>
                        </div>

                        <div class="welcome mb-20">
                            <p>
                                Hello, <strong>{{Auth::guard('worker')->user()->name}}</strong> (<a href="{{route('worker.logout')}}" class="logout"> Logout</a>)
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
                <div class="tab-pane fade" id="order-info" role="tabpanel">
                    <div class="myaccount-content">
                        <h3 class="p-0">Order Details</h3>
                        <div class="account-details-form">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Assign Date</th>
                                        <th>Service Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders) > 0)
                                    @foreach($orders as $key => $item)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{date('d-m-Y', strtotime($item->updated_at))}}</td>
                                        <td>{{$item->service->name}}</td>
                                        <td>
                                            @if($item->status == 'pending')
                                            <span class="badge bg-danger">Pending</span>
                                            @elseif($item->status == 'proccess')
                                            <span class="badge bg-warning">On Going</span>
                                            @else
                                            <span class="badge bg-success">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 'pending')
                                            <form onsubmit="changeStatus(event)">
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <input type="hidden" name="status" value="proccess">
                                                <button type="submit" style="padding: 5px;" class="btn btn-xs btn-warning shadow-none"> <i class="fa fa-spinner"></i> </button>
                                            </form>
                                            @elseif($item->status == 'proccess')
                                            <button onclick="showModal(event, {{$item->id}})" type="button" style="padding: 5px;" class="btn btn-xs btn-success shadow-none"> <i class="fa fa-check-square-o"></i> </button>
                                            @else
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="5">Not Found Order</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Single Tab Content End -->

                <!-- Single Tab Content Start -->
                <div class="tab-pane fade" id="account-info" role="tabpanel">
                    <div class="myaccount-content">
                        <h3 class="p-0">Account Details</h3>
                        <div class="account-details-form">
                            <form onsubmit="updateWorker(event)">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-5">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{Auth::guard('worker')->user()->name}}">
                                        <span class="text-danger error error-name"></span>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-5">
                                        <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father Name" value="{{Auth::guard('worker')->user()->father_name}}">
                                        <span class="text-danger error error-father_name"></span>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-5">
                                        <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Mother Name" value="{{Auth::guard('worker')->user()->mother_name}}">
                                        <span class="text-danger error error-mother_name"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-5">
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{Auth::guard('worker')->user()->mobile}}">
                                        <span class="text-danger error error-mobile"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-5">
                                        <select onchange="getUpazila(event)" style="height: 38px;border-radius:0;line-height:1;" name="district_id" id="district_id" class="form-select">
                                            <option value="">Select District</option>
                                            @foreach($districts as $item)
                                            <option value="{{$item->id}}" {{Auth::guard('worker')->user()->district_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error error-district_id"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-5">
                                        <select style="height: 38px;border-radius:0;line-height:1;" name="thana_id" id="thana_id" class="form-select">
                                            <option value="">Select Upazila</option>
                                            @foreach($upazilas as $item)
                                            <option value="{{$item->id}}" {{Auth::guard('worker')->user()->thana_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error error-thana_id"></span>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-5">
                                        <textarea class="form-control" name="address" id="address" placeholder="Address">{{Auth::guard('worker')->user()->address}}</textarea>
                                    </div>

                                    <!-- <div class="col-12 mb-5">
                                        <h4>Password change</h4>
                                    </div> -->

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


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Worker Deal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form onsubmit="changeStatus(event)">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="status" name="status">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billAmount">Bill Amount</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="billAmount" oninput="calculateTotal(event)" name="billAmount" value="0" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paidAmount">Paid Amount</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="paidAmount" oninput="calculateTotal(event)" name="paidAmount" value="0" />
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="dueAmount">Due Amount</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="dueAmount" oninput="calculateTotal(event)" name="dueAmount" value="0" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Completed</button>
                    </div>
                </form>
            </div>
        </div>
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
                url: location.origin + "/worker-imageUpdate",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: res => {
                    if (res.error) {
                        $(".error-image").text(res.error.image);
                    } else {
                        $.notify(res, "success");
                        document.querySelector(".workerImage").setAttribute('src', window.URL.createObjectURL(event.target.files[0]))
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

    function updateWorker(event) {
        event.preventDefault();
        let formdata = new FormData(event.target)
        $.ajax({
            url: location.origin + "/worker-update",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: () => {
                $(".account-details-form").find(".error").text("")
            },
            success: res => {
                if (res.error) {
                    $.each(res.error, (index, value) => {
                        $(".account-details-form").find(".error-" + index).text(value)
                    })
                } else if (res.errors) {
                    $(".account-details-form").find(".error-old_password").text(res.errors)
                } else {
                    $.notify(res, "success")
                }
            }
        })
    }

    function showModal(event, id) {
        $("#staticBackdrop").modal('show');
        $("#staticBackdrop").find('#id').val(id);
        $("#staticBackdrop").find('#status').val('complete');
    }

    function calculateTotal(event) {
        let billAmount = $("#staticBackdrop").find('#billAmount').val();
        let paidAmount = $("#staticBackdrop").find('#paidAmount').val();

        let dueAmount = (billAmount - paidAmount);
        $("#staticBackdrop").find('#dueAmount').val(parseFloat(dueAmount).toFixed(2));
    }

    function changeStatus(event) {
        event.preventDefault();
        if (confirm("Are you sure !!")) {
            let formdata = new FormData(event.target);
            $.ajax({
                url: "/order-status-update",
                method: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: res => {
                    if (res.status) {
                        $.notify(res.msg, "success");
                        setTimeout(() => {
                            location.reload();
                        }, 1000)
                    } else {
                        console.log(res.msg);
                    }
                }
            })
        }
    }
</script>
@endpush