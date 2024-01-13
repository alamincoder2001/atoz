<?php

namespace App\Http\Controllers;

use App\Models\HowToOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HowToOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function howToOrder()
    {
        $howToOrder = HowToOrder::latest()->first();
        return view('admin.howToOrder',compact('howToOrder'));
    }

    public function howToOrderUpdate(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            "thumbnail" => "nullable|dimensions:width=546,height=314"
        ], ["thumbnail.dimensions" => "Image dimension must be (546px x 314px)"]);

        if ($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $input = $request->all();

        try {
            $data = HowToOrder::find($request->id);

            if($request->file('thumbnail')){

                $old_thumbnail    = $data->thumbnail;
                if (!empty($old_thumbnail) && isset($old_thumbnail)) {
                    if (File::exists($old_thumbnail)) {
                        File::delete($old_thumbnail);
                    }
                }
                $input['thumbnail']  = $this->imageUpload($request, 'thumbnail', 'uploads/logo') ?? '';
            }else{
                unset($input['thumbnail']);
            }

            $data->update($input);

            return back()->with('success', 'Successfully Updated');
        } catch (\Throwable $th) {
            return back()->with('success', 'Update Failed!');
        }
    }

}
