<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.category.subcategory");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Subcategory::find($id);
        } else {
            $data = Subcategory::with('category')->get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $validator = Validator::make($request->all(), [
                    "name" => "required|unique:subcategories,name," . $request->id,
                    "category_id" => "required"
                ]);
                $data = Subcategory::find($request->id);
                $old = $data->image;
                $data->updated_at = Carbon::now();
            } else {
                $validator = Validator::make($request->all(), [
                    "name" => "required|unique:subcategories",
                    "category_id" => "required"
                ]);
                $data = new Subcategory();
                $data->created_at = Carbon::now();
            }

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data->name        = $request->name;
            $data->slug        = Str::slug($request->name);
            $data->category_id = $request->category_id;
            if ($request->hasFile("image")) {
                if (isset($old) && $old != "") {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                }
                $data->image = $this->imageUpload($request, 'image', 'uploads/subcategories') ?? '';
            }
            $data->save();

            if (!empty($request->id)) {
                return "Subcategory updated successfully";
            } else {
                return "Subcategory insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Subcategory::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return "Subcategory Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
