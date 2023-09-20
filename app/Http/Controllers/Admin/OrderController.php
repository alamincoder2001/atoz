<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.order.index");
    }
    public function proccessing()
    {
        return view("admin.order.proccess");
    }
    public function delivery()
    {
        return view("admin.order.delivery");
    }
    public function canceled()
    {
        return view("admin.order.canceled");
    }

    public function invoice($invoice)
    {
        $data = Order::where("invoice", $invoice)->first();
        return view("admin.order.invoice", compact("data"));
    }

    public function fetch(Request $request)
    {
        $clauses = "";
        $areaId = $request->thanaId;
        if (Auth::guard('admin')->user()->role == 'manager') {
            $areaId = Auth::guard()->user()->thana_id;
        }
        if (isset($request->dateFrom) && !empty($request->dateFrom)) {
            $clauses .= " AND o.date BETWEEN '$request->dateFrom' AND '$request->dateTo'";
        }
        // if (isset($request->Status) && !empty($request->Status)) {
        //     $clauses .= " AND o.status = '$request->Status'";
        // }
        if (isset($request->id) && !empty($request->id)) {
            $clauses .= " AND o.id = '$request->id'";
        }
        if (isset($request->thanaId) && !empty($request->thanaId)) {
            $clauses .= " AND cth.id = '$request->thanaId'";
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
                            sth.name as shipping_thana_name
                        FROM orders AS o
                        LEFT JOIN users AS c ON c.id = o.customer_id
                        LEFT JOIN thanas cth ON cth.id = c.id
                        LEFT JOIN districts cd ON cd.id = cth.id
                        LEFT JOIN thanas sth ON sth.id = o.shipping_thana
                        LEFT JOIN districts sd ON sd.id = sth.id
                        WHERE 1=1
                        $clauses ORDER BY o.invoice DESC                            
                        ");

        foreach ($orders as $order) {
            $order->orderDetails = DB::select("SELECT
                                    od.*,
                                    s.name
                                FROM order_details AS od
                                LEFT JOIN services s ON s.id = od.service_id
                                WHERE od.order_id = ?", [$order->id]);
        }

        $invoice = $this->invoiceGenerate("Order", "PI");
        return response()->json(['invoice' => $invoice, 'orders' => $orders]);
    }

    public function destroy(Request $request)
    {
        $data = Order::find($request->id);
        $data->status = "cancel";
        $data->save();
        return "Order Cancel Successfully";
    }

    // status change
    public function changeStatus(Request $request)
    {
        try{
            $data = Order::where("id", $request->id)->first();
            $data->status = $request->Status;
            $data->updated_at = date("Y-m-d");
            $data->save();
            return "Order ".$request->Status." successfully";
        }catch(\Throwable $e){
            return "Opps! something went wrong";
        }
    }

    //update order

    public function update(Request $request)
    {
        try{
            if (count($request->orderDetails) > 0) {
                
                $data = Order::find($request->id);
                $data->subtotal = $request->subtotal;
                $data->total = $request->total;
                $data->save();
    
                OrderDetail::where("order_id", $request->id)->delete();
                foreach($request->orderDetails as $item){
                    $detail             = new OrderDetail();
                    $detail->order_id   = $request->id;
                    $detail->service_id = $item['service_id'];
                    $detail->quantity   = $item['quantity'];
                    $detail->unit_price = $item['unit_price'];
                    $detail->total      = $item['total'];
                    $detail->save();
    
                }
    
                return "Order Update successfully";
            }else{
                return "Cart is empty";
            }
        }catch(\Throwable $e){
            return "Opps! something went wrong";
        }
    }

    public function report()
    {
        return view('admin.order.report');
    }

    public function getCommission(Request $request)
    {
        try{
            $clauses = "";
            if(!empty($request->dateFrom)){
                $clauses .= "AND o.date BETWEEN '$request->dateFrom' AND '$request->dateTo'";
            }
            $query = DB::select("SELECT
                                    c.id,
                                    concat_ws('-', c.customer_code, c.name) AS customer_name,
                                    SUM(o.total) as paid
                                FROM orders o
                                JOIN users c ON c.id = o.customer_id
                                WHERE c.customer_type != 'Wholesale' 
                                $clauses
                                GROUP BY id");

            return $query;
        }catch(\Throwable $e){
            return "Opps! something went wrong";
        }
    }
} 
