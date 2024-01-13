<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function storeReview(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'rating' => 'required',
            'worker_id' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        $input = $request->all();

        try {
            $input['customer_id'] = Auth::guard('web')->user()->id;

            Review::create($input);
            return redirect()->back()->with('success', 'Thanks for your feedback.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Oops! something went wrong.');
        }
    }
}
