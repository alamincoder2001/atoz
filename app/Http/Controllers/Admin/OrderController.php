<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (!userAccess("orderList")) {
            return view("admin.unauthorize");
        }
        return view("admin.order.index");
    }

    public function assign()
    {
        if (!userAccess("orderAssign")) {
            return view("admin.unauthorize");
        }
        return view("admin.order.assign");
    }

    public function delivery()
    {
        if (!userAccess("orderComplete")) {
            return view("admin.unauthorize");
        }
        return view("admin.order.delivery");
    }

    public function canceled()
    {
        if (!userAccess("orderCancel")) {
            return view("admin.unauthorize");
        }
        return view("admin.order.canceled");
    }

    public function invoice($invoice)
    {
        $data = Order::where("invoice", $invoice)->first();
        return view("admin.order.invoice", compact("data"));
    }

    public function fetch(Request $request)
    {
        // dd($request->orderId);
        $clauses = "";
        $areaId = $request->thanaId;

        if (Auth::guard('admin')->user()->role == 'manager') {
            $areaId = Auth::guard()->user()->thana_id;
            $clauses .= " AND c.thana_id = '$areaId'";
        } else {
            if (isset($request->thanaId) && !empty($request->thanaId)) {
                $clauses .= " AND c.thana_id = '$request->thanaId'";
            }
        }
        if (isset($request->dateFrom) && !empty($request->dateFrom)) {
            $clauses .= " AND o.date BETWEEN '$request->dateFrom' AND '$request->dateTo'";
        }
        if (isset($request->status) && !empty($request->status)) {
            $clauses .= " AND o.status = '$request->status'";
        }
        if (isset($request->id) && !empty($request->id)) {
            $clauses .= " AND o.id = '$request->id'";
        }
        if (isset($request->managerId) && !empty($request->managerId)) {
            $clauses .= " AND wo.manager_id = '$request->managerId'";
        }

        $orders = DB::select("SELECT
                            o.*,
                            c.id as customer_id,
                            c.name,
                            c.customer_code as code,
                            c.address,
                            c.mobile,
                            cd.name as customer_district_name,
                            cth.id as thanaId,
                            cth.name as customer_thana_name,
                            sd.name as shipping_district_name,
                            sth.name as shipping_thana_name,
                            ifnull(sth.charge, cth.charge) as shipping_charge,
                            (SELECT count(*) FROM order_details od WHERE od.order_id = o.id) as totaldetail,
                            (SELECT count(*) FROM order_details od WHERE od.order_id = o.id AND od.worker_id is not null) as totalassign
                        FROM orders AS o
                        LEFT JOIN users AS c ON c.id = o.customer_id
                        LEFT JOIN thanas cth ON cth.id = c.thana_id
                        LEFT JOIN districts cd ON cd.id = cth.district_id
                        LEFT JOIN thanas sth ON sth.id = o.shipping_thana
                        LEFT JOIN districts sd ON sd.id = sth.district_id
                        LEFT JOIN order_details od ON od.order_id = o.id
                        LEFT JOIN workers wo ON wo.id = od.worker_id
                        WHERE 1=1
                        $clauses GROUP BY od.order_id ORDER BY o.invoice DESC
                        ");

        foreach ($orders as $order) {
            $order->orderDetails = DB::select("SELECT
                                    od.*,
                                    s.name,
                                    ifnull(w.name, 'N/A') as worker_name,
                                    w.mobile
                                FROM order_details AS od
                                LEFT JOIN services s ON s.id = od.service_id
                                LEFT JOIN workers w ON w.id = od.worker_id
                                WHERE od.order_id = ?", [$order->id]);
        }

        $commission = 0;
        $invoice = $this->invoiceGenerate("Order", "PI");
        if (Auth::guard('admin')->user()->role == 'manager') {
            $commission = Auth::guard('admin')->user()->commission;
        }
        return response()->json(['invoice' => $invoice, 'orders' => $orders, 'commission' => $commission]);
    }

    public function destroy(Request $request)
    {
        $data = Order::find($request->id);
        $data->status = "cancel";
        $data->save();
        OrderDetail::where('order_id', $request->id)->update(['status' => 'cancel']);
        return "Order Cancel Successfully";
    }

    // status change
    public function assignWorker(Request $request)
    {
        try {
            $data = OrderDetail::where("id", $request->id)->first();
            $data->worker_id = $request->worker_id;
            $data->updated_at = Carbon::now();
            Order::findOrFail($data->order_id)->update(['status' => 'bill']);
            $data->save();
            return "Service assign successfully";
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function dueAdd(Request $request)
    {
        $data = OrderDetail::where("id", $request->orderDetailId)->where('status', '!=', 'complete')->first();
        if ($request->type == 'Due') {
            $data->update([
                'due' => $request->amount
            ]);
        }else{
            $data->update([
                'discount' => $request->amount
            ]);
        }
        return response()->json(['success' => "{$request->type} amount added"]);
    }

    //update order
    public function update(Request $request)
    {
        try {
            if (count($request->orderDetails) > 0) {

                $data = Order::find($request->id);
                $data->subtotal = $request->subtotal;
                $data->total = $request->total;
                $data->save();

                OrderDetail::where("order_id", $request->id)->delete();
                foreach ($request->orderDetails as $item) {
                    $detail             = new OrderDetail();
                    $detail->order_id   = $request->id;
                    $detail->service_id = $item['service_id'];
                    $detail->quantity   = $item['quantity'];
                    $detail->unit_price = $item['unit_price'];
                    $detail->total      = $item['total'];
                    $detail->save();
                }

                return "Order Update successfully";
            } else {
                return "Cart is empty";
            }
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function report()
    {
        if (!userAccess("reportShow")) {
            return view("admin.unauthorize");
        }
        return view('admin.report.manager_paymentreport');
    }

    public function orderDetails(Request $request)
    {
        try {
            $clauses = "";
            $areaId = $request->thanaId;
            if (Auth::guard('admin')->user()->role == 'manager') {
                $areaId = Auth::guard()->user()->thana_id;
                $clauses .= " AND c.thana_id = '$areaId'";
            } else {
                if (isset($request->thanaId) && !empty($request->thanaId)) {
                    $clauses .= " AND c.thana_id = '$request->thanaId'";
                }
            }
            if (isset($request->dateFrom) && !empty($request->dateFrom)) {
                $clauses .= " AND o.date BETWEEN '$request->dateFrom' AND '$request->dateTo'";
            }
            if (isset($request->workerId) && !empty($request->workerId)) {
                $clauses .= " AND od.worker_id = '$request->workerId'";
            }
            if (isset($request->status) && !empty($request->status)) {
                $clauses .= " AND od.status = '$request->status'";
            }

            $detail = DB::select("SELECT
                            od.*,
                            s.name as service_name,
                            w.name as worker_name,
                            w.mobile as mobile,
                            w.thana_id as worker_district,
                            w.district_id as worker_thana,
                            o.date,
                            o.customer_id,
                            c.name as customer_name,
                            c.district_id as customer_district,
                            c.thana_id as customer_thana
                        FROM order_details od
                        LEFT JOIN services s ON s.id = od.service_id
                        LEFT JOIN workers w ON w.id = od.worker_id
                        LEFT JOIN orders o ON o.id = od.order_id
                        LEFT JOIN users c ON c.id = o.customer_id
                        WHERE od.status != 'complete'
                        AND od.status != 'cancel'
                        AND od.worker_id is not null
                        $clauses
                        ");

            return response()->json(['status' => false, 'msg' => $detail]);
        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }
}
