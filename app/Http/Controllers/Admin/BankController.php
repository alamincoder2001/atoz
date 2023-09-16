<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.bank.index");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = BankAccount::find($id);
        } else {
            $data = DB::select("SELECT ba.*, (CASE WHEN(ba.status = 'a') THEN 'Active' ELSE 'Inactive'END) AS status_text FROM  bank_accounts ba");
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $data = BankAccount::find($request->id);
                $data->updated_at = Carbon::now();
            } else {
                $data = new BankAccount();
                $data->created_at = Carbon::now();
            }

            $data->bank_name      = $request->bank_name;
            $data->account_name   = $request->account_name;
            $data->account_number = $request->account_number;
            $data->branch_name    = $request->branch_name;
            $data->status         = $request->status;
            $data->save();

            if (!empty($request->id)) {
                return "BankAccount updated successfully";
            } else {
                return "BankAccount insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = BankAccount::find($request->id);
            $data->delete();
            return "BankAccount Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}

