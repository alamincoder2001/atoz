@extends('layouts.backend_master')

@section('title', 'Admin Worker Commission Report')
@section('breadcrumb_title', 'Worker Commission Report')
@section('breadcrumb_item', 'Worker Commission Report')

@section('content')
<div class="container-fluid p-4">


    <div class="row">

        <div class="col-12">
            <a href="javascript:void(0)" style="float: right;" onclick="printMoneyReceive(event)" class="btn btn-addnew">
                <i class="fa fa-print"></i> Print
            </a>
        </div>
        <div class="col-12 col-md-12">
            <hr>


            <div class="report border-0" id="reportContent">
                {{-- <div class="row">
                    <div class="col-4">
                        <table class="table table-borderless">
                            <tr>
                                <td class="d-flex">
                                    <img class="mt-4" src="{{asset($companyInfo->logo != null ? $companyInfo->logo : 'noImage.jpg')}}"
                                        alt="logo" style="height: 80px">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-8">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <h5 class="mt-4">{{ $companyInfo->company_name }}</h5>
                                    <span style="font-weight: 500">Mobile No.</span>
                                    <span>{{ $companyInfo->mobile }}</span><br>
                                    <span style="font-weight: 500">Email.</span>
                                    <span>{{ $companyInfo->email }}</span><br>
                                    <span style="font-weight: 500">Address.</span>
                                    <span>{{ $companyInfo->address }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="p-1"
                    style="border-top: 1px dashed gray; border-bottom: 1px dashed gray; text-align: center; margin: 20px 0 0 0; color: #606060cf;">
                    <strong class="">Payment Money Receive</strong>
                </div> --}}


                <div class="row mt-4">
                    <div class="col-lg-6 col-md-6">

                        <span class="c_color">TR.Id:</span>
                        <span class="txt-color"> {{ $workerCommission->transaction_id }} </span> <br>

                        <span class="c_color">TR.Type:</span>
                        <span class="txt-color">{{ $workerCommission->payment_type }}</span> <br>

                        <span class="c_color">TR.Date:</span>
                        <span class="txt-color">{{ $workerCommission->payment_date }}</span> <br>
                    </div>

                    <div class="col-lg-6 col-md-6" style="text-align: right;">
                        <span class="c_color">Worker Code:</span>
                        <span class="txt-color">
                            @if (isset($workerCommission->worker))
                                {{ $workerCommission->worker->worker_code }}
                            @else
                                N/A
                            @endif
                        </span> <br>

                        <span class="c_color">Worker Name:</span>
                        <span class="txt-color">
                            @if (isset($workerCommission->worker))
                                {{ $workerCommission->worker->name }}
                            @else
                                N/A
                            @endif
                        </span> <br>

                        <span class="c_color">Worker Phone:</span>
                        <span class="txt-color">
                            @if (isset($workerCommission->worker))
                                {{ $workerCommission->worker->mobile }}
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                </div>

                {{-- bill master info --}}
                <div class="row mt-4">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered" style="border: 1px solid rgb(204, 204, 204);">
                            <tr class="text-center" style="color: rgb(109, 109, 109)">
                                <td>Sl.</td>
                                <td>Description</td>
                                <td>Received By</td>
                                {{-- <td>Received By</td> --}}
                                <td>Amount</td>
                            </tr>
                            <tbody>
                                <tr>
                                    <td align="center">1</td>
                                    <td>
                                        @if (isset($workerCommission->note) || $workerCommission->note != '')
                                            {{ $workerCommission->note }}
                                        @else
                                            <span class="d-flex justify-content-center">N/A</span>
                                        @endif
                                    </td>
                                    <td align="center">
                                        @if (isset($workerCommission->givenBy))
                                            {{ $workerCommission->givenBy->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td align="right">{{ number_format($workerCommission->amount, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="col-9">
                        <div class="d-flex mt-5">
                            <span
                                style="font-size: 14px;font-weight: 500;color: #323232;text-transform: uppercase !important;">
                                In word :
                            </span> &nbsp;
                            <p class="word" style="text-transform: uppercase !important;"></p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="col-xs-6">
                            <table>

                                <tr>
                                    <td><strong>Paid Amount:</strong></td>
                                    <td style="text-align:right">
                                        {{ number_format( $workerCommission->amount, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-bottom: 1px solid #ccc"></td>
                                </tr>
                                <tr>
                                    <td><strong>Current Due:</strong></td>
                                    <td style="text-align:right">
                                        0.00
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4" style="float: right !important;">
                        <table class="table table-borderless">
                            <tr>
                                <td style="float: right !important;" class="pe-0 me-0">Authorized Signature</td>
                            </tr>
                            <tr>
                                <td style="float: right !important;" class="pe-0 me-0 pt-3">------------------------</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            let getnumber = {{ $workerCommission->amount }};
            numberToWords(getnumber);
            $(".word").text(numberToWords(getnumber) + " TAKA ONLY.");
        });

        function numberToWords(number) {
            var digit = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
            var elevenSeries = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen',
                'eighteen', 'nineteen'
            ];
            var countingByTens = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
            var shortScale = ['', 'thousand', 'million', 'billion', 'trillion'];
            number = number.toString();
            number = number.replace(/[\, ]/g, '');
            if (number != parseFloat(number)) return 'not a number';
            var x = number.indexOf('.');
            if (x == -1) x = number.length;
            if (x > 15) return 'too big';
            var n = number.split('');
            var str = '';
            var sk = 0;
            for (var i = 0; i < x; i++) {
                if ((x - i) % 3 == 2) {
                    if (n[i] == '1') {
                        str += elevenSeries[Number(n[i + 1])] + ' ';
                        i++;
                        sk = 1;
                    } else if (n[i] != 0) {
                        str += countingByTens[n[i] - 2] + ' ';
                        sk = 1;
                    }
                } else if (n[i] != 0) {
                    str += digit[n[i]] + ' ';
                    if ((x - i) % 3 == 0) str += 'hundred ';
                    sk = 1;
                }
                if ((x - i) % 3 == 1) {
                    if (sk) str += shortScale[(x - i - 1) / 3] + ' ';
                    sk = 0;
                }
            }
            if (x != number.length) {
                var y = number.length;
                str += 'point ';
                for (var i = x + 1; i < y; i++) str += digit[n[i]] + ' ';
            }
            str = str.replace(/\number+/g, ' ');
            return str.trim() + " ";
            $(".word").text(number);
        }

        // print  money receive
        async function printMoneyReceive(event) {
            event.preventDefault();

            let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed gray; border-bottom: 1px dashed gray; padding:3px; color:gray;">
                                    Payment Money Receive
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
                    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
                    <link rel="stylesheet" href="{{ asset('frontend/assets/css/boxicons.min.css') }}">

					<style>

                        @media print
                        {
                            .no-print, .no-print *
                            {
                                display: none !important;
                            }
                        }

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

				// let rows = reportWindow.document.querySelectorAll('.record-table tr');
				// rows.forEach(row => {
				// 	row.lastChild.remove();
				// })

				reportWindow.focus();
				await new Promise(resolve => setTimeout(resolve, 3000));
				reportWindow.print();
				reportWindow.close();
        }
    </script>
@endpush
