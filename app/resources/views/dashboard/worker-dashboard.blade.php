@extends("layouts.fronted_master")
@section("front_title", " - Worker Dashboard")

@push('front_style')
<style>
    /*------------------*
        # Account Page
        *------------------*/
    .my-account .title {
        border-bottom: 1px solid #ebebeb;
        font-weight: 500;
        padding-bottom: 20px;
        margin-bottom: 20px;
        font-size: 24px;
    }

    .register .title {
        border-bottom: 1px solid #ebebeb;
        font-weight: 500;
        padding-bottom: 20px;
        margin-bottom: 20px;
        font-size: 24px;
    }

    .myaccount-tab-menu {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        background-color: #fff;
    }

    .myaccount-tab-menu a {
        border: 1px solid #ebebeb;
        border-bottom: 0;
        color: #32383e;
        font-weight: 500;
        display: block;
        padding: 15px 15px 13px;
        line-height: 30px;
        font-size: 15px;
        text-transform: uppercase;
    }

    .myaccount-tab-menu a:last-child {
        border-bottom: 1px solid #ebebeb;
    }

    .myaccount-tab-menu a:hover,
    .myaccount-tab-menu a.active {
        background-color: #ce5cf6;
        color: #fff;
    }

    .myaccount-tab-menu a i {
        font-size: 14px;
        text-align: center;
        width: 25px;
    }

    .myaccount-content {
        background-color: #fff;
        font-size: 14px;
        border: 1px solid #ebebeb;
        padding: 30px;
    }

    @media only screen and (max-width: 575px) {
        .myaccount-content {
            padding: 20px 15px;
        }
    }

    .myaccount-content h3,
    .myaccount-content .h3 {
        border-bottom: 1px solid #ebebeb;
        font-size: 24px;
        font-weight: 500;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .myaccount-content .welcome a {
        color: #32383e;
    }

    .myaccount-content .welcome a:hover {
        color: #fe6022;
    }

    .myaccount-content .welcome strong {
        font-weight: 600;
    }

    .myaccount-content a.edit-address-btn {
        border-color: #333;
    }

    .myaccount-content a.edit-address-btn i {
        padding-right: 5px;
    }

    .myaccount-content a.edit-address-btn:hover {
        color: #fe6022;
    }

    .myaccount-table {
        white-space: nowrap;
        font-size: 15px;
    }

    .myaccount-table table th,
    .myaccount-table .table th {
        padding: 10px;
        font-weight: 600;
    }

    .myaccount-table table td,
    .myaccount-table .table td {
        padding: 20px 10px;
        vertical-align: middle;
    }

    .myaccount-table table td a:hover,
    .myaccount-table .table td a:hover {
        color: #fff;
    }

    .saved-message {
        font-weight: 600;
        font-size: 13px;
        padding: 20px;
    }

    .account-details-form h4,
    .account-details-form .h4 {
        text-transform: capitalize;
        margin: 0;
        color: #32383e;
        font-weight: 500;
        font-size: 18px;
    }

    .table .thead-light th {
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .account-details-form input[type="text"],
    .account-details-form input[type="email"],
    .account-details-form input[type="url"],
    .account-details-form input[type="password"],
    .account-details-form input[type="search"],
    .account-details-form input[type="number"],
    .account-details-form input[type="tel"] {
        width: 100%;
        background-color: #fff;
        border: 1px solid #ebebeb;
        font-size: 14px;
        color: #63696f;
        padding: 0.8rem 0.6rem;
        height: 38px;
        line-height: 1.25;
        border-radius: 0px;
    }

    /* ***************
            my-account End
        ******************/
    .btn-warning {
        background-color: #ce5cf6 !important;
        border-color: #ce5cf6 !important;
        color: white !important;
    }

    .btn-check:focus+.btn-warning,
    .btn-warning:focus {
        box-shadow: 0 0 0 0.25rem rgb(206 92 246 / 95%) !important;
    }

    .f_c {
        color: #1f1f1f !important;
    }

    .form-control {
        background-color: #ffffff !important;
        height: 35px !important;
        border: 1px solid #da5bfe7a !important;
    }

    .nav {
        display: flex;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        flex-direction: column !important;
    }

    /* disabled input */
    .form-control:disabled,
    .form-control[readonly] {
        cursor: not-allowed;
    }
</style>
@endpush

@section("front_content")

<nav class="breadcrumb-section mb-3 section-py bg-light2" style="margin-top: 100px !important">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="bread-crumb-title text-center f_c">My Account | <span style="color: #ce5cf6 !important;">{{Auth::guard('worker')->user()->name}}</span></h3>
            </div>
        </div>
    </div>
</nav>
{{-- <section class="listing-area mt-5"> --}}
<div class="container">

    <div class="row">
        <!-- My Account Tab Menu Start -->
        <div class="col-lg-3 col-12 mb-5">
            <div class="myaccount-tab-menu nav" role="tablist" style="box-shadow: 0 0 20px 1px #ce5cf645;">
                <a href="#dashboad" onclick="" data-bs-toggle="tab" aria-selected="true" role="tab" class="active tab-btn mb-1">
                    <i class="bx bx-tachometer mt-2" style="font-size: 19px"></i> <span>Dashboard</span>
                </a>

                <a href="#order-info" data-bs-toggle="tab" class="tab-btn mb-1" aria-selected="false" role="tab" tabindex="-1">
                    <i class="bx bx-cart mt-2" style="font-size: 19px"></i> Order Details
                </a>

                <a href="#account-info" data-bs-toggle="tab" class="tab-btn mb-1" aria-selected="false" role="tab" tabindex="-1">
                    <i class="bx bx-user mt-2" style="font-size: 19px"></i> Account Details
                </a>

                <a href="{{route('worker.logout')}}" class="tab-btn">
                    <i class="bx bx-log-out mt-2" style="font-size: 19px"></i> Logout
                </a>
            </div>
        </div>
        <!-- My Account Tab Menu End -->

        <!-- My Account Tab Content Start -->
        <div class="col-lg-9 col-12 mb-5">
            <div class="tab-content" id="myaccountContent" style="box-shadow: 0 0 20px 1px #ce5cf645;">
                <!-- Single Tab Content Start -->
                <div class="tab-pane fade active show" id="dashboad" role="tabpanel">
                    <div class="myaccount-content">
                        <h3>Dashboard</h3>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="technician-img-section">
                                    <img src="{{asset(Auth::guard('worker')->user()->image != null ? Auth::guard('worker')->user()->image : 'nouser.png')}}" class="workerImage mb-1" style="height: 100px;" alt="">
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
                                        <th>Invoice</th>
                                        <th>Assign Date</th>
                                        <th>Customer</th>
                                        <th>Contact</th>
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
                                        <td>{{$item->order->invoice}}</td>
                                        <td>{{date('d-m-Y', strtotime($item->updated_at))}}</td>
                                        <td>{{$item->order->customer ? $item->order->customer->name : "n/a"}}</td>
                                        <td>{{$item->order->customer ? $item->order->customer->mobile : "n/a"}}</td>
                                        <td>{{$item->service->name}}</td>
                                        <td>
                                            @if($item->status == 'pending')
                                            <span class="badge bg-danger">Pending</span>
                                            @elseif($item->status == 'bill')
                                            <span class="badge bg-warning">On Going</span>
                                            @else
                                            <span class="badge bg-success">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ url('view-worker-order-details',$item->id) }}" title="View Order Details">
                                                    <i class='bx bx-show' style="font-size: 25px;"></i>
                                                </a>
                                                @if($item->status == 'pending')
                                                <i onclick="showModal(event, {{$item->id}}, 'bill')" class="bx bx-money" style="font-size: 22px;padding-top: 2px;color: gray !important;cursor: pointer;"></i>
                                                @elseif($item->status == 'bill')
                                                <i onclick="showModal(event, {{$item->id}}, 'complete', {{$item}})" class="bx bx-check-square" style="font-size: 22px;padding-top: 2px;color: #55bd00 !important;cursor: pointer;"></i>
                                                @else
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="8">Not Found Order</td>
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
                                    <div class="col-lg-6 col-12 mb-2">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{Auth::guard('worker')->user()->name}}">
                                        <span class="text-danger error error-name"></span>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-2">
                                        <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father Name" value="{{Auth::guard('worker')->user()->father_name}}">
                                        <span class="text-danger error error-father_name"></span>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-2">
                                        <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Mother Name" value="{{Auth::guard('worker')->user()->mother_name}}">
                                        <span class="text-danger error error-mother_name"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{Auth::guard('worker')->user()->mobile}}">
                                        <span class="text-danger error error-mobile"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <select onchange="getUpazila(event)" style="height: 38px;border-radius:0;line-height:1;" name="district_id" id="district_id" class="form-control">
                                            <option value="">Select District</option>
                                            @foreach($districts as $item)
                                            <option value="{{$item->id}}" {{Auth::guard('worker')->user()->district_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error error-district_id"></span>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <select style="height: 38px;border-radius:0;line-height:1;" name="thana_id" id="thana_id" class="form-control">
                                            <option value="">Select Upazila</option>
                                            @foreach($upazilas as $item)
                                            <option value="{{$item->id}}" {{Auth::guard('worker')->user()->thana_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error error-thana_id"></span>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2">
                                        <textarea class="form-control" name="present_address" id="address" placeholder="Address">{{Auth::guard('worker')->user()->present_address}}</textarea>
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
                            <div class="col-md-12 billAmount">
                                <div class="form-group">
                                    <label for="billAmount">Bill Amount</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="billAmount" oninput="calculateTotal(event)" name="billAmount" value="0" />
                                </div>
                            </div>
                            <div class="col-md-6 d-none discountAmount">
                                <div class="form-group">
                                    <label for="discountAmount">Discount</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="discountAmount" oninput="calculateTotal(event)" name="discountAmount" value="0" readonly />
                                </div>
                            </div>
                            <div class="col-md-6 d-none dueAmount">
                                <div class="form-group">
                                    <label for="dueAmount">Due Amount</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="dueAmount" oninput="calculateTotal(event)" name="dueAmount" value="0" readonly />
                                </div>
                            </div>
                            <div class="col-md-6 d-none total">
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="total" oninput="calculateTotal(event)" name="total" value="0" readonly />
                                </div>
                            </div>
                            <div class="col-md-12 d-none commissionAmount">
                                <div class="form-group">
                                    <label for="commissionAmount">Commission</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="commissionAmount" oninput="calculateTotal(event)" name="commissionAmount" value="0" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- </section> --}}
@endsection

@push("front_script")
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
                        Toastify({
                            text: res,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                        }).showToast();
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
                    Toastify({
                        text: res.error,
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"
                    }).showToast();

                } else if (res.errors) {
                    Toastify({
                        text: res.errors,
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"
                    }).showToast();
                } else {
                    Toastify({
                        text: res,
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                    }).showToast();
                }
            }
        })
    }

    function showModal(event, id, type, item) {
        $("#staticBackdrop").modal('show');
        $("#staticBackdrop").find('#id').val(id);
        $("#staticBackdrop").find('#status').val(type);
        if (type == 'complete') {
            $("#staticBackdrop").find('.billAmount').removeClass("col-md-12").addClass("col-md-6");
            $("#staticBackdrop").find('.commissionAmount').removeClass("d-none");
            $("#staticBackdrop").find('.discountAmount').removeClass("d-none");
            $("#staticBackdrop").find('.dueAmount').removeClass("d-none");
            $("#staticBackdrop").find('.total').removeClass("d-none");
            $("#staticBackdrop").find('#billAmount').val(item.bill_amount);
            $("#staticBackdrop").find('#discountAmount').val(item.discount);
            $("#staticBackdrop").find('#dueAmount').val(item.due);

            calculateTotal();
        }
    }

    function calculateTotal(event) {
        let billAmount = $("#staticBackdrop").find('#billAmount').val();
        let discount = $("#staticBackdrop").find('#discountAmount').val();
        let commissionPer = "{{Auth::guard('worker')->user()->commission}}";
        let total = parseFloat(billAmount) - parseFloat(discount);
        
        let commAmount = (total * parseFloat(commissionPer)) / 100;
        $("#staticBackdrop").find('#commissionAmount').val(parseFloat(commAmount).toFixed(2));
        $("#staticBackdrop").find('#total').val(parseFloat(parseFloat(total)).toFixed(2));
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
                        Toastify({
                            text: res.msg,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            backgroundColor: "linear-gradient(to right, #7b3edb, #7b3edb)"
                        }).showToast();
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