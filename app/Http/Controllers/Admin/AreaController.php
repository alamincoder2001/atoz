<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (!userAccess("AreaEntry")) {
            return view("admin.unauthorize");
        }
        return view("admin.bdgeocode.area");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Area::find($id);
        } else {
            $data = Area::with('upazila')->get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $validator = Validator::make($request->all(), [
                    "name" => "required",
                    "upazila_id" => "required"
                ]);
                $data = Area::find($request->id);
            } else {
                $validator = Validator::make($request->all(), [
                    "name" => "required",
                    "upazila_id" => "required"
                ]);
                $data = new Area();
            }

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data->name        = $request->name;
            $data->upazila_id = $request->upazila_id;

            $data->save();

            if (!empty($request->id)) {
                return "Area updated successfully";
            } else {
                return "Area insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Area::find($request->id);
            $data->delete();
            return "Area Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
