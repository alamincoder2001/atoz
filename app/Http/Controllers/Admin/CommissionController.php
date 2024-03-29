<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function list()
    {
        if (!userAccess("commissionList")) {
            return view("admin.unauthorize");
        }
        return view('admin.commission.list');
    }

    public function fetch(Request $request)
    {
        try {
            $clauses = "";
            if (!empty($request->managerId)) {
                $clauses .= " AND cm.manager_id = '$request->managerId'";
            }
            if (!empty($request->workerId)) {
                $clauses .= " AND cm.worker_id = '$request->workerId'";
            }

            if (!empty($request->dateFrom)) {
                $clauses .= " AND cm.payment_date BETWEEN '$request->dateFrom' AND '$request->dateTo'";
            }

            $query = DB::select("SELECT
                        cm.*,
                        concat(w.name, '(Worker)') as worker_name,
                        concat(am.name, '(Area Manager)') as manager_name
                        FROM commissions cm
                        LEFT JOIN workers w ON w.id = cm.worker_id
                        LEFT JOIN admins am ON am.id = cm.manager_id
                        WHERE 1 = 1 $clauses");
            return $query;
        } catch (\Throwable $e) {
            return "Opps! something went wrong" . $e->getMessage();
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
