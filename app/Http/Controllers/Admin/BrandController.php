<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.brand.index");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Brand::find($id);
        } else {
            $data = Brand::get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $validator = Validator::make($request->all(), [
                    "name" => "required|unique:brands,name," . $request->id,
                    "image" => "dimensions:width=188,height=74"
                ], ["image.dimensions" => "Image dimension must be 188px X 74px"]);
                $data = Brand::find($request->id);
                $old = $data->image;
                $data->updated_at = Carbon::now();
            } else {
                $validator = Validator::make($request->all(), [
                    "name" => "required|unique:brands",
                    "image" => "dimensions:width=188,height=74"
                ], ["image.dimensions" => "Image dimension must be 188px X 74px"]);
                $data = new Brand();
                $data->created_at = Carbon::now();
            }

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data->name = $request->name;
            $data->slug = Str::slug($request->name);
            if ($request->hasFile("image")) {
                if (isset($old) && $old != "") {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                }
                $data->image = $this->imageUpload($request, 'image', 'uploads/brands') ?? '';
            }
            $data->save();

            if (!empty($request->id)) {
                return "Brand updated successfully";
            } else {
                return "Brand insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Brand::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return "Brand Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
