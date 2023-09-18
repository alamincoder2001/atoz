<?php

namespace App\Http\Controllers\Admin;

use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create()
    {
        // $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
        //     ->pluck('permissions')
        //     ->toArray();
        // if (!in_array("userEntry", $access)) {
        //     return view("admin.unauthorize");
        // }
        return view("admin.worker.create");
    }

    public function index()
    {
        $data = Worker::latest()->get();

        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|min:3|max:30',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()
            ]);
        }

        try {
            $data              = new Worker();
            $data->name        = $request->name;
            $data->mobile      = $request->mobile;
            $data->father_name = $request->father_name;
            $data->mother_name = $request->mother_name;
            $data->district_id = $request->district_id;
            $data->thana_id    = $request->thana_id;
            $data->address     = $request->address;
            $data->reference   = $request->reference;
            if ($request->hasFile('image')) {
                $data->image    = $this->imageUpload($request, 'image', 'uploads/admins');
            }
            $data->save();


            return response()->json([
                'status'  => true,
                'msg' => 'Yea! Worker Added Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|min:3|max:30',
            'mobile' => 'required|unique:workers,mobile,' . $request->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()
            ]);
        }

        try {
            $data = Worker::find($request->id);

            $data->name        = $request->name;
            $data->mobile      = $request->mobile;
            $data->father_name = $request->father_name;
            $data->mother_name = $request->mother_name;
            $data->district_id = $request->district_id;
            $data->thana_id    = $request->thana_id;
            $data->address     = $request->address;
            $data->reference   = $request->reference;
            if ($request->hasFile('image')) {
                if (File::exists($data->image)) {
                    File::delete($data->image);
                }
                $data->image    = $this->imageUpload($request, 'image', 'uploads/workers');
            }
            $data->update();

            return response()->json([
                'status'  => true,
                'msg' => 'Yea! Worker Updated Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $worker_id = Worker::find($request->id);

            $worker_id->delete();
            return response()->json([
                'status'  => true,
                'msg' => 'Worker Delete successfully'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
}
