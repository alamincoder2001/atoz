<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\WorkerCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WorkerCommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.worker.worker_commission');
    }

    public function getCommission()
    {
        $commissionList = WorkerCommission::with('worker', 'givenBy')->latest()->get();
        return response()->json(['commissionList' => $commissionList]);
    }

    public function getWorkerWithCommission()
    {
        $workers = $this->dueWorker();

        return response()->json(['workers' => $workers]);
    }

    public function storeWorkerCommission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_type' => 'required',
            'amount' => 'required',
            'commission' => 'required',
            'worker_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        $input = $request->all();

        try {
            $input['transaction_id'] = 'WC' . '-' . rand();
            $input['given_by'] = Auth::guard('admin')->user()->id;

            $pay = WorkerCommission::create($input);
            return response()->json(['success' => 'Worker Commission Paid Successfully', 'id' => $pay->id]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function commissionReceive($id)
    {
        $workerCommission = WorkerCommission::with('worker', 'givenBy')->findOrFail($id);
        $companyInfo = Setting::first();
        return view('admin.worker.worker_commission_report', compact('companyInfo', 'workerCommission'));
    }

    public function deleteWorkerCommission(Request $request)
    {
        try {
            $workerCommission = WorkerCommission::findOrFail($request->id);
            $workerCommission->delete();
            return response()->json(['success' => 'Commission Deleted Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Commission Delete Failed!']);
        }
    }

    public function dueListWorker()
    {
        $dueWorker = $this->dueWorker();
        return view('admin');
    }

    protected function dueWorker()
    {
        $due = DB::select("SELECT
                            w.worker_code,
                            w.name,
                            w.mobile,
                            w.commission,
                            d.name as district_name,
                            t.name as thana_name,
                            concat(w.name, '-', w.commission) as worker_name,
                            SUM(od.commission_amount) as dueAmount
                        FROM order_details od
                        LEFT JOIN workers w ON w.id = od.worker_id
                        LEFT JOIN districts d ON d.id = w.district_id
                        LEFT JOIN thanas t ON t.id = w.thana_id
                        WHERE od.status = 'complete'
                        GROUP BY od.worker_id");

        return $due;
    }
}
