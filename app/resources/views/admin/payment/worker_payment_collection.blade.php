@extends("layouts.backend_master")

@section("title")
    Payment Collection
@endsection
@section("breadcrumb_title", "Payment Collection")
@section("breadcrumb_item", "Payment Collection")

@section("content")
    <worker-payment
        admin_id="{{Auth::guard('admin')->user()->id}}"
        role="{{Auth::guard('admin')->user()->role}}">
    </worker-payment>
@endsection
