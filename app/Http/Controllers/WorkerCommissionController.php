<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
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
        $commissionList = WorkerCommission::with('worker','givenBy')->latest()->get();
        return response()->json(['commissionList' => $commissionList]);
    }

    public function getWorkerWithCommission()
    {
        $workers = DB::select("SELECT od.*, w.id as w_id, w.name, w.commission, w.mobile,
                    SUM(od.bill_amount) AS amountTotal,
                    concat(w.name,'-', w.mobile,'-',w.commission,'%') as worker_name
                    FROM order_details od
                    JOIN workers w ON w.id = od.worker_id
                    WHERE od.payment_receive_status = 1
                    AND od.commission_receive_status = 0
                    AND od.status = 'complete'
                    GROUP BY od.worker_id ");

        return response()->json(['workers' => $workers]);
    }

    public function storeWorkerCommission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_type' => 'required',
            'amount' => 'required',
            'commission' => 'required',
            // 'note' => 'required',
            'worker_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        $input = $request->all();

        try {
            $orderDetails = OrderDetail::where('worker_id', $request->worker_id)->where('status', 'complete')->where('commission_receive_status', 0)->get();

            $input['transaction_id'] = 'WC'.'-'.rand();
            $input['given_by'] = Auth::guard('admin')->user()->id;

            $pay = WorkerCommission::create($input);
            $pay_id = $pay->id;
            // if ($request->workerCommission == $request->amount) {
                foreach ($orderDetails as $od) {
                    OrderDetail::findOrFail($od->id)->update([
                        'commission_receive_status' => 1,
                        'commission_id' => $pay_id
                    ]);
                }
            // }
            return response()->json(['success' => 'Worker Commission Paid Successfully', 'id' => $pay_id]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function commissionReceive($id)
    {
        $workerCommission = WorkerCommission::with('worker','givenBy')->findOrFail($id);
        $companyInfo = Setting::first();
        return view('admin.worker.worker_commission_report',compact('companyInfo','workerCommission'));
    }

    public function deleteWorkerCommission(Request $request)
    {
        try {
            $workerCommission = WorkerCommission::findOrFail($request->id);

            $orderDetails = OrderDetail::where('worker_id', $workerCommission->worker_id)
                                        ->where('status', 'complete')
                                        ->where('payment_receive_status', 1)
                                        ->where('commission_receive_status', 1)
                                        ->where('commission_id', $workerCommission->id)
                                        ->get();
            foreach ($orderDetails as $od) {
               OrderDetail::findOrFail($od->id)->update(['commission_receive_status' => 0]);
            }
            $workerCommission->delete();
            return response()->json(['success'=> 'Commission Deleted Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Commission Delete Failed!']);
        }
    }


}
