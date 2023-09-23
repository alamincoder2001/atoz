<?php

namespace App\Http\Controllers\Admin;

use App\District;
use Carbon\Carbon;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
            ->pluck('permissions')
            ->toArray();
        if (!in_array("districtEntry", $access)) {
            return view("admin.unauthorize");
        }
        return view("admin.bdgeocode.district");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = District::find($id);
        } else {
            $data = District::with('division')->get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $validator = Validator::make($request->all(), [
                    "name" => "required|unique:districts,name," . $request->id,
                    "division_id" => "required"
                ]);
                $data = District::find($request->id);
            } else {
                $validator = Validator::make($request->all(), [
                    "name" => "required|unique:districts",
                    "division_id" => "required"
                ]);
                $data = new District();
            }

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data->name        = $request->name;
            $data->division_id = $request->division_id;

            $data->save();

            if (!empty($request->id)) {
                return "District updated successfully";
            } else {
                return "District insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = District::find($request->id);
            $data->delete();
            return "District Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
