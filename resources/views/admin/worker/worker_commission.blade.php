@extends("layouts.backend_master")

@section("title")
    Worker Commission
@endsection
@section("breadcrumb_title", "Worker Commission")
@section("breadcrumb_item", "Worker Commission")

@section("content")
    <worker-commission
        admin_id="{{Auth::guard('admin')->user()->id}}"
        role="{{Auth::guard('admin')->user()->role}}">
    </worker-commission>
@endsection
