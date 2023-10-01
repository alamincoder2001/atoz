<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (Auth::guard('admin')->user()->role != 'SuperAdmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("serviceEntry", $access)) {
                return view("admin.unauthorize");
            }
        }
        return view("admin.service.index");
    }

    public function fetch($id = null)
    {
        $service_code = $this->generateCode("Service", "S");
        $data = DB::select("SELECT
                    s.*,
                    concat(s.service_code, '-', s.name) AS display_name,
                    c.name AS category_name
                FROM services s
                LEFT JOIN categories c ON c.id = s.category_id
                ORDER BY s.id DESC");

        return response()->json(["data" => $data, "service_code" => $service_code]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'error' => $validator->errors()]);
            }

            if (!empty($request->id)) {
                $data = Service::find($request->id);
                $old = $data->image;
                $data->updated_at = Carbon::now();
            } else {
                $data = new Service();
                $data->created_at = Carbon::now();
            }

            $data->service_code   = $request->service_code;
            $data->name           = $request->name;
            $data->slug           = $this->make_slug($request->name);
            $data->category_id    = $request->category_id;
            $data->description    = $request->description;

            if ($request->hasFile("image")) {
                if (isset($old) && $old != "") {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                }
                $data->image = $this->imageUpload($request, 'image', 'uploads/service') ?? '';
            }
            $data->save();

            if (!empty($request->id)) {
                return response()->json(['status' => true, 'msg' => 'Service updated successfully']);
            } else {
                return response()->json(['status' => true, 'msg' => 'Service insert successfully']);
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => true, 'msg' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Service::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return response()->json(['status' => true, 'msg' => 'Service Delete successfully']);
        } catch (\Throwable $e) {
            return response()->json(['status' => true, 'msg' => $e->getMessage()]);
        }
    }
}
