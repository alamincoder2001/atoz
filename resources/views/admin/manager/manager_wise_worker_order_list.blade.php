@extends('layouts.backend_master')

@push('admin_style')
    <style>
        .cform {height: 25px !important;}
    </style>
@endpush

@section('title', 'Manager Wise Worker Order List')
@section('breadcrumb_title', 'Manager Wise Worker Order List')
@section('breadcrumb_item', 'Manager Wise Worker Order List')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            @if (isset($workers[0]->manager_name))
                                <a href="javascript:void(0)" onclick="print(event)" style="color: #3e5569;">
                                    <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                                    Print
                                </a>
                            @endif
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <form action="" method="GET">
                                @csrf
                                <div class="row g-3" style="height: 0;">
                                    <div class="col-auto">
                                        <label for="fromDate" class="col-form-label cform">Date</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" id="fromDate" name="fromDate"
                                        @if (isset($input['fromDate'])) value="{{ $input['fromDate'] }}" @else value="{{ date('Y-m-d') }}" @endif
                                        class="form-control mt-1 cform">
                                    </div>
                                    <input type="hidden" name="id" @if(isset($manager)) value="{{ $manager->id }}" @endif>
                                    <div class="col-auto">
                                        <label for="toDate" class="col-form-label">To</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" id="toDate" name="toDate"
                                        @if (isset($input['toDate'])) value="{{ $input['toDate'] }}" @else value="{{ date('Y-m-d') }}" @endif
                                        class="form-control mt-1 cform">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-3 cform mt-1" style="padding-top: 1px;">Get</button>
                                        <a @if(isset($manager)) href="{{ url('admin/manager/wise/worker/report', $manager->id) }}" @else href="javascript:void(0)" @endif title="Clear" class="btn btn-danger mb-3 cform mt-1" style="padding-top: 1px;">X</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <h4 class="page-title" style="float: right;color: #3e5569;">Order List</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0" id="reportContent">

                    <table class="table table-bordered caption-top m-0 record-table">
                        @if (isset($manager->name))
                            <caption class="p-0">
                                <span class="fw-bold" style="float: left !important; color: gray;text-transform: capitalize">
                                    Manager: {{ $manager->name }}
                                </span>
                            </caption>
                        @endif
                        <thead style="background: gray">
                            <tr>
                                <th class="text-white" style="font-weight: bold; width: 5%">
                                    SL
                                </th>
                                <th class="text-white" style="font-weight: bold; width: 5%">
                                    Invoice
                                </th>
                                <th class="text-white" style="font-weight: bold;">
                                    Date
                                </th>
                                <th class="text-white" style="font-weight: bold">
                                    Worker
                                </th>
                                <th class="text-white" style="font-weight: bold">
                                    Payment Type
                                </th>

                                <th class="text-white text-center" style="font-weight: bold">
                                    Bill Amount
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Total Paid
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Total Due
                                </th>
                                <th class="text-white  text-center" style="font-weight: bold;width: 10%">
                                    Order Status
                                </th>
                                {{-- <th class="text-white text-end" style="font-weight: bold">
                                    Action
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($workers as $key => $worker)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $worker->invoice }}</td>
                                    <td>{{ $worker->date }}</td>
                                    <td>{{ $worker->name }}</td>
                                    <td>{{ $worker->payment_type }}</td>
                                    <td style="text-align: end;">{{ $worker->subtotal }}</td>
                                    <td style="text-align: end;">{{ $worker->total }}</td>
                                    <td style="text-align: end;">{{ $worker->due }}</td>
                                    <td class="text-center">
                                        @if ($worker->status == 'pending')
                                            <span class="badge bg-warning">{{ $worker->status }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $worker->status }}</span>
                                        @endif
                                    </td>
                                    {{-- <td class="text-end">
                                        <a href="javascript:void(0)" class="btn shadow-none" title="View Area Manager wise worker Report">
                                            <i class="fas fa-file"></i>
                                        </a>
                                    </td> --}}
                                </tr>
                            @empty
                                <td colspan="8" style="text-align:center">Data Not Found</td>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        async function print(event) {
            let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed gray; border-bottom: 1px dashed gray; padding:3px; color:gray;">
                                    Manager Wise Worker Order Record
                                </h3>
							</div>
							<div class="col-sm-12">
								${document.querySelector('#reportContent').innerHTML}
							</div>
						</div>
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
					</style>
				`;
            reportWindow.document.body.innerHTML += reportContent;

            reportWindow.focus();
            await new Promise(resolve => setTimeout(resolve, 3000));
            reportWindow.print();
            reportWindow.close();
        }
    </script>
@endsection
