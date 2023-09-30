<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Banner;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (Auth::guard('admin')->user()->role != 'superadmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("bannerEntry", $access)) {
                return view("admin.unauthorize");
            }
        }
        return view("admin.banner.index");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Banner::find($id);
        } else {
            $data = Banner::get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "image" => "required|mimes:jpg,png,jpeg|dimensions:width=400,height=150'"
            ], ["image.dimensions" => "Image dimension must be 400px X 150px"]);

            if (!empty($request->id)) {
                $data = Banner::find($request->id);
                $old = $data->image;
                $data->updated_at = Carbon::now();
            } else {
                $data = new Banner();
                $data->created_at = Carbon::now();
            }

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data->title = $request->title;

            if ($request->hasFile("image")) {
                if (isset($old) && $old != "") {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                }
                $data->image = $this->imageUpload($request, 'image', 'uploads/banners') ?? '';
            }
            $data->save();

            if (!empty($request->id)) {
                return "Banner updated successfully";
            } else {
                return "Banner insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Banner::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return "Banner Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
