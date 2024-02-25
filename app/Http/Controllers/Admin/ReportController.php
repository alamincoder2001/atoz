<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function workerPaymentReport()
    {
        return view('admin.report.worker_paymentreport');
    }

    public function managerPaymentReport()
    {
        return view('admin.report.manager_paymentreport');
    }
}
