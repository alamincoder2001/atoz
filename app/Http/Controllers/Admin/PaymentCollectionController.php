<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\PaymentCollection;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentCollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (!userAccess("paymentCollection")) {
            return view("admin.unauthorize");
        }
        return view('admin.payment.worker_payment_collection');
    }

    public function getPayment()
    {
        $paymentCollections = PaymentCollection::with('worker','receiveBy')->latest()->get();
        return response()->json(['paymentCollections' => $paymentCollections]);
    }

    public function getWorkerWithDueAmount()
    {
        $workers = DB::select("SELECT
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

        return response()->json(['workers' => $workers]);
    }

    public function storePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_type' => 'required',
            'amount' => 'required',
            'workerDue' => 'required',
            // 'note' => 'required',
            'worker_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        $input = $request->all();

        try {
            if ($request->workerDue == $request->amount) {
                $worker = Worker::findOrFail($request->worker_id);
                $orderDetails = OrderDetail::where('worker_id', $worker->id)->where('status', 'complete')->get();
                $worker->update(['payment_receive' => 0]);
                foreach ($orderDetails as $od) {
                   OrderDetail::findOrFail($od->id)->update(['payment_receive_status' => 1]);
                }
            }
            $input['transaction_id'] = 'PC'.'-'.rand();
            $input['receive_by'] = Auth::guard('admin')->user()->id;

            $pay = PaymentCollection::create($input);
            $pay_id = $pay->id;
            return response()->json(['success' => 'Payment Received Successfully', 'id' => $pay_id]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function paymentReceive($id)
    {
        $paymentCollection = PaymentCollection::with('worker','receiveBy')->findOrFail($id);
        $companyInfo = Setting::first();
        return view('admin.payment.worker_collection_report',compact('companyInfo','paymentCollection'));
    }

    public function deletePayment(Request $request)
    {
        try {
            $paymentCollection = PaymentCollection::findOrFail($request->id);
            $worker = Worker::findOrFail($paymentCollection->worker_id);
            $worker->update(['payment_receive' => 1]);
            $orderDetails = OrderDetail::where('worker_id', $paymentCollection->worker_id)->where('status', 'complete')->where('payment_receive_status', 1)->get();

            foreach ($orderDetails as $od) {
               OrderDetail::findOrFail($od->id)->update(['payment_receive_status' => 0]);
            }
            $paymentCollection->delete();
            return response()->json(['success'=> 'Payment Deleted Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Payment Delete Failed!']);
        }
    }



}
