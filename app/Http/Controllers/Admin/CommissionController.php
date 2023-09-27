<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getCommission(Request $request)
    {
        try {
            $clauses = "";
            if (!empty($request->month)) {
                $clauses .= " AND DATE_FORMAT(o.date, '%Y-%m') = '$request->month'";
            }
            if (!empty($request->managerThana)) {
                $clauses .= " AND c.thana_id = '$request->managerThana'";
            }
            $query = DB::select("SELECT c.id,
                                    concat_ws('-', c.customer_code, c.name) AS customer_name,
                                    SUM(o.subtotal) as subtotal
                                    FROM orders o
                                    JOIN users c ON c.id = o.customer_id
                                    WHERE o.status = 'complete' 
                                    $clauses
                                    GROUP BY id");
            return $query;
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function payCommission(Request $request)
    {
        try {
            if (isset($request->manager_id)) {
                $check = DB::select("SELECT * FROM commissions cm WHERE DATE_FORMAT(cm.payment_date, '%Y-%m') = ? AND cm.manager_id = ?", [$request->month, $request->manager_id]);
            } else {
                $check = DB::select("SELECT * FROM commissions cm WHERE DATE_FORMAT(cm.payment_date, '%Y-%m') = ? AND cm.worker_id = ?", [$request->month, $request->worker_id]);
            }
            if (count($check) == 0) {
                $data = new Commission();
            } else {
                $data = Commission::find($check[0]->id);
                $data->updated_at = Carbon::now();
            }
            $data->payment_date = date('Y-m-d');
            $data->manager_id = isset($request->manager_id) ? $request->manager_id : null;
            $data->worker_id = isset($request->worker_id) ? $request->worker_id : null;
            $data->amount = $request->amount;
            $data->save();

            return response()->json(['status' => true, 'msg' => 'Commission payment successfully']);
        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }
}