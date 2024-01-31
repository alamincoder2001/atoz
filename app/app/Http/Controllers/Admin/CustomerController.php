<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (!userAccess("customerList")) {
            return view("admin.unauthorize");
        }
        return view("admin.customer.index");
    }

    public function fetch($id = null)
    {
        return DB::select("SELECT
                        c.*,
                        up.name as thana_name,
                        d.name as district_name
                    FROM users c
                    LEFT JOIN thanas up ON up.id = c.thana_id
                    LEFT JOIN districts d ON d.id = up.district_id
                    ORDER BY c.id DESC");
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $old = $data->image;
        $nid = $data->nid_card;
        $license = $data->trade_license;
        $visiting = $data->visiting_card;
        if (File::exists($old)) {
            File::delete($old);
        }
        if (File::exists($nid)) {
            File::delete($nid);
        }
        if (File::exists($license)) {
            File::delete($license);
        }
        if (File::exists($visiting)) {
            File::delete($visiting);
        }
        $data->delete();
        return response()->json("Delete user successfully");
    }

    public function status(Request $request)
    {
        try {
            $data = User::find($request->id);
            $data->status = $request->setStatus;
            $data->save();
            return "Status change successfully";
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }
}
