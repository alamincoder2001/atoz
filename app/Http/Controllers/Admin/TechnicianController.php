<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Technician;
use Illuminate\Support\Facades\File;

class TechnicianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.technician.index");
    }

    public function fetch($id = null)
    {
        return DB::select("SELECT
                            t.*,
                            up.name AS thana_name,
                            d.name AS district_name
                        FROM technicians t
                        LEFT JOIN thanas up ON up.id = t.thana_id
                        LEFT JOIN districts d ON d.id = up.district_id
                        ORDER BY t.id DESC");
    }

    public function destroy($id)
    {
        $data = Technician::find($id);
        $old = $data->image;
        if (File::exists($old)) {
            File::delete($old);
        }
        $data->delete();
        return response()->json("Delete technician successfully");
    }

    public function status(Request $request)
    {
        try{
            $data = Technician::find($request->id);
            $data->status = $request->setStatus;
            $data->save();
            return "Status change successfully";
        }catch(\Throwable $e){
            return "Opps! something went wrong";
        }
    }

    public function rating(Request $request)
    {
        try{
            $data = Technician::find($request->id);
            $data->admin_rating = $request->rating;
            $data->save();
            return "Rating change successfully";
        }catch(\Throwable $e){
            return "Opps! something went wrong";
        }
    }
}
