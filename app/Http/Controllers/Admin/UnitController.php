<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.unit.index");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Unit::find($id);
        } else {
            $data = Unit::get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name"        => "required",
            ],["name.required" => "Unit name required"]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            if (!empty($request->id)) {
                $data = Unit::find($request->id);
            } else {
                $data = new Unit();
            }
            $data->name        = $request->name;

            $data->save();

            if (!empty($request->id)) {
                return "Unit updated successfully";
            } else {
                return "Unit insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Unit::find($request->id);
            $data->delete();
            return "Unit Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
