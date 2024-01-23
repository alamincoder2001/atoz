<?php

namespace App\Http\Controllers\Admin;

use App\Thana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ThanaContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (!userAccess("thanaEntry")) {
            return view("admin.unauthorize");
        }
        return view("admin.bdgeocode.thana");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Thana::find($id);
        } else {
            $data = Thana::with('district')->orderBy('name', 'asc')->get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name"        => "required",
                "district_id" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            if (!empty($request->id)) {
                $data = Thana::find($request->id);
            } else {
                $data = new Thana();
            }
            $data->name        = $request->name;
            $data->charge      = $request->charge;
            $data->district_id = $request->district_id;

            $data->save();

            if (!empty($request->id)) {
                return "Thana updated successfully";
            } else {
                return "Thana insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Thana::find($request->id);
            $data->delete();
            return "Thana Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
