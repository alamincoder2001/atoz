@extends("layouts.fronted_master")
@section("title", " - Customer Dashboard")

@section("content")

<div class="login-register-area section-py">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                    <div class="text-center">
                        <img src="{{asset(Auth::guard('web')->user()->image != null ? Auth::guard('web')->user()->image : 'noImage.jpg')}}" width="100" class="img rounded">
                        <h5 class="mt-2 mb-0">{{Auth::guard('web')->user()->name}}</h5>
                    </div>
                    <hr style="margin: 5px 0 !important;">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="" onclick="Dashboard(event)" class="nav-link dashboard active" aria-current="page">
                                <i class="bi bi-grid me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a href="" class="nav-link orderTable" onclick="OrderTable(event)">
                                <i class="bi bi-cart me-2"></i>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a href="#" onclick="Setting(event)" class="nav-link setting">
                                <i class="bi bi-gear me-2"></i>
                                Settings
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a href="{{route('customer.logout')}}" class="nav-link">
                                <i class="bi bi-box-arrow-in-left me-2"></i>
                                SignOut
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-9 item-section" id="dashboard">
                <div class="mt-2">
                    <div class="row">
                        <div class="col-lg-4 mb-5">
                            <a href="">
                                <div class="card border-0" style="box-shadow: 3px 5px 10px #838383a3;" onclick="OrderTable(event)">
                                    <div class="card-body text-center">
                                        <i class="bi bi-cart"></i>
                                        <p>Orders</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <a href="">
                                <div class="card border-0" onclick="Pending(event)" style="box-shadow: 3px 5px 10px #838383a3;">
                                    <div class="card-body text-center">
                                        <i class="bi bi-p-circle"></i>
                                        <p>Pending Order</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <a href="">
                                <div class="card border-0" onclick="Completed(event)" style="box-shadow: 3px 5px 10px #838383a3;">
                                    <div class="card-body text-center">
                                        <i class="bi bi-cart-check"></i>
                                        <p>Completed Order</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <a href="">
                                <div class="card border-0" style="box-shadow: 3px 5px 10px #838383a3;" onclick="Setting(event)">
                                    <div class="card-body text-center">
                                        <i class="bi bi-gear"></i>
                                        <p>Settings</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <a href="{{route('customer.logout')}}">
                                <div class="card border-0" style="box-shadow: 3px 5px 10px #838383a3;">
                                    <div class="card-body text-center">
                                        <i class="bi bi-box-arrow-in-left"></i>
                                        <p>SignOut</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- order table -->
            <div class="col-12 col-lg-9 d-none item-section" id="orderTable">
                <div class="mt-1">
                    <div class="card border-0" style="box-shadow: 3px 5px 10px #838383a3;">
                        <div class="card-body">
                            <h4 class="m-0 text-center text-decoration-underline pb-3">All Order List</h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>#Invoice</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders->count() > 0)
                                    @foreach($orders as $key => $item)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$item->invoice}}</td>
                                        <td>{{date("d-m-Y", strtotime($item->date))}}</td>
                                        <td class="{{$item->status == 'pending' || $item->status == 'cancel' ? 'text-danger': 'text-success'}} text-capitalize">{{$item->status}}</td>
                                        <td>
                                            <button title="Order Invoice" class="shadow-none text-white" style="background: #00000038;width:25px;height:22px;"><i class="bi bi-file-earmark"></i></button>
                                            @if($item->status == 'pending')
                                            <button onclick="showModal({{$item}})" title="Order Edit" class="shadow-none text-white" style="background: #180174;width:25px;height:22px;"><i class="bi bi-pencil-square"></i></button>
                                            <button title="Order Delete" onclick="OrderCancel({{$item->id}})" class="shadow-none text-white" style="background: red;width:25px;height:22px;">X</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-center">
                                        <td colspan="5">Order Not found in Table</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending order table -->
            <div class="col-12 col-lg-9 d-none item-section" id="pending">
                <div class="mt-1">
                    <div class="card border-0" style="box-shadow: 3px 5px 10px #838383a3;">
                        <div class="card-body">
                            <h4 class="m-0 text-center text-decoration-underline pb-3">Pending Order List</h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>#Invoice</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($pending->count() > 0)
                                    @foreach($pending as $key => $item)
                                    <tr>
                                    <td>{{$key + 1}}</td>
                                        <td>{{$item->invoice}}</td>
                                        <td>{{date("d-m-Y", strtotime($item->date))}}</td>
                                        <td class="text-danger text-capitalize">{{$item->status}}</td>
                                        <td>
                                            <button title="Order Invoice" class="shadow-none text-white" style="background: #00000038;width:25px;height:22px;"><i class="bi bi-file-earmark"></i></button>
                                            <button onclick="showModal({{$item}})" title="Order Edit" class="shadow-none text-white" style="background: #180174;width:25px;height:22px;"><i class="bi bi-pencil-square"></i></button>
                                            <button title="Order Delete" onclick="OrderCancel({{$item->id}})" class="shadow-none text-white" style="background: red;width:25px;height:22px;">X</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-center">
                                        <td colspan="5">Order Not Found in Table</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Completed order table -->
            <div class="col-12 col-lg-9 d-none item-section" id="completed">
                <div class="mt-1">
                    <div class="card border-0" style="box-shadow: 3px 5px 10px #838383a3;">
                        <div class="card-body">
                            <h4 class="m-0 text-center text-decoration-underline pb-3">Completed Order List</h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>#Invoice</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($complete->count() > 0)
                                    @foreach($complete as $key => $item)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$item->invoice}}</td>
                                        <td>{{date("d-m-Y", strtotime($item->date))}}</td>
                                        <td class="text-success text-capitalize">{{$item->status}}</td>
                                        <td>
                                            <button class="shadow-none text-white" style="background: #00000038;width:25px;height:22px;"><i class="bi bi-file-earmark"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-center">
                                        <td colspan="5">Order Not found in Table</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Setting -->
            <div class="col-12 col-lg-9 d-none item-section" id="setting">
                <div class="mt-1">
                    <div class="card border-0" style="box-shadow: 3px 5px 10px #838383a3;">
                        <div class="card-body">
                            <form onsubmit="updateCustomer(event)">
                                <div class="row">
                                    <div class="col-12 col-lg-2">
                                        <div class="form-group ImageBackground">
                                            <img src="{{asset(Auth::guard('web')->user()->image != null ? Auth::guard('web')->user()->image : 'noImage.jpg')}}" class="imageShow" />
                                            <label for="image">Image</label>
                                            <input type="file" id="image" class="form-control shadow-none" onchange="imageUpdate(event)" />
                                        </div>
                                        <span class="text-danger error error-image"></span>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-gorup">
                                                    <label for="name">Customer Name</label>
                                                    <input type="text" name="name" id="name" value="{{Auth::guard('web')->user()->name}}" class="form-control shadow-none" autocomplete="off">
                                                    <span class="text-danger error error-name"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-gorup">
                                                    <label for="username">User Name</label>
                                                    <input type="text" name="username" id="username" value="{{Auth::guard('web')->user()->username}}" class="form-control shadow-none" autocomplete="off">
                                                    <span class="text-danger error error-username"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-gorup">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" id="email" value="{{Auth::guard('web')->user()->email}}" class="form-control shadow-none" autocomplete="off">
                                                    <span class="text-danger error error-email"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-gorup">
                                                    <label for="mobile">Phone</label>
                                                    <input type="text" name="mobile" id="mobile" value="{{Auth::guard('web')->user()->mobile}}" class="form-control shadow-none" autocomplete="off">
                                                    <span class="text-danger error error-mobile"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-gorup">
                                                    <label for="district_id">District</label>
                                                    <select name="district_id" onchange="getUpazila(event)" id="district_id" class="form-select shadow-none">
                                                        <option value="">Select District</option>
                                                        @foreach($districts as $item)
                                                        <option value="{{$item->id}}" {{Auth::guard('web')->user()->district_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger error error-district_id"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-gorup">
                                                    <label for="thana_id">Upazila</label>
                                                    <select name="thana_id" id="thana_id" class="form-select shadow-none">
                                                    <option value="">Select Upazila</option>
                                                        @foreach($upazilas as $item)
                                                        <option value="{{$item->id}}" {{Auth::guard('web')->user()->thana_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger error error-thana_id"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <div class="form-gorup">
                                                    <label for="address">Address</label>
                                                    <textarea name="address" id="address" autocomplete="off" class="form-control shadow-none">{{Auth::guard('web')->user()->address}}</textarea>
                                                    <span class="text-danger error error-address"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mt-2">
                                                <div class="form-gorup">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="old_password" id="old_password" class="form-control shadow-none" autocomplete="off">
                                                    <span class="text-danger error error-old_password"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mt-2">
                                                <div class="form-gorup">
                                                    <label for="new_password">New Password</label>
                                                    <input type="password" name="new_password" id="new_password" class="form-control shadow-none" autocomplete="off">
                                                    <span class="text-danger error error-new_password"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mt-2">
                                                <div class="form-gorup">
                                                    <label for="confirm_password">Confirm Password</label>
                                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control shadow-none" autocomplete="off">
                                                    <span class="text-danger error error-confirm_password"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <div class="form-gorup text-center">
                                                    <button class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade myModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Invoice: <span></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form onsubmit="QuantitySubmit(event)">
            <input type="hidden" name="orderId" class="orderId">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div class="text-center">
                <button class="btn btn-success" type="submit">Submit</button>
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
                url: location.origin+"/customer-imageUpdate",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: res => {
                    if (res.error) {
                        $(".error-image").text(res.error.image);
                    }else{
                        $.notify(res, "success");
                        document.querySelector(".imageShow").setAttribute('src', window.URL.createObjectURL(event.target.files[0]))
                        event.target.value = "";
                    }
                }
            })
        }
    }

    // save profile
    function updateCustomer(event) {
        event.preventDefault();
        let formdata = new FormData(event.target)
        $.ajax({
            url: location.origin+"/customer-update",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: () => {
                $("#setting").find(".error").text("")
            },
            success: res => {
                if(res.error){
                    $.each(res.error, (index, value) => {
                        $("#setting").find(".error-"+index).text(value)
                    })
                }else if(res.errors){
                    $("#setting").find(".error-old_password").text(res.errors)
                }else{
                    $.notify(res, "success")
                }
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

    function Dashboard(event) {
        event.preventDefault();
        $('.login-register-area').find(".nav-link").removeClass("active")
        $('.login-register-area').find(".dashboard").addClass("active")
        $('.login-register-area').find(".item-section").addClass("d-none")
        $('.login-register-area').find("#dashboard").removeClass("d-none")
    }
    // order table
    function OrderTable(event) {
        event.preventDefault();
        if ($('.login-register-area').find(".orderTable").attr("class") == "nav-link orderTable") {
            $('.login-register-area').find(".nav-link").removeClass("active")
            $('.login-register-area').find(".orderTable").addClass("active")
            $('.login-register-area').find(".item-section").addClass("d-none")
            $('.login-register-area').find("#orderTable").removeClass("d-none")
        }
    }

    // wishlist table
    function Setting(event) {
        event.preventDefault();
        if ($('.login-register-area').find(".setting").attr("class") == "nav-link setting") {
            $('.login-register-area').find(".nav-link").removeClass("active")
            $('.login-register-area').find(".setting").addClass("active")
            $('.login-register-area').find(".item-section").addClass("d-none")
            $('.login-register-area').find("#setting").removeClass("d-none")
        }
    }

    // pending order
    function Pending(event) {
        event.preventDefault();
        $('.login-register-area').find(".item-section").addClass("d-none")
        $('.login-register-area').find("#pending").removeClass("d-none")
    }
    // completed order
    function Completed(event) {
        event.preventDefault();
        $('.login-register-area').find(".item-section").addClass("d-none")
        $('.login-register-area').find("#completed").removeClass("d-none")
    }

    // show Modal
    function showModal(rowData){
        $(".myModal .modal-body .table tbody").html("")
        $(".myModal").modal("show")
        $(".myModal .modal-title span").text(rowData.invoice)
        $(".myModal .orderId").val(rowData.id)

        $.each(rowData.order_details, (index, value) => {
            let row = `
                <tr class="removeItem-${index}">
                    <td>${index + 1}</td>
                    <td>${value.service.name}<input type="hidden" name="service_id[]" value="${value.service_id}" class="form-control" /></td>
                    <td style="width:15%;" class="text-center"><input type="number" name="quantity[]" oninput="QuantityUpdate(event, ${index})" step="0.01" min="0" value="${value.quantity}" class="form-control" /></td>
                    <td class="text-center">${value.unit_price}<input type="hidden" name="unitprice[]" value="${value.unit_price}" class="form-control unitprice-${index}" /></td>
                    <td class="text-center"><span class='totaltxt-${index}'>${value.total}</span><input type="hidden" name="total[]" value="${value.total}" class="form-control total-${index}" /></td>
                    <td class="text-center" style="width:8%;">
                        <button onclick="deleteItem(${index})" type="button"><i class='fa fa-trash'></i></button>
                    </td>
                </tr>
            `;

            $(".myModal .modal-body .table tbody").append(row)
        })
    }

    function QuantityUpdate(event, sl){
        let qty       = event.target.value;
        let unitprice = $(".myModal").find('.unitprice-'+sl).val();
        let calculate = Number(qty)*parseFloat(unitprice);
        $(".myModal").find(".total-"+sl).val(calculate.toFixed(2))
        $(".myModal").find(".totaltxt-"+sl).text(calculate.toFixed(2))
    }

    function deleteItem(sl){
        $(".myModal").find(".removeItem-"+sl).remove()
    }

    // save
    function QuantitySubmit(event){
        event.preventDefault();
        let formdata = new FormData(event.target)
        $.ajax({
            url: location.origin+"/order-edit",
            method: "POST",
            data: formdata,
            processData:false,
            contentType: false,
            success: res => {
                $.notify(res, "success")
                $(".myModal").modal("hide");
            }
        })
    }

    // order cancel
    function OrderCancel(id){
        $.ajax({
            url: location.origin+"/order-delete",
            method: "POST",
            data: {id: id},
            success: res => {
                $.notify(res, "success")
            }
        })
    }
</script>
@endpush