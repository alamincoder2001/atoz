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
            border: 1px solid #ce5cf659;
            padding: 20px;
            min-height: 175px;
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


    </style>
@endpush

@section("front_content")

    <nav class="breadcrumb-section mb-3 section-py bg-light2" style="margin-top: 100px !important">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h6 class="bread-crumb-title">
                        <a href="{{ url('worker-dashboard') }}" style="color: #ce5cf6">Dashboard</a>
                        <i class="bx bx-right-arrow-alt" style="font-size: 19px;"></i>
                        Order Details
                    </h6>
                </div>
                <div class="col-6" style="text-align: end; color: #ce5cf6;">
                    <a href="javascript:void(0)" onclick="printThis()"> <i class="bx bx-file mt-1"></i> Print</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container" id="printThis">

        <div class="row">

            <!-- My Account Tab Content Start -->
            <div class="col-4">
                <div class="myaccount-content">
                    <h5 class="p-0">Order Information</h5>
                    <div class="account-details-form">
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th style="border-bottom: 1px dashed #ce5cf659">Sl</th>
                                    <th style="border-bottom: 1px dashed #ce5cf659">Assign Date</th>
                                    <th style="border-bottom: 1px dashed #ce5cf659">Service Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ date('d-M-Y', strtotime($orderDetail->updated_at)) }}</td>
                                    <td>
                                        @if(isset($orderDetail->service))
                                            {{ $orderDetail->service->name }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="myaccount-content">
                    <h5 class="p-0">Customer Information</h5>
                    <div class="account-details-form">
                        <div class="text-start d-block mt-2 btn-top-txt mt-4" style="letter-spacing: .7px;">
                            <i class="bx bx-user-circle mt-1"></i>
                            <span class="name">
                                @if(isset($orderDetail->order->customer))
                                    {{ $orderDetail->order->customer->name }}
                                @endif
                            </span>
                            <br>
                            @if(isset($orderDetail->order->customer))
                                <i class="bx bx-map mt-1"></i>
                                <span class="address">
                                    {{ $orderDetail->order->customer->address }}
                                </span>
                                <br>
                            @endif
                            <i class="bx bx-phone mt-1"></i>
                            <span class="phone">
                                @if(isset($orderDetail->order->customer))
                                    {{ $orderDetail->order->customer->mobile }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="myaccount-content">
                    <h5 class="p-0">Shipping Information</h5>
                    <div class="account-details-form">
                        <div class="text-start d-block mt-2 btn-top-txt mt-4" style="letter-spacing: .7px;">
                            <i class="bx bx-map mt-1"></i>
                            <span class="address">
                                @if(isset($orderDetail->order))
                                    {{ $orderDetail->order->shipping_address }}
                                @endif
                            </span>
                            <br>
                            <i class="bx bx-phone mt-1"></i>
                            <span class="phone">
                                @if(isset($orderDetail->order))
                                    {{ $orderDetail->order->shipping_mobile }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push("front_script")
    <script>

        function printThis() {
				let reportContent = `
                    <div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed #ce5cf659; border-bottom: 1px dashed #ce5cf659; padding:3px; color: #212529;">
                                    Order Details
                                </h3>
							</div>
                        </div>
						${document.querySelector('#printThis').innerHTML}
					</div>
				`;
				var reportWindow = window.open('', 'PRINT', `height=${screen.height}, width=${screen.width}`);

                reportWindow.document.write(`
                    <table>
                        <tr>
                            <td><img src="/uploads/logo/6524546_6517fde95908b.png"></td>
                            <td>
                                <strong style="padding:0;"> A2Z Services<strong>
                                <p style="text-transform:capitalize;padding:0;margin:0;">
                                    18/4 d bagomgonj line narinda Dhaka 1100
                                </p>
                            </td>
                        </tr>
                    </table>
				`);

				reportWindow.document.head.innerHTML += `
                <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
                <link rel="stylesheet" href="{{ asset('frontend/assets/css/boxicons.min.css') }}">
					<style>
						.record-table{
							width: 100%;
							border-collapse: collapse;
						}
						.record-table thead{
							background-color: #0097df;
							color:white;
						}
						.record-table th, .record-table td{
							padding: 3px;
							border: 1px solid #454545;
						}
						.record-table th{
							text-align: center;
						}
                        i { color: #7b3edb !important; }
                        .myaccount-content {
                            background-color: #fff;
                            font-size: 14px;
                            border: 1px solid #ce5cf659;
                            padding: 20px;
                            min-height: 175px;
                        }
					</style>
				`;
				reportWindow.document.body.innerHTML += reportContent;

				let rows = reportWindow.document.querySelectorAll('.record-table tr');
				// rows.forEach(row => {
				// 	row.lastChild.remove();
				// })

				reportWindow.focus();
				reportWindow.print();
                // setTimeout(() => {
                //     reportWindow.close();
                // }, 1000);
			}

    </script>
@endpush
